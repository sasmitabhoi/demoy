<?
checklogin();
error_reporting(E_ALL & ~E_NOTICE);
if($_SESSION["sess_user_id"] == 0)
{
        header("Location:index.php");
        exit(0);   
}

$sess_power_id = $_SESSION["sess_power_id"];

if(isset($_POST['submit']) && $_POST['submit'] == 'Show')
{
    @extract($_POST);
}
if($issue_type=='')
{
	$issue_type=0;
}
if($month=='')
{
	$month=0;
}
if($year=='')
{
	$year=0;
}
    $get_abstarct_detail_sql = "select * from USP_ISSUE_DETAILS_REPORT1 (".$issue_type.",'".$sess_power_id."',0,0,0,1,'',".$month.",".$year.")";

//echo  $get_abstarct_detail_sql;
        //echo $get_abstarct_detail_sql;

$get_issue_abstarct_detail_res=pg_query($get_abstarct_detail_sql);

$get_issue_abstracy_detail_cnt=pg_num_rows($get_issue_abstarct_detail_res);


include_once ('view/issue_detail_report.html');
?>