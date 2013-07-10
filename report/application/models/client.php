<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tarek
 * Date: 4/18/12
 * Time: 6:08 PM
 * To change this template use File | Settings | File Templates.
 */
class clientmodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function getClient($id)
    {
        $this->db->get_where('clients', array('id' => $id));
        return $query->result_array();
    }
    function get_last_ten_entries()
    {
        $query = $this->db->get('entries', 10);
        return $query->result();
    }

    function insert_entry()
    {
        $this->title   = $_POST['title']; // please read the below note
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('entries', $this);
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

    function addClient()
    {
        $clientsinfo=array
        (
            'first_name'=>$this->input->post('first_name'),
            'last_name'=>$this->input->post('last_name'),
            'project_id'=>$this->input->post('project_id'),
            'primary_phone'=>$this->input->post('primary_phone1').'-'.$this->input->post('primary_phone2').'-'.$this->input->post('primary_phone3'),
            'secondary_phone'=>$this->input->post('secondary_phone1').'-'.$this->input->post('secondary_phone2').'-'.$this->input->post('secondary_phone3'),
            'fax'=>$this->input->post('fax1').'-'.$this->input->post('fax2').'-'.$this->input->post('fax3'),
            'email'=>$this->input->post('email'),
            'contact_time'=>$this->input->post('contact_time')
        );
        //showArray($clientsinfo);
        $this->db->insert('clients',$clientsinfo);
        $clientid=$this->db->insert_id();
        return $clientid;
    }

    function deleteClient($clientid)
    {
        // $clienttables=array('clients','client_primary','client_billing');
        $this->db->where('id',$clientid);
        $this->db->delete('clients');
    }

    function deleteClientContact($clientid)
    {
        $this->db->where('client_id',$clientid);
        $this->db->delete('client_primary');
    }

    function deleteClientBillingContact($clientid)
    {
        $this->db->where('client_id',$clientid);
        $this->db->delete('client_billing');
    }

    function updateClient($clientid)
    {
        $clientsinfo=array
        (
            'first_name'=>$this->input->post('first_name'),
            'last_name'=>$this->input->post('last_name'),
            'primary_phone'=>$this->input->post('primary_phone1').'-'.$this->input->post('primary_phone2').'-'.$this->input->post('primary_phone3'),
            'secondary_phone'=>$this->input->post('secondary_phone1').'-'.$this->input->post('secondary_phone2').'-'.$this->input->post('secondary_phone3'),
            'fax'=>$this->input->post('fax1').'-'.$this->input->post('fax2').'-'.$this->input->post('fax3'),
            'email'=>$this->input->post('email'),
            'contact_time'=>$this->input->post('contact_time')
        );
        $this->db->where('id',$clientid);
        $this->db->update('clients',$clientsinfo);
    }
    function addClientContact()
    {
        echo "Hmm";

        $clientscontactinfo=array(
            'client_id'=>$this->input->post('client_id'),
            'address1'=>$this->input->post('address1'),
            'address2'=>$this->input->post('address2'),
            'city'=>$this->input->post('city'),
            'state'=>$this->input->post('state'),
            'zipcode1'=>$this->input->post('zipcode1'),
            'zipcode2'=>$this->input->post('zipcode2'),
            'country'=>$this->input->post('country'),
            'same'=>$this->input->post('same')
        );
        $this->db->insert('client_primary',$clientscontactinfo);

    }

    function updateClientContact($params)
    {
        $clientscontactinfo=array(
            'address1'=>$this->input->post('address1'),
            'address2'=>$this->input->post('address2'),
            'city'=>$this->input->post('city'),
            'state'=>$this->input->post('state'),
            'zipcode1'=>$this->input->post('zipcode1'),
            'zipcode2'=>$this->input->post('zipcode2'),
            'country'=>$this->input->post('country'),
            'same'=>$this->input->post('same')
        );

        //$this->db->where('client_id',$params['id']);
        $this->db->where('client_id',$params);
        $this->db->update('client_primary',$clientscontactinfo);

    }

    function addClientbillContact()
    {
        $clientsbillinginfo=array(
            'client_id'=>$this->input->post('client_id'),
            'address1'=>$this->input->post('address1'),
            'address2'=>$this->input->post('address2'),
            'city'=>$this->input->post('city'),
            'state'=>$this->input->post('state'),
            'zipcode1'=>$this->input->post('zipcode1'),
            'zipcode2'=>$this->input->post('zipcode2'),
            'country'=>$this->input->post('country')
        );
        $this->db->insert('client_billing',$clientsbillinginfo);
    }

    function updateClientbillContact($clientid)
    {
        $clientsbillinginfo=array(
            'address1'=>$this->input->post('address1'),
            'address2'=>$this->input->post('address2'),
            'city'=>$this->input->post('city'),
            'state'=>$this->input->post('state'),
            'zipcode1'=>$this->input->post('zipcode1'),
            'zipcode2'=>$this->input->post('zipcode2'),
            'country'=>$this->input->post('country')
        );
        $this->db->where('client_id',$clientid);
        $this->db->update('client_billing',$clientsbillinginfo);
    }

    function getallclients()
    {
        $clientdata=array();
        $this->db->select('id,first_name,last_name,email');
        $allclient=$this->db->get('clients',10,$this->uri->segment(3));
        if($allclient->num_rows()>0)
        {
            foreach($allclient->result_array() as $row)
            {
                $clientdata[]=$row;
            }
        }
        return $clientdata;
    }
    function getallclientsbySP($uid)
    {
        $myprojects = array();
        $q = $this->db->select("id")->from("projects")->where("user_id",$uid)->get();
        foreach($q->result_array() as $row){
            $myprojects[]=$row['id'];
        }

        $allprojects = "(".join(",",$myprojects).")";

        $clientdata=array();
        $this->db->select('id,first_name,last_name,email');
        $this->db->where("project_id in {$allprojects}");
        $allclient=$this->db->get('clients',10,$this->uri->segment(3));
        if($allclient->num_rows()>0)
        {
            foreach($allclient->result_array() as $row)
            {
                $clientdata[]=$row;
            }
        }
        return $clientdata;
    }

    function gettotalclientsbySP($uid)
    {
        $myprojects = array();
        $q = $this->db->select("id")->from("projects")->where("user_id",$uid)->get();
        foreach($q->result_array() as $row){
            $myprojects[]=$row['id'];
        }

        $allprojects = "(".join(",",$myprojects).")";

        $clientdata=array();
        $this->db->select('id,first_name,last_name,email');
        $this->db->where("project_id in {$allprojects}");
        $allclient=$this->db->get('clients');
        return $allclient->num_rows();

    }
    function getclient($clientid)
    {
        $clientinfo=$this->db->get_where('clients',array('id'=>$clientid));
        $clientdata = $clientinfo->result_array();
        return json_encode($clientdata[0]);
    }

    function getClientContact($clientid)
    {
        $clientinfo=$this->db->get_where('client_primary',array('client_id'=>$clientid));
        $clientdata = $clientinfo->result_array();
        return json_encode($clientdata[0]);
    }

    function getClientBillingContact($clientid)
    {
        $clientinfo=$this->db->get_where('client_billing',array('client_id'=>$clientid));
        $clientdata = $clientinfo->result_array();
        return json_encode($clientdata[0]);
    }


    function getClientDetails($id){

        $data = $this->db->get_where('clients',array('project_id'=>$id))->row_array();
        return $data;

    }

    function isPriamryContactAvailable($clientid){
        return $this->db->get_where('client_primary',array('client_id'=>$clientid))->num_rows();
    }

    function isBillingContactAvailable($clientid){
        return $this->db->get_where('client_billing',array('client_id'=>$clientid))->num_rows();
    }

}