<?php

class opor extends CI_Controller 

{


    function __construct()

    {

        parent::__construct();



        $this->load->model("opormodel", "o");

        //$this->session->start();

        if($this->session->userdata("loggedin")!='1'){

            redirectToLogin();

            die();

        }

        parse_str($_SERVER['QUERY_STRING'], $_GET);

    }

    function changeState($id,$state){
        $this->o->changeState($id,$state);
    }

    function changeMontoF($id,$monto){
        $this->o->changeMontoF($id,$monto);
    }

    function index()

    {

    }

    function nuevas()

    {

        $default = array('page', 'filter', 'category', 'location', 'client', 'salesman', 'from', 'to','status','prob');



        $params = $this->uri->uri_to_assoc(3, $default);// print_r($params);die;

        $data['pagetitle'] = "Inicio > Nuevas Oportunidades ";

        if($this->session->userdata("loggedin")!='1'){

            $this->load->view('theme/login.php');

        } else {

            $page =  ($params['page'] != '') ? $params['page'] : 1;//die('>>>'.$page);

            $per_page = 30;

            $offset = ($page -1) * $per_page;

            $this->load->library('pagination');

            $this->load->model('clientsmodel', 'cm');

            $this->load->model('marketnichemodel', 'mktm');

            $this->load->model("locationsmodel", "l");



            $filterByCategory =  ($params['category'] != '') ? $params['category'] : NULL;

            $filterByLocation =  ($params['location'] != '') ? $params['location'] : NULL;

            $filterByClient =  ($params['client'] != '') ? $params['client'] : NULL;

            $filterBySalesman =  ($params['salesman'] != '') ? $params['salesman'] : NULL;

            $filterByfrom =  ($params['from'] != '') ? $params['from'] : NULL;

            $filterByTo =  ($params['to'] != '') ? $params['to'] : NULL;
            $filterByProb =  ($params['prob'] != '') ? $params['prob'] : NULL;
            $filterByStatus =  ($params['status'] != '') ? $params['status'] : NULL;
            $filterByStatus="New";

            $urisegments = array();



            if($params['category'] != '') {

                $urisegments['category'] = $filterByCategory;

            }

            if($params['location'] != '') {

                $urisegments['location'] = $filterByLocation;

            }

            if($params['client'] != '') {

                $urisegments['client'] = $filterByClient;

            }

            if($params['salesman'] != '') {

                $urisegments['salesman'] = $filterBySalesman;

            }

            if($params['from'] != '') {

                $urisegments['from'] = $filterByfrom;

            }

            if($params['to'] != '') {

                $urisegments['to'] = $filterByTo;

            }

            if($params['prob'] != '') {

                $urisegments['prob'] = $filterByProb;

            }
                 if($params['status'] != '') {

                $urisegments['status'] = $filterByStatus;

            }
            



//      
            $config['base_url'] =  $this->config->item("base_url") . 'opor/nuevas/' . $this->uri->assoc_to_uri($urisegments) . '/page/';


            $config['per_page'] = $per_page;

            $config['use_page_numbers'] = TRUE;


            $config['cur_tag_open'] = '<a href="#" class="active">';

            $config['cur_tag_close'] = '</a>';

            $this->pagination->initialize($config);

            $response = $this->o->getAll($per_page, $offset, $filterByCategory, $filterByLocation, $filterByClient,$filterBySalesman,$filterByfrom,$filterByTo, $filterByStatus,$filterByProb);


            if($response) {

                $data['scheduleList'] = $response;//die;

            }



            $data['categoryList'] =  $this->mktm->getAll();



            $locationList = ($filterByClient) ? $this->l->getLocationsByClient($filterByClient) : $this->l->getAll();

            $data['locationList'] = $locationList;

            $data['clientList'] = $this->cm->getAll(NULL, 0 , $filterByCategory);

            $this->load->model('usersmodel', 'u');

            $data['salesManList'] = $this->u->getByRole('Sales Man');



            $data['filterBycategory'] = $filterByCategory;

            $data['filterBylocation'] = $filterByLocation;

            $data['filterByClient'] = $filterByClient;

            $data['filterBySalesman'] = $filterBySalesman;

            $data['filterByFrom'] = $filterByfrom;

            $data['filterByTo'] = $filterByTo;
            $data['filterByStatus'] = $filterByStatus;



            $data['exporturl'] = $this->config->item("base_url") . 'opor/nuevas/' . $this->uri->assoc_to_uri($urisegments);

            $this->load->view('theme/opornew',$data);
        }

    }
     function admin()

    {

        $default = array('page', 'filter', 'category', 'location', 'client', 'salesman', 'from', 'to','status','prob');



        $params = $this->uri->uri_to_assoc(3, $default);// print_r($params);die;

        $data['pagetitle'] = "Inicio > Oportunidades procesadas";

        if($this->session->userdata("loggedin")!='1'){

            $this->load->view('theme/login.php');

        } else {

            $page =  ($params['page'] != '') ? $params['page'] : 1;//die('>>>'.$page);

            $per_page = 30;

            $offset = ($page -1) * $per_page;

            $this->load->library('pagination');

            $this->load->model('clientsmodel', 'cm');

            $this->load->model('marketnichemodel', 'mktm');

            $this->load->model("locationsmodel", "l");



            $filterByCategory =  ($params['category'] != '') ? $params['category'] : NULL;

            $filterByLocation =  ($params['location'] != '') ? $params['location'] : NULL;

            $filterByClient =  ($params['client'] != '') ? $params['client'] : NULL;

            $filterBySalesman =  ($params['salesman'] != '') ? $params['salesman'] : NULL;

            $filterByfrom =  ($params['from'] != '') ? $params['from'] : NULL;

            $filterByTo =  ($params['to'] != '') ? $params['to'] : NULL;
            $filterByProb =  ($params['prob'] != '') ? $params['prob'] : NULL;
            $filterByStatus =  ($params['status'] != '') ? $params['status'] : NULL;

            $urisegments = array();



            if($params['category'] != '') {

                $urisegments['category'] = $filterByCategory;

            }

            if($params['location'] != '') {

                $urisegments['location'] = $filterByLocation;

            }

            if($params['client'] != '') {

                $urisegments['client'] = $filterByClient;

            }

            if($params['salesman'] != '') {

                $urisegments['salesman'] = $filterBySalesman;

            }

            if($params['from'] != '') {

                $urisegments['from'] = $filterByfrom;

            }

            if($params['to'] != '') {

                $urisegments['to'] = $filterByTo;

            }

            if($params['prob'] != '') {

                $urisegments['prob'] = $filterByProb;

            }
                 if($params['status'] != '') {

                $urisegments['status'] = $filterByStatus;

            }
            



//      
            $config['base_url'] =  $this->config->item("base_url") . 'opor/nuevas/' . $this->uri->assoc_to_uri($urisegments) . '/page/';


            $config['per_page'] = $per_page;

            $config['use_page_numbers'] = TRUE;


            $config['cur_tag_open'] = '<a href="#" class="active">';

            $config['cur_tag_close'] = '</a>';

            $this->pagination->initialize($config);

            $response = $this->o->getAll($per_page, $offset, $filterByCategory, $filterByLocation, $filterByClient,$filterBySalesman,$filterByfrom,$filterByTo, $filterByStatus,$filterByProb);


            if($response) {

                $data['scheduleList'] = $response;//die;

            }



            $data['categoryList'] =  $this->mktm->getAll();



            $locationList = ($filterByClient) ? $this->l->getLocationsByClient($filterByClient) : $this->l->getAll();

            $data['locationList'] = $locationList;

            $data['clientList'] = $this->cm->getAll(NULL, 0 , $filterByCategory);

            $this->load->model('usersmodel', 'u');

            $data['salesManList'] = $this->u->getByRole('Sales Man');



            $data['filterBycategory'] = $filterByCategory;

            $data['filterBylocation'] = $filterByLocation;

            $data['filterByClient'] = $filterByClient;

            $data['filterBySalesman'] = $filterBySalesman;

            $data['filterByFrom'] = $filterByfrom;

            $data['filterByTo'] = $filterByTo;
            $data['filterByStatus'] = $filterByStatus;



            $data['exporturl'] = $this->config->item("base_url") . 'opor/nuevas/' . $this->uri->assoc_to_uri($urisegments);

            $this->load->view('theme/oporadmin',$data);
        }

    }

   


       function report()

    {

        $default = array('page', 'filter', 'category', 'location', 'client', 'salesman', 'from', 'to','status','prob');



        $params = $this->uri->uri_to_assoc(3, $default);// print_r($params);die;

        $data['pagetitle'] = "Inicio > Oportunidades ";

        if($this->session->userdata("loggedin")!='1'){

            $this->load->view('theme/login.php');

        } else {

            $page =  ($params['page'] != '') ? $params['page'] : 1;//die('>>>'.$page);

            $per_page = 30;

            $offset = ($page -1) * $per_page;

            $this->load->library('pagination');

            $this->load->model('clientsmodel', 'cm');

            $this->load->model('marketnichemodel', 'mktm');

            $this->load->model("locationsmodel", "l");



            $filterByCategory =  ($params['category'] != '') ? $params['category'] : NULL;

            $filterByLocation =  ($params['location'] != '') ? $params['location'] : NULL;

            $filterByClient =  ($params['client'] != '') ? $params['client'] : NULL;

            $filterBySalesman =  ($params['salesman'] != '') ? $params['salesman'] : NULL;

            $filterByfrom =  ($params['from'] != '') ? $params['from'] : NULL;

            $filterByTo =  ($params['to'] != '') ? $params['to'] : NULL;
            $filterByProb =  ($params['prob'] != '') ? $params['prob'] : NULL;
            $filterByStatus =  ($params['status'] != '') ? $params['status'] : NULL;
        

            $urisegments = array();



            if($params['category'] != '') {

                $urisegments['category'] = $filterByCategory;

            }

            if($params['location'] != '') {

                $urisegments['location'] = $filterByLocation;

            }

            if($params['client'] != '') {

                $urisegments['client'] = $filterByClient;

            }

            if($params['salesman'] != '') {

                $urisegments['salesman'] = $filterBySalesman;

            }

            if($params['from'] != '') {

                $urisegments['from'] = $filterByfrom;

            }

            if($params['to'] != '') {

                $urisegments['to'] = $filterByTo;

            }

            if($params['prob'] != '') {

                $urisegments['prob'] = $filterByProb;

            }
                 if($params['status'] != '') {

                $urisegments['status'] = $filterByStatus;

            }
            



//      
            $config['base_url'] =  $this->config->item("base_url") . 'opor/report/' . $this->uri->assoc_to_uri($urisegments) . '/page/';


            $config['per_page'] = $per_page;

            $config['use_page_numbers'] = TRUE;


            $config['cur_tag_open'] = '<a href="#" class="active">';

            $config['cur_tag_close'] = '</a>';

            $this->pagination->initialize($config);

            $response = $this->o->getAll($per_page, $offset, $filterByCategory, $filterByLocation, $filterByClient,$filterBySalesman,$filterByfrom,$filterByTo, $filterByStatus,$filterByProb);


            if($response) {

                $data['scheduleList'] = $response;//die;

            }



            $data['categoryList'] =  $this->mktm->getAll();



            $locationList = ($filterByClient) ? $this->l->getLocationsByClient($filterByClient) : $this->l->getAll();

            $data['locationList'] = $locationList;

            $data['clientList'] = $this->cm->getAll(NULL, 0 , $filterByCategory);

            $this->load->model('usersmodel', 'u');

            $data['salesManList'] = $this->u->getByRole('Sales Man');



            $data['filterBycategory'] = $filterByCategory;

            $data['filterBylocation'] = $filterByLocation;

            $data['filterByClient'] = $filterByClient;

            $data['filterBySalesman'] = $filterBySalesman;

            $data['filterByFrom'] = $filterByfrom;

            $data['filterByTo'] = $filterByTo;
            $data['filterByStatus'] = $filterByStatus;



            $data['exporturl'] = $this->config->item("base_url") . 'opor/report/' . $this->uri->assoc_to_uri($urisegments);

            $this->load->view('theme/oporplot',$data);

        }

    }

	
}