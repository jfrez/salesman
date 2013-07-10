<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

class Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
     //phpinfo();   
    }


    function index($text="ProjectName") {
        $params = array("page"=>"Inicio","text"=>$text);//die($this->session->userdata("loggedin"));
        if($this->session->userdata("loggedin")=='1') {
        //die('kaj kore');
                    $this->load->model("opormodel", "o");
                            $this->load->model("compmodel", "c");
                                    $this->load->model("schedulemodel", "s");


                    $response = $this->o->getAll();

                if($response) {

                                $data['opor'] = $response;//die;

                   }
                   $response = $this->c->getAll();

                if($response) {

                                $data['comp'] = $response;//die;

                   }
                    $response = $this->s->getAll();

                if($response) {

                                $data['visit'] = $response;//die;

                   }
            $this->load->view('theme/index.php',$data);
        } else {
            $this->load->view('theme/login.php',$params);
		}
    }

    function login() {

        $this->load->helper('lang_helper');

        $this->load->model('usersmodel','um');
        $response = $this->um->login($this->input->post('username') ,$this->input->post('password'));
        if($response) {
            $this->session->set_userdata('loggedin', '1');
            $this->session->set_userdata('userid', $response[0]['id']);
            $this->session->set_userdata('username',$response[0]['username']);
            $userdata = Array();
            $newdata = Array();
            $userdata['user_id'] = $response[0]['id'];
            $userdata['user_roles'] = $this->um->getUserDetails($response[0]['id']);
            $roles = $this->um->getUserRole($response[0]['id']);
            //$this->session->set_userdata('name',$newdata[0]['name']);
            header("Location:{$this->config->item("base_url")}");
        }
        else {
            $this->session->set_userdata('loggedin', '0');

            setErrorMessage("Username and password did not match. Please try again.", "errormsg");
            $this->load->view('theme/login.php',array("response"=>'error'));
        }

    }

    function logout() {

        //$this->load->library('session');
        $this->session->sess_destroy();
        $url = $this->config->item('base_url');
        header("Location:$url");

    }
}