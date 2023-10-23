<?php
defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */

class Club_Controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_Curl_Club');
        $this->load->library('template');
    }


    function index()
    {
        redirect(base_url('club_controller/getdata'));
    }

    function getData()
    {
        $data = array(
            'limit' => "10",
            'offset' => $this->input->get('offset', TRUE)
        );

        $result = $this->Mdl_Curl_Club->getDataClub($data);
        $data_results['result'] = json_decode($result, TRUE);

        // echo($data_results);
        $this->template->load('data', $data_results);
    }

    function addClub()
    {
        $this->template->load('insertclub');
    }

    function postclub()
    {
        //Validasi Form
        $validValue = array(
            array(
                'field' => 'clubname',
                'label' => 'clubname',
                'rules' => 'required',
            ),
            array(
                'field' => 'clubcity',
                'label' => 'clubcity',
                'rules' => 'required',
            ),
        );
        $this->form_validation->set_rules($validValue);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'clubname' => $this->input->post('clubname', true),
                'city' => $this->input->post('clubcity', true)
            );
            $exec = $this->Mdl_Curl_Club->insertClub($data);
           
           
            $response = json_decode($exec, TRUE);

            if ($response['status_code'] == 1) {
                $this->session->set_flashdata('msg', $response['status_desc']);
                redirect(base_url('club_controller/getdata'), 'location', 301);
            } else {
                $this->session->set_flashdata('msg', $response['status_desc']);
                redirect(base_url('club_controller/addclub'), 'location', 301);
            }
        } else {
            $this->session->set_flashdata('msg', 'Inputan Data Harus Diisi.');
            redirect(base_url('club_controller/addclub'), 'location', 301);
        }
    }

    function getClub($id = NULL)
    {
        if ($id != NULL) {
            $data = array(
                'idclub' => $id
            );
            $result = $this->Mdl_Curl_Club->getDataById($data);
            $response = json_decode($result, true);
            if($response['status_code'] == 1) {
                $data_result = array(
                    'idclub' => $response['results'][0]['idclub'],
                    'clubname' => $response['results'][0]['clubName'],
                    'city' => $response['results'][0]['city'],
                );
                $this->template->load('updateclub', $data_result);
            } else {
                $this->session->set_flashdata('msg', $response['status_desc']);
                redirect(base_url('club_controller/getdata', 'location', 301));
            }
        } else {
            redirect(base_url('club_controller/getdata'), 'location', 301);
        }
    }

    function putDataClub()
    {
        //Form Validation
        $valueValid = array(
            array(
                'field' => 'id',
                'label' => 'id',
                'rules' => 'required',
            ),
            array(
                'field' => 'clubname',
                'label' => 'clubname',
                'rules' => 'required',
            ),
            array(
                'field' => 'city',
                'label' => 'city',
                'rules' => 'required',
            )
        );

        $this->form_validation->set_rules($valueValid);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'idClub' => $this->input->post('id', true),
                'clubname' => $this->input->post('clubname', true),
                'city' => $this->input->post('city', true),
            );
            $response = $this->Mdl_Curl_Club->upDataClub($data);
            $result = json_decode($response, true);

            if ($result['status_code'] == 1) {
                $this->session->set_flashdata('msg', $result['status_desc']);
                redirect(base_url("club_controller/getdata"), 'location', 301); 
            } else {
                $this->session->set_flashdata('msg', $result['status_desc']);
                redirect(base_url("club_controller/getdata"), 'location', 301); 
            }
        } else {
            $this->session->set_flashdata('msg', "Form Harus Terisi Semua");
            redirect(base_url("club_controller/getclub/".$this->input->post('id', true)), 'location', 301);
        }
    }

    function delClub($id = NULL)
    {
        if ($id != NULL){
            $data = array(
                'idclub' => $id,
            );

            $response = $this->Mdl_Curl_Club->delDataClub($data);
            $result = json_decode($response, TRUE);

            if ($result['status_code'] == 1) {
                $this->session->set_flashdata('msg', $result['status_desc']);
                redirect(base_url('club_controller/getdata'), 'location', 301);
            } else {
                $this->session->set_flashdata('msg', $result['status_desc']);
                redirect(base_url('club_controller/getdata'), 'location', 301);
            }
        } else {
            redirect(base_url('club_controller/getdata'), 'location', 301);
        }
    }
}