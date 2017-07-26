<?php
require_once("common/globali.php");
require_once("common/meta_tags.php");
$issue_detail=isset($_GET['a'])&& $_GET['a']!=''?$_GET['a']:'' ;
$work_id=isset($_GET['b'])&& $_GET['b']!=''?$_GET['b']:'' ;
$issue_id=isset($_GET['c'])&& $_GET['c']!=''?$_GET['c']:'' ;

$issue_sql=pg_query("SELECT PID.* FROM pm_issue_detail PID where work_id=".$work_id." and issue_detail_id=".$issue_id."");
if(pg_num_rows($issue_sql)>0){
$get_issue_dtl_list_row=pg_fetch_assoc($issue_sql);
}

$issueaction_sql=pg_query("SELECT * FROM pm_issue_action where work_id=".$work_id." and issue_detail_id=".$issue_id."");


$user_detail=getuserInfo($get_issue_dtl_list_row['power_id'],$get_issue_dtl_list_row['wings_id'],$get_issue_dtl_list_row['circle_id'],$get_issue_dtl_list_row['division_id'],$get_issue_dtl_list_row['sub_division_id'],$get_issue_dtl_list_row['section_id']);


if(isset($_POST['submit']) && $_POST['submit'] == 'Submit')
{
	/*echo '<pre>';
	print_r($_FILES);
	print_r($_POST);*/
    @extract($_POST);
    $error=array();
    if($_FILES['issue_updated_file']['name']!='' )
{
	$new_file_name = rand().'_'.strtolower($_FILES['issue_updated_file']['name']); //rename file
		
			if(move_uploaded_file($_FILES['issue_updated_file']['tmp_name'], './writereaddata/issue_remark_file/'.$new_file_name)){

			}else{
				$error[]="File couldnot be uploaded";
			}
			
}else{
   $error[]="Please upload a valid file";
}

    $remark_dd=date('Y-m-d', strtotime(str_replace('/', '-', $remark_date)));
    if(count($error) == 0){
    	$issue_sql=pg_query("INSERT INTO pm_issue_action(work_id, remark_date,remark_note,issue_status,issue_detail_id,issue_updated_file) VALUES(".$work_id.", '".$remark_dd."','".$remark_note."','".$issue_status."','".$issue_id."','".$new_file_name."')");
	    //echo $issue_sql;exit;
	    if($issue_status == 1){
	    	$updateissue_detail=pg_query("UPDATE pm_issue_detail set is_work_issue_solved='Y', resolved_date = NOW() where issue_detail_id=".$issue_id."");
	    }
	    //echo "INSERT INTO pm_issue_action(work_id, remark_date,remark_note,issue_status) VALUES(".$work_id.",'".$remark_dd."','".$remark_note."','".$issue_status."')";exit;
	    if($issue_sql){
	    	//header("Location:index.php?page=310");
	    	$success=1;

		}else{
		  	$success=0;
		}
    }
    
    
}
?>
<script type="text/javascript">
	<?php
	if(isset($success) && $success==1){
	?> 
	    $(document).ready(function(){
	      parent.location.href = parent.location.href;
	      parent.parentPower();
	    
	    }); 
	<?  
	  }?>
</script>

<div id="wing_list_div">
				<div class="dash_panel_header">Action Forward By <!-- Satya Ranjan Sethi(CE) --><?php echo $user_detail['fullname'];?> </div>	<form name="frmcomp" id="frmcomp" action="index.php?page=312" enctype="multipart/form-data" method="post">
				<input type="hidden" name="work_id" id="work_id" value="<?php echo $work_id;?>"  maxlength="10" size="10" class="tbox required" readonly="readonly" />	
				<input type="hidden" name="issue_id" id="issue_id" value="<?php echo $issue_id;?>"  maxlength="10" size="10" class="tbox required" readonly="readonly" />	
				<table width="100%" align="center" cellspacing="2" cellpadding="4" border="0">
				<tr class="listtabletr1">
				<td class="blk2b" width="30%">Action Date</td>
				<td class="blk2"><input type="text" name="remark_date" id="remark_date" value="<?php echo date("d/m/Y")?>"  maxlength="10" size="10" class="tbox required" readonly="readonly" /></td>
				</tr>
				<tr class="listtabletr1">
				<td class="blk2b">Issue Action Detail </td><td class="blk2">
				<!-- Improvement to Nimapara Balanga Satasankha Road(ODR) from 14/0 km to 22/0 km
				in the district Puri under NABARD Assistance RIDF XIX -->
				<?php echo $issue_detail;?>
				</td>
				</tr>
				<tr class="listtabletr1">
				<td class="blk2b">Remark</td><td class="blk2">
				<!-- Improvement to Nimapara Balanga Satasankha Road(ODR) from 14/0 km to 22/0 km
				in the district Puri under NABARD Assistance RIDF XIX -->
				<textarea name="remark_note" cols="30" rows="3" class="tbox required" id="remark_note"><?php echo isset($remark_note) && $remark_note!=''?$remark_note:''?></textarea>
				</td>
				</tr>
				<!-- <tr class="listtabletr1">
				<td class="blk2b">File Download</td><td class="blk2">
				
				<a href="download.php?file=" target="_blank">Download</a>
						
				
				</td>
				</tr> -->
				<tr class="listtabletr1">
				<td class="blk2b">Status</td>
				<td class="blk2b">
				  <input type="radio" name="issue_status" value="1" checked> Resolved<br>
 				  <input type="radio" name="issue_status" value="0"> Not Resolved<br>
 				</td>
 				</tr>
 				<tr class="listtabletr1">
				<td class="blk2b">File Upload</td>
				<td class="blk2b">
				  <input type="file" name="issue_updated_file" id="issue_updated_file">
 				</td>
 				</tr>
				<tr class="listtabletr1">
				<td class="blk2b">File Download</td><td class="blk2">
				<a href="./writereaddata/issue_file/<?php echo $get_issue_dtl_list_row['work_issue_file']?>" target="_blank">Download</a>
				</td>
				</tr>
				<tr>
					<td align="center" colspan="2">
					<input type="submit" name="submit" value="Submit"  class="btn" onClick="return datavalidate();"  />
					</td>
				</tr>
				</table> 
				 </form>
				</div>
				<div>
					<?php if(pg_num_rows($issueaction_sql)>0){?>
						
						<table width="100%" align="center" cellspacing="2" cellpadding="4" border="0">
							<tr class="listtabletr1">
								<th>Sl.No.</th>
								<th>Status</th>
								<th>Issue updated file</th>
								<th>Remark</th>
							</tr>
							<?php $cnt=0;
							while($get_issue_action_row=pg_fetch_assoc($issueaction_sql)){$cnt++;
						?>
							<tr class="listtabletr1">
								<td><?php echo $cnt?></td>
								<td><?php echo $get_issue_action_row['issue_status']==0?'Not Resolved':'Resolved'?></td>
								<td>
							<?php if(isset($get_issue_action_row['issue_updated_file']) && $get_issue_action_row['issue_updated_file']!=''){?>
								<a target="_blank" href="./writereaddata/issue_remark_file/<?php echo $get_issue_action_row['issue_updated_file']?>">File download</a>
							<?php }?>
								</td>
								<td><?php echo $get_issue_action_row['remark_note']?></td>
							</tr>
						
					<?php }}?>
					</table>
				</div>