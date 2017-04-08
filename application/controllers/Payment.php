<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {
        
    }

    /*
     * 	$method		=	paypal/skrill/2CO/mastercard
     */

    function pay_invoice() {
        if ($this->session->userdata('client_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        $method = $this->input->post('method');

        if ($method == 'paypal')
            $this->paypal_payment();
    }

    // param1 = project_milestone_id
    function paypal_payment($project_milestone_id = '') {

        $paypal_email           =   $this->db->get_where('settings', array('type' => 'paypal_email'))->row()->description;
        $system_currency_id     =   $this->db->get_where('settings' , array('type'=>'system_currency_id'))->row()->description;
        $currency_code          =   $this->db->get_where('currency' , array('currency_id'=>$system_currency_id))->row()->currency_code;
        
        $invoice_title          =   $this->db->get_where('project_milestone', array('project_milestone_id' => $project_milestone_id))->row()->title;
        $total_amount           =   $this->db->get_where('project_milestone', array('project_milestone_id' => $project_milestone_id))->row()->amount;
        $project_code           =   $this->db->get_where('project_milestone', array('project_milestone_id' => $project_milestone_id))->row()->project_code;
        
        /** **TRANSFERRING USER TO PAYPAL TERMINAL*** */
        $this->paypal->add_field('rm', 2);
        $this->paypal->add_field('no_note', 0);
        $this->paypal->add_field('item_name', $invoice_title);
        $this->paypal->add_field('amount', $total_amount);
        $this->paypal->add_field('currency_code', $currency_code);
        $this->paypal->add_field('custom', $project_milestone_id);
        $this->paypal->add_field('business', $paypal_email);
        $this->paypal->add_field('notify_url', base_url() . 'index.php?payment/paypal_ipn');
        $this->paypal->add_field('cancel_return', base_url() . 'index.php?client/paypal_payment/cancel/' . $project_code);
        $this->paypal->add_field('return', base_url() . 'index.php?client/paypal_payment/success/' . $project_code);

        $this->paypal->submit_paypal_post();
    }

    // confirm paypal payment internally and preserve payment info into db via ipn call
    function paypal_ipn() {
        if ($this->paypal->validate_ipn() == true) {
            $ipn_response = '';
            foreach ($_POST as $key => $value) {
                $value = urlencode(stripslashes($value));
                $ipn_response .= "\n$key=$value";
            }

            $project_milestone_id   =   $_POST['custom'];
            //update the project milestone status
            $data['status'] = 1;
            $this->db->where('project_milestone_id', $project_milestone_id);
            $this->db->update('project_milestone', $data);

            //create new payment entry
            $data2['type']           =   'income';
            $data2['amount']         =   $this->db->get_where('project_milestone' , array('project_milestone_id' => $project_milestone_id))->row()->amount;
            $data2['title']          =   $this->db->get_where('project_milestone' , array('project_milestone_id' => $project_milestone_id))->row()->title;
            $data2['payment_method'] =   'paypal';
            $data2['description']    =   $ipn_response;
            $data2['project_code']   =   $this->db->get_where('project_milestone' , array('project_milestone_id' => $project_milestone_id))->row()->project_code;
            $data2['timestamp']      =   strtotime(date("m/d/Y"));
            $data2['milestone_id']   =   $project_milestone_id;
            $data2['client_id']      =   $this->session->userdata('login_user_id');
            $this->db->insert('payment', $data2);

            // notify client with payment confirmation
            $this->email_model->notify_email('payment_completion_notification', $data2['project_code'] , $project_milestone_id , 'admin');
        }
    }

    function stripe_payment($param1 = '', $param2 = '') {

        if ($this->session->userdata('client_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'pay') {
            require_once(APPPATH . 'libraries/stripe-php/init.php');
            $stripe_api_key = $this->db->get_where('settings' , array('type' => 'stripe_api_key'))->row()->description;
            \Stripe\Stripe::setApiKey($stripe_api_key); //system payment settings
            try {
                if (!isset($_POST['stripeToken']))
                    throw new Exception("The Stripe Token was not generated correctly");

                $currency_id          = $this->db->get_where('settings', array('type' => 'system_currency_id'))->row()->description;
                $currency_code        = $this->db->get_where('currency', array('currency_id' => $currency_id))->row()->currency_code;
                $project_milestone_id = $param2;
                $amount               = $this->db->get_where('project_milestone' , array('project_milestone_id' => $project_milestone_id))->row()->amount;
                $amount              *= 100;
                $client_email       =   $this->db->get_where('client' , array('client_id' => $this->session->userdata('login_user_id')))->row()->email;

                $customer = \Stripe\Customer::create(array(
                    'email' => $client_email, // client email id
                    'card'  => $_POST['stripeToken']
                ));

                $charge = \Stripe\Charge::create(array(
                    'customer'  => $customer->id,
                    'amount'    => $amount,
                    'currency'  => $currency_code
                ));

                //update the project milestone status
                $data['status'] = 1;
                $this->db->where('project_milestone_id', $project_milestone_id);
                $this->db->update('project_milestone', $data);

                //create new payment entry
                $data2['type']           =   'income';
                $data2['amount']         =   $this->db->get_where('project_milestone' , array('project_milestone_id' => $project_milestone_id))->row()->amount;
                $data2['title']          =   $this->db->get_where('project_milestone' , array('project_milestone_id' => $project_milestone_id))->row()->title;
                $data2['payment_method'] =   'stripe';
                $data2['project_code']   =   $this->db->get_where('project_milestone' , array('project_milestone_id' => $project_milestone_id))->row()->project_code;
                $data2['timestamp']      =   strtotime(date("m/d/Y"));
                $data2['milestone_id']   =   $project_milestone_id;
                $data2['client_id']      =   $this->session->userdata('login_user_id');
                $this->db->insert('payment', $data2);

                // notify admins with payment confirmation
                $this->email_model->notify_email('payment_completion_notification', $data2['project_code'] , $project_milestone_id , 'admin');

                $error = '';
                $this->session->set_flashdata('flash_message', get_phrase('your_payment_was_successful.'));
                redirect(base_url() . 'index.php?client/projectroom/payment/' . $data2['project_code'], 'refresh');
            } catch (Exception $e) {
                $error = $e->getMessage();
                $this->session->set_flashdata('flash_message', $error);
            }
        }

        $page_data['project_milestone_id']    = $param1;
        $page_data['page_name']               = 'project_milestone_stripe_pay';
        $page_data['page_title']              = get_phrase('stripe_payment');
        $this->load->view('backend/index', $page_data);
    }

}