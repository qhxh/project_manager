<?php
/**
 * @file(Qh_notification_model.php)
 * @author qhxh <[<email address>]>
 * Class model : Thao tac cac thong bao
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Qh_notification_model extends CI_Model
{
	private $table = 'notification';

	function __construct()
	{
		parent::__construct();
	}

	/**
	 *  Ham tao 1 thong bao
	 */
	function create_notify($receiver_id, $receiver_level,$title, $content , $status = 0)
	{
		$data =  array(
			'notify_title'		  => $title,
			'notify_content'	  => $content,
			'receiver_id' 		  => $receiver_id,
			'receiver_level'      => $receiver_level,
			'notify_time'         => date("h:i:sa m-d-Y"),
			'read_status'		  => $status
		);

		$this->db->insert($this->table, $data);
	}

	/**
	 * Dem tat ca cac thong bao moi cho user
	 * @param  int $receiver_id    id user
	 * @param  int $receiver_level level user 1:khach hang 2:staff 3:admin
	 * @return int  so thong bao moiw nhat chua doc
	 */
	function count_new_notify($receiver_id, $receiver_level)
	{
		$this->db->where('receiver_id', $receiver_level);
		$this->db->where('receiver_level', $receiver_level);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	/**
	 * [get_notify description]
	 * @param  [type] $receiver_id    [description]
	 * @param  [type] $receiver_level [description]
	 * @param  [type] $num_rows       [description]
	 * @return [type]                 [description]
	 */
	function get_notify($receiver_id, $receiver_level, $num_rows = 0)
	{
		$where = array(
			'receiver_id' => $receiver_id,
			'receiver_level' => $receiver_level
		);
        if ( $num_rows == 0 )
		  return $this->db->get_where($this->table, $where, $num_rows)->result_array();
        else
          return $this->db->get_where($this->table, $where)->result_array();
	}
    
    function delete_notify($notify_id)
    {
        $this->db->where('notify_id', $notify_id);
        $this->db->delete($this->table);
    }
    
    /**
     *  danh dấu dã xem cho các thông báo
     */
    function update_notification()
    {
        
    }
    
    function get_one($notify_id)
    {
        $this->db->where('notify_id',$notify_id);
        return $this->db->select($this->table)->row();
        
    }
	/********************************************************************************************/

}