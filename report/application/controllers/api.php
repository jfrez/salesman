<?php

/* 

 * To change this template, choose Tools | Templates

 * and open the template in the editor.

 */

class Api extends CI_Controller {



    function __construct()

    {

        parent::__construct();

    }



    function index(){

       // $this->load->view('theme/login.php');

    }



    function login() {

        $this->load->model('usersmodel','um');

        $isSaleman = false;



        $response = $this->um->login($this->input->post('username') ,$this->input->post('password'));

        $data = array();

        if($response) {

            $data['success'] = true;

            $data['message'] = 'Ingreso correcto';

            $userinfo = $this->um->getUserDetails($response[0]['id']);

            $userroles = $this->um->getUserRole($response[0]['id']);

            foreach($userroles as $role) {

                if($role['role_id'] ==2) {

                    $isSaleman = true;

                    break;

                }

            }



        }

        if($isSaleman) {

            $data['userinfo'] = $userinfo[0];

            header('Content-type: application/json');

            die(json_encode($data));

        }

        else {

            $data['success'] = false;

            $data['message'] = 'Ingreso fallido';

            header('Content-type: application/json');

            die(json_encode($data));

        }



    }
	function cumplir () {
		        $id = $this->input->post('id');
		 $this->load->model("schedulemodel", "s");

            $response = $this->s->cumplir($id);
		
	}
    function checkin () {
error_reporting(0);
        $this->load->model('clientsmodel','cm');

        $this->client_id     =  $this->input->post('clientid');

        $this->salesman_id   =  $this->input->post('salesmanid');

        $this->location_id   =  $this->input->post('locationid');

        $this->message       =  $this->input->post('message');
		$this->date = date('Y-m-d',  strtotime($this->input->post('date')));
			
		

        $this->is_approved   =  '0';

        $this->status = "checkin";
				$q = $this->db->get_where('visit', array('user' => $this->salesman_id, 'location' =>  $this->location_id));
//buscar
if ($q->num_rows() > 0)
				{
				$row = $q->row();
				$enter = strtotime($row->time);
								$data['enter'] =$enter;
								$data['exit'] =time();

				$diff = time()- $enter;
				$this->visittime = $diff;	
				 $data['time'] =  $diff;			
				}

        if($this->db->insert('scheduled_visits', $this)) {

            $data['success'] = true;

            $data['message'] = 'marcado exitoso';

            header('Content-type: application/json');

            die(json_encode($data));

        }

        $data['success'] = false;

        $data['message'] = 'Ingreso fallido';

        header('Content-type: application/json');

        die(json_encode($data));

    }

    function nearbyclients() {

       // print_r($this->input->post());die;

        $this->load->model('clientsmodel','cm');

        $lat = $this->input->post('lat');

        $lng = $this->input->post('lng');
		
        $response = $this->cm->getNearBy($lat, $lng);



        if($response) {

            $data['success'] = true;

            $data['clientList'] = $response;

            header('Content-type: application/json');

            die(json_encode($data));

        } else {

            $data['success'] = false;

            $data['message'] = 'error';

            header('Content-type: application/json');

            die(json_encode($data));

        }

    }

    function myshcedules() {

        $userId = $this->input->post('userid');

        if($userId) {

            $this->load->model("schedulemodel", "s");

            $response = $this->s->getBySaleman($userId, 'pending');
			//$response = $this->s->getTodoBySaleman($userId);

        }



        if($response) {

            $data['success'] = true;

            $data['clientList'] = $response;

            header('Content-type: application/json');

            die(json_encode($data));

        } else {

            $data['success'] = false;

            $data['message'] = 'error';

            header('Content-type: application/json');

            die(json_encode($data));

        }

    }
 function todo() {
  $userId = $this->input->post('userid');

        if($userId) {

            $this->load->model("schedulemodel", "s");

            $response = $this->s->getTodoBySaleman($userId);

        }

        if($response) {

            $data['success'] = true;

            $data['clientList'] = $response;

            header('Content-type: application/json');

            die(json_encode($data));

        } else {

            $data['success'] = false;

            $data['message'] = 'error';

            header('Content-type: application/json');

            die(json_encode($data));

        }

			
    }

    function checkedin() {

        $id = $this->input->post('id');

        if($id) {

            $this->load->model("schedulemodel", "s");

            $this->status     =  'checkin';



            if($this->db->update('scheduled_visits', $this, array('id' => $id))) {

                $data['success'] = true;

                header('Content-type: application/json');

                die(json_encode($data));

            }

        }

        $data['success'] = false;

        $data['message'] = 'failed';

        header('Content-type: application/json');

        die(json_encode($data));

    }

    function getmarketniches() {

        $this->load->model('marketnichemodel', 'mkt_niche');

        $response = $this->mkt_niche->getAll();



        if($response) {

            $data['success'] = true;

            $data['marketList'] = $response;

            header('Content-type: application/json');

            die(json_encode($data));

        } else {

            $data['success'] = false;

            $data['message'] = 'failed';

            header('Content-type: application/json');

            die(json_encode($data));

        }

    }

    function getuserinfo() {

//        $this->load->model("usersmodel", "u");

//        $userid = $this->input->post('userid');

//        $response = $this->u->getUser($userid);

//

//        if($response) {

//            $data['success'] = true;

//            $data['us'] = $response;

//            header('Content-type: application/json');

//            die(json_encode($data));

//        } else {

//            $data['success'] = false;

//            $data['message'] = 'failed';

//            header('Content-type: application/json');

//            die(json_encode($data));

//        }

    }

    function  updateprofile() {

        $this->load->library('form_validation');



        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');

        $this->form_validation->set_rules('sur_name', 'Sur Name', 'trim|xss_clean');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');

        if(count($_POST) > 0){

            if ($this->form_validation->run() ) {

                $this->name              =  $this->input->post('name');

                $this->sur_name          =  $this->input->post('sur_name');

                $this->email             =  $this->input->post('email');

                //$this->password          =  md5($this->input->post('password'));



                $userid = $this->input->post('userid');



                if($userid && $this->db->update('users', $this, array('id' => $userid))) {

                    $data['success'] = true;

                    $this->load->model('usersmodel','um');

                    $userinfo = $this->um->getUserDetails($userid);

                    $data['userinfo'] = $userinfo[0];

                    header('Content-type: application/json');

                    die(json_encode($data));

                } else  {

                    $data['success'] = false;

                    $data['message'] = 'failed';

                    header('Content-type: application/json');

                    die(json_encode($data));

                }

            }

        }

    }

function getclients(){
            $this->load->model('clientsmodel', 'cm');
            $clientList = $this->cm->getAll(NULL, 0 );
			  die(json_encode($clientList));


}


    function addclient() {

        $this->load->library('form_validation');




        $this->form_validation->set_rules('lat', 'Lat', 'trim|required|xss_clean');

        $this->form_validation->set_rules('lon', 'Lon', 'trim|required|xss_clean');

        $this->form_validation->set_rules('location_name', 'Location Name', 'trim|required|xss_clean');




        if(count($_POST) > 0){

            //print_r($_POST);die;

            if ($this->form_validation->run()) {


                $clientId =  $this->input->post('client');
                $locData = array(

                    'address' => $this->input->post('address'),

                    'name' => $this->input->post('location_name'),
					'contacto' => $this->input->post('contacto'),
					'desc' => $this->input->post('desc'),
					'tel' => $this->input->post('tel'),
					'email' => $this->input->post('email'),

                    'lat' => $this->input->post('lat'),

                    'lon' => $this->input->post('lon')

                );

                if($this->db->insert("locations", $locData)) {

                    $locId = $this->db->insert_id();

                    $this->db->insert("clients_locations", array('client_id' => $clientId, 'location_id' => $locId));



                }

                $data['success'] = true;

                header('Content-type: application/json');

                die(json_encode($data));



            } else {

                $data['success'] = false;

                $data['message'] = 'failed';

                header('Content-type: application/json');

                die(json_encode($data));

            }

        }

    }

    function locate() {

                $data = array(
				'user' =>  $this->input->post('user'),
			    'lat' =>  $this->input->post('lat'),
				'lng' =>  $this->input->post('lng'),
				'time' => date("Y-m-d H:i:s")
				);
				
				
				$query = $this->db->get_where('localization', array('user' => $data['user']));
				if ($query->num_rows() > 0)
				{
					$this->db->where('user', $data['user']);
					$this->db->update('localization', $data); 

				}else{
	    			 $this->db->insert("localization", $data);
				}



	}
 function event() {


$eventtime   = strtotime($this->input->post("date")." ".$this->input->post("time"));
		$eventtime   = date('Y-m-d H:i:s', $eventtime); 
                $data = array(
				'owner' =>  $this->input->post('salesmanid'),
			    'Description' =>  $this->input->post('message'),
				'Date' =>  $eventtime,
				);
				
						print_r($data);

				
	    			 $this->db->insert("events", $data);
				


	}
	 function getevents() {

				$owner=  $this->input->post('salesmanid');

		$query=$this->db->query('select Description, DATEDIFF(events.Date,NOW()) as Date from events where Date > now() and Date < adddate(now(),Interval 7 day) and owner = '.$owner);
		
		$r = array();

   foreach ($query->result() as $row)
   {
    $r[] = $row;
   }
	echo json_encode($r);

	}
function enter() {
  $data = array(
				'user' =>  $this->input->post('user'),
			    'location' =>  $this->input->post('location'),
				
				);
				
				
				$query = $this->db->get_where('visit', array('user' => $data['user']));
				if ($query->num_rows() > 0)
				{
					$this->db->where('user', $data['user']);
					$this->db->update('visit', $data); 

				}else{
	    			 $this->db->insert("visit", $data);
				}
}
function getenter() {
  $data = array(
				'user' =>  $this->input->post('user'),
				
				);
				
				
				$query = $this->db->get_where('visit', array('user' => $data['user']));
					$r = array();

			   foreach ($query->result() as $row)
			   {
				$r[] = $row;
			   }
				echo json_encode($r);	
}


//COMPROMISOS
    function getComp() {
 $user = $this->input->post('user');
        $this->load->model('compmodel');

        $response = $this->compmodel->getCommitbyUser($user);



        if($response) {

            $data['success'] = true;

            $data['comp'] = $response;

            header('Content-type: application/json');

	    
            die(json_encode($data));

        } else {

            $data['success'] = false;

            $data['message'] = 'failed';

            header('Content-type: application/json');

            die(json_encode($data));

        }

    }
    function getCompAll() {
 $user = $this->input->post('user');
        $this->load->model('compmodel');

        $response = $this->compmodel->getCommitbyUserAll($user);



        if($response) {

            $data['success'] = true;

            $data['comp'] = $response;

            header('Content-type: application/json');

	    
            die(json_encode($data));

        } else {

            $data['success'] = false;

            $data['message'] = 'failed';

            header('Content-type: application/json');

            die(json_encode($data));

        }

    }

function addComp() {
 $user = $this->input->post('user');
 $client = $this->input->post('client');
 $fecha = $this->input->post('fecha');
 $comment = $this->input->post('comment');
 $type = $this->input->post('type');
  $importance = $this->input->post('importance');

 
        $this->load->model('compmodel');

        $response = $this->compmodel->newCommit($user,$client,$fecha,$comment,$type,$importance);

echo "Compromiso Agregado";
}
function doneComp() {
 $id = $this->input->post('id');
 
        $this->load->model('compmodel');

        $response = $this->compmodel->doneCommit($id);

}
function undoneComp() {
 $id = $this->input->post('id');
 
        $this->load->model('compmodel');

        $response = $this->compmodel->undoneCommit($id);


}


//OPORTUNIDADES

  function getOpor() {
 $user = $this->input->post('user');
        $this->load->model('opormodel');

        $response = $this->opormodel->getOporbyUser($user);



        if($response) {

            $data['success'] = true;

            $data['comp'] = $response;

            header('Content-type: application/json');

	    
            die(json_encode($data));

        } else {

            $data['success'] = false;

            $data['message'] = 'failed';

            header('Content-type: application/json');

            die(json_encode($data));

        }

    }
    function getOporAll() {
 $user = $this->input->post('user');
        $this->load->model('opormodel');

        $response = $this->opormodel->getoporbyUserAll($user);



        if($response) {

            $data['success'] = true;

            $data['comp'] = $response;

            header('Content-type: application/json');

	    
            die(json_encode($data));

        } else {

            $data['success'] = false;

            $data['message'] = 'failed';

            header('Content-type: application/json');

            die(json_encode($data));

        }

    }

function addOpor() {
 $salesman = $this->input->post('user');
 $client = $this->input->post('client');
 $fecha = $this->input->post('fecha');
 $comment = $this->input->post('comment');
 $amount = $this->input->post('amount');
  $prob = $this->input->post('prob');

 
        $this->load->model('opormodel');

        $response = $this->opormodel->newOpor($salesman,$client,$fecha,$comment,$amount,$prob);

}


}

?>