<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_club extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function setClub($parin)
    {
        $replay = array();
        $clubname = strtoupper($parin['clubname']);
        $city = strtoupper($parin['city']);
       
        $sql = "INSERT INTO club(idclub, club_name, club_city, deletests)
                VALUES ('','".$clubname."','".$city."','0')";

        $exec = $this->db->query($sql);
        if ($exec) {
            $replay['status_code'] = CodeStatus::SUCCESS;
            $replay['status_desc'] = "Club Berhasil Tersimpan";
        } else {
            $replay['status_code'] = CodeStatus::DATA_NOT_FOUND;
            $replay['status_desc'] = "Club Gagal Tersimpan";
        }
    
        return $replay;
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
}