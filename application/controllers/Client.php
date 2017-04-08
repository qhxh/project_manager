<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*  
 *  @author : Joyonto Roy
 *  date    : 1 March, 2015
 *  http://codecanyon.net/user/Creativeitem
 *  http://creativeitem.com
 */

class Client extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();

        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    // default function, redirects to login page if no client logged in yet

    public function index() {
        if ($this->session->userdata('client_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('client_login') == 1)
            redirect(base_url() . 'index.php?client/dashboard', 'refresh');
    }

    
    // client dashboard

    function dashboard() {
        if ($this->session->userdata('client_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('client_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    // project management 

    function project($param1 = '', $param2 = '') {
        if ($this->session->userdata('client_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $page_data['page_name'] = 'project';
        $page_data['page_title'] = get_phrase('manage_project');
        $this->load->view('backend/index', $page_data);
    }

    // crud for sidebar todo list
    function todo($task = '', $todo_id = '', $swap_with = '') {
        
        if($task == 'add')
            $this->crud_model->add_todo();
        
        if($task == 'reload')
            $this->load->view('backend/todo_body');

        if($task == 'reload_incomplete_todo')
            $this->crud_model->get_incomplete_todo();
        
        if($task == 'mark_as_done')
            $this->crud_model->mark_todo_as_done($todo_id);
        
        if($task == 'mark_as_undone')
            $this->crud_model->mark_todo_as_undone($todo_id);
        
        if($task == 'swap')
            $this->crud_model->swap_todo($todo_id, $swap_with);
        
        if($task == 'delete')
            $this->crud_model->delete_todo($todo_id);
    }


    // project room : wall, files, tasks, milestones,notes
    function projectroom($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('client_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'wall') {
            $page_data['room_page']    = 'project_wall';
            $page_data['project_code'] = $param2; 
        }

        else if ($param1 == 'file') {
            $page_data['room_page']    = 'project_file';
            $page_data['project_code'] = $param2;
        }

        else if ($param1 == 'timesheet') {
            $page_data['room_page'] = 'project_timesheet';
            $page_data['project_code'] = $param2;
        }

        else if ($param1 == 'payment') {
            $page_data['room_page'] = 'project_payment';
            $page_data['project_code'] = $param2;
        }
        // projectroom tasks
        else if ($param1 == 'bug') {
            $page_data['room_page'] = 'project_bug';
            $page_data['project_code'] = $param2;
        }
        else if ($param1 == 'overview') {
            $page_data['room_page'] = 'project_overview';
            $page_data['project_code'] = $param2;
        }

        $page_data['page_name']   = 'project_room'; 
        $page_data['page_title']  = get_phrase('project_room');
        $page_data['page_title'] .=  " : " . $this->db->get_where('project',array('project_code'=>$param2))->row()->title;
        $this->load->view('backend/index', $page_data);
    }

    function project_message($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('client_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($this->session->userdata('client_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'add') {
            $this->crud_model->create_project_message($param2);  // param2 = project_code
        }

        if ($param1 == 'download') {
            $this->crud_model->download_project_message_file($param2);
        }
    }
     // projectroom bug
    function project_bug($param1 = '', $param2 = '', $param3 = '') 
    {
        /*if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }*/

        if ($param1 == 'create') 
        {
            $this->crud_model->create_project_bug($param2);  // param2 = project_code
        } 
        else if ($param1 == 'edit') 
        {
            $this->crud_model->update_project_bug($param2); // param2 = project_bug_id
        } 
        else if ($param1 == 'delete') 
        {
            $this->crud_model->delete_project_bug($param2); // param2 = project_bug_id
        }
    }
    function reload_projectroom_wall($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/client/project_wall' , $page_data);
    }
     // reloads the projectroom bug body 
    function reload_projectroom_bug($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/client/project_bug' , $page_data);
    }

    function project_file($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('client_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'upload')
            $this->crud_model->upload_project_file($param2); // param2 = project_code

        else if ($param1 == 'dropzone_upload') {
            $this->crud_model->dropzone_upload($param2); // param2 = project_code
        }

        else if ($param1 == 'dropbox_upload') {
            $this->crud_model->dropbox_upload($param2); // param2 = project_code

        }

        else if ($param1 == 'download')
            $this->crud_model->download_project_file($param2); // param2 = project_file_id

        else if ($param1 == 'delete')
            $this->crud_model->delete_project_file($param2); // param2 = project_file_id
    }

    function reload_projectroom_file($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/client/project_file' , $page_data);
    }

    function reload_projectroom_file_list($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/client/project_file_list' , $page_data);
    }

    function project_milestone($param1 = '' , $param2 = '' , $param3 = '') {
        if ($this->session->userdata('client_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'add') {
            $this->crud_model->add_project_milestone($param2); // param2 = project code
        }

        if ($param1 == 'edit') {
            $this->crud_model->edit_project_milestone($param2); // param2 = project milestone id
        }

        if ($param1 == 'delete') {
            $this->crud_model->delete_project_milestone($param2); // param2 = project milestone id
        }

        if ($param1 == 'take_manual_payment') {
            $this->crud_model->take_project_milestone_manual_payment($param2); // param2 = project milestone id
        }
    }

    function reload_projectroom_payment($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/client/project_payment' , $page_data);
    }

    // note lists, ajax based ( similar to ios note )
    function note($param1 = '', $param2 = '' , $param3 = '') {

        if ($this->session->userdata('client_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($this->session->userdata('client_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'save') {
            $this->crud_model->save_note($param2); // param2 = note id
        }

        if ($param1 == 'delete') {
            $this->crud_model->delete_note($param2); // param2 = note id
        }

        $page_data['page_name']     = 'note';
        $page_data['page_title']    = get_phrase('notes');
        $this->load->view('backend/index', $page_data);
    }

    // create note and reply the created note_id, to reload via ajax and activate that blank note
    function create_note() {
        $this->crud_model->create_note();
    }

    function reload_notes_tab_body($note_id = '') {
        $note_data['active_note_id'] = $note_id;
        $this->load->view('backend/client/notes_tab_body' , $note_data);
    }


    // redirection checking after paypal terminal
    function paypal_payment($param1 = '' , $project_code = '') {
        
        if ($param1 == 'cancel') {
            $this->session->set_flashdata('paypal_cancel', 'true');
        }
        if ($param1 == 'success') {
            $this->session->set_flashdata('paypal_success', 'true');
        }

        redirect(base_url() . 'index.php?client/projectroom/payment/' . $project_code, 'refresh');
    }
    // client payment history
    function payment_history() {

        if ($this->session->userdata('client_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        $page_data['page_title'] =   get_phrase('payment_history');
        $page_data['page_name']  = 'payment_history';
        $this->load->view('backend/index', $page_data);
    }

    /* support ticket */

    function support_ticket($param1 = '', $param2 = '', $param3 = '') {
        
        if ($this->session->userdata('client_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create')
            $this->crud_model->create_support_ticket();

        $page_data['page_title'] =   get_phrase('support_ticket');
        $page_data['page_name']  = 'support_ticket';
        $this->load->view('backend/index', $page_data);
    }

    function support_ticket_view($ticket_code = '') {
        

        $page_data['ticket_code'] = $ticket_code;
        $page_data['page_name'] = 'support_ticket_view';
        $page_data['page_title'] = get_phrase('support_ticket');
        $this->load->view('backend/index', $page_data);
    }

    function support_ticket_post_reply($ticket_code = '') {
        $this->crud_model->post_ticket_reply($ticket_code);
    }

    function reload_support_ticket_list( ) {
        $this->load->view('backend/client/support_ticket_list');
    }

    function reload_support_ticket_view_body($ticket_code = '') {
        $page_data['ticket_code'] = $ticket_code;
        $this->load->view('backend/client/support_ticket_view_body', $page_data);
    }

    function support_ticket_create() {
        

        $page_data['page_name'] = 'support_ticket_create';
        $page_data['page_title'] = get_phrase('create_new_ticket');
        $this->load->view('backend/index', $page_data);
    }
    

    
    function project_quote($param1 = '', $param2 = '') 
    {
        if ($this->session->userdata('client_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create') {
            $this->crud_model->create_project_quote();
        }

        $page_data['page_name']     = 'project_quote';
        $page_data['page_title']    = get_phrase('manage_project_quote');
        $this->load->view('backend/index', $page_data);
    }
    function project_quote_view($quote_id = '') {

        if ($this->session->userdata('client_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        $page_data['quote_id']   = $quote_id;
        $page_data['page_name']  = 'project_quote_view';
        $page_data['page_title'] = get_phrase('project_quote');
        $this->load->view('backend/index', $page_data);
    }
    function project_quote_post_reply($quote_id = '') {
        $this->crud_model->post_quote_reply($quote_id);
    }
    function reload_quote_message_view_body($quote_id = '') {
        $page_data['quote_id'] = $quote_id;
        $this->load->view('backend/admin/project_quote_view_body', $page_data);
    }
    function reload_project_quote_list() 
    {
        $this->load->view('backend/admin/project_quote_list');
    }


    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('client_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?client/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?client/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name'] = $param1;
        $page_data['page_name'] = 'message';
        $page_data['page_title'] = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }

/*     * ****MANAGE OWN PROFILE AND CHANGE PASSWORD** */

    function manage_profile($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('client_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'update_profile_info') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('address');
            $data['phone'] = $this->input->post('phone');
            $data['website'] = $this->input->post('website');
            $data['skype_id'] = $this->input->post('skype_id');
            $data['facebook_profile_link'] = $this->input->post('facebook_profile_link');
            $data['linkedin_profile_link'] = $this->input->post('linkedin_profile_link');
            $data['twitter_profile_link'] = $this->input->post('twitter_profile_link');
            $client_id = $this->session->userdata('login_user_id');

            $this->db->where('client_id', $client_id);
            $this->db->update('client', $data);
            move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/client_image/" . $client_id . '.jpg');

            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?client/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $current_password_input = sha1($this->input->post('password'));
            $new_password = sha1($this->input->post('new_password'));
            $confirm_new_password = sha1($this->input->post('confirm_new_password'));

            $current_password_db = $this->db->get_where('client', array('client_id' =>
                        $this->session->userdata('login_user_id')))->row()->password;

            if ($current_password_db == $current_password_input && $new_password == $confirm_new_password) {
                $this->db->where('client_id', $this->session->userdata('login_user_id'));
                $this->db->update('client', array('password' => $new_password));
            }
            redirect(base_url() . 'index.php?client/manage_profile/', 'refresh');
        }
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data'] = $this->db->get_where('client', array(
                    'client_id' => $this->session->userdata('login_user_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /******************************qhxh code notification ******************************************/
    function notification()
    {
      $this->load->model('qh_notification_model');
    //data
      $page_data['all_categories'] = $this->qh_notification_model->get_notify();
      $page_data['num_cats'] = $this->qh_notification_model->count_new_notify();
      //page setting
      $page_data['page_name'] = 'notification';
      $page_data['page_title'] = get_phrase('manager_notify');

      $this->load->view('backend/index', $page_data);
    }
     
}