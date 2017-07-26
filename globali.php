<?
session_start();//start Session
set_time_limit(90000);
ini_set('upload_max_filesize', '2000M');
ini_set('display_errors', 0);
date_default_timezone_set('Asia/Kolkata');
//define usefull system variables
define("REQ_FIELD", " <span class='red2b'>*</span>");
define("MANDATORY_FIELD", " <span class='blk2'>( All <span class='red2b'>*</span> marked fields are mandatory</span> )");

define("WEB_SERVER", "http://192.168.1.110:8585/pms_v3_2013");// For live Server
define("ANDRIOD_WEB_SERVER", "http://192.168.1.110:8585/enirman");// For live Server
define("IMAGE_PATH", "writereaddata/custom/images/");// For department custom pages
require_once("connection_db.php");
$link = conOpen();

// INI Settings //
ini_set("SMTP","relay-hosting.secureserver.net");
//ini_set("SMTP","smtp.secureserver.net");
ini_set("smtp_port","25");    
//$intTime = 2;
//ini_set("session.gc_maxlifetime",$intTime);

//define downloadable file
$download_file = array('jpg','jpeg','gif','png','doc','pdf');
require_once("functionsi.php");
require_once("validation_function.php");
require_once("cyber_security.php");
require_once("savehack.php");



?>