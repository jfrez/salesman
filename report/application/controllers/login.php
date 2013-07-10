<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index(){
        $this->load->view('theme/login.php');
    }

    function ln() {
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
            $newdata = $this->um->getUserDetails($response[0]['id']);
            $this->session->set_userdata('name',$newdata[0]['name']);
            $this->session->set_userdata('role',$newdata[0]['role_id']);
            $userdata['name'] = $newdata[0]['name'];
            $userdata['role_id'] = $newdata[0]['role_id'];
            header("Location:{$this->config->item("base_url")}/");
        }
        else {
            $this->session->set_userdata('loggedin', '0');
            setErrorMessage("Username and password did not match. Please try again.", "errormsg");
            $this->load->view('theme/login.php',array("response"=>'error'));
        }

    }
}
?>
