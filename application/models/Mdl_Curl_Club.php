<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_Curl_Club extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // Get Data Club
    function getDataClub($data) {
        $curl = curl_init();
    
        $json_data = json_encode($data, TRUE);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/teskoding/api/club/getClub",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Accept: application/json"
            ),
            // CURLOPT_HTTPHEADER => array(
			// 	"Content-Type: application/x-www-form-urlencoded",
			// 	"cache-control: no-cache",
			// 	"key: ".$this->api_key
			// ),

            CURLOPT_POSTFIELDS => $json_data,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    // Add Data Club
    function insertClub($data)
    {
        $curl = curl_init();
        $jason_data = json_encode($data, TRUE);

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => "http://localhost/teskoding/api/club/setClub",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Accept: application/json"
                ),
                CURLOPT_POSTFIELDS => $jason_data,
            )          
        );
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    //Get Data By Id
    function getDataById($data) {
        $curl = curl_init();
        $data_json = json_encode($data, TRUE);

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => "http://localhost/teskoding/api/club/getClubById",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Accept: application/json",
                ),
                CURLOPT_POSTFIELDS => $data_json,
            )
        );
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    // Update Data Club
    function upDataClub($data)
    {
        $data_json = json_encode($data, TRUE);
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => "http://localhost/teskoding/api/club/setUpClub",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "PUT",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Accept: application/json"
                ),
                CURLOPT_POSTFIELDS => $data_json,
            )
        );
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    // Delete Data Club
    function delDataClub($data)
    {
        $data_json = json_encode($data, TRUE);
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => "http://localhost/teskoding/api/club/delClub",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Accept: application/json"
                ),
                CURLOPT_POSTFIELDS => $data_json,
            )
        );
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

}