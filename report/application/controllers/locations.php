<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Locations extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->model("locationsmodel", "lm");
        //$this->session->start();
        if($this->session->userdata("loggedin")!='1'){
            redirectToLogin();
            die();
        }
    }
    function index($page = 1)
    {
        $data['pagetitle'] = "Ubicaciones";
        if($this->session->userdata("loggedin")!='1'){
            $this->load->view('theme/login.php');
        } else {
            $per_page = 4;
            $offset = ($page -1) * $per_page;
            $this->load->library('pagination');

            $config['base_url'] = $this->config->item("base_url") . 'locations/index/';
            $config['total_rows'] = $this->rm->getTotalCount();;
            $config['per_page'] = 4;
            $config['use_page_numbers'] = TRUE;

            $config['cur_tag_open'] = '<a href="#" class="active">';
            $config['cur_tag_close'] = '</a>';
            $this->pagination->initialize($config);
            $response = $this->lm->getAll($per_page, $offset);
            if($response) {
                $data['locationsList'] = $response;//die;
            } else {
                $data['locationsList'] = array();
            }
            $this->load->view('theme/locationsList',$data);
        }
    }
    function add()
    {
        $data['pagetitle'] = 'Agregar ubicación';

        if($this->session->userdata("loggedin")!='1'){
            $this->load->view('theme/login.php',$params);
        } else {
            $this->load->library('form_validation');
            //$this->load->helper(array('form', 'url'));

            $this->form_validation->set_rules('address', 'address', 'trim|required|min_length[5]|max_length[100]|xss_clean|callback_rolename_check');

            if(count($_POST) > 0){

                if ($this->form_validation->run()) {
                    $this->title = $this->input->post('title');

                    $this->db->insert('roles', $this);
                    header("Location:{$this->config->item("base_url")}roles");
                }

            }
            $data['roles_data'] = false;
            $this->load->view('theme/roleadd',$data);
        }
    }
    function edit($id)
    {
        $data['pagetitle'] = 'Editar Rol';
        if($this->session->userdata("loggedin")!='1'){
            $this->load->view('theme/login.php',$params);
        } else {
            $this->load->library('form_validation');
            //$this->load->helper(array('form', 'url'));

            $this->form_validation->set_rules('title', 'Role Name', 'trim|required|min_length[5]|max_length[100]|xss_clean|callback_rolename_check');

            if(count($_POST) > 0){

                if ($this->form_validation->run()) {
                    $this->title               = $this->input->post('title');

                    $this->db->update('roles', $this, array('id' => $id));
                    header("Location:{$this->config->item("base_url")}roles");
                }

            }

            $data['roles_data'] = $this->rm->getRole($id);

            $this->load->view('theme/roleadd',$data);

        }
    }
    function delete($id)
    {
        $data['pagetitle'] = 'Editar Rol';
        if($this->session->userdata("loggedin")!='1'){
            $this->load->view('theme/login.php',$params);
        } else {
            $this->rm->deleteLocation($id);
            header("Location:{$this->config->item("base_url")}roles");
        }
    }
    public function rolename_check($str)
    {
        if ($this->rm->isDuplicateRole($str))
        {
            $this->form_validation->set_message('rolename_check', 'Duplicate role. Please change the role title');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

}
