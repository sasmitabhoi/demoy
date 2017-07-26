<!--ABSTRACT REPORT CIRCLE START -->
<?
session_start();
require_once("../common/globali.php");
require_once("../common/meta_tags.php");
require_once("../common/sqlserver.php");

$issue_type_id   = (isset($_GET['issue_type_id']) && $_GET['issue_type_id'] != '')?$_GET['issue_type_id']:'';

$power_id   = (isset($_GET['power_id']) && $_GET['power_id'] != '')?$_GET['power_id']:'';
$type   = (isset($_GET['type']) && $_GET['type'] != '')?(int)$_GET['type']:0;
 
$is_resolve   = (isset($_GET['is_resolve']) && $_GET['is_resolve'] != '')?$_GET['is_resolve']:'';
//echo $is_resolve ;
if($is_resolve=='' || $is_resolve='undefined'){$is_resolve='N';}
$pr = base64_decode($pr);   
if($month=='')
{
    $month=0;
}
if($year=='')
{
    $year=0;
}
     $get_issue_dtl_list_sql = "select * from USP_ISSUE_DETAILS_REPORT2 (".$issue_type_id.",'".$power_id."',0,0,0,".$type.",'".$is_resolve."',".$month.",".$year.")";

 
$circleid=$_SESSION["session_circle_id"];
$divisionid=$_SESSION["session_division_id"];
$power_idd=$_SESSION["sess_power_id"];
$sub_division_id=$_SESSION["session_sub_division_id"];
$section_id=$_SESSION["session_section_id"];
 /*$get_issue_dtl_list_sql33="     SELECT PID.*
         ,PIT.issue_type_name,PW.work_name,PIFD.to_user_id,PID.is_work_issue_solved,PIT.issue_type_id 
         FROM pm_issue_detail PID 
         INNER JOIN pm_issue_type PIT ON PID.issue_type_id = PIT.issue_type_id 
         INNER JOIN pm_works PW ON PW.work_id = PID.work_id 
         INNER JOIN pm_issue_fwd_detail PIFD ON PIFD.issue_detail_id = PID.issue_detail_id 
         WHERE  PID.entry_type = 'F' AND PID.issue_type_id='$issue_type_id' ";
         if($divisionid!='' && $divisionid>0){$get_issue_dtl_list_sql.="AND PID.division_id='$divisionid' ";}
         if($sub_division_id!='' && $sub_division_id>0){$get_issue_dtl_list_sql.="AND PID.sub_division_id='$sub_division_id'";}
         if($section_id!='' && $section_id>0){$get_issue_dtl_list_sql.="AND PID.section_id='$section_id'";}*/
        //echo $get_issue_dtl_list_sql;

 $get_issue_dtl_list_res = pg_query($get_issue_dtl_list_sql);
$get_issue_dtl_list_cnt = @pg_num_rows($get_issue_dtl_list_res);
//echo $get_issue_dtl_list_sql;
$_SESSION['session_issue_sql']=$get_issue_dtl_list_sql;
$_SESSION['session_issue_type_id']=$issue_type_id;
$_SESSION['session_issue_power_id']=$power_id;
$_SESSION['session_issue_division_id']=0;
$_SESSION['session_issue_sub_division_id']=0;
$_SESSION['session_issue_section_id']=0;
$_SESSION['session_issue_type']=$type;
$_SESSION['session_issue_is_resolve']=$is_resolve;
$_SESSION['session_issue_month']=$month;
$_SESSION['session_issue_year']=$year;

if($get_issue_dtl_list_cnt > 0){
    $totissueapproved = 0;
    $totissueresolve = 0;
?>
<h2><?php if($is_resolve=='R'){echo "View Total Resolved:-";}else{ echo "View Total Issue";}?></h2>

<table width="100%" cellspacing="1" cellpadding="4"  class="tableWithFloatingHeader listtable" border="0" style="margin-bottom:20px;" align="center">
                        <thead>
                            <tr bgcolor="#FFFFFF">
                                <th class="blk2b" valign="top">Sl. No.</th>
                                <th class="blk2b" valign="top">Issue Type Name </th>
                                <th class="blk2b" valign="top">Dsignation </th>
                                <th class="blk2b" valign="top">Division Name</th>
                                <th class="blk2b" valign="top">Sub Division Name </th>      
                                <th class="blk2b" valign="top">Section Name </th> 
                                <?php if($is_resolve!='R'){?>        
                                <th class="blk2b" valign="top">Total Issue </th> 
                                <?php } ?>
                                <th class="blk2b" valign="top">Total Resolve </th>                                
                            </tr>
<?
$tota=0;
$totall=0;
            while($get_issue_dtl_list_row = pg_fetch_assoc($get_issue_dtl_list_res))
            {
                $cnt++;  
                $totissueapproved=$totissueapproved+$get_issue_dtl_list_row['tot_issue'];
                $totissueresolve=$totissueresolve+$get_issue_dtl_list_row['tot_issue_resolve'];  
                $issue_type_idd=$get_issue_dtl_list_row['issue_type_id'];
                $divisionid=$get_issue_dtl_list_row['division_id'];
                $sql_div=pg_query("select division_name from division where division_id='$divisionid'");
                $res_div=pg_fetch_assoc($sql_div);

                $subdivisionid=$get_issue_dtl_list_row['sub_division_id'];
                $sql_divdub=pg_query("select division_name from sub_division where sub_division_id='$subdivisionid'");
                $res_div_sub=pg_fetch_assoc($sql_divdub);

                     $sectionid=$get_issue_dtl_list_row['section_id'];
                $sql_divdub=pg_query("select division_name from section where section_id='$sectionid'");
                $res_div_section=pg_fetch_assoc($sql_divdub);
 
 



?>
                            <tr bgcolor="#FFFFFF"> 
                                <td class="blk2" align="center"><?php echo $cnt?></td>
                                <td class="blk2" align="left"><?php echo $get_issue_dtl_list_row['issue_type_name']?></td>
                                 <td class="blk2" align="left"><?php echo $get_issue_dtl_list_row['power_id']?></td>
                                <td class="blk2" align="center"><?php echo $res_div['division_name']?></td>
                                <td class="blk2" align="center"><?php echo $res_div_sub['sub_division_name']?></td>
                                <td class="blk2" align="center"><?php echo $res_div_section['section_name']?></td>
                               <?php if($is_resolve!='R'){?>    
                                <td class="blk2" align="center">
                                    
                                <a class="lnblk2b" href="javascript:void(0);" onclick="javascript:getissuedtllistrow('<?php echo $get_issue_dtl_list_row['issue_type_id']?>','<?php echo  $get_issue_dtl_list_row['power_id']?>',<?php echo  $get_issue_dtl_list_row['division_id']?>,<?php echo  $get_issue_dtl_list_row['sub_division_id']?>,<?php echo  $get_issue_dtl_list_row['section_id']?>,3,'');"><?php
                                echo $get_issue_dtl_list_row['tot_issue'];
                                    
                                ?></a> 

                                    &nbsp;<a class="lnblk2b" href="javascript:void(0);" onclick="javascript:getissuedtllistrow('<?php echo $get_issue_dtl_list_row['issue_type_id']?>','<?php echo  $get_issue_dtl_list_row['power_id']?>',<?php echo  $get_issue_dtl_list_row['division_id']?>,<?php echo  $get_issue_dtl_list_row['sub_division_id']?>,<?php echo  $get_issue_dtl_list_row['section_id']?>,3,'');">[Cilck here to view detail]</a> 
                                  
                                    </td> 
                                      <?php }?>   
                                <td class="blk2" align="center">
                                 <a class="lnblk2b" href="javascript:void(0);" onclick="javascript:getissuedtllistrow('<?php echo $get_issue_dtl_list_row['issue_type_id']?>','<?php echo  $get_issue_dtl_list_row['power_id']?>',<?php echo  $get_issue_dtl_list_row['division_id']?>,<?php echo  $get_issue_dtl_list_row['sub_division_id']?>,<?php echo  $get_issue_dtl_list_row['section_id']?>,3,'R');">
                                 <?php echo $get_issue_dtl_list_row['tot_issue_resolve'];
                                  //echo $res_total_solved2['total_issuessolv'];
                                 ?></a> 

                                    &nbsp;<a class="lnblk2b" href="javascript:void(0);" onclick="javascript:getissuedtllistrow('<?php echo $get_issue_dtl_list_row['issue_type_id']?>','<?php echo  $get_issue_dtl_list_row['power_id']?>',<?php echo  $get_issue_dtl_list_row['division_id']?>,<?php echo  $get_issue_dtl_list_row['sub_division_id']?>,<?php echo  $get_issue_dtl_list_row['section_id']?>,3,'R');">[Cilck here to view detail]</a> 
                               
                                </td>
                            </tr>
<?
 
            }
?>
                            <tr bgcolor="#FFFFFF"> 
                                <td class="blk2b" colspan="6">Total</td>
                                 <?php if($is_resolve!='R'){?>
                                <td class="blk2b" align="center"><?php echo $totissueapproved;?></td>
                                 <?php }?>
                                <td class="blk2b" align="center"><?php echo $totissueresolve?></td>
                            </tr>
        </table>
<?
}
?>

