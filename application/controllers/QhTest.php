<?php
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class QhTest extends CI_Controller 
    {
    	function __construct()
    	{
    		parent::__construct();
    	}

    	public function index()
    	{
            echo 'fac';
    		$this->load->model('Qh_notification_model');
    		$receiver_id = 1;
    		$receiver_level = 3;
    		$content = "bạn đã được phân công một project";
            try
            {
                $this->Qh_notification_model->create_notify($receiver_id,$receiver_level,$content, 0);
                echo 'Add notify!';
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
    		
    	}
    }