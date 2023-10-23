<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Lib_fungsi
{

   private $listhari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
   private $listbulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
   private $listShortMonth = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Oktr", "Nov", "Des");

   public function __construct()
   {
      // parent::__construct();
   }

   /**
    * fungsi sismaf
    */
   public function filter($word)
   {
      $word = stripslashes(trim($word));
      $word = htmlentities($word);
      $word = nl2br($word);
      //$word = htmldecode($word);
      return $word;
   }
   public function dateSQL($date)
   {
      if ($date != '') {
         $dateSQL   = substr($date, 6, 4) . "-" . substr($date, 3, 2) . "-" . substr($date, 0, 2);
         return $dateSQL;
      } else {
         $dateSQL   = "";
         return $dateSQL;
      }
   }
   public function dateTimeSQL($stringDate)
   {
      if ($stringDate != '') {
         $time = strtotime($stringDate);
         $dateSQL = date("Y-m-d H:i:s", $time);
         return $dateSQL;
      } else {
         $dateSQL   = "";
         return $dateSQL;
      }
   }
   public function reDateSQL($date)
   {
      if ($date != '') {
         $dateSQL   = substr($date, 8, 2) . "/" . substr($date, 5, 2) . "/" . substr($date, 0, 4);
         return $dateSQL;
      } else {
         $dateSQL   = "";
         return $dateSQL;
      }
   }
   public function dateSQLKaco($date)
   {
      if ($date != '') {
         $tgl   = date("d/m/Y", strtotime($date));
         if ($tgl == '01/01/1970') {
            //$tgl = "";
            $tgl = $tgl;
         } else if ($tgl == '01/01/1900') {
            $tgl = "";
         } else {
            $tgl = $tgl;
         }
         return $tgl;
      } else {
         $tgl   = "";
         return $tgl;
      }
   }
   public function dateTHBL($date)
   {
      if ($date != '') {
         $dateSQL   = substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
         return $dateSQL;
      } else {
         $dateSQL   = "";
         return $dateSQL;
      }
   }
   public function dateSQLKacotime($date)
   {
      if ($date != '') {
         $tgl   = date("d/m/Y", strtotime($date));
         $tgl2   = date("D/M/Y H:i:s", strtotime($date));
         if ($tgl == '01/01/1970') {
            $tgl = "";
         } else if ($tgl == '01/01/1900') {
            $tgl = "";
         } else {
            $time   = substr($tgl2, 13, 8);
            $tgl = $tgl . " " . $time;
         }
         return $tgl;
      } else {
         $tgl   = "";
         return $tgl;
      }
   }
   public function dateSQLKacotimeslashen($date)
   {
      if ($date != '') {
         $tgl   = date("d/m/Y", strtotime($date));
         $tgl2   = date("D/M/Y H:i:s", strtotime($date));
         if ($tgl == '01/01/1970') {
            $tgl = "";
         } else if ($tgl == '01/01/1900') {
            $tgl = "";
         } else {
            $time   = substr($tgl2, 13, 8);
            $tgl = $tgl . "\n" . $time;
         }
         return $tgl;
      } else {
         $tgl   = "";
         return $tgl;
      }
   }
   public function datetimeTojam($date, $spar = ":")
   {
      $jam = "";
      if ($date != '') {
         $tgl   = date("d/m/Y", strtotime($date));
         $tgl2   = date("H" . $spar . "i", strtotime($date));
         if ($tgl == '01/01/1970') {
            $jam = "";
         } else if ($tgl == '01/01/1900') {
            $jam = "";
         } else {
            $jam = $tgl2;
         }
      } else {
         $jam   = "";
      }
      return $jam;
   }
   public function dateFormatBulJam($date)
   {
      if ($date != '') {
         $tgl        = date("d/m/Y", strtotime($date));
         $tanggal    = date("d", strtotime($date));
         $hari       = date("w", strtotime($date));
         $bulan      = date("n", strtotime($date));
         $tahun      = date("Y", strtotime($date));
         $waktu      = date("H:i:s", strtotime($date));
         $tgl2   = date("w n Y H:i:s", strtotime($date));
         if ($tgl == '01/01/1970') {
            $tgl = "";
         } else if ($tgl == '01/01/1900') {
            $tgl = "";
         } else {

            $tgl = $this->listhari[$hari] . ", " . $tanggal . " " . $this->listbulan[$bulan - 1] . " " . $tahun . " " . $waktu;
         }
      } else {
         $tgl   = "";
      }
      return $tgl;
   }

   public function dateFormatBul($date)
   {
      if ($date != '') {
         $tgl        = date("d/m/Y", strtotime($date));
         $tanggal    = date("d", strtotime($date));
         $bulan      = date("n", strtotime($date));
         $tahun      = date("Y", strtotime($date));

         if ($tgl == '01/01/1970') {
            $tgl = "";
         } else if ($tgl == '01/01/1900') {
            $tgl = "";
         } else {

            $tgl = $tanggal . " " . $this->listbulan[$bulan - 1] . " " . $tahun;
         }
      } else {
         $tgl   = "";
      }
      return $tgl;
   }

   public function dateFormatBulan($date)
   {
      if ($date != '') {
         $tgl        = date("d/m/Y", strtotime($date));
         $tanggal    = date("d", strtotime($date));
         $bulan      = date("n", strtotime($date));
         $tahun      = date("Y", strtotime($date));
         $waktu      = date("H:i:s", strtotime($date));
         if ($tgl == '01/01/1970') {
            $tgl = "";
         } else if ($tgl == '01/01/1900') {
            $tgl = "";
         } else {

            $tgl = $tanggal . " " . $this->listbulan[$bulan - 1] . " " . $tahun . " " . $waktu;
         }
      } else {
         $tgl   = "";
      }
      return $tgl;
   }
   public function setDateFormat($date, $format = "Y-m-d")
   {
      $newdate = "";
      if (!empty(trim($date))) {
         $time = strtotime($date);
         if ($time) {
            $newdate = date($format, $time);
         }
      }
      return $newdate;
   }
   public function checkSingleQuotes($str)
   {
      $str = stripslashes(trim($str));
      $str = str_replace("'", "''", $str);
      return $str;
   }
   public function SingleQuotesToUpper($str)
   {
      $str = strtoupper($str);
      $str = stripslashes(trim($str));
      $str = str_replace("'", "''", $str);
      return $str;
   }
   // Jika kosong
   public function isEmpty($nilai, $pengganti = "")
   {
      if (empty(trim($nilai))) {
         $nilai = $pengganti;
      }
      return $nilai;
   }
   public function isEmpty2($nilai, $pengganti = "")
   {
      if (empty($nilai)) {
         $nilai = $pengganti;
      } else {
         $nilai = trim($nilai);
         if (empty($nilai)) {
            $nilai = $pengganti;
         }
      }
      return $nilai;
   }
   //untuk rumus hitung angsuran
   //agus waluyo
   //untuk hitung angsuran dari bunga effective
   //PMT ($Rate, $Nper, $Pv, $Fv, $myType)
   public function PMT($Rate, $Nper, $Pv, $Fv, $myType)
   {
      $gd_i = $Rate / 12;
      $gd_i100 = $gd_i / 100;
      $gd_i1 = $gd_i100 + 1;
      $gd_ipow = 1 / pow($gd_i1, $Nper);
      $gd_p0 = -$Pv - $Fv * $gd_ipow;
      $gd_p100 = $gd_p0 * $gd_i100;

      $nachschuss = $gd_p100 / (1 - $gd_ipow);
      return ($nachschuss / (1 + $gd_i100 * $myType)) * -1;
   }
   //untuk konversi eff ke flate rate
   function flaterate($plafon, $tenor, $anguran)
   {
      $hasil = ((($anguran * $tenor) - $plafon) / ($plafon * ($tenor / 12)));
      return $hasil;
   }
   //tambahan agus 20/03/2016
   //untuk hitung NPV dari persent ke nominal
   function npv($ph, $flatdealer, $flatmaf, $tenor)
   {
      $rp = $ph * ((($flatdealer - $flatmaf) * $tenor / 12) / (1 + ($flatmaf * $tenor / 12)));
      return $rp;
   }
   //round up
   // function roundUpToAny($n,$x=5) {
   //     return (ceil($n)%$x === 0) ? ceil($n) : round(($n+$x/2)/$x)*$x;
   // }
   //round nearest
   public function roundUpToAny($n, $x = 5)
   {
      return (round($n) % $x === 0) ? round($n) : round(($n + $x / 2) / $x) * $x;
   }
   public function bulatkan5ratus($rp)
   {
      $bulat = round($rp / 500, 0) * 500;
      $selisih = $rp - $bulat;
      if ($selisih > 0) {
         return $bulat + 500;
      } else {
         return $bulat;
      }
   }

   /**
    *  Tampilkan DealerId dan Nama Showroom
    */
   public function formatNamaShoroom($dealerid, $dealername)
   {

      if (!empty(trim($dealerid))) {
         $dealername = $dealername . " (DEALERID : $dealerid)";
      }
      return $dealername;
   }

   /**
    *  Replace Sub Jabatan Tertentu
    */
   public function replaceSubJabatan($jabatan)
   {
      $rgm = "REGIONAL GENERAL MANAGER";
      $am = "AREA MANAGER";
      $kacab = "KEPALA CABANG";
      $korcab = "KOORDINATOR CABANG";
      $inorder = "";
      /* $rgm = "REGIONAL GENERAL MANAGER"; */
      if (preg_match("/^$rgm/i", $jabatan)) {
         $inorder = str_replace($rgm, "RGM", $jabatan);
      }/* $am = "AREA MANAGER"; */ elseif (preg_match("/^$am/i", $jabatan)) {
         $inorder = str_replace($am, "AM", $jabatan);
      } elseif (preg_match("/^$kacab/i", $jabatan)) {
         $inorder = str_replace($kacab, "KACAB", $jabatan);
      } elseif (preg_match("/^$korcab/i", $jabatan)) {
         $inorder = str_replace($korcab, "KORCAB", $jabatan);
      } else {
         $inorder = $jabatan;
      }
      return $inorder;
   }
   /**
    *  cek Key pada Array
    */
   public function setArrayIfEmpety($list, $key, $retur = "")
   {
      if (array_key_exists($key, $list)) {
         $retur = $list->$key;
      }
      return $retur;
   }
   public function setArrayIfEmpety2($list, $key, $retur = "")
   {
      if (array_key_exists($key, $list)) {
         $retur = $list[$key];
      }
      return $retur;
   }
   public function cekKeyInArray($list, $key)
   {
      $retur = false;
      if (array_key_exists($key, $list)) {
         $retur = true;
      }
      return $retur;
   }
   public function setNoEmpty($nilai, $char)
   {
      $set = "";
      if (!empty(trim($nilai))) {
         $set = $char;
      }
      return $set;
   }
   public function cekSamaganti($value = "", $compare = "", $substitute = "")
   {
      $new_value = "";
      $old_value = trim($value);
      if ($old_value == $compare) {
         $new_value = $substitute;
      } else {
         $new_value = $old_value;
      }
      return $new_value;
   }

   public function formatDateShortMonth($date)
   {
      $localDate = $this->dateSQLKaco($date);
      $checker = DateTime::createFromFormat('d/m/Y', $localDate);

      if ($checker && $checker->format('d/m/Y') == $localDate) {
         $thn = substr($localDate, -4);
         $bln = (int)substr($localDate, 3, 2);
         $tgl = substr($localDate, 0, 2);

         $date = $tgl . " " . $this->listShortMonth[$bln - 1] . " " . $thn;
      }

      return $date;
   }

   /** REQUEST DATA FROM EXTERNAL API */
   public function request_curl($url, $method = "", $field = "", $headers = "", $timout = 30)
   {
      $result = "";

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, $timout);

      if (empty(trim($method))) {
         $method = "GET";
      }
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

      if (!empty($field)) {
         curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
      }
      if (!empty($headers)) {
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      }

      $result = curl_exec($ch);
      curl_close($ch);
      return $result;
   }

   /** FILTER HANYA ANGKA */
   public function NumberOnly($nilai)
   { 
      $balikan = preg_replace('/[^0-9]/', '', $nilai);
      if ($balikan == '') {
         return 0;
      } else {
         return $balikan;
      }
   }
}
