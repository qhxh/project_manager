<?php
define('ENVIRONMENT', 'development');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 	
 * 	@author : Joyonto Roy
 * 	date	: 1 March, 2015
 * 	http://codecanyon.net/user/Creativeitem
 * 	http://creativeitem.com
 */

class Staff extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();

        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    // default function, redirects to login page if no staff logged in yet

    public function index() {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('staff_login') == 1)
            redirect(base_url() . 'index.php?staff/dashboard', 'refresh');
    }

    // staff dashboard

    function dashboard() {
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('staff_dashboard');
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

        if ($this->session->userdata('staff_login') != 1) {
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

        else if ($param1 == 'task') {
            $page_data['room_page'] = 'project_task';
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

        else if ($param1 == 'note') {
            $page_data['room_page'] = 'project_note';
            $page_data['project_code'] = $param2;
        }

        else if ($param1 == 'overview') {
            $page_data['room_page'] = 'project_overview';
            $page_data['project_code'] = $param2;
        }
         // projectroom tasks
        else if ($param1 == 'bug') {
            $page_data['room_page'] = 'project_bug';
            $page_data['project_code'] = $param2;
        }

        else if ($param1 == 'edit') {
            $page_data['room_page'] = 'project_edit';
            $page_data['project_code'] = $param2;
        }

        // QHXH code : cap nhat tien do du an
        else if ($param1 == 'project_staff_progress') {
            $page_data['room_page'] = 'project_staff_progress';
            $page_data['project_code'] = $param2;
        }


        $page_data['page_name']   = 'project_room'; 
        $page_data['page_title']  = get_phrase('project_room');
        $page_data['page_title'] .=  " : " . $this->db->get_where('project',array('project_code'=>$param2))->row()->title;
        $this->load->view('backend/index', $page_data);
    }
    /*********************** qhxh code: update tien do nhan vien *************************/
    function project_staff_progress() {
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

       
            $progress_value = $_POST['progress_status'];
            $progress_staff = $_POST['progress_staff'];
            $progress_code = $_POST['progress_code'];
            //run model
            
            $this->crud_model->project_staff_progress_update($progress_value, $progress_staff, $progress_code);
            //update tong tien do du an
            $this->crud_model->project_sum_update($progress_code);
            
            //Lay thong tin du an vua khoi tao
            $current_project = $this->crud_model->get_one_project($progress_code);
             /************gui thong bao den nhan vien trong project*********************************/
             $this->load->model('qh_notification_model');
            $list_staffs = $this->crud_model->get_staff_in_project($progress_code);
            //gui thong bao cho nhan vien (quyen staff)
            foreach ($list_staffs as $staff) 
            {
                $notify_title = '<span class="text-danger"> ' . get_phrase('Staff'). ': ' . $this->session->userdata('name'). ' ' . get_phrase('nofify update progress') . '</span>';
                $notify_content = get_phrase('Staff') . ' ' . $this->session->userdata('name') . ' ';
                $notify_content.= 'vừa cập nhật tiến độ dự án ';
                $notify_content.= '<a href="'. base_url() .'index.php?staff/projectroom/overview/'. $progress_code .'" >'. $current_project->title .'</a>';
             
                $this->qh_notification_model->create_notify($staff,'staff',$notify_title,$notify_content,0);
            }

            //gui thong bao den tat ca admin
            $list_admin = $this->db->get('admin')->result_array();
            foreach ($list_admin as $admin ) 
            {
                $notify_title = '<span class="text-danger"> ' . get_phrase('Staff'). ': ' . $this->session->userdata('name') . ' ' . get_phrase('nofify update progress') . '</span>';
                $notify_content = get_phrase('Staff'). ' ' . $this->session->userdata('name') . ' ';
                $notify_content.= 'vừa cập nhật tiến độ dự án ';
                $notify_content.= '<a href="'. base_url() .'index.php?admin/projectroom/overview/'. $progress_code .'" >'. $current_project->title .'</a>';
                $this->qh_notification_model->create_notify($admin['admin_id'],'admin',$notify_title,$notify_content,0);
            }

            $this->session->set_flashdata('flash_message' , 'Cập nhật thành công');
            redirect(base_url() . 'index.php?staff/projectroom/project_staff_progress/' . $progress_code , 'refresh');
    }

    function reload_project_staff_progress($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/staff/project_staff_progress' , $page_data);
    }

    /************************************************************************************/
    function project_message($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($this->session->userdata('staff_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'add') {
            $this->crud_model->create_project_message($param2);  // param2 = project_code
        }

        if ($param1 == 'download') {
            $this->crud_model->download_project_message_file($param2);
        }
    }

    function reload_projectroom_wall($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/staff/project_wall' , $page_data);
    }

    function project_file($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('staff_login') != 1) {
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
        $this->load->view('backend/staff/project_file' , $page_data);
    }

    function reload_projectroom_file_list($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/staff/project_file_list' , $page_data);
    }

    function project_task($param1 = '', $param2 = '', $param3 = '') 
    {
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create') 
        {
            $this->crud_model->create_project_task($param2);  // param2 = project_id
        } 
        else if ($param1 == 'edit') 
        {
            $this->crud_model->update_project_task($param2); // param2 = project_task_id
        } 
        else if ($param1 == 'delete') 
        {
            $this->crud_model->delete_project_task($param2); // param2 = project_task_id
        }
    }

    function reload_projectroom_task($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/staff/project_task' , $page_data);
    }

    function project_note($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'save')
            $this->crud_model->save_project_note($param2); // param2 = project_code
    }

    function reload_projectroom_note($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/staff/project_note' , $page_data);
    }

    function reload_projectroom_edit($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/staff/project_edit' , $page_data);
    }
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
    // reloads the projectroom bug body 
    function reload_projectroom_bug($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/staff/project_bug' , $page_data);
    }
    // task create, manage, edit, delete, fileupload, subtask, reminder, staff assign
    function team_task($param1 = '', $param2 = '') {
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create') {
            $team_task_id = $this->crud_model->add_new_team_task();
            redirect(base_url() . 'index.php?staff/team_task_view/' . $team_task_id , 'refresh');
        }

        if ($param1 == 'edit') {
            $this->crud_model->edit_team_task($param2);
        }

        if ($param1 == 'mark_archived') {
            $this->db->where('team_task_id' , $param2);
            $this->db->update('team_task' , array('task_status' => 0));
            $this->session->set_flashdata('flash_message' , get_phrase('task_archived'));
            redirect(base_url() . 'index.php?staff/team_task_archived' , 'refresh');
        }

        if ($param1 == 'remove_from_archive') {
            $this->db->where('team_task_id' , $param2);
            $this->db->update('team_task' , array('task_status' => 1));
            $this->session->set_flashdata('flash_message' , get_phrase('removed_from_archive'));
            redirect(base_url() . 'index.php?staff/team_task' , 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('team_task_id' , $param2);
            $this->db->delete('team_task');
            $this->session->set_flashdata('flash_message' , get_phrase('task_deleted'));
            redirect(base_url() . 'index.php?staff/team_task' , 'refresh');
        }

        $page_data['page_name']     = 'team_task';
        $page_data['page_title']    = get_phrase('running_team_tasks');
        $this->load->view('backend/index', $page_data);
    }

    function team_task_archived($param1 = '' , $param2 = '') {
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']     = 'team_task_archived';
        $page_data['page_title']    = get_phrase('archived_team_tasks');
        $this->load->view('backend/index', $page_data);
    }

    function save_task_note($team_task_id = '') {
        $data['task_note']  =   $this->input->post('task_note');
        $this->db->where('team_task_id' , $team_task_id);
        $this->db->update('team_task' , array('task_note' => $data['task_note']));
    }

    function team_task_view($team_task_id = '') {
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $page_data['page_name']    =   'team_task_view';
        $page_data['team_task_id'] =   $team_task_id;
        $page_data['page_title']   =   get_phrase('team_task');
        $this->load->view('backend/index' , $page_data);
    }

    function team_task_file($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'upload')
            $this->crud_model->upload_team_task_file($param2); 

        else if ($param1 == 'download')
            $this->crud_model->download_team_task_file($param2); 

        else if ($param1 == 'delete')
            $this->crud_model->delete_team_task_file($param2); 
    }

    function reload_team_task_information($team_task_id = '') {
        $page_data['team_task_id'] =   $team_task_id;
        $this->load->view('backend/staff/team_task_information' , $page_data);
    }

    function reload_team_task_information_archived($team_task_id = '') {
        $page_data['team_task_id'] =   $team_task_id;
        $this->load->view('backend/staff/team_task_information_archived' , $page_data);
    }

    function reload_team_task_tab($team_task_id = '') {
        $page_data['team_task_id'] =   $team_task_id;
        $this->load->view('backend/staff/team_task_tab' , $page_data);
    }

    // note lists, ajax based ( similar to ios note )
    function note($param1 = '', $param2 = '' , $param3 = '') {

        if ($this->session->userdata('staff_login') != 1) {
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
        $this->load->view('backend/staff/notes_tab_body' , $note_data);
    }

    // accounting of client payment
    function accounting_client_payment($param1 = '', $param2 = '') {

        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $page_data['page_name']     = 'accounting_client_payment';
        $page_data['page_title']    = get_phrase('client_payments');
        $this->load->view('backend/index', $page_data);
    }

    // accounting of expenses
    function accounting_expense($param1 = '', $param2 = '') {

        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'add') {
            $this->crud_model->expense_add();
        }

        if ($param1 == 'edit') {
            $this->crud_model->expense_edit($param2); // param2 = payment id
        }

        if ($param1 == 'delete') {
            $this->crud_model->expense_delete($param2); // param2 = payment id
        }

        $page_data['page_name']     = 'accounting_expense';
        $page_data['page_title']    = get_phrase('manage_expenses');
        $this->load->view('backend/index', $page_data);
    }

    function reload_expense_list() {
        $this->load->view('backend/staff/expense_list');
    }

    // expense categories
    function accounting_expense_category($param1 = '' , $param2 = '') {

        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'add') {
            $this->crud_model->expense_category_add();
        }

        if ($param1 == 'edit') {
            $this->crud_model->expense_category_edit($param2); // param2 = expense category id
        }

        if ($param1 == 'delete') {
            $this->crud_model->expense_category_delete($param2); // param2 = expense category id
        }

        $page_data['page_name']     = 'accounting_expense_category';
        $page_data['page_title']    = get_phrase('expense_category');
        $this->load->view('backend/index', $page_data);

    }

    /* support ticket */

    function support_ticket($param1 = '', $param2 = '', $param3 = '') {
        
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create')
            $this->crud_model->create_support_ticket();

        if ($param1 == 'delete')
            $this->crud_model->delete_support_ticket($param2);   //param2 = ticket_code

        if ($param1 == 'assign_staff')
            $this->crud_model->support_ticket_assign_staff($param2); //param2 = ticket_code

        if ($param1 == 'update_status')
            $this->crud_model->support_ticket_update_status($param2); //param2 = ticket_code

        $page_data['page_title'] =   get_phrase('support_ticket');
        $page_data['page_name']  = 'support_ticket';
        $this->load->view('backend/index', $page_data);
    }

    function support_ticket_view($ticket_code = '') {
        
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $page_data['ticket_code'] = $ticket_code;
        $page_data['page_name'] = 'support_ticket_view';
        $page_data['page_title'] = get_phrase('support_ticket');
        $this->load->view('backend/index', $page_data);
    }

    function support_ticket_post_reply($ticket_code = '') {
        $this->crud_model->post_ticket_reply($ticket_code);
    }

    function reload_support_ticket_list( ) {
        $this->load->view('backend/staff/support_ticket_list');
    }

    function reload_support_ticket_view_body($ticket_code = '') {
        $page_data['ticket_code'] = $ticket_code;
        $this->load->view('backend/staff/support_ticket_view_body', $page_data);
    }

    

    function email_milestone_invoice($project_milestone_id) {
        
        $this->load->helper(array('dompdf', 'file'));
        
        $page_data['project_milestone_id']      =   $project_milestone_id;
        $html   =   $this->load->view('backend/staff/project_milestone_view_pdf' , $page_data , true);
        
        // generate pdf by dompdf
        $data = pdf_create($html, '', false);
        write_file('uploads/invoice.pdf', $data);
        $invoice_number =   $this->db->get_where('invoice' , array('invoice_id' => $invoice_id))->row()->invoice_number;
        $client_id      =   $this->db->get_where('invoice' , array('invoice_id' => $invoice_id))->row()->client_id;
        $client_email   =   $this->db->get_where('client' , array('client_id' => $client_id))->row()->email;
        
        // send the invoice to client email
        $this->email_model->do_email('' , 'invoice #'.$invoice_number , $client_email , NULL , 'uploads/invoice.pdf');
    }

	

    /* project management */

    function project($param1 = '', $param2 = '') {
        

        if ($param1 == 'create') {
            $project_code = $this->crud_model->create_project();
            $this->session->set_flashdata('flash_message' , get_phrase('project_created_successfully'));
            redirect(base_url() . 'index.php?staff/projectroom/wall/' . $project_code , 'refresh');
        }


        if ($param1 == 'edit') {
            $this->crud_model->update_project($param2);
            $this->session->set_flashdata('flash_message' , get_phrase('project_updated'));
            redirect(base_url() . 'index.php?staff/projectroom/edit/' . $param2 , 'refresh');
        }

        if ($param1 == 'delete')
            $this->crud_model->delete_project($param2);

        if ($param1 == 'mark_as_archive') {
            $this->db->where('project_code' , $param2);
            $this->db->update('project' , array('project_status' => 0));
        }

        if ($param1 == 'remove_from_archived') {
            $this->db->where('project_code' , $param2);
            $this->db->update('project' , array('project_status' => 1));
        }


        $page_data['page_name'] = 'project';
        $page_data['page_title'] = get_phrase('manage_project');
        $this->load->view('backend/index', $page_data);
    }

    function project_add() {
        
        $page_data['page_name'] = 'project_add';
        $page_data['page_title'] = get_phrase('create_new_project');
        $this->load->view('backend/index', $page_data);
    }

    

    function project_timer($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'edit') {
            $this->crud_model->update_project_timer($param2, $param3);  // param2 = timer_status 0stop 1start, param3 = project_id
        }

        if ($param1 == 'delete') {
            $this->crud_model->delete_project_timer($param2); // param2 = project timesheet id
        }
    }

    function reload_projectroom_timer($project_code = '') {
        $page_data['project_code'] =   $project_code;
        $this->load->view('backend/staff/project_timesheet' , $page_data);
    }
    
    function project_quote($param1 = '', $param2 = '') 
    {
        if ($this->session->userdata('staff_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        if ($param1 == "archive")
        {
            $this->crud_model->archive_project_quote($param2);
            $this->session->set_flashdata('flash_message' , get_phrase('data_archived_successfuly'));
            redirect('staff/project_quote');
        }
        
        if ($param1 == "unarchive")
        {
            $this->crud_model->unarchive_project_quote($param2);
            $this->session->set_flashdata('flash_message' , get_phrase('data_unarchived_successfuly'));
            redirect('staff/project_quote');
        }

        if ($param1 == 'delete')
            $this->crud_model->delete_project_quote($param2);

        $page_data['page_name']     = 'project_quote';
        $page_data['page_title']    = get_phrase('manage_project_quote');
        $this->load->view('backend/index', $page_data);
    }
    
    function reload_project_quote_list() 
    {
        $this->load->view('backend/staff/project_quote_list');
    }

    

    /* 	Client and company management */

    function client($param1 = '', $param2 = '') {
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create')
            $this->crud_model->create_client();

        if ($param1 == 'edit')
            $this->crud_model->update_client($param2);

        if ($param1 == 'delete')
            $this->crud_model->delete_client($param2);

        $page_data['page_name'] = 'client';
        $page_data['page_title'] = get_phrase('manage_client');
        $this->load->view('backend/index', $page_data);
    }

    function reload_client_list() {
        $this->load->view('backend/staff/client_list');
    }
    
    function pending_client($task = "", $client_pending_id = "")
    {
        if ($this->session->userdata('staff_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        if ($task == "approve")
        {
            $this->crud_model->approve_pending_client_info($client_pending_id);
            $this->session->set_flashdata('flash_message' , get_phrase('data_approved_successfuly'));
            redirect('staff/pending_client');
        }
        
        if ($task == "delete")
        {
            $this->crud_model->delete_pending_client_info($client_pending_id);
        }
        
        $page_data['page_name']     = 'pending_client';
        $page_data['page_title']    = get_phrase('manage_pending_client');
        $this->load->view('backend/index', $page_data);
    }
    
    function reload_pending_client_list()
    {
        $this->load->view('backend/staff/pending_client_list');
    }

    function company($param1 = '' , $param2 = '') {
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create') {
            $this->crud_model->create_company();
        }

        if ($param1 == 'edit') {
            $this->crud_model->edit_company($param2);
        }

        if ($param1 == 'delete') {
            $this->crud_model->delete_company($param2);
        }

        $page_data['page_name']     = 'company';
        $page_data['page_title']    = get_phrase('company');
        $this->load->view('backend/index', $page_data);
    }

    function reload_company_list()
    {
        $this->load->view('backend/staff/company_list');
    }

    /* 	staff management */

    function staff($param1 = '', $param2 = '') {
        
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create')
            $this->crud_model->create_staff();

        if ($param1 == 'edit')
            $this->crud_model->update_staff($param2);

        if ($param1 == 'delete')
            $this->crud_model->delete_staff($param2);

        $page_data['page_name'] = 'staff';
        $page_data['page_title'] = get_phrase('manage_staff');
        $this->load->view('backend/index', $page_data);
    }

    function reload_staff_list() {
        $this->load->view('backend/staff/staff_list');
    }

    /* 	account_role management */

    function account_role($param1 = '', $param2 = '') {
        
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create')
            $this->crud_model->create_account_role();

        if ($param1 == 'edit')
            $this->crud_model->update_account_role($param2);

        if ($param1 == 'delete')
            $this->crud_model->delete_account_role($param2);

        $page_data['page_name'] = 'account_role';
        $page_data['page_title'] = get_phrase('manage_account_role');
        $this->load->view('backend/index', $page_data);
    }

    function reload_account_role_list() {
        $this->load->view('backend/staff/account_role_list');
    }

    /* private messaging */
	function message($param1 = 'message_home' , $param2 = '' , $param3 = '')
	{
		if ($this->session->userdata('staff_login') != 1)
		{
			$this->session->set_userdata('last_page' , current_url());
			redirect(base_url(), 'refresh');
		}

		if ($param1 == 'send_new')
		{
			$message_thread_code 	=	$this->crud_model->send_new_private_message();
			$this->session->set_flashdata('flash_message' , get_phrase('message_sent!'));
			redirect(base_url().'index.php?staff/message/message_read/'.$message_thread_code, 'refresh');
		}

		if ($param1 == 'send_reply')
		{
			$this->crud_model->send_reply_message($param2);		//$param2 = message_thread_code
			$this->session->set_flashdata('flash_message' , get_phrase('message_sent!'));
			redirect(base_url().'index.php?staff/message/message_read/'.$param2, 'refresh');
		}

		if ($param1 == 'message_read')
		{
			$page_data['current_message_thread_code']  	= $param2;
			$this->crud_model->mark_thread_messages_read($param2);
		}
		
		$page_data['message_inner_page_name']  	= $param1;
		$page_data['page_name']  				= 'message';
		$page_data['page_title'] 				= get_phrase('private_messaging');
		$this->load->view('backend/index', $page_data);
	}

	/******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
			
        if ($param1 == 'update_profile_info') {
            $data['name']                   = $this->input->post('name');
            $data['email']                  = $this->input->post('email');
            $data['phone']                  = $this->input->post('phone');
            $data['skype_id']               = $this->input->post('skype_id');
            $data['facebook_profile_link']  = $this->input->post('facebook_profile_link');
            $data['linkedin_profile_link']  = $this->input->post('linkedin_profile_link');
            $data['twitter_profile_link']   = $this->input->post('twitter_profile_link');
            $staff_id                       = $this->session->userdata('login_user_id');
            
            $this->db->where('staff_id', $staff_id);
            $this->db->update('staff', $data);
            move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/staff_image/" . $staff_id . '.jpg');
            
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?staff/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $current_password_input			= sha1($this->input->post('password'));
            $new_password						= sha1($this->input->post('new_password'));
            $confirm_new_password			= sha1($this->input->post('confirm_new_password'));
            
            $current_password_db				= $this->db->get_where('staff', array( 'staff_id' => 
																	$this->session->userdata('login_user_id')))->row()->password;
																	
            if ($current_password_db == $current_password_input && $new_password == $confirm_new_password) {
                $this->db->where('staff_id', $this->session->userdata('login_user_id'));
                $this->db->update('staff', array('password' => $new_password));
            }
            redirect(base_url() . 'index.php?staff/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('staff', array(
            								'staff_id' => $this->session->userdata('login_user_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }


/**************************qhxh code : show all notification *************/
public function notification()
{
    //check user
     if ($this->session->userdata('staff_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
    
    $this->load->model('qh_notification_model');
    //data
      $current_user_id = $this->session->userdata('login_user_id');
      $page_data['all_notify'] = $this->qh_notification_model->get_notify($current_user_id, 'staff');
      $page_data['num_notify'] = $this->qh_notification_model->count_new_notify();
      //page setting
      $page_data['page_name'] = 'notification';
      $page_data['page_title'] = get_phrase('manager_notify');

      $this->load->view('backend/index', $page_data);
}

function delete_notify()
{
    //check user
     if ($this->session->userdata('staff_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
    /**********************************************************************/
    if ( $this->input->post( 'notify_delete_submit' ) )
    {
        $this->load->model('qh_notification_model'); //load resource
        
        if ( $this->input->post( 'notify_check' ) && is_array( $this->input->post( 'notify_check' ) ) )
        {
            foreach ($this->input->post( 'notify_check' ) as $checked ) 
            {
                $this->qh_notification_model->delete_notify($checked);
            }
            $this->session->set_flashdata('flash_message' , get_phrase('data_approved_successfuly'));
            
        }
    }
    redirect('staff/notification');
}
function notify_reload_list()
{
    $this->load->view('backend/admin/notification');
}
    
}