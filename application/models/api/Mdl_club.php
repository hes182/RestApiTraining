<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_club extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('Lib_fungsi'));
    }

    public function setClub($parin)
    {
        $clubname = strtoupper($parin['clubname']);
        $city = strtoupper($parin['city']);
       
        $sql = "INSERT INTO club(idclub, club_name, club_city, deletests)
                VALUES ('','".$clubname."','".$city."','0')";

        $exec = $this->db->query($sql);
        return $exec;
    }

    public function cekClub($parin) 
    {
        $clubname = strtoupper($parin['clubname']);
        $city = strtoupper($parin['city']);

        $sql_cek = "SELECT idclub from club where club_name = '".$clubname."' and club_city ='".$city."' ";
        $exec_cek = $this->db->query($sql_cek);

        if ($exec_cek->num_rows() > 0) {
            return true;
        } else  {
            return false;
        }
    }

    function getClub($parin) {
        $limit = $parin['limit'];
        $offset = $this->lib_fungsi->isEmpty2($parin['offset'], "0");

        $result = array();
        $sql = "SELECT * FROM club where deletests = 0 LIMIT $limit OFFSET $offset";
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            foreach($query->result() as $val) {
                $result_field = array();
                $result_field['idClub'] = $val->idclub;
                $result_field['clubName'] = $val->club_name;
                $result_field['cityClub'] = $val->club_city;

                array_push($result, $result_field);
            }
        }
        return $result;
    }

    function setUpClub($parin) {
        $idClub = $parin['idClub'];
        $clubName = strtoupper($parin['clubname']);
        $clubCity = strtoupper($parin['city']);

        $sql = "UPDATE club SET club_name = '".$clubName."', club_city = '".$clubCity."' WHERE idclub = '".$idClub."' ";
        return $this->db->query($sql);
    }

    function delClub($parin) {
        $idClub = $parin['idclub'];

        $sql = "DELETE FROM club where idclub = ".$idClub;

        return $this->db->query($sql);
    }

    function getClubByid($parin) 
    {
        $result = array();
        $idClub = $parin['idclub'];

        $sql = "SELECT * FROM club where deletests = 0 and idclub = ".$idClub;
        $exec = $this->db->query($sql);

        if ($exec->num_rows() > 0) {
            foreach($exec->result() as $val) {
                $result_data = array();
                $result_data['idclub'] = $val->idclub;
                $result_data['clubName'] = $val->club_name;
                $result_data['city'] = $val->club_city;

                array_push($result, $result_data);
            }
        }
        return $result;
    }
}