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
        $this->load->model('Mdl_club');
        $this->load->library(array('Lib_validation'));
    }


    public function setClub_post()
    {
        $post = file_get_contents("php://input","applicatin/json");
        $parin = json_decode($post, true);

        $fieldValid = array(
            "clubname" => "required",
            "city" => "required",
        );

        $this->lib_validation->fieldValueInvalid(get_instance(), $fieldValid, $parin);

        $result = $this->Mdl_club->setClub($fieldValid);
        $this->response($result, REST_Controller::HTTP_OK);
    }

 }