<?php

/**

 * Name: Compromisos Model

 *

 * Author: Jonathan Frez

 *        jonathan.frez@gmail.com

 *

 * 
 *

 */

class compmodel extends CI_Model {



    function __construct() {

        parent::__construct();

    }

    function getAll($limit = null, $offset  = 0, $category = NULL, $location = NULL, $client = NULL, $user = NULL, $dateFrom = NULL, $dateTo = NULL,$is_approved = NULL) {

        $this->db->select('commit.id, users.name as salesman_name, clients.name as  client_name,commit.importance as importance,commit.done as done,commit.client,commit.user, commit.idate,commit.fdate,commit.comment,commit.type as type,locations.name as location_name');

        $this->db->from('commit');

        $this->db->join('clients', 'commit.client = clients.id', 'left');
        $this->db->join('clients_locations', 'clients_locations.client_id = commit.client', 'left');
        $this->db->join('locations', 'locations.id = clients_locations.location_id', 'left');
        $this->db->join('users', 'users.id = commit.user', 'left');

         if($category){

            $this->db->where('clients.market_niche_id', $category);

        }

        if($location){

            $this->db->where('locations.id', $location);

        } if($client) {

            $this->db->where('clients.id', $client);

        }

        if($user) {

            $this->db->where('users.id', $user);

        }

        if($dateFrom && $dateTo) {

            $this->db->where('commit.fdate >', $dateFrom);

            $this->db->where('commit.fdate <', $dateTo);

        }


        if($is_approved) {

            $this->db->where('commit.done', $is_approved);

        }
        if($limit) {

            $query = $this->db->limit($limit, $offset);

        }

        



         return $this->db->get()->result_array();

        //print_r($this->db->last_query());die;

    }

    function getCommit($id)

    {

        $this->db->select('commit.id, commit.importance,commit.done,commit.client,commit.user, commit.idate,commit.fdate,commit.comment,commit.type');

        $this->db->from('commit');


        $this->db->where( 'commit.id' , $id);

        return $this->db->get()->result_array();

    }

    function getCommitbyUser($id)

    {
        $this->db->select('commit.id,commit.importance,commit.done, commit.client,commit.user, commit.idate,commit.fdate,DATEDIFF(commit.fdate,NOW()) as days,commit.comment,commit.type');

        $this->db->from('commit');

      
        $this->db->where( 'commit.user' , $id);
	$this->db->where( 'commit.done' , "0");
        return $this->db->get()->result_array();

    }
    function getCommitbyUserAll($id)

    {
        $this->db->select('commit.id,commit.importance,commit.done, commit.client,clients.name,commit.user, commit.idate,DATE(commit.fdate) as fdate,DATEDIFF(commit.fdate,NOW()) as days,commit.comment,commit.type');

        $this->db->from('commit');
	$this->db->join('clients', 'commit.client = clients.id', 'left');
      
        $this->db->where( 'commit.user' , $id);
        return $this->db->get()->result_array();

    }
	  function getCommitbyClient($id)

    {
        $this->db->select('commit.id,commit.importance,commit.done, commit.client,commit.user, commit.idate,commit.fdate,commit.comment,commit.type');

        $this->db->from('commit');

      
        $this->db->where( 'commit.client' , $id);

        return $this->db->get()->result_array();

    }
	function newCommit($user,$client,$fechaf,$comment,$type,$importance){
			$data = array(
				'user' => $user,
				'client' => $client,
				'fdate' => $fechaf,
				'comment' => $comment,
				'type' => $type,
				'importance'=>$importance
				);
		
			$this->db->insert('commit', $data); 
		
		
	}

	function doneCommit($id){
	 
			$data = array(
				'done' => 1
				);
			$this->db->where('id', $id);
			$this->db->update('commit', $data); 
		
		
	}
	function undoneCommit($id){
	 
			$data = array(
				'done' => 0
				);
			$this->db->where('id', $id);
			$this->db->update('commit', $data); 
		
		
	}


}

?>