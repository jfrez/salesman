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

class opormodel extends CI_Model {



    function __construct() {

        parent::__construct();

    }

    function getAll($limit = null, $offset  = 0, $category = NULL, $location = NULL, $client = NULL, $user = NULL, $dateFrom = NULL, $dateTo = NULL,$status = NULL,$prob = NULL) {

        $this->db->select('opor.id, clients.name as  client_name, opor.client, opor.salesman as salesman_id, users.name as salesman, locations.name as location_name ,opor.date as date, opor.comment, opor.amount as amount, opor.prob as prob,opor.state as state, opor.famount,opor.fechaf');

        $this->db->from('opor');

        $this->db->join('clients', 'opor.client = clients.id', 'left');
        $this->db->join('clients_locations', 'clients_locations.client_id = opor.client', 'left');
        $this->db->join('locations', 'locations.id = clients_locations.location_id', 'left');
        $this->db->join('users', 'users.id = opor.salesman', 'left');

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

            $this->db->where('opor.date >', $dateFrom);

            $this->db->where('opor.date <', $dateTo);

        }


        if($status) {

            $this->db->where('opor.state', $status);

        }
          if($prob) {

            $this->db->where('opor.prob', $prob);

        }
        if($limit) {

            $query = $this->db->limit($limit, $offset);

        }

        



         return $this->db->get()->result_array();

        //print_r($this->db->last_query());die;

    }

    function getOpor($id)

    {

        $this->db->select('opor.id,  opor.client, opor.salesman, opor.date, opor.comment, opor.amount, opor.prob,opor.state, opor.famount,opor.fechaf');

        $this->db->from('opor');


        $this->db->where( 'opor.id' , $id);

        return $this->db->get()->result_array();

    }

    function getOporbyUser($id)

    {
        $this->db->select('opor.id,  opor.client, opor.salesman, opor.date, opor.comment, opor.amount, opor.prob,opor.state, opor.famount,opor.fechaf');

        $this->db->from('opor');


      
        $this->db->where( 'opor.salesman' , $id);

        return $this->db->get()->result_array();

    }
    function getOporbyUserAll($id)

    {
        $this->db->select('opor.id,  opor.client,  clients.name as  client_name, opor.salesman, opor.date, opor.comment, opor.amount, opor.prob,opor.state, opor.famount,opor.fechaf');

        $this->db->from('opor');
	$this->db->join('clients', 'opor.client = clients.id', 'left');
      
        $this->db->where( 'opor.saleman' , $id);
        return $this->db->get()->result_array();

    }
	  function getOporbyClient($id)

    {
        $this->db->select('opor.id,  opor.client,  clients.name as  client_name, opor.salesman, opor.date, opor.comment, opor.amount, opor.prob,opor.state, opor.famount,opor.fechaf');

        $this->db->from('opor');

      
        $this->db->where( 'opor.client' , $id);

        return $this->db->get()->result_array();

    }

	function newOpor($user,$client,$fecha,$comment,$amount,$prob){
			$data = array(
				'user' => $user,
				'client' => $client,
				'date' => $fecha,
				'comment' => $comment,
				'amount' => $amount,
				'prob'=>$prob
				);
		
			$this->db->insert('opor', $data); 
		
		
	}

    function changeState($id,$state){
            $data = array(
                'state' => $state
                );
        $this->db->where('id', $id);
        $this->db->update('opor', $data); 
            
    }

    function changeMontoF($id,$montof){
            $data = array(
                'famount' => $montof
                );
        $this->db->where('id', $id);
        $this->db->update('opor', $data); 
            
    }
	


}

?>