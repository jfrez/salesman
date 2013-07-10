<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(1);
class Clients extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->model("clientsmodel", "cm");
        //$this->session->start();
        if($this->session->userdata("loggedin")!='1'){
            redirectToLogin();
            die();
        }
        parse_str($_SERVER['QUERY_STRING'], $_GET);
    }
    function index()
    {
        $default = array('page', 'filter');

        $params = $this->uri->uri_to_assoc(2, $default);
        //print_r($params);die;
        $data['pagetitle'] = "Inicio > Administrar Clientes";
        if($this->session->userdata("loggedin")!='1'){
            $this->load->view('theme/login.php');
        } else {
            $page =  ($params['page'] != '') ? $params['page'] : 1;//; die('>>'.$page);
            $per_page = 4;
            $offset = ($page -1) * $per_page;
            $this->load->library('pagination');

            $filter =  ($params['filter'] != '') ? $params['filter'] : null;
            if($filter) {
                $config['base_url'] = $this->config->item("base_url") . 'clients/filter/' . $filter . '/page/';
            } else {
                $config['base_url'] = $this->config->item("base_url") . 'clients/page/';
            }

            $config['total_rows'] = $this->cm->getTotalCount($filter);
            $data['total_count'] = $config['total_rows'];
            $config['per_page'] = 4;
            $config['use_page_numbers'] = TRUE;

            $config['cur_tag_open'] = '<a href="#" class="active">';
            $config['cur_tag_close'] = '</a>';
            $this->pagination->initialize($config);
            $response = $this->cm->getAll($per_page, $offset, $filter);
            if($response) {
                $data['clientList'] = $response;//die;
            }
            $this->load->model("marketnichemodel", "m");
            $category = $this->m->getAll();
            $data['categoryList'] = $category;
            if($filter){
                $data['filter'] = $filter;
            }
            
            $this->load->view('theme/clientlist',$data);
        }
    }
    function add()
    {
        $data['pagetitle'] = "Inicio > Administrar Clientes > Agregar";

        if($this->session->userdata("loggedin")!='1'){
            $this->load->view('theme/login.php');
        } else {
            $this->load->library('form_validation');
            //$this->load->helper(array('form', 'url'));

            $this->form_validation->set_rules('name', 'Client Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
            $this->form_validation->set_rules('sap_code', 'Sap Code', 'trim|required|max_length[30]|xss_clean');
            $this->form_validation->set_rules('market', 'Market Niche', 'trim|required|xss_clean');
            $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        //    $this->form_validation->set_rules('locations["address"][]', 'Location', 'required|trim|xss_clean');
            if(count($_POST) > 0){
                //print_r($_POST);die;
                if ($this->form_validation->run()) {
                    $this->name               = $this->input->post('name');
                    $this->sap_code           =  $this->input->post('sap_code');
                    $this->market_niche_id    =  $this->input->post('market');
                    $this->description        =  $this->input->post('description');

                    $this->db->insert('clients', $this);
                    $clientId = $this->db->insert_id();
                    $locations = $this->input->post('location');
                    //print_r($locations);die;
                    for($i = 0; $i < count($locations['id']); $i++) {
                        $locData = array(
                            'address' => $locations['address'][$i],
                            'name' => $locations['name'][$i],
                            'lat' => $locations['lat'][$i],
                            'lon' => $locations['lon'][$i]
                        );
                       // die(print_r($locData));
                        if($this->db->insert("locations", $locData)) {
                            $locId = $this->db->insert_id();
                            $this->db->insert("clients_locations", array('client_id' => $clientId, 'location_id' => $locId));
                        }
                    }


                    header("Location:{$this->config->item("base_url")}/clients");
                }

            }
            $this->load->model('marketnichemodel', 'mkt_niche');
            $marketNiche = $this->mkt_niche->getAll();
            $data['market_niche'] = $marketNiche;
            $this->load->view('theme/clientadd',$data);
        }
    }
    function edit($id)
    {
        $data['pagetitle'] = "Inicio > Administrar Clientes > Editar";
        if($this->session->userdata("loggedin")!='1'){
            $this->load->view('theme/login.php');
        } else {
            $this->load->library('form_validation');
            //$this->load->helper(array('form', 'url'));

            $this->form_validation->set_rules('name', 'Client Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
            $this->form_validation->set_rules('sap_code', 'Sap Code', 'trim|required|max_length[30]|xss_clean');
            $this->form_validation->set_rules('market', 'Market Niche', 'trim|required|xss_clean');
            $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
            //$this->form_validation->set_rules('locations[address][]', 'Location', 'required|trim|xss_clean');
            if(count($_POST) > 0){

                if ($this->form_validation->run()) {
                    $this->name               = $this->input->post('name');
                    $this->sap_code           =  $this->input->post('sap_code');
                    $this->market_niche_id    =  $this->input->post('market');
                    $this->description        =  $this->input->post('description');


                    $this->db->update('clients', $this, array('id' => $id));

                    $locations = $this->input->post('location');
                    //print_r($locations);die;
                    for($i = 0; $i < count($locations['id']); $i++) {
                        $locData = array(
                            'name' => $locations['name'][$i],
                            'address' => $locations['address'][$i],
                            'lat' => $locations['lat'][$i],
                            'lon' => $locations['lon'][$i]
                        );

                        if(is_numeric($locations['id'][$i])) {
                            $this->db->update('locations', $locData, array('id' => $locations['id'][$i]));
                        } else {
                            // die(print_r($locData));
                            if($this->db->insert("locations", $locData)) {
                                $locId = $this->db->insert_id();
                                $this->db->insert("clients_locations", array('client_id' => $id, 'location_id' => $locId));
                            }
                        }
                    }

                    header("Location:{$this->config->item("base_url")}/clients");
                }

            }

            $data['client_data'] = $this->cm->getClient($id);
            $data['client_locations'] = $this->cm->getClientLocation($id);
            //echo '<pre>'; print_r($data['client_data']);die;
            $this->load->model('marketnichemodel', 'mkt_niche');
            $marketNiche = $this->mkt_niche->getAll();
            $data['market_niche'] = $marketNiche;
            $this->load->view('theme/clientadd',$data);

        }
    }
     function details($id)
    {
        $data['pagetitle'] = "Inicio > Administrar Clientes > Cliente";
        if($this->session->userdata("loggedin")!='1'){
            $this->load->view('theme/login.php',$params);
        } else {
            $data['client_data'] = $this->cm->getClient($id);
            $data['client_locations'] = $this->cm->getClientLocation($id);
            
            $this->load->view('theme/clientdetails',$data);
        }
    }
    function  deletelocation($id) {
        $this->db->delete("locations",array("id"=>$id));
    }
    function delete($id)
    {
        $data['pagetitle'] = 'Edit Client';
        if($this->session->userdata("loggedin")!='1'){
            $this->load->view('theme/login.php',$params);
        } else {
            $this->cm->deleteClient($id);
            header("Location:{$this->config->item("base_url")}/clients");
        }
    }
    public function get_location($id)
    {
      $locations = $this->cm->getLocationByClientId($id);
      $output = '';
        if(is_array($locations)){
            foreach ($locations as $location){
                    $output .= '<option value="'.$location['id'].'">'.$location['name'].'</option>';
            }
            echo $output;
        }else{
            echo FALSE;
        }
        die();
    }
    
    function export()
    {
        $default = array('page', 'filter');

        $params = $this->uri->uri_to_assoc(3, $default);

        //print_r($params); die;
        $filter =  ($params['filter'] != '') ? $params['filter'] : NULL;
        $reports = $this->cm->getAll(NULL, 0 , $filter);
        $this->exportAsCsv('Client List', $reports);
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
                $getValue['name'] = 'Client Name';
                $getValue['sap_code'] = 'Sap Code';
                $getValue['title'] = 'Market Niche';
                $getValue['created_date'] = 'Date';
                $arrayToWrite[$i++] = $getValue;
            }
            $getValue['name'] = $fields['name'];
          
            $getValue['sap_code'] = $fields['sap_code'];
            $getValue['title'] = $fields['title'];
            $getValue['created_date'] = $fields['created_date'];
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
