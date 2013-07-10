<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class rolesmodel extends CI_Model{
    function __construct() {
        parent::__construct();
    }

    function getAll($limit = null, $offset  = 0) {
        $this->db->select('*');
        $this->db->from('roles');

        if($limit) {
            $query = $this->db->limit($limit, $offset);
        }

        return $this->db->get()->result_array();
        //print_r($this->db->last_query());die;
    }
    function getTotalCount() {
        $this->db->select('count(id) as count');
        $this->db->from('roles');

        $query = $this->db->get()->result_array();

        if(count($query) > 0) {
            return $query[0]['count'];
        } else {
            return 0;
        }
    }
    function isDuplicateRole($title)
    {
        $this->db->select('*');
        $this->db->from('roles');
        $this->db->where( 'title' , $title);
        $query = $this->db->get()->result_array();
        //print_r($this->db->last_query());die;
        if(count($query) > 0 ) {
            return true;
        } else {
            return false;
        }
    }

    function getRole($id)
    {
        $this->db->select('*');
        $this->db->from('roles');
        $this->db->where( 'id' , $id);
        return $this->db->get()->result_array();
    }
    function deleteRole($id)
    {
        // $clienttables=array('clients','client_primary','client_billing');
        $this->db->where('id',$id);
        $this->db->delete('roles');
    }
}
?>
