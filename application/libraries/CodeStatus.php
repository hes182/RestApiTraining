<?php

class CodeStatus
{

   const SUCCESS               = 1;
   const DATA_NOT_FOUND        = 2;
   const DUPLICATE_DATA        = 3;
   const API_KEY_INVALID       = 4; // 
   const EMPTY_FIELD           = 5;
   const NOT_CONNECT_FTP       = 6;
   const NOT_DOWNLOAD_FTP      = 7;
   const PROJECT_INVALID       = 8;
   const USER_INVALID          = 9;
   const ACCESS_TOKEN_INVALID  = 10;
   const NOT_UPLOAD_FTP        = 11;
   const PARAMETER_INVALID     = 12;
   const DATA_RQSVA_INVALID    = 13;
   const ERROR_MITRA           = 14;
   const ORDER_TIMEOUT         = 15;
   const ORDER_HOLIDAY         = 16;
   const INVALID_CLIENTID      = 17;
   const INVALID_OTP           = 18;
   const REPLACE_DEVICE        = 19;
   const DEVICE_NOTFOUND       = 20;
   const SYSTEM_INACTIVE       = 21;
   const NOT_HANDLE            = 22;
   const INVALID_COMBINED      = 23;
   const MANDATORY_DATA        = 24;
   const INVALID_HEADER        = 25;
   const INVALID_PAKET_RQS     = 26;
   const PROCESS_REJECTED      = 27;
   const MANDATORY_FILE        = 28;
   const DATA_ISOPEN           = 29;

   public function __construct()
   {
      // parent::__construct();
   }

   public static function getName($code, $lang = "")
   {
      $desc_in = array(
         self::SUCCESS              => "Sukses",
         self::DATA_NOT_FOUND        => "Data tidak ditemukan",
         self::DUPLICATE_DATA        => "Data duplikat",
         self::API_KEY_INVALID       => "Kunci API tidak valid",
         self::EMPTY_FIELD           => "Field kosong",
         self::NOT_CONNECT_FTP       => "Koneksi FTP gagal",
         self::NOT_DOWNLOAD_FTP      => "Unduh berkas FTP gagal",
         self::PROJECT_INVALID       => "Proyek tidak valid",
         self::USER_INVALID          => "Pengguna tidak valid",
         self::ACCESS_TOKEN_INVALID  => "Token akses tidak valid",
         self::NOT_UPLOAD_FTP        => "Upload berkas FTP gagal",
         self::PARAMETER_INVALID     => "Parameter tidak valid",
         self::DATA_RQSVA_INVALID    => "Data request tidak valid",
         self::ERROR_MITRA           => "Response mitra error",
         self::INVALID_CLIENTID      => "client_id/client_secret/grant_type tidak valid",
         self::ORDER_TIMEOUT         => "Waktu habis",
         self::ORDER_HOLIDAY         => "Libur",
         self::INVALID_OTP           => "OTP tidak valid",
         self::REPLACE_DEVICE        => "Ganti perangkat",
         self::DEVICE_NOTFOUND       => "Perangkat tidak terdaftar",
         self::SYSTEM_INACTIVE       => "Sistem dinonaktifkan sementara",
         self::NOT_HANDLE            => "Tidak menangani",
         self::INVALID_COMBINED      => "Kombinasi tidak sesuai",
         self::MANDATORY_DATA        => "Data harus dilengkapi",
         self::INVALID_HEADER        => "Request header tidak valid",
         self::INVALID_PAKET_RQS     => "Request paket tidak sesuai",
         self::PROCESS_REJECTED      => "Permintaan tidak dapat diproses",
         self::MANDATORY_FILE        => "File harus dilengkapi",
         self::DATA_ISOPEN           => "Data sedang dibuka"
      );
      $desc_en = array(
         self::SUCCESS               => "Success",
         self::DATA_NOT_FOUND        => "Data not found",
         self::DUPLICATE_DATA        => "Data duplikat",
         self::API_KEY_INVALID       => "Kunci API tidak valid",
         self::EMPTY_FIELD           => "Field kosong",
         self::NOT_CONNECT_FTP       => "Koneksi FTP gagal",
         self::NOT_DOWNLOAD_FTP      => "Unduh berkas FTP gagal",
         self::PROJECT_INVALID       => "Invalid project",
         self::USER_INVALID          => "Invalid user",
         self::ACCESS_TOKEN_INVALID  => "Token akses tidak valid",
         self::NOT_UPLOAD_FTP        => "Upload berkas FTP gagal",
         self::PARAMETER_INVALID     => "Parameter tidak valid",
         self::DATA_RQSVA_INVALID    => "Data request tidak valid",
         self::ERROR_MITRA           => "Response mitra error",
         self::INVALID_CLIENTID      => "Invalid client_id/client_secret/grant_type",
         self::ORDER_TIMEOUT         => "Timeout",
         self::ORDER_HOLIDAY         => "Holiday",
         self::INVALID_OTP           => "OTP tidak valid",
         self::REPLACE_DEVICE        => "Replace device",
         self::DEVICE_NOTFOUND       => "Device not found",
         self::SYSTEM_INACTIVE       => "System disabled",
         self::NOT_HANDLE            => "Not handling",
         self::INVALID_COMBINED      => "Incompatible combination",
         self::MANDATORY_DATA        => "Data must be completed",
         self::INVALID_HEADER        => "Invalid header",
         self::INVALID_PAKET_RQS     => "Invalid paket request",
         self::PROCESS_REJECTED      => "Request cannot be processed",
         self::MANDATORY_FILE        => "File must be completed",
         self::DATA_ISOPEN           => "Data is opened"
      );

      $name = "";
      switch ($lang) {
         case "in":
            $name = $desc_in[$code];
            break;
         case "en":
            $name = $desc_en[$code];
            break;
         default:
            $name = $desc_in[$code];
      }
      return $name;
   }
}
