<!--ABSTRACT REPORT CIRCLE START -->
<?
session_start();
require_once("../common/globali.php");
require_once("../common/meta_tags.php");
require_once("../common/sqlserver.php");
$issue_type_name='';
$issue_type_id   = (isset($_GET['issue_type_id']) && $_GET['issue_type_id'] != '')?$_GET['issue_type_id']:'';
$power_id   = (isset($_GET['power_id']) && $_GET['power_id'] != '')?$_GET['power_id']:'';
$division_id   = (isset($_GET['division_id']) && $_GET['division_id'] != '')?(int)$_GET['division_id']:0;
$sub_division_id   = (isset($_GET['sub_division_id']) && $_GET['sub_division_id'] != '')?(int)$_GET['sub_division_id']:0;
$section_id   = (isset($_GET['section_id']) && $_GET['section_id'] != '')?(int)$_GET['section_id']:0;
$type   = (isset($_GET['type']) && $_GET['type'] != '')?(int)$_GET['type']:0;
$is_resolve   = (isset($_GET['is_resolve']) && $_GET['is_resolve'] != '')?$_GET['is_resolve']:'';
$pr = base64_decode($pr);  
if($month=='')
{
    $month=0;
}
if($year=='')
{
    $year=0;
}
$_SESSION['session_issue_type_id']=$issue_type_id;
$_SESSION['session_issue_power_id']=$power_id;
$_SESSION['session_issue_division_id']=$division_id;
$_SESSION['session_issue_sub_division_id']=$sub_division_id;
$_SESSION['session_issue_section_id']=$section_id;
$_SESSION['session_issue_type']=$type;
$_SESSION['session_issue_is_resolve']=$is_resolve;
$_SESSION['session_issue_month']=$month;
$_SESSION['session_issue_year']=$year;

if($type==1){
    $get_issue_dtl_list_sql = "select * from usp_issue_details_report_counter (".$issue_type_id.",'".$power_id."',".$division_id.",".$sub_division_id.",".$section_id.",'".$is_resolve ."',".$month.",".$year.")";   
}

if($type==2){
    $get_issue_dtl_list_sql = "select * from usp_issue_details_report_resolves (".$issue_type_id.",'".$power_id."',".$division_id.",".$sub_division_id.",".$section_id.",'".$is_resolve ."',".$month.",".$year.")";   
}

if($type==3){
    $get_issue_dtl_list_sql = "select * from usp_issue_details_report_details(".$issue_type_id.",'".$power_id."',".$division_id.",".$sub_division_id.",".$section_id.",'".$is_resolve ."',".$month.",".$year.")";   
}

  $get_issue_dtl_list_sql;
$get_issue_dtl_list_sql444="SELECT PID.*,PIT.issue_type_name,PW.work_name,PIFD.to_user_id,PID.is_work_issue_solved 
         FROM pm_issue_detail PID 
         INNER JOIN pm_issue_type PIT ON PID.issue_type_id = PIT.issue_type_id 
         INNER JOIN pm_works PW ON PW.work_id = PID.work_id 
         INNER JOIN pm_issue_fwd_detail PIFD ON PIFD.issue_detail_id = PID.issue_detail_id 
         WHERE  PID.entry_type = 'F'";   
           //  ORDER BY PID.issue_detail_id DESC";

/*if(isset($issue_type_id) && $issue_type_id!=''){$get_issue_dtl_list_sql.="AND PID.issue_type_id='$issue_type_id'";}
if(isset($power_id) && $power_id!=''){$get_issue_dtl_list_sql.="AND PID.power_id='$power_id'";}
if(isset($division_id) && $division_id!=''){$get_issue_dtl_list_sql.="AND PID.division_id='$division_id'";}
if(isset($division_id) && $division_id!=''){$get_issue_dtl_list_sql.="AND PID.division_id='$division_id'";}
if(isset($section_id) && $section_id!=''){$get_issue_dtl_list_sql.="AND PID.section_id='$section_id'";}
if(isset($is_resolve) && $is_resolve!=''){$get_issue_dtl_list_sql.="AND  PID.is_work_issue_solved='$is_resolve'";}*/
//echo "--".$get_issue_dtl_list_sql;

 $get_issue_dtl_list_res = pg_query($get_issue_dtl_list_sql);
$get_issue_dtl_list_cnt = @pg_num_rows($get_issue_dtl_list_res);
//echo $get_issue_dtl_list_sql;
$issue_sql=pg_query("select issue_type_name from pm_issue_type where issue_type_id=".$issue_type_id."");
if(pg_num_rows($issue_sql)>0){
$issuetype_name=pg_fetch_assoc($issue_sql);
//print_r($issuetype_name);
extract($issuetype_name);
}

if($get_issue_dtl_list_cnt > 0){
   
?>

<input type="button" value="Print The Report" onclick="PrintDiv();" />
<div id="divToPrint" style="">
<h2><?php echo $issue_type_name;?>:-</h2>
<table width="100%" cellspacing="1" cellpadding="4"  class="tableWithFloatingHeader listtable" border="0" style="margin-bottom:20px;" align="center">
                        <thead>
                            <tr bgcolor="#FFFFFF">
                                <th class="blk2b" valign="top">Sl. No.</th>
                                <th class="blk2b" valign="top">Forwarded By </th>
                                <th class="blk2b" valign="top">Work Name </th>
                                <th class="blk2b" valign="top">Issue Details</th>
                                <th class="blk2b" id="download" valign="top">Download </th>
                                 <th class="blk2b" valign="top">Issue Date </th>
                                                         
                            </tr>
<?php
            while($get_issue_dtl_list_row = pg_fetch_assoc($get_issue_dtl_list_res))
            {
                $cnt++; 
             $user_detail=getuserInfo($get_issue_dtl_list_row['power_id'],$get_issue_dtl_list_row['wings_id'],$get_issue_dtl_list_row['circle_id'],$get_issue_dtl_list_row['division_id'],$get_issue_dtl_list_row['sub_division_id'],$get_issue_dtl_list_row['section_id']);
?>
                            <tr bgcolor="#FFFFFF"> 
                                <td class="blk2" align="center"><?php echo $cnt?></td>
                                <td class="blk2" align="left">
                                    <span class="blk3b">Name<br/></span>
                                    <span class="vlt2b"><?php echo $user_detail['fullname'];?><br/></span>
                                    <span class="blk3b">Designation<br/></span>
                                    <span class="vlt2b"><?php echo $user_detail['designame'];?><br/></span>  
                                        <?if($user_detail['CRINAME']){?>  
                                            <span class="blk3b">Circle<br/></span>
                                            <span class="vlt2b"><?php echo $user_detail['criname']?><br/></span> 
                                        <?}?>   
                                        <?if($user_detail['DIVNAME']){?>    
                                            <span class="blk3b">Division<br/></span>
                                            <span class="vlt2b"><?php echo $user_detail['divname']?><br/></span>   
                                        <?}?>    
                                         <?if($user_detail['SUBDIVNAME']){?>    
                                            <span class="blk3b">Sub Division<br/></span>
                                            <span class="vlt2b"><?php echo $user_detail['subdivname']?><br/></span>   
                                        <?}?>  
                                        <?if($user_detail['SECNAME']){?>    
                                            <span class="blk3b">Section<br/></span>
                                            <span class="vlt2b"><?php echo $user_detail['secname']?><br/></span>   
                                        <?}?>    
                                        <? /*if($user_detail['WINGNAME']){?>    
                                            <span class="blk3b">Wing<br/></span>
                                            <span class="vlt2b"><?php echo $user_detail['WINGNAME']?><br/></span>   
                                        <?} */?>
                                       
                                </td>
                                <td class="blk2" align="left"><?php echo wordwrap($get_issue_dtl_list_row['work_name'], 80, "<br />\n");?></td>
                                <td class="blk2" align="center"><?php echo  wordwrap($get_issue_dtl_list_row['work_issue_detail'],80,"<br />\n");?></td>
                                <td class="blk2 download" align="center">
                                <?php
                                    if(trim($get_issue_dtl_list_row['work_issue_file'])!=''){
                                ?>
                                <a href="./writereaddata/issue_file/<?php echo $get_issue_dtl_list_row['work_issue_file'];?>" target="_blank"> Download</a>
                                <?php
                                 }
                                ?>
                                </td>
                                <td class="blk2" align="center"><?php echo  date("d-m-Y",strtotime($get_issue_dtl_list_row['work_issue_date']))?></td>
                            </tr>
<?
            }
?>
                            
        </table>
<?
}
?>

