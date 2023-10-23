<?php
defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/CodeStatus.php';

/**
 * Keys Controller
 * This is a basic Key Management REST controller to make and delete keys
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */

 class Club extends REST_Controller
 {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Mdl_club');
        $this->load->library(array('Lib_validation'));
    }

    function getClub_get() {
        $post = file_get_contents("php://input", "application/json");
        $parin = json_decode($post, true);

        $fieldValid = array(
            "limit" => "",
            "offset" => ""
        );

        $this->lib_validation->fieldValueInvalid(get_instance(), $fieldValid, $parin);

        $result = $this->Mdl_club->getClub($parin);
        $countResult = count($result);
        if ($countResult > 0) {
            $replay['status_code'] = CodeStatus::SUCCESS;
            $replay['status_desc'] = CodeStatus::getName(CodeStatus::SUCCESS);
            $replay['total_results'] = $countResult;
            $replay['results'] = $result;
            $this->response($replay, REST_Controller::HTTP_OK);
        } else {
            $replay['status_code'] = CodeStatus::DATA_NOT_FOUND;
            $replay['status_desc'] = CodeStatus::getName(CodeStatus::DATA_NOT_FOUND);
            $replay['total_results'] = $countResult;
            $this->response($replay, REST_Controller::HTTP_OK);
        }
    }

    public function setClub_post()
    {
        $post = file_get_contents("php://input", "application/json");
        $parin = json_decode($post, true);

        $fieldValid = array(
            "clubname" => "required",
            "city" => "required",
        );

        $this->lib_validation->fieldValueInvalid(get_instance(), $fieldValid, $parin);
        $this->lib_validation->authInvalid(get_instance(), $fieldValid, CodeStatus::NOT_HANDLE);

        if ($this->Mdl_club->cekClub($parin)){
            $replay['status_code'] = CodeStatus::DUPLICATE_DATA;
            $replay['status_desc'] = CodeStatus::getName(CodeStatus::DUPLICATE_DATA);
            $this->response($replay, REST_Controller::HTTP_OK);
        }

        $result = $this->Mdl_club->setClub($parin);
        if ($result) {
            $replay['status_code'] = CodeStatus::SUCCESS;
            $replay['status_desc'] = "Club Berhasil Tersimpan";
            $this->response($replay, REST_Controller::HTTP_OK);
        } else {
            $replay['status_code'] = CodeStatus::DATA_NOT_FOUND;
            $replay['status_desc'] = "Club Gagal Tersimpan";
            $this->response($replay, REST_Controller::HTTP_OK);
        }
    
    }

    function setUpClub_put() {
        $post = file_get_contents("php://input", "application/json");
        $parin = json_decode($post, true);

        $fieldValid = array(
            "idClub" => "required|number",
            "clubname" => "required",
            "city" => "required"
        );

        $this->lib_validation->fieldValueInvalid(get_instance(), $fieldValid, $parin);
        $this->lib_validation->authInvalid(get_instance(), $fieldValid, CodeStatus::NOT_HANDLE);

        if ($this->Mdl_club->cekClub($parin)){
            $replay['status_code'] = CodeStatus::DUPLICATE_DATA;
            $replay['status_desc'] = CodeStatus::getName(CodeStatus::DUPLICATE_DATA);
            $this->response($replay, REST_Controller::HTTP_OK);
        }

        if($this->Mdl_club->setUpClub($parin)){
            $replay['status_code'] = CodeStatus::SUCCESS;
            $replay['status_desc'] = "Club Berhasil Diupdate";
            $this->response($replay, REST_Controller::HTTP_OK);
        } else {
            $replay['status_code'] = CodeStatus::DATA_NOT_FOUND;
            $replay['status_desc'] = "Club Gagal Diupdate";
            $this->response($replay, REST_Controller::HTTP_OK);
        }
    }

    function delClub_post() {
        $post = file_get_contents("php://input", "application/json");
        $parin = json_decode($post, true);

        $fieldValid = array(
            "idclub" => "required|number"
        );

        $this->lib_validation->fieldValueInvalid(get_instance(), $fieldValid, $parin);
        $this->lib_validation->authInvalid(get_instance(), $fieldValid, CodeStatus::NOT_HANDLE);

        if($this->Mdl_club->delClub($parin)){
            $replay['status_code'] = CodeStatus::SUCCESS;
            $replay['status_desc'] = "Club Berhasil Dihapus";
            $this->response($replay, REST_Controller::HTTP_OK);
        } else {
            $replay['status_code'] = CodeStatus::DATA_NOT_FOUND;
            $replay['status_desc'] = "Club Gagal Dihapus";
            $this->response($replay, REST_Controller::HTTP_OK);
        }

    }

    function getClubById_post()
    {
        $post = file_get_contents("php://input", "application/json");
        $parin = json_decode($post, true);

        $fieldValid = array(
            'idclub' => 'required|number'
        );

        $this->lib_validation->fieldValueInvalid(get_instance(), $fieldValid, $parin);
        $this->lib_validation->authInvalid(get_instance(), $fieldValid, CodeStatus::NOT_HANDLE);

        $result = $this->Mdl_club->getClubByid($parin);
        if ($result) {
            $replay['status_code'] = CodeStatus::SUCCESS;
            $replay['status_desc'] = CodeStatus::getName(CodeStatus::SUCCESS);
            $replay['results'] = $result;
            $this->response($replay, REST_Controller::HTTP_OK);
        } else {
            $replay['status_code'] = CodeStatus::DATA_NOT_FOUND;
            $replay['status_desc'] = CodeStatus::getName(CodeStatus::DATA_NOT_FOUND);
            $this->response($replay, REST_Controller::HTTP_OK);
        }
    }

 }