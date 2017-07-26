<?php
checklogin();
$msg=(isset($_GET['msg']) && $_GET['msg']!='' && count($_GET)>0)?$_GET['msg']:'';
$msg=urldecode($msg);
$msg=base64_decode($msg);
 //$page_title =" Inspection Report xxxxxxxxxx";

	
	$get_issue_report_sql = " SELECT PID.*,PIT.issue_type_name,PW.work_name,PIFD.to_user_id FROM pm_issue_detail PID ";
	$get_issue_report_sql .=" INNER JOIN pm_issue_type PIT ON PID.issue_type_id = PIT.issue_type_id  ";
	$get_issue_report_sql .=" INNER JOIN pm_works PW ON PW.work_id = PID.work_id  ";
	$get_issue_report_sql .=" INNER JOIN pm_issue_fwd_detail PIFD ON PIFD.issue_detail_id = PID.issue_detail_id  ";
	$get_issue_report_sql .=" WHERE PID.issue_detail_id != 0 ";
	$get_issue_report_sql .=" AND PID.entry_type = 'F' ";
	
	//echo $get_issue_report_sql;
	$get_issue_report_sql .=" AND PID.power_id = '".$_SESSION["sess_power_id"]."' ";
	if($_SESSION["session_circle_id"] != 0){
		$get_issue_report_sql .=" AND PID.circle_id = ".$_SESSION["session_circle_id"]." ";
	}
	if($_SESSION["session_division_id"] != 0){
		$get_issue_report_sql .=" AND PID.division_id = ".$_SESSION["session_division_id"]." ";
	}
	if($_SESSION["session_sub_division_id"] != 0){
		$get_issue_report_sql .=" AND PID.sub_division_id = ".$_SESSION["session_sub_division_id"]." ";
	}	
	if($_SESSION["session_section_id"] != 0){
		$get_issue_report_sql .=" AND PID.section_id = ".$_SESSION["session_section_id"]." ";
	}
	$get_issue_report_sql .=" ORDER BY PID.issue_detail_id DESC";
	$get_issue_report_res = pg_query($get_issue_report_sql);
	$get_issue_report_cnt = pg_num_rows($get_issue_report_res);
	//echo $get_issue_report_cnt;
	//echo $get_issue_report_sql;
	//$get_inspection_report_sql = " SELECT top 5 * FROM pm_inspection INSP WHERE inspection_id != 0 ";
	
	$Num_Rows = $get_issue_report_res;
	$Per_Page = 50;   // Per Page
	
	if(count($_POST) == 0)
	{
		$Page=1;
	}

	$Prev_Page = $Page-1;
	$Next_Page = $Page+1;

	$Page_Start = (($Per_Page*$Page)-$Per_Page);
	if($Num_Rows<=$Per_Page)
	{
		$Num_Pages =1;
	}
	else if(($Num_Rows % $Per_Page)==0)
	{
		$Num_Pages =($Num_Rows/$Per_Page) ;
	}
	else
	{
		$Num_Pages =($Num_Rows/$Per_Page)+1;
		$Num_Pages = (int)$Num_Pages;
	}
	$Page_End = $Per_Page * $Page;
	IF ($Page_End > $Num_Rows)
	{
		$Page_End = $Num_Rows;
	}

//echo $Page_Start."---".$Page_End;

include_once ('./view/issue_forward_listing.html');
?>
