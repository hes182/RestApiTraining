<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Rest Controller
 * A fully RESTful server implementation for CodeIgniter using one library, one config file and one controller.
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 * @version         3.0.0
 */

class Lib_validation
{

   /**
    * Mambandingkan parameter request dengan parameter yang ditentukan
    * fungsi menghandle response keclient jika parameter request tidak sesuai ketentuan
    * 
    * contoh panggil method library difungsi anda:
    * $field = array("field1", "field2"); // parameter yang ditentukan
    * $this->lib_validation->fieldInComplete(get_instance(), $field, $param_request);
    */
   public function fieldInComplete($ci, $field, $parin)
   {
      $parValid = true;
      foreach ($field as $val) {
         // jika field yang ditentukan tidak ada pada perameter request
         if (!array_key_exists($val, $parin)) {
            $parValid = false;
         }
      }
      // response jika salah satu field yang ditentukan tidak ada pada perameter request
      if (!$parValid) {
         $replay['status_code'] = CodeStatus::PARAMETER_INVALID;
         $replay['status_desc'] = CodeStatus::getName(CodeStatus::PARAMETER_INVALID);
         $ci->response($replay, REST_Controller::HTTP_OK);
      }
   }

   /**
    * fungsi menghandle response keclient jika nilai $valid false
    * 
    * contoh panggil method library difungsi anda:
    * $this->lib_validation->authInvalid(get_instance(), $valid, CodeStatus::NOT_HANDLE);
    */
   public function authInvalid($ci, $valid, $code, $desc = "")
   {
      if (!$valid) {
         if (empty(trim($desc))) {
            $desc =  CodeStatus::getName($code);
         }

         if ($code == CodeStatus::PROJECT_INVALID) {
            $http_status = REST_Controller::HTTP_NO_CONTENT;
         } else {
            $http_status = REST_Controller::HTTP_OK;
         }
         $replay['status_code'] = $code;
         $replay['status_desc'] = $desc;
         $ci->response($replay, $http_status);
      }
   }

   /**
    * Mambandingkan parameter request dengan parameter yang ditentukan
    * Memvalidasi inputan sesuai yang ditentukan
    * fungsi menghandle response keclient jika parameter request tidak sesuai ketentuan
    * 
    * contoh panggil method library difungsi anda:
    * $field = array("field1"=>"required", "field2"=>"required|numeric|len:10"); // parameter yang ditentukan
    * $this->lib_validation->fieldValueInvalid(get_instance(), $field, $param_request);
    */
   public function fieldValueInvalid($ci, $fieldValid, $parin, $status_desc = "")
   {
      $parComplete = true;
      $parValid = true;
      if (!$parin) {
         $replay['status_code'] = CodeStatus::PARAMETER_INVALID;
         $replay['status_desc'] = CodeStatus::getName(CodeStatus::PARAMETER_INVALID);
         $ci->response($replay, REST_Controller::HTTP_OK);
      }

      /* mengambil field yang ditentukan */
      foreach ($fieldValid as $validkey => $validval) {
         /* cek apakah field ketentuan ada di parameter request */
         if (array_key_exists($validkey, $parin)) {
            $fieldval = $parin[$validkey];
            $split_valid =  explode("|", $validval);
            /* mengambil daftar role validasi */
            foreach ($split_valid as $expval) {
               /* poses validasi */
               if ($this->validation($expval, $fieldval)) {/* Jika tidak lolos validasi */
                  if (strpos($expval, ":")) {
                     $split_role_valid =  explode(":", $expval);
                     $status_desc = str_replace("{{0}}", $split_role_valid[1], $validkey . ": " . $this->listError[$split_role_valid[0]]);
                  } else {
                     $status_desc = $validkey . ": " . $this->listError[$expval];
                  }
                  $parValid = false;
                  break;
               }
            }
            if (!$parValid) break;
         } else {
            $parComplete = false;
            break;
         }
      }

      /* */
      if (empty(trim($status_desc))) {
         $status_desc = CodeStatus::getName(CodeStatus::EMPTY_FIELD);
      }
      /* handle response jika salah satu field yang ditentukan tidak ada pada perameter request */
      if (!$parComplete) {
         $replay['status_code'] = CodeStatus::PARAMETER_INVALID;
         $replay['status_desc'] = CodeStatus::getName(CodeStatus::PARAMETER_INVALID);
         $ci->response($replay, REST_Controller::HTTP_OK);
      }
      /* handle response jika input field tidak valid */
      if (!$parValid) {
         $replay['status_code'] = CodeStatus::EMPTY_FIELD;
         $replay['status_desc'] = $status_desc;
         $ci->response($replay, REST_Controller::HTTP_OK);
      }
   }

   /**
    * block kode proses validasi
    */
   private $listError = array(
      "required" => "tidak boleh kosong", // message tidak boleh kosong
      "numeric" => "harus numeric", // message numeric
      "max" => "maksimal {{0}} karakter", // message maksimal
      "min" => "minimal {{0}} karakter", // message minimal
      "len" => "panjang {{0}} karakter", // message panjang
      "val" => "nilai parameter harus sesuai ketentuan ({{0}})" // message value parameter yang diijinkan
   );
   private function validation($validation, $value)
   {
      /* validasi tidak boleh kosong */
      if ($validation == "required") {
         if (empty($value)) {
            return true;
         } else {
            return false;
         }
      }
      /* validasi numeric */
      if ($validation == "numeric") {
         if (is_numeric($value)) {
            return false;
         } else {
            return true;
         }
      }
      /* maksimal panjang karakter */
      if (preg_match("/^max/", $validation)) {
         $explode =  explode(":", $validation);
         if (count($explode) > 1) {
            if (strlen($value) > $explode[1]) {
               return true;
            }
         }
         return false;
      }
      /* validasi minimal panjang karakter */
      if (preg_match("/^min/", $validation)) {
         $explode =  explode(":", $validation);
         if (count($explode) > 1) {
            if (strlen($value) < $explode[1]) {
               return true;
            }
         }
         return false;
      }
      /* validasi panjang karakter */
      if (preg_match("/^len/", $validation)) {
         $explode =  explode(":", $validation);
         if (count($explode) > 1) {
            if (strlen($value) == $explode[1]) {
               return true;
            }
         }
         return false;
      }
      /* validasi nilai parameter yang diijinkan */
      if (preg_match("/^val/", $validation)) {
         $explode =  explode(":", $validation);
         if (count($explode) > 1) {
            $parallow = explode(",", $explode[1]);
            if (!in_array($value, $parallow)) {/* jika tidak ada dalam nilai yang diijinkan */
               return true;
            }
         }
         return false;
      }


      return false;
   }


   // ---------------------
   // set cutomer validation
   // ---------------------


   /**
    * CEK HEADER
    */
   public function headerValidation($_ci, $header, $body = "", $value = "")
   {
      $replay = array();

      if (isset($header['SM-HEADER-PASSCODE'])) return true;

      // CEK TIMESTAMP
      // if(!isset($header['SM-time'])) return false;
      if (
         !isset($header['CONTENT-TYPE']) ||
         !isset($header['SM-KEY']) ||
         !isset($header['SM-PAKET']) ||
         !isset($header['VERSI']) ||
         !isset($header['TIMESTAMP'])
      ) {
         $replay['status_code'] = CodeStatus::INVALID_HEADER;
         $replay['status_desc'] = CodeStatus::getName(CodeStatus::INVALID_HEADER);
         $replay['header'] = $header;
         $_ci->response($replay, REST_Controller::HTTP_BAD_REQUEST);
      } else {
         $statusCode = CodeStatus::SUCCESS;

         // CEK KEY
         if ($header['SM-KEY'] <> $value['apiKey']) $statusCode = CodeStatus::API_KEY_INVALID;
         // CEK PAKET
         if ($header['SM-PAKET'] <> $this->generatePaket("$body:" . $header['TIMESTAMP'], $value)) $statusCode = CodeStatus::INVALID_PAKET_RQS;
         // CEK CONTENT TYPE
         if (($header['CONTENT-TYPE']) <> 'application/json; charset=utf-8') $statusCode = CodeStatus::INVALID_HEADER;

         if ($statusCode !== CodeStatus::SUCCESS) {
            $replay['status_code'] = $statusCode;
            $replay['status_desc'] = CodeStatus::getName($statusCode);
            $_ci->response($replay, REST_Controller::HTTP_BAD_REQUEST);
         }
      }

      return true;
   }

   /**
    * GENERATE PAKET
    */
   private function generatePaket($value, $param)
   {

      $bodyRequest = $this->stringify($value);

      return hash_hmac('sha256', $bodyRequest, $param['apiKey']);
   }

   /**
    * RETURN JSON TO SINGLE TEXT TANPA SPASI
    */
   private function stringify($json)
   {
      return preg_replace("/[\r\n\t\s+]/", "", $json);
   }
}
