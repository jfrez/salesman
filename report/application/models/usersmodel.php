<?php

class usersmodel extends CI_Model {



    function __construct() {

        parent::__construct();

    }



    function login($username,$password) {

        $query= $this->db->get_where('users',array('username'=>$username,'password'=>md5($password)));


	if($query->num_rows()>0 ){
        $result = $query->result_array();
		$query2= $this->db->get_where('users_roles',array('user_id'=>$result[0]['id'],'role_id'=>1));
	


        if($query2->num_rows()>0)

            return $result;

        else

            return false;

    }
    }

    public function getAll($limit = null, $offset  = 0)

    {

        $this->db->select('users.id, users.username, users.name, GROUP_CONCAT(roles.title) as role_title')

                ->from('users')

                ->join('users_roles','users_roles.user_id = users.id', 'left')

                ->join('roles','roles.id = users_roles.role_id', 'left');



        if($limit) {

            $this->db->limit($limit, $offset);

        }

        //$this->db->get()->result_array();

        $this->db->group_by(array("users.id"));



        return $this->db->get()->result_array();

    }

    function getTotalCount() {

        $this->db->select('  count(distinct users.id) as count');

        $this->db->from('users');

        $this->db->join('users_roles','users_roles.user_id = users.id', 'left')

                 ->join('roles','roles.id = users_roles.role_id', 'left');

        //$this->db->group_by(array("users.id"));

        $query = $this->db->get()->result_array();



        if(count($query) > 0) {

            return $query[0]['count'];

        } else {

            return 0;

        }

    }

    function getByRole($role)

    {

        $this->db->select('users.name, users.id')

            ->from('users')

            ->join('users_roles','users_roles.user_id = users.id')

            ->join('roles','roles.id = users_roles.role_id');

        $this->db->where( 'roles.title' , $role)

                ->group_by(array("users.id"));

        return $this->db->get()->result_array();

    }

    function getUserRole($userId) {

        $this->db->select('roles.id as role_id, roles.title as role_title')

            ->from('users_roles')

            ->join('roles','roles.id = users_roles.role_id', 'left');

        $this->db->where( 'users_roles.user_id' , $userId);

        return $this->db->get()->result_array();

    }

    function getUser($id)

    {

        $this->db->select('users.*, GROUP_CONCAT(roles.id) as role_ids')

            ->from('users')

            ->join('users_roles','users_roles.user_id = users.id', 'left')

            ->join('roles','roles.id = users_roles.role_id', 'left');

        $this->db->where( 'users.id' , $id);

        return $this->db->get()->result_array();

    }

    function getUserDetails($userid) {

        //$this->load->model('profiles');

        $query= $this->db->get_where('users',array('id'=>$userid));



        //print_r($query->result_array());

        return $query->result_array();

    }



    function getUsers() {

        $query = $this->db->select("users.id, users.username, profiles.name,profiles.phone as phone, profiles.role_id,profiles.email,roles.name as role")

                ->from("users")

                ->join('profiles', 'profiles.user_id = users.id', 'left')

                ->join("roles","roles.id = profiles.role_id")

                ->get();

        return $query->result_array();



    }



    function getSalesPerons() {

        $query = $this->db->get_where("profiles",array('role_id'=>2));

             

        return $query->result_array();



    }





    function checkDuplicate($username) {

        $isFound = $this->db->get_where("users",array("username"=>$username))->num_rows();

        //print_r($username.$isFound);

        //die("ss".$isFound);

        return $isFound;

    }



    function deleteUser($id)

    {

        $this->db->delete("users",array("id"=>$id));

    }

}

?>