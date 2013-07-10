<?php

/**

 * Name: Client Model

 *

 * Author: Tarek Mahmud Apu

 *         apu.eee@gmail.com

 *

 * Client model do all database staff related to client.

 *

 */

class clientsmodel extends CI_Model {



    function __construct() {

        parent::__construct();

    }

    function getAll($limit = null, $offset  = 0, $filter = NULL) {

        $this->db->select('clients.id, clients.name,clients.sap_code, market_niches.title,clients.description,clients.created_date');

        $this->db->from('clients');

        $this->db->join('market_niches', 'market_niches.id = clients.market_niche_id', 'left');

        //$this->db->where('feed.categoryID', $categoryID);

        if($filter){

            $this->db->where('market_niches.id', $filter);

        }

        if($limit) {

            $query = $this->db->limit($limit, $offset);

        }

        





         return $this->db->get()->result_array();

        //print_r($this->db->last_query());die;

    }

    function getNearBy($lat, $lng) {

        $sql = 'SELECT c.*, l.id as location_id, l.lat as llat, l.lon as llon,l.name as lname, ( 3959 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( l.lat ) ) * cos( radians( l.lon ) - radians( ' . $lng . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( l.lat ) ) ) ) AS distance

                FROM locations AS l

                LEFT JOIN clients_locations AS cl ON ( cl.location_id = l.id )

                LEFT JOIN clients AS c ON ( cl.client_id = c.id )

                LEFT JOIN market_niches AS mn ON ( mn.id = c.market_niche_id )

                HAVING distance <2

                ORDER BY distance';
			
			

//        $this->db->select('clients.id, clients.name,clients.sap_code, market_niches.title,clients.description,clients.created_date, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( locations.lat ) ) * cos( radians( locations.lon ) - radians(' . $lng . ') ) + sin( radians(' . $lat . ') ) * sin( radians( locations.lat ) ) ) ) AS distance');

//        $this->db->from('locations');

//        $this->db->join('clients_locations', 'clients_locations.location_id = locations.id', 'left');

//        $this->db->join('clients', 'clients.id = clients_locations.client_id', 'left');

//        $this->db->join('market_niches', 'market_niches.id = clients.market_niche_id', 'left');

//        $this->db->where('distance', 10, '>');





        return $this->db->query($sql)->result_array();

        //print_r($this->db->last_query());die;

    }



    function getTotalCount($filter = NULL) {

        $this->db->select('count(clients.id) as count');

        $this->db->from('clients');

        $this->db->join('market_niches', 'market_niches.id = clients.market_niche_id', 'left');

        if($filter){

            $this->db->where('market_niches.id', $filter);

        }

        $query = $this->db->get()->result_array();



        if(count($query) > 0) {

            return $query[0]['count'];

        } else {

            return 0;

        }

    }

    function getClient($id)

    {

        $this->db->select('clients.id, clients.name,clients.sap_code,clients.market_niche_id, market_niches.title,clients.description,clients.created_date');

        $this->db->from('clients');

        $this->db->join('market_niches', 'market_niches.id = clients.market_niche_id', 'left');

        $this->db->where( 'clients.id' , $id);

        return $this->db->get()->result_array();

    }

    function getClientLocation($clientId)

    {

        $this->db->select('locations.*');

        $this->db->from('locations');

        $this->db->join('clients_locations', 'locations.id = clients_locations.location_id', 'right');

        $this->db->where( 'clients_locations.client_id' , $clientId);





        return $this->db->get()->result_array();

    }



    function deleteClient($clientid)

    {

        // $clienttables=array('clients','client_primary','client_billing');

        $this->db->where('id',$clientid);

        $this->db->delete('clients');

    }

    function getLocationByClientId($id)

    {

        $this->db->select('locations.id, locations.address, locations.name');

        $this->db->from('clients');

        $this->db->join('clients_locations', 'clients_locations.client_id = clients.id', 'left');

        $this->db->join('locations', 'locations.id = clients_locations.location_id', 'left');

        $this->db->where( 'clients.id' , $id);

        return $this->db->get()->result_array();

    }

}

?>