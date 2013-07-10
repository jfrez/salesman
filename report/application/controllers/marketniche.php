<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tarek
 * Date: 4/19/12
 * Time: 6:40 PM
 *
 */
class MarketNiche extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('marketnichemodel', 'mkt_niche');
    }

    function index($page=1) {
        $data['pagetitle'] = "Inicio > Nichos";
        if($this->session->userdata("loggedin")!='1')
            $this->load->view('theme/login.php',$params);
        else {
            $per_page = 4;
            $offset = ($page -1) * $per_page;
            $this->load->library('pagination');

            $config['base_url'] = $this->config->item("base_url") . 'marketniche/index/';
            $config['total_rows'] = $this->mkt_niche->getTotalCount();;
            $config['per_page'] = 4;
            $config['use_page_numbers'] = TRUE;
            $data['total_count'] = $config['total_rows'];
            $config['cur_tag_open'] = '<a href="#" class="active">';
            $config['cur_tag_close'] = '</a>';
            $this->pagination->initialize($config);
            $response = $this->mkt_niche->getAll($per_page, $offset);
            if($response) {
                $data['marketList'] = $response;//die;
            }
            $this->load->view('theme/marketnichelist',$data);
        }
    }

    function add() {

        if($this->session->userdata("loggedin")!='1') {
            $this->load->view('theme/login.php');
        } else {
            $data['pagetitle'] = 'Inicio > Nichos > Agregar';
            $this->load->library('form_validation');
            //$this->load->helper(array('form', 'url'));

            $this->form_validation->set_rules('title', 'Market Niche Name', 'trim|required|min_length[3]|max_length[30]|xss_clean');
            if(count($_POST) > 0){

                if ($this->form_validation->run())
                {
                    $this->title = $this->input->post('title');

                    $this->db->insert('market_niches', $this);

                    header("Location:{$this->config->item("base_url")}marketniche");
                }

            }
            //$this->load->model('marketnichemodel', 'mkt_niche');
            //$marketNiche = $this->mkt_niche->getAll();
            //$data['market_niche'] = $marketNiche;
            $data['client_data'] = null;
            $this->load->view('theme/addmarket',$data);
        }
    }

    function edit($id)
    {
        $data['pagetitle'] = 'Inicio > Nichos > Editar';
        if($this->session->userdata("loggedin")!='1'){
            $this->load->view('theme/login.php',$params);
        } else {
            $this->load->library('form_validation');
            //$this->load->helper(array('form', 'url'));

            $this->form_validation->set_rules('title', 'Market Niche Name', 'trim|required|min_length[3]|max_length[30]|xss_clean');

            if(count($_POST) > 0){

                if ($this->form_validation->run()) {
                    $this->title = $this->input->post('title');

                    $this->db->update('market_niches', $this, array('id' => $id));
                    $this->load->view('theme/addmarket.php');
                    header("Location:{$this->config->item("base_url")}marketniche");
                }

            }

            $data['client_data'] = $this->mkt_niche->getMarket($id);

            $this->load->view('theme/addmarket',$data);

        }
    }
    function delete($id)
    {
        $data['pagetitle'] = 'Inicio > Nichos > Borrar';
        if($this->session->userdata("loggedin")!='1'){
            $this->load->view('theme/login.php',$params);
        } else {
            $this->mkt_niche->deleteMarketNiche($id);
            header("Location:{$this->config->item("base_url")}marketniche");
        }
    }
    function export()
    {
        $reports = $this->mkt_niche->getAll();
        $this->exportAsCsv('Market Niche List', $reports);
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
                $getValue['title'] = 'Title';
                $getValue['status'] = 'Status';
                $getValue['created_date'] = 'Date';
                $arrayToWrite[$i++] = $getValue;
            }
            $getValue['title'] = $fields['title'];
          
            $getValue['status'] = $fields['status'];
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
