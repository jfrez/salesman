<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Users extends CI_Controller {



	function __construct()

	{

		parent::__construct();

                $this->load->model("usersmodel", "u");

	}



	function index($page = 1)

	{

        $data['pagetitle'] = "Inicio > Administrar usuarios";

            if($this->session->userdata("loggedin")!='1'){

                $this->load->view('theme/login.php');

            } else {

                $per_page = 4;

                $offset = ($page -1) * $per_page;

                $this->load->library('pagination');



                $config['base_url'] = $this->config->item("base_url") . 'users/index/';

                $config['total_rows'] = $this->u->getTotalCount();;

                $config['per_page'] = $per_page;

                $config['use_page_numbers'] = TRUE;

                $data['total_count'] = $config['total_rows'];

                $config['cur_tag_open'] = '<a href="#" class="active">';

                $config['cur_tag_close'] = '</a>';

                $this->pagination->initialize($config);

                $response = $this->u->getAll($per_page, $offset);

                //print_r($response);die;

                if($response) {

                    $data['userList'] = $response;//die;

                }



                $this->load->view('theme/userslist',$data);

            }

	}

    function add()

    {

        $data['pagetitle'] = "Inicio > Administrar usuarios > Agregar";



        if($this->session->userdata("loggedin")!='1'){

            $this->load->view('theme/login.php');

        } else {

            $this->load->library('form_validation');

            //$this->load->helper(array('form', 'url'));



            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');

            $this->form_validation->set_rules('sur_name', 'Sur Name', 'trim|max_length[30]|xss_clean');

            $this->form_validation->set_rules('username', 'Username', 'trim|min_length[4]|max_length[100]|required|xss_clean|callback_username_check');

            $this->form_validation->set_rules('email', 'Email', 'trim|min_length[4]|max_length[100]|required|xss_clean');

            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[4]|max_length[100]|required|xss_clean');

            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|min_length[4]|max_length[100]|required|xss_clean');

            $this->form_validation->set_rules('birth_date', 'Birth Date', 'xss_clean');

            $this->form_validation->set_rules('id_no', 'Identification Number', 'xss_clean');

            $this->form_validation->set_rules('roles[]', 'Roles', 'trim|required');



            if(count($_POST) > 0) {

                if ($this->form_validation->run() ) {

                    $this->name              =  $this->input->post('name');

                    $this->sur_name          =  $this->input->post('sur_name');

                    $this->username          =  $this->input->post('username');

                    $this->email             =  $this->input->post('email');

                    $this->password          =  md5($this->input->post('password'));

                    $this->birth_date        =  $this->input->post('birth_date');

                    $this->Identification_no =  $this->input->post('id_no');



                    $this->db->insert('users', $this);

                    $userId = $this->db->insert_id();

                    if(count($this->input->post('roles') ) > 0 ) {

                        foreach($this->input->post('roles') as $role) {

                            $this->db->insert('users_roles', array('user_id' => $userId, 'role_id' => $role));

                        }

                    }

                    //$this->load->view('theme/userslist.php');

                    header("Location:{$this->config->item("base_url")}/users");

                }

            }

            $data['user_data'] = null;

            $this->load->model('rolesmodel', 'r');

            $roles = $this->r->getAll();

            $data['roles'] = $roles;

            $this->load->view('theme/useradd',$data);

        }

    }

    public function username_check($str)

    {

        if ($this->u->checkDuplicate($str))

        {

            $this->form_validation->set_message('username_check', 'This username already taken. Please try another');

            return FALSE;

        }

        else

        {

            return TRUE;

        }

    }

    function edit($id)

    {

        $data['pagetitle'] = "Inicio > Administrar usuarios > Editar ";



        if($this->session->userdata("loggedin")!='1'){

            $this->load->view('theme/login.php');

        } else {

            $this->load->library('form_validation');



            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');

            $this->form_validation->set_rules('sur_name', 'Sur Name', 'trim|max_length[30]|xss_clean');

            $this->form_validation->set_rules('username', 'Username', 'trim|min_length[4]|max_length[100]|required|xss_clean');

            $this->form_validation->set_rules('email', 'Email', 'trim|min_length[4]|max_length[100]|required|xss_clean');

            //$this->form_validation->set_rules('password', 'Password', 'trim|min_length[4]|max_length[100]|required|xss_clean');

            //$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|min_length[4]|max_length[100]|required|xss_clean');

            $this->form_validation->set_rules('birth_date', 'Birth Date', 'xss_clean');

            $this->form_validation->set_rules('id_no', 'Identification Number', 'xss_clean');

            $this->form_validation->set_rules('roles[]', 'Roles', 'trim|required');



            if(count($_POST) > 0){

                if ($this->form_validation->run() ) {

                    $this->name              =  $this->input->post('name');

                    $this->sur_name          =  $this->input->post('sur_name');

                    $this->username          =  $this->input->post('username');

                    $this->email             =  $this->input->post('email');

                    $this->password          =  md5($this->input->post('password'));

                    $this->birth_date        =  $this->input->post('birth_date');

                    $this->Identification_no =  $this->input->post('id_no');



                    $this->db->update('users', $this, array('id' => $id));

                    //$userId = $this->db->insert_id();

                    if(count($this->input->post('roles') ) > 0 ) {

                        $this->db->where('user_id',$id);

                        $this->db->delete('users_roles');

                        foreach($this->input->post('roles') as $role) {

                            $this->db->insert('users_roles', array('user_id' => $id, 'role_id' => $role));

                        }

                    }

                    header("Location:{$this->config->item("base_url")}/users");

                }

            }

            $data['user_data'] = $this->u->getUser($id);

            $this->load->model('rolesmodel', 'r');

            $roles = $this->r->getAll();

            $data['roles'] = $roles;

            $this->load->view('theme/useradd',$data);

        }

    }

    function delete($id)

    {

        $data['pagetitle'] = 'Inicio > Administrar usuarios > Eliminar';

        if($this->session->userdata("loggedin")!='1'){

            $this->load->view('theme/login.php');

        } else {

            $this->u->deleteUser($id);

            header("Location:{$this->config->item("base_url")}/users");

        }

    }

    function export()

    {

        $reports = $this->u->getAll();

        $this->exportAsCsv('User List', $reports);

        return true;

    }

    function exportAsCsv($title, $getReports)

    {

        $csvFile = APPPATH.'../public/static/new.csv';



        $fp = fopen($csvFile, 'w');

        $arrayToWrite = array();

        $i=0;

        

        foreach ($getReports as $fields) {

            if($i == 0){

                $getValue['username'] = 'Username';

                $getValue['name'] = 'Full Name';

                $getValue['role_title'] = 'Role';

                $arrayToWrite[$i++] = $getValue;

            }

            $getValue['username'] = $fields['username'];

          

            $getValue['name'] = $fields['name'];

            $getValue['role_title'] = $fields['role_title'];

            $arrayToWrite[$i] = $getValue;

            

            $i++;

        }

        

        foreach ($arrayToWrite as $write):

            fputcsv($fp, $write);

        endforeach;



        fclose($fp);

        header('Content-type: text/csv');

        header('Content-Disposition: attachment; filename="'.$title.'.csv"');

        readfile($csvFile);

        exit;



    }

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */