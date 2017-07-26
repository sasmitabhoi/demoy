<?php
session_start();
checklogin();
$sess_user_id=$_SESSION["sess_user_id"];
$COMMALLOTED = 'Y';
$ISRIDF 	 = 'Y';
$opt = (isset($_GET['opt']) && $_GET['opt'] != "")? $_GET['opt']:'';
$opt1 = (isset($_GET['opt1']) && $_GET['opt1'] != "")? $_GET['opt1']:'';


//get the first date ande last date from admin home page
$first_date = (isset($_GET['first_date']) && $_GET['first_date'] !='')?$_GET['first_date'] : '';
$last_date = (isset($_GET['last_date']) && $_GET['last_date'] != '')?$_GET['last_date'] : '';
$msg=(isset($_GET['msg']) && $_GET['msg']!='' && count($_GET)>0)?$_GET['msg']:'';
$msg=urldecode($msg);
$msg=base64_decode($msg);

if($_SESSION["sess_power_id"] == 'EIC')
{
	header("Location:index.php?page=222&msg=".urlencode(base64_encode($msg)));
}

$is_financial_year_enabled = 'Y';
define("ISEXCEL", "N");
define("ISPRINT", "N");
$isdistrict = 'N';

$sess_user_id = $_SESSION["sess_user_id"];
$sess_power_id_Header = $_SESSION["sess_power_id"];

if(isset($_POST) && $_POST['assign'] == 'Assign'){
	extract($_POST);
	$update_sql = "UPDATE pm_work_allotment SET wa_circle_id  = ".$circle_id.", wa_division_id = ".$division_id.",  wa_sub_division_id = ".$sub_division_id.", wa_section_id = ".$section_id."  WHERE work_id = ".$work_id." ";
	//echo $update_sql;
	//print_r($_POST);exit;
	pg_query($update_sql);
	$msg = "Project has been assigned successfully";
	header("Location:index.php?page=192&msg=".urlencode(base64_encode($msg)));
	exit;	
	
}




//echo "Session--".$_SESSION["sess_power_id"];

include_once ('./view/work_listing_detail_jee.html');
?>
