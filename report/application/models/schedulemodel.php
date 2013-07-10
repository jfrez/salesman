<?php

/**

 * Name: Scheule Model

 *

 * Author: Emran Ul Hadi

 *         emran@wneeds.com

 *

 * Schedule Model do all database staff related to Schedule.

 *

 */

class schedulemodel extends CI_Model {



    function __construct() {

        parent::__construct();

    }

    function getAll($limit = null, $offset  = 0, $category = NULL, $location = NULL, $client = NULL, $user = NULL, $dateFrom = NULL, $dateTo = NULL, $status = null,$is_approved=null) {

        $this->db->select('scheduled_visits.id, scheduled_visits.date,scheduled_visits.is_approved as is_approved, scheduled_visits.message, clients.name as  client_name, users.name as salesman_name, locations.address, locations.name as location_name,scheduled_visits.comment as comment, scheduled_visits.created_date,scheduled_visits.visittime');

        $this->db->from('scheduled_visits');
		
		$this->db->join('clients_locations', 'clients_locations.location_id = scheduled_visits.location_id', 'left');

        $this->db->join('clients', 'clients.id = clients_locations.client_id', 'left');

        $this->db->join('users', 'users.id = scheduled_visits.salesman_id', 'left');

        $this->db->join('locations', 'locations.id = scheduled_visits.location_id', 'left');

        //$this->db->where('feed.categoryID', $categoryID);

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

            $this->db->where('scheduled_visits.created_date >', $dateFrom);

            $this->db->where('scheduled_visits.created_date <', $dateTo);

        }

        if($status) {

            $this->db->where('scheduled_visits.status', $status);

        }
		if(isset($is_approved)){
			   $this->db->where('scheduled_visits.is_approved', $is_approved);
			   

		}
        if($limit) {

            $query = $this->db->limit($limit, $offset);

        }



		$this->db->order_by("scheduled_visits.created_date", "desc"); 



         return $this->db->get()->result_array();

        //print_r($this->db->last_query());die;

    }

    function getTotalCount($category = NULL, $location = NULL, $client = NUL, $user = NULL, $dateFrom = NULL, $dateTo = NULL, $status = 'pending') {

        $this->db->select('count(scheduled_visits.id) as count');

        $this->db->from('scheduled_visits');

        $this->db->join('clients', 'clients.id = scheduled_visits.client_id', 'left');

        $this->db->join('users', 'users.id = scheduled_visits.salesman_id', 'left');

        $this->db->join('locations', 'locations.id = scheduled_visits.location_id', 'left');

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

            $this->db->where('scheduled_visits.created_date >', $dateFrom);

            $this->db->where('scheduled_visits.created_date <', $dateTo);

        }

        if($status) {

            $this->db->where('scheduled_visits.status', $status);

        }

        $query = $this->db->get()->result_array();



        if(count($query) > 0) {

            return $query[0]['count'];

        } else {

            return 0;

        }

    }

    function  getBySaleman($salesmanId,$status = null) {

        $this->db->select('scheduled_visits.id, clients.name as  client_name,  locations.address, locations.name as location_name,scheduled_visits.comment as comment,scheduled_visits.date as date, DATEDIFF(scheduled_visits.date,NOW()) as days ');

        $this->db->from('scheduled_visits');

        $this->db->join('clients', 'clients.id = scheduled_visits.client_id', 'left');

        $this->db->join('users', 'users.id = scheduled_visits.salesman_id', 'left');

        $this->db->join('locations', 'locations.id = scheduled_visits.location_id', 'left');



        $this->db->where('scheduled_visits.salesman_id', $salesmanId);

        if($status) {

            $this->db->where('scheduled_visits.status', $status);

        }



        return $this->db->get()->result_array();

    }
	 function  getTodoBySaleman($salesmanId) {
		 $status = "checkin";

        $this->db->select('scheduled_visits.id, clients.name as  cname,  locations.address, locations.name as location_name, scheduled_visits.date as date, DATEDIFF(scheduled_visits.date,NOW()) as days,scheduled_visits.message as message');

        $this->db->from('scheduled_visits');


        $this->db->join('users', 'users.id = scheduled_visits.salesman_id', 'left');

        $this->db->join('locations', 'locations.id = scheduled_visits.location_id', 'left');
		        $this->db->join('clients_locations', 'locations.id = clients_locations.location_id', 'left');

        $this->db->join('clients', 'clients.id = clients_locations.client_id', 'left');



        $this->db->where('scheduled_visits.salesman_id', $salesmanId);
		 $this->db->where('scheduled_visits.is_approved', "0");
		 
		 $this->db->where('scheduled_visits.date > ', "1969-12-31");



            $this->db->where('scheduled_visits.status', $status);


		$this->db->order_by("scheduled_visits.date ", "asc"); 


        return $this->db->get()->result_array();

    }

    function getById($id)

    {

        $this->db->select('*');

        $this->db->from('scheduled_visits');

        $this->db->where( 'id' , $id);

        return $this->db->get()->result_array();

    }

	 function cumplir($id)

    {
	$data = array(
               'is_approved' => "1"
               
            );
	$this->db->where('id', $id);
	     return $this->db->update('scheduled_visits', $data); 
  

    }

    function delete($id)

    {

        return $this->db->delete("scheduled_visits",array("id"=>$id));

    }

}