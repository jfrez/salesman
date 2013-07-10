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
class marketnichemodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function getAll($limit = null, $offset  = 0) {
        $this->db->select('*');
        $this->db->from('market_niches');
        if($limit)
        $this->db->limit($limit, $offset);
      //  $this->db->join('market_niches', 'market_niches.id = clients.market_niche_id', 'left');
        //$this->db->where('feed.categoryID', $categoryID);

        return $this->db->get()->result_array();
    }
    function getTotalCount() {
        $this->db->select('count(id) as count');
        $this->db->from('market_niches');

        $query = $this->db->get()->result_array();

        if(count($query) > 0) {
            return $query[0]['count'];
        } else {
            return 0;
        }
    }
    function getMarket($id)
    {
        $this->db->select('*');
        $this->db->from('market_niches');
        $this->db->where( 'id' , $id);
        return $this->db->get()->result_array();
    }
    function deleteMarketNiche($id)
    {
        // $clienttables=array('clients','client_primary','client_billing');
        $this->db->where('id',$id);
        $this->db->delete('market_niches');
    }
}
?>
