<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class visita extends CI_Controller {



	function __construct()

	{

		parent::__construct();

	}



	function index()

	{
	            $this->load->model('usersmodel', 'u');

            $data['salesManList'] = $this->u->getByRole('Sales Man');

            $this->load->view('theme/map',$data);

	}

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */