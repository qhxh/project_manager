<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class QH_category_model extends CI_Model {
	private $table = 'project_category';

    function __construct() {
        parent::__construct();
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }



    function get_all_categories() {
    	return $this->db->get($this->table)->result();
    }

    function get_num_categries() {
    	return $this->db->count_all();
    }

    function add_category($cat_data = array()) {
    	$this->db->insert($this->table, $cat_data);
    }

    function delete_category($id) {
        $this->db->where('project_category_id', $id);
        $this->db->delete($this->table);
    }

    function update_category($id,$cat_data = array()) {
        $this->db->where('project_category_id', $id);
        $this->db->update($this->table,$cat_data);
    }

    function get_cat_by_id($id) {
        $this->db->where('project_category_id', $id);
        return $this->db->get($this->table)->row();
    }

/**********************************************************************/
}