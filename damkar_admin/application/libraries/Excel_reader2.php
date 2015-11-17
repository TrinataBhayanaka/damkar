<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  ======================================= 
 *  Author     : Muhammad Surya Ikhsanudin 
 *  License    : Protected 
 *  Email      : mutofiyah@gmail.com 
 *   
 *  Dilarang merubah, mengganti dan mendistribusikan 
 *  ulang tanpa sepengetahuan Author 
 *  ======================================= 
 */  
require_once APPPATH."/third_party/php-excel-reader/excel_reader2.php"; 
require_once APPPATH."/third_party/SpreadsheetReader.php"; 
 
class Excel_reader2 extends Spreadsheet_Excel_Reader { 
    public function __construct() { 
        parent::__construct(); 
    } 
}