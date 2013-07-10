<?php

class comp extends CI_Controller 

{


    function __construct()

    {

        parent::__construct();



        $this->load->model("compmodel", "s");

        //$this->session->start();

        if($this->session->userdata("loggedin")!='1'){

            redirectToLogin();

            die();

        }

        parse_str($_SERVER['QUERY_STRING'], $_GET);

    }

    function index()

    {
/*
        $default = array('page', 'filter', 'category', 'location', 'client', 'salesman', 'from', 'to');



        $params = $this->uri->uri_to_assoc(2, $default); //print_r($params);die;

        $data['pagetitle'] = "Inicio > Solicitar Visita";

        if($this->session->userdata("loggedin")!='1'){

            $this->load->view('theme/login.php');

        } else {

            $page =  ($params['page'] != '') ? $params['page'] : 1;

            $per_page = 2;

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

            $filterByStatus = 'pending';

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





            $config['base_url'] =  $this->config->item("base_url") . 'schedule/' . $this->uri->assoc_to_uri($urisegments) . '/page/';

            $config['total_rows'] = $this->s->getTotalCount($filterByCategory, $filterByLocation, $filterByClient, $filterBySalesman,$filterByfrom,$filterByTo, $filterByStatus);

            $config['per_page'] = $per_page;

            $config['use_page_numbers'] = TRUE;

            $data['total_count'] = $config['total_rows'];

            $config['cur_tag_open'] = '<a href="#" class="active">';

            $config['cur_tag_close'] = '</a>';

            $this->pagination->initialize($config);

            $response = $this->s->getAll($per_page, $offset, $filterByCategory, $filterByLocation, $filterByClient,$filterBySalesman,$filterByfrom,$filterByTo, $filterByStatus);

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

            $urisegments['status'] = "pending";

            $data['exporturl'] = $this->config->item("base_url") . 'schedule/export/' . $this->uri->assoc_to_uri($urisegments);

            $this->load->view('theme/checkedplot',$data);

        }
*/
    }

    function checkedin()

    {

        $default = array('page', 'filter', 'category', 'location', 'client', 'salesman', 'from', 'to','is_approved');



        $params = $this->uri->uri_to_assoc(3, $default);// print_r($params);die;

        $data['pagetitle'] = "Inicio > Visitas ";

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
			$is_approved =  ($params['is_approved'] != '') ? $params['is_approved'] : NULL;

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
			if($params['is_approved'] != '') {

                $urisegments['is_approved'] = $is_approved;
				

            }


            $filterByStatus = 'checkin';

//            if($page > 1)

//                $urisegments['page'] = $page;

            $config['base_url'] =  $this->config->item("base_url") . 'schedule/checkedin/' . $this->uri->assoc_to_uri($urisegments) . '/page/';

            $config['total_rows'] = $this->s->getTotalCount($filterByCategory, $filterByLocation, $filterByClient, $filterBySalesman,$filterByfrom,$filterByTo, $filterByStatus);

            $config['per_page'] = $per_page;

            $config['use_page_numbers'] = TRUE;

            $data['total_count'] = $config['total_rows'];

            $config['cur_tag_open'] = '<a href="#" class="active">';

            $config['cur_tag_close'] = '</a>';

            $this->pagination->initialize($config);

            $response = $this->s->getAll($per_page, $offset, $filterByCategory, $filterByLocation, $filterByClient,$filterBySalesman,$filterByfrom,$filterByTo, $filterByStatus,$is_approved);
			

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
			$data['is_approved'] = $is_approved;


            $urisegments['status'] = "checkin";

            $data['exporturl'] = $this->config->item("base_url") . 'schedule/export/' . $this->uri->assoc_to_uri($urisegments);

            $this->load->view('theme/checkedinlist',$data);

        }

    }
    function complist()

    {

        $default = array('page', 'filter', 'category', 'location', 'client', 'salesman', 'from', 'to','is_approved');



        $params = $this->uri->uri_to_assoc(3, $default);// print_r($params);die;

        $data['pagetitle'] = "Inicio > Compromisos ";

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
            $is_approved =  ($params['is_approved'] != '') ? $params['is_approved'] : NULL;


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
            if($params['is_approved'] != '') {

                $urisegments['is_approved'] = $is_approved;
                

            }

            $filterByStatus = 'checkin';

//            if($page > 1)

//                $urisegments['page'] = $page;

            $config['base_url'] =  $this->config->item("base_url") . 'comp/checkedplot/' . $this->uri->assoc_to_uri($urisegments) . '/page/';

            
            
            $response = $this->s->getAll($per_page, $offset, $filterByCategory, $filterByLocation, $filterByClient,$filterBySalesman,$filterByfrom,$filterByTo, $filterByStatus,$is_approved);
            

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
            



            $urisegments['status'] = "checkin";


            $this->load->view('theme/complist',$data);

        }

    }

    function checkedplot()

    {

        $default = array('page', 'filter', 'category', 'location', 'client', 'salesman', 'from', 'to','is_approved');



        $params = $this->uri->uri_to_assoc(3, $default);// print_r($params);die;

        $data['pagetitle'] = "Inicio > Reporte Compromisos ";

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
            $is_approved =  ($params['is_approved'] != '') ? $params['is_approved'] : NULL;


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
            if($params['is_approved'] != '') {

                $urisegments['is_approved'] = $is_approved;
                

            }

            $filterByStatus = 'checkin';

//            if($page > 1)

//                $urisegments['page'] = $page;

            $config['base_url'] =  $this->config->item("base_url") . 'comp/checkedplot/' . $this->uri->assoc_to_uri($urisegments) . '/page/';

            
            
            $response = $this->s->getAll($per_page, $offset, $filterByCategory, $filterByLocation, $filterByClient,$filterBySalesman,$filterByfrom,$filterByTo, $filterByStatus,$is_approved);
			

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
			



            $urisegments['status'] = "checkin";


            $this->load->view('theme/compplot',$data);

        }

    }


    function add()

    {

        $data['pagetitle'] = 'Inicio > Agendar Visita > Agregar';



        if($this->session->userdata("loggedin")!='1'){

            $this->load->view('theme/login.php');

        } else {

            $this->load->library('form_validation');

            //$this->load->helper(array('form', 'url'));



            $this->form_validation->set_rules('client', 'Client Name', 'trim|required|xss_clean');

            $this->form_validation->set_rules('salesman', 'Salesman', 'trim|required|xss_clean');

            $this->form_validation->set_rules('location', 'Location', 'trim|required|xss_clean');

          

            if(count($_POST) > 0){



                if ($this->form_validation->run() == FALSE)

                {



                } else {

                    $this->client_id     =  $this->input->post('client');

                    $this->salesman_id   =  $this->input->post('salesman');

                    $this->location_id   =  $this->input->post('location');
					$this->comment   =  $this->input->post('comment');
					$this->date = $this->input->post('date');

                    $this->is_approved   =  '1';

                   

                    $this->db->insert('scheduled_visits', $this);

                    header("Location:{$this->config->item("base_url")}schedule");

                }



            }

            $data['schedule_data'] = null;

            $this->load->model('clientsmodel', 'cm');

            $clientList = $this->cm->getAll();

            $data['clientList'] = $clientList;

            $this->load->model('usersmodel', 'u');

            $data['salesManList'] = $this->u->getByRole('Sales Man');

            $this->load->model('locationsmodel', 'l');

            $data['locationList'] = $this->l->getAll(); //print_r($data['locationList']);die;

            $this->load->view('theme/scheduleadd',$data);

        }

    }

    function edit($id)

    {

        $data['pagetitle'] = 'Inicio > Agendar Visita >  Editar';



        if($this->session->userdata("loggedin")!='1'){

            $this->load->view('theme/login.php');

        } else {

            $this->load->library('form_validation');

            //$this->load->helper(array('form', 'url'));



            $this->form_validation->set_rules('client', 'Client Name', 'trim|required|xss_clean');

            $this->form_validation->set_rules('salesman', 'Salesman', 'trim|required|xss_clean');

            $this->form_validation->set_rules('location', 'Location', 'trim|required|xss_clean');

          

            if(count($_POST) > 0){



                if ($this->form_validation->run() )

                {

                    $this->client_id     =  $this->input->post('client');

                    $this->salesman_id   =  $this->input->post('salesman');

                    $this->location_id   =  $this->input->post('location');

                    

                    $this->db->update('scheduled_visits', $this, array('id' => $id));

                    header("Location:{$this->config->item("base_url")}schedule");

                } 

            }

            

            $data['schedule_data'] = $this->s->getById($id);

            $this->load->model('clientsmodel', 'cm');

            $clientList = $this->cm->getAll();

            $data['clientList'] = $clientList;

            $this->load->model('usersmodel', 'u');

            $data['salesManList'] = $this->u->getByRole('Sales man');

            $this->load->model('locationsmodel', 'l');

            $data['locationList'] = $this->l->getAll();

            $this->load->view('theme/scheduleadd',$data);

        }

    }

    function delete($id)

    {

        $data['pagetitle'] = 'Inicio > Agendar Visita > Eliminar';

        if($this->session->userdata("loggedin")!='1'){

            $this->load->view('theme/login.php');

        } else {

            $this->s->delete($id);

            header("Location:{$this->config->item("base_url")}schedule");

        }

    }

    function export()

    {

        $default = array('page', 'filter', 'category', 'location', 'client', 'from', 'to', 'status');



        $params = $this->uri->uri_to_assoc(3, $default);

        //print_r($params);die;

        $filterByCategory =  (isset ($params['category']) && $params['category'] != '') ? $params['category'] : NULL;

        $filterByLocation =  (isset ($params['location']) && $params['location'] != '') ? $params['location'] : NULL;

        $filterByClient =  (isset ($params['client']) && $params['client'] != '') ? $params['client'] : NULL;

        $filterBySalesman =  (isset ($params['salesman']) && $params['salesman'] != '') ? $params['salesman'] : NULL;

        $filterByfrom =  (isset ($params['from']) && $params['from'] != '') ? $params['from'] : NULL;

        $filterByTo =  (isset ($params['to']) && $params['to'] != '') ? $params['to'] : NULL;

        $filterByStatus =  (isset ($params['status']) && $params['status'] != '') ? $params['status'] : NULL;

        $reports = $this->s->getAll(NULL, 0, $filterByCategory, $filterByLocation, $filterByClient, $filterBySalesman, $filterByfrom, $filterByTo, $filterByStatus);

        $this->exportAsCsv('Schedule List', $reports);

        return true;

    }

    function isok($id) {

        if($id) {

            $this->load->model("schedulemodel", "s");

            $this->is_approved     =  '1';



            if($this->db->update('scheduled_visits', $this, array('id' => $id))) {

                $data['success'] = true;



            }

        }

        header("Location:{$this->config->item("base_url")}schedule/checkedin");

    }

    function exportAsCsv($title, $getReports)

    {
		
        $csvFile = APPPATH.'../static/new.csv';



        $fp = fopen($csvFile, 'w');

        $arrayToWrite = array();

        $i=0;

        

        foreach ($getReports as $fields) {

            if($i == 0){
				$getValue['created_date'] = "Fecha";
				
                $getValue['client_name'] = 'Cliente';
				$getValue['location_name'] = "Ubicación";				

                $getValue['salesman_name'] = 'Vendedor';
				$getValue['message'] = 'Compromiso';
				$getValue['is_approved'] = 'cumplido';
				

                $getValue['address'] = 'Dirección';

                $arrayToWrite[$i++] = ($getValue);

            }
				$getValue['created_date'] = $fields['created_date'];

            $getValue['client_name'] = utf8_decode($fields['client_name']);
          	$getValue['location_name'] =  utf8_decode($fields['location_name']);				


            $getValue['salesman_name'] =utf8_decode( $fields['salesman_name']);
				$getValue['message'] = utf8_decode( $fields['message']);
$getValue['is_approved'] = $fields['is_approved'];
            $getValue['address'] =utf8_decode( $fields['address']);

            $arrayToWrite[$i] = ($getValue);

            

            $i++;

        }

        

        foreach ($arrayToWrite as $write):

            fputcsv($fp, $write);

        endforeach;
		
		$table = $this->array2table($arrayToWrite);		

        fclose($fp);
header("Content-disposition: attachment; filename=csv.xls");
header("Content-type: application/vnd.ms-excel");

//      readfile($csvFile);

		echo $table;
  

        exit;



    }

function array2table($array, $recursive = false, $null = ' '){
	$table = "<table>";
	$table .= "\t<tr>";
	foreach ($array[0] as $heading) {
		$table .= '<th>' . $heading . '</th>';
	}
	$table .= "</tr>\n";
	$i=0;
	foreach ($array as $row) {
	if($i>0){
		$table .= "\t<tr>" ;
		foreach ($row as $cell) {
			$table .= '<td>';
			if (is_object($cell)) { $cell = (array) $cell; }
			if ($recursive === true && is_array($cell) && !empty($cell)) {
				$table .= "\n" . array2table($cell, true, true) . "\n";
			} else {
				$table .= (strlen($cell)> 0) ?
				htmlspecialchars((string) $cell) :
				$null;
			}
				$table .= '</td>';
		}
				$table .= "</tr>\n";
				}
				$i++;
		}
	$table .= '</table>';
	return $table;
}

	
}