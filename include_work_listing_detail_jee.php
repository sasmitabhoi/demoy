<?php
require_once("../common/globali.php");

$workid   		= (isset($_GET['workid']) && $_GET['workid'] != 0)?(int) $_GET['workid']:0;
$wings_id 		= (isset($_GET['wings_id']) && $_GET['wings_id'] != 0)?(int) $_GET['wings_id']:0;
$source_fund_id 	= (isset($_GET['source_fund_id']) && $_GET['source_fund_id'] != 0)?(int) $_GET['source_fund_id']:0;
$circle_id 		= (isset($_GET['circle_id']) && $_GET['circle_id'] != 0)?(int) $_GET['circle_id']:0;
$division_id 		= (isset($_GET['division_id']) && $_GET['division_id'] != 0)?(int) $_GET['division_id']:0;
$sub_division_id 	= (isset($_GET['sub_division_id']) && $_GET['sub_division_id'] != 0)?(int) $_GET['sub_division_id']:0;
$section_id 		= (isset($_GET['section_id']) && $_GET['section_id'] != 0)?(int) $_GET['section_id']:0;
$completion_work 		= (isset($_GET['work_completion']) && $_GET['work_completion'] != 0)?(int) $_GET['work_completion']:0;
$work_status 		= (isset($_GET['work_status']) && $_GET['work_status'] != 0)?(int) $_GET['work_status']:1;
$_SESSION["workid"]=$workid;
$_SESSION["wings_id"]=$wings_id;
$_SESSION["source_fund_id"]=$source_fund_id;
$_SESSION["circle_id"]=$circle_id;
$_SESSION["division_id"]=$division_id;
$_SESSION["sub_division_id"]=$sub_division_id;
$_SESSION["section_id"]=$section_id;
$_SESSION["completion_work"]=$completion_work;
$_SESSION["work_status"]=$work_status;
//echo $workid;
$limit 		= (isset($_GET['limit']) && $_GET['limit'] != 0)?(int) $_GET['limit']:5;
$page1 		= (isset($_GET['page1']) && $_GET['page1'] != 0)?(int) $_GET['page1']:0;
//if(isset($_GET['work_completion'])){ $completion_work=$_GET['work_completion'];};
//echo "complet".$completion_work;
$query_Work_lising_sql="SELECT  ";
$query_Work_lising_sql .= " workms.*,ALLOT.wa_is_complete,ALLOT.wa_is_closed,CONDET.con_commencement_date,CONDET.con_completion_date,CONDET.con_name,ALLOT.wa_id,ALLOT.wa_circle_id,ALLOT.wa_division_id,ALLOT.wa_sub_division_id,ALLOT.wa_section_id, modified::timestamp FROM pm_works workms ";
$query_Work_lising_sql .= " INNER JOIN pm_work_allotment ALLOT ON ALLOT.work_id = workms.work_id ";
$query_Work_lising_sql .= " INNER JOIN pm_contractor_details CONDET ON CONDET.con_work_id = workms.work_id ";
$query_Work_lising_sql.= " WHERE workms.work_id != 0";
$query_Work_lising_sql.= " AND ALLOT.work_id != 0";
if($sess_power_id_Header == 'CE')
	$query_Work_lising_sql.= " AND workms.wings_id = ".$_SESSION["sess_wings_id"]."  ";
if($sess_power_id_Header == 'SE')
	$query_Work_lising_sql.= " AND ALLOT.wa_circle_id = ".$_SESSION["session_circle_id"]."  ";
if($sess_power_id_Header == 'EE')
	$query_Work_lising_sql.= " AND ALLOT.wa_division_id = ".$_SESSION["session_division_id"]."  ";
if($sess_power_id_Header == 'AE')
	$query_Work_lising_sql.= " AND ALLOT.wa_sub_division_id = ".$_SESSION["session_sub_division_id"]."  ";
if($sess_power_id_Header == 'JE')
	$query_Work_lising_sql.= " AND ALLOT.wa_section_id = ".$_SESSION["session_section_id"]." ";
//echo $query_Work_lising_sql;

if($workid != 0)
{
	$query_Work_lising_sql.= " AND workms.work_id = ".$workid." ";
}
if($wings_id != 0)
{
	$query_Work_lising_sql.= " AND workms.wings_id = ".$wings_id." ";
}
if($source_fund_id != 0)
{
	$query_Work_lising_sql.= " AND workms.source_fund_id = ".$source_fund_id." ";
}
if($circle_id != 0)
{
	$query_Work_lising_sql.= " AND ALLOT.wa_circle_id = ".$circle_id." ";
}
if($division_id != 0)
{
	$query_Work_lising_sql.= " AND ALLOT.wa_division_id = ".$division_id." ";
}
if($sub_division_id != 0)
{
	$query_Work_lising_sql.= " AND ALLOT.wa_sub_division_id = ".$sub_division_id." ";
}

if($section_id != 0)
{
	$query_Work_lising_sql.= " AND ALLOT.wa_section_id = ".$section_id." ";
}

if($completion_work!='')
{ //echo "--inside--".$completion_work;
    /*1-physical completion,2:financial completion*/

	 if($completion_work==1)
	 {
	 $query_Work_lising_sql.= " AND ALLOT.wa_is_closed = 'Y' ";	
	 }
	 if($completion_work==2)
	{
     $query_Work_lising_sql.= " AND ALLOT.wa_is_complete = 'Y' ";	
	}


}

if($work_status!='')
{
  if($work_status==1)
	 {
	 	//1 on going
	 $query_Work_lising_sql.= " AND (ALLOT.wa_is_closed = 'N' or  ALLOT.wa_is_complete = 'N')";	
	 }
	 if($work_status==2)
	{
       //2: completed
     $query_Work_lising_sql.= " AND (ALLOT.wa_is_closed = 'Y' and  ALLOT.wa_is_complete = 'Y')";	
	}


}
 //echo $query_Work_lising_sql;






$query_Work_lising_sql.= " ORDER BY workms.work_id DESC"; //echo $query_Work_lising_sql;exit;
$_SESSION['session_ajax_listing_query'] = $query_Work_lising_sql;
$_SESSION['sess_query_work_listing_sql'] = $query_Work_lising_sql;
//$work_list_res1 = pg_query($query_Work_lising_sql);

//Set a Session variablee on First visit.

//Used to get Latest Updated Row.
//$getMaxDate = pg_query("select MAX(modified::timestamp) as maxdate from pm_works");
//$getMaxDateResult = pg_fetch_assoc($getMaxDate);
//$maxDate = $getMaxDateResult['maxdate'];

//echo $query_Work_lising_sql;


//**************************************PAGING STARTS HERE***************************
  //Paging Starts here
  //How many adjacent page1s should be shown on each side?
  $limit = 5;
  $adjacents = 3;
  $res = pg_query($query_Work_lising_sql);    
  //First get total number of rows in data table.
  $total_page1s = pg_num_rows($res);
  $count = 0; //innitialize
  /* Setup vars for query. */
  
  $targetpage1 = "index.php?page=192";             //your file name  (the name of this file)
  if($page1)
      $start = ($page1 - 1) * $limit;          //first item to display on this page1
  else
      $start = 0;                             //if no page1 var is given, set start to 0

 // echo "PAGE1=".$page1." LIMIT=".$limit." START=".$start."<br>";
  $query_Work_lising_sql .= ' LIMIT '.$limit.' OFFSET '.$start.' ';
  
  //echo "FINAL QRY: ".$query_Work_lising_sql;
  $work_list_res1 = pg_query($query_Work_lising_sql);
  /* Setup page1 vars for display. */
  if ($page1 == 0) $page1 = 1;                  //if no page1 var is given, default to 1.
  $prev = $page1 - 1;                          //previous page1 is page1 - 1
  $next = $page1 + 1;                          //next page1 is page1 + 1
  $lastpage1 = ceil($total_page1s/$limit);      //lastpage1 is = total page1s / items per page1, rounded up.
  $lpm1 = $lastpage1 - 1;                      //last page1 minus 1

  // Now we apply our rules and draw the pagination object.

  $pagination = "";
  if($lastpage1 > 1)
  {
      $pagination .= "<div class=\"pagination\">";
      //previous button
      if ($page1 > 1)
          $pagination.= "<a href=\"$targetpage1&limit=$limit&page1=$prev\">&laquo; Previous</a>";
      else
          $pagination.= "<span class=\"disabled\">&laquo; Previous</span>";

      //page1s
      if ($lastpage1 < 7 + ($adjacents * 2))   //not enough page1s to bother breaking it up
      {
          for ($counter = 1; $counter <= $lastpage1; $counter++)
          {
              if ($counter == $page1)
                  $pagination.= "<span class=\"current\">$counter</span>";
              else
                  $pagination.= "<a href=\"$targetpage1&limit=$limit&page1=$counter\">$counter</a>";
          }
      }
      elseif($lastpage1 > 5 + ($adjacents * 2))    //enough page1s to hide some
      {
          //close to beginning; only hide later page1s
          if($page1 < 1 + ($adjacents * 2))
          {
              for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
              {
                  if ($counter == $page1)
                      $pagination.= "<span class=\"current\">$counter</span>";
                  else
                      $pagination.= "<a href=\"$targetpage1&limit=$limit&page1=$counter\">$counter</a>";
              }
              $pagination.= "...";
              $pagination.= "<a href=\"$targetpage1&limit=$limit&page1=$lpm1\">$lpm1</a>";
              $pagination.= "<a href=\"$targetpage1&limit=$limit&page1=$lastpage1\">$lastpage1</a>";
          }
          //in middle; hide some front and some back
          elseif($lastpage1 - ($adjacents * 2) > $page1 && $page1 > ($adjacents * 2))
          {
              $pagination.= "<a href=\"$targetpage1&limit=$limit&page1=1\">1</a>";
              $pagination.= "<a href=\"$targetpage1&limit=$limit&page1=2\">2</a>";
              $pagination.= "...";
              for ($counter = $page1 - $adjacents; $counter <= $page1 + $adjacents; $counter++)
              {
                  if ($counter == $page1)
                      $pagination.= "<span class=\"current\">$counter</span>";
                  else
                      $pagination.= "<a href=\"$targetpage1&limit=$limit&page1=$counter\">$counter</a>";
              }
              $pagination.= "...";
              $pagination.= "<a href=\"$targetpage1&limit=$limit&page1=$lpm1\">$lpm1</a>";
              $pagination.= "<a href=\"$targetpage1&limit=$limit&page1=$lastpage1\">$lastpage1</a>";
          }
          //close to end; only hide early page1s
          else
          {
              $pagination.= "<a href=\"$targetpage1&limit=$limit&page1=1\">1</a>";
              $pagination.= "<a href=\"$targetpage1&limit=$limit&page1=2\">2</a>";
              $pagination.= "...";
              for ($counter = $lastpage1 - (2 + ($adjacents * 2)); $counter <= $lastpage1; $counter++)
              {
                  if ($counter == $page1)
                      $pagination.= "<span class=\"current\">$counter</span>";
                  else
                      $pagination.= "<a href=\"$targetpage1&limit=$limit&page1=$counter\">$counter</a>";
              }
          }
      }

      //next button
      if ($page1 < $counter - 1)
          $pagination.= "<a href=\"$targetpage1&limit=$limit&page1=$next\">Next &raquo;</a>";
      else
          $pagination.= "<span class=\"disabled\">Next &raquo;</span>";
          $pagination.= "</div>\n";
}

//Paging ends here
//**************************************PAGING ENDS HERE*****************************
?>

<?php echo $pagination; //echo "@@@".$_SESSION['work_updated_id'];?>

	    	<table id="dataTable" width="100%" cellspacing="1" cellpadding="4" bgcolor="#A8D5F4" border="0" style="margin-bottom:2px;" align="center" class="tableWithFloatingHeader">
				<thead>
					<tr class="listtabletr1" >
						<th align="center"  class="blk2b" width="5%">Sl. No.</th>

						<th align="left" class="blk2b" width="8%">Project Code</th>
						<th align="left" class="blk2b" width="8%">Admin. Approval Date</th>
						<th align="left" class="blk2b" width="8%">Scheme</th>
						<th align="center" class="blk2b" width="25%">Work Name</th>
						<th align="center" class="blk2b" width="10%">Agency Name</th>
						<th align="left" class="blk2b" width="20%">Contract Detail</th>							
 						<th align="center" class="blk2b" width="6%">Financial Updation</th>
 						<th align="center"  class="blk2b" width="6%">Physical Target Updation</th>
						<th align="center"  class="blk2b" width="6%">Physical Progress Updation</th>
						<th align="center"  class="blk2b" width="6%">Delete</th>
<?php
if($_SESSION["sess_power_id"] == 'EE' || $_SESSION["sess_power_id"] == 'AE' ){
?>						
						<th align="center"  class="blk2b" width="6%">Assign</th>
<?
}
?>
						<th align="center"  class="blk2b" width="6%">Edit</th>
						<th align="center"  class="blk2b" width="6%">Detail</th>
						<th align="center"  class="blk2b" width="6%"></th>
						<th align="center"  class="blk2b" width="6%">Project Completion<br/>
							
						</th>
						<th align="center"  class="blk2b" width="6%">Edit & Delete <br/> Component</th>
					</tr>
				</thead>
<?
	$cnt = 0;

	while($row = pg_fetch_assoc($work_list_res1))
	{
		$work_date_added = $row['work_creation_date'];
		$work_date_Completion = $row['con_completion_date'];
		
		$fisYear = calculateFiscalYearForSingleDate($work_date_added,"4/1","3/31");
		$firstfisYearForLoop = explode(',', $fisYear);
		$firstfisYearlastLoop = explode('-', $firstfisYearForLoop[1]);
		//echo "##".$firstfisYearlastLoop[0];


		$LastfisYear = calculateFiscalYearForSingleDate($work_date_Completion,"4/1","3/31");
		//echo("##".$LastfisYear);
		$LastfisYearForLoop = explode('-', $LastfisYear);
		//print_r($LastfisYearFind);
		//echo "##".$LastfisYearForLoop[0];



		// $added_year = date("Y",strtotime($work_date_added ));
		// $Completion_year = date("Y",strtotime($work_date_Completion ));
         $value = array();
        for($i = $firstfisYearlastLoop[0]-1; $i <= $LastfisYearForLoop[0]; $i++) {
             $value[]=($i);
          }    
          //print_r($value);
         


		$fisYearSplit = explode(',', $fisYear);
		$fisLastYearSplit = explode(',', $LastfisYear);
		$sendToFunctionDate = $fisYearSplit[0];
		$sendToFunctionLastDate = $fisLastYearSplit[0];
		//echo $sendToFunctionDate;
		//echo "##".$sendToFunctionLastDate;
		//print_r($fisYear);
		//echo tanmays();
		//echo "##".$row['modified'];
		$cnt++;
		if($cnt%2==0)
		{
			$bgcolor='class="listtabletr2"';
		}
		else
		{
			$bgcolor='class="listtabletr3"';
		}

		$get_circle_name=pg_query("select circle_name from circle where circle_id='$row[wa_circle_id]'");
		$rec_circle=pg_fetch_assoc($get_circle_name);


		$get_division_name=pg_query("select division_name from division where division_id='$row[wa_division_id]'");
		$rec_division_name=pg_fetch_array($get_division_name);

		$get_sub_div_name=pg_query("select sub_division_name from subdivision where sub_division_id='$row[wa_sub_division_id]'");
		$rec_sub_div_name=pg_fetch_assoc($get_sub_div_name);

		$get_section_name=pg_query("select section_name from section where section_id='$row[wa_section_id]'");
		 $rec_section_name=pg_fetch_assoc($get_section_name);
		 $year=pg_query("select wpa_year from pm_works_budget_allotment");
		 
		if($row['modified'] === $maxDate){
			//$bgcolor = 'style="background:rgba(205, 220, 57, 0.92)"';
			$scrollTo = "workid_".$row['work_id'];
		}else{
			$bgcolor = '#e7f4fe';
			$scrollTo = '';
		}

		//echo $row['con_name'];
		$contractorid=$row['con_name'];

		  $sqlcont="select contractor_name from pm_contractor where contractor_id='$contractorid'";
		$resultcont=pg_query($sqlcont);
		$rec_contrator=pg_fetch_assoc($resultcont);

		//get Financial year corr. to the work
		$getFinancialYear = "select * from pm_works_budget_allotment where wpa_work_id ='".$row['work_id']."' LIMIT 1";
		$getFinancialYearData = pg_fetch_assoc(pg_query($getFinancialYear));
		//echo "<pre>";
		//print_r($getFinancialYearData);
		$financialYear 		= $getFinancialYearData['wpa_year'];
		$financialAmount 	= $getFinancialYearData['wpa_bp_amount'];
		//echo $financialYear." // ";

		//echo "--name--".$rec_contrator['contractor_name'];
		$currentWork = "select * from pm_works where wpa_work_id ='".$row['work_id']."' LIMIT 1";
		$getFinancialYearData = pg_fetch_assoc(pg_query($getFinancialYear));
//echo $work_updated_id;
//style="<?php if(isset($row['work_id']) && $row['work_id'] == $work_updated_id){echo 'color:green;'}
?>

						<tr id="<?php echo "workid_".$row['work_id']; ?>" class="listtabletr2">
							<td align="center" class="blk2" valign="top"><?php echo $cnt?>
							

							</td>
							<td align="left" class="orng2b" valign="top">
								<?php echo trim($row['short_work_name'])?><br/>
								<?php echo "<span class='grn3b'>".trim($row['pcode']).'</span>'?><br/>	
								<?php echo "<span class='blk3b'>"."Circle[".$rec_circle['circle_name'].']</span>'?><br/>	
							 
								<?php echo "<span class='blk3b'>"."Division".'</span>'?><br/>	
								<?php echo "<span class='vlt2b'>"."[".$rec_division_name['division_name']."]".'</span>'?><br/>
								<?php echo "<span class='blk3b'>"."Sub Division".'</span>'?><br/>	
								<?php echo "<span class='vlt2b'>"."[".$rec_sub_div_name['sub_division_name']."]".'</span>'?><br/>
								<?php echo "<span class='blk3b'>"."Section".'</span>'?><br/>	
								<?php echo "<span class='vlt2b'>"."[".$rec_section_name['section_name']."]".'</span>'?><br/>
							
							</td>

							<td align="left" class="blk2" valign="top"><?php echo date('d/m/Y',strtotime($row['work_creation_date']))?><br/><br/>	
															<span class="grn2b">A/A Amount:</span> <br/> <span class="WebRupee"><strong>Rs</strong></span><span class="blk1b"><?php echo (float)getAllotmentamt($row['work_id'])?></span><br/><br/>

							
							</td>
							<td align="left" class="blk2" valign="top"><?php echo getFUND($row['source_fund_id'])?>

							</td>
							<td align="left" class="blk2" valign="top"><?php echo $row['work_name']?></td>
							 <td><?php echo $rec_contrator['contractor_name'];?></td>
							<td align="left" class="blk2" valign="top">
<?
//get project type detail
$PTYPE = '';
$get_project_type_sql = " SELECT project_type_name AS ptype FROM pm_project_type WHERE project_id = ".$row['project_type']." "; 
@extract(pg_fetch_assoc(pg_query($get_project_type_sql)));
?>
									<span class="grn2b">Agreement Amount:</span> <br/><span class="WebRupee"><strong>Rs</strong></span><span class="blk1b"><?php echo (float)getAgreementamt($row['work_id'])?></span><br/><br/>
									<span class="grn2b">Date of Commencement:</span> <br/><span class="blk1b"><?php echo ($row['con_commencement_date'] != '' && mysql2date($row['con_commencement_date']) != '01/01/1970')? date("d/m/Y",strtotime(getcommdate($row['work_id']))) :''?></span><br/><br/>
									<span class="grn2b">Stipulated Date of Completion:</span> <br/><span class="blk1b"><?php echo ($row['con_completion_date'] != '' && mysql2date($row['con_completion_date']) != '01/01/1970')? date("d/m/Y",strtotime(getcompdate($row['work_id']))) :''?></span><br/><br/>
									<span class="grn2b">Project Type:</span> <br/> <span class="blk1b"><?php echo $ptype?></span><br/>
									
							</td>
							<td align="center" class="blk2" valign="top">
<?php
         $hidefisyear = '';
          $wid= $row['work_id'];
          $firstyaer = $fisYear[0].$fisYear[1].$fisYear[2].$fisYear[3];
          $lastyaer = $fisYear[0].$fisYear[1].$fisYear[13].$fisYear[14];
         $hidefisyear = pg_num_rows(pg_query("select * from pm_update_work_allotment where uwa_work_id = $wid
         	and uwa_year in ($firstyaer,$lastyaer') and (uwa_remarks='' or exp_amount <= 0 or  act_amount <= 0 or misc_amount <= 0)"));


		if($row['wa_is_complete'] == 'N'){

 if($firstfisYearlastLoop[0] < $LastfisYearForLoop[0]){ 
foreach ($value as $yearValue) { ?>
	<a class="lnsky2b" href="javascript:void(0);"  onclick="javascript:NewPopupWindow('index.php?page=245&wid=<?php echo $row['work_id']?>&fisyear=<?php echo base64_encode($yearValue."-04-01");?>',1150,650);">
<?php echo $yearValue; ?>-<?php echo substr($yearValue+1, 2); ?></a><br/><br/><br/>
<?php } 
       } 									
		}
?>
								<a class="lnsky2b"  href="javascript:void(0);"
  onclick="javascript:NewPopupWindow('index.php?page=193&wid=<?php echo $row['work_id']?>', 950,650);"
								></a><br/>

							</td>
							<td>
								<a href="javascript:void(0);" href="" class="lnsky2b" onclick="javascript:NewPopupWindow('index.php?page=212&wid=<?php echo $row['work_id']?>&project_type=<?php echo $row['project_type']?>',1150,650);">Update</a><br /><br />
							</td>					
							<td align="center" class="blk2" valign="top">
<?
		if($row['wa_is_complete'] == 'N'){
			if($row['wa_is_closed'] == 'N'){
?>									
								<!--<a href="index.php?page=59&wa_id=<?php echo $row['wa_id']?>&work_id=<?php echo $row['work_id']?>&project_type=<?php echo $row['project_type']?>" class="lnsky2b" >Update</a><br /><br />-->
<?
			}
		}
?>							
							
								<a href="index.php?page=315&wid=<?php echo $row['work_id']?>&project_type=<?php echo $row['project_type']?>" class="lnsky2b" >Update</a><br /><br />

							</td>
						
							<td  valign="top">
<?
		if($row['wa_is_complete'] == 'N' && $_SESSION["sess_power_id"] == 'EIC'){
?>							
								<form action="" method="post" name="delete_<?php echo $row['work_id']?>" onsubmit = "javascript:if(confirm('Are you sure to delete this project')){}else{return false;};">
									<input type="hidden" name="work_id" value="<?php echo $row['work_id']?>" />
									<input type="hidden" name="wa_id" value="<?php echo $row['wa_id']?>" />
									<input type="submit" name="delete" value="Delete" class="btn"/>
								</form>
<?
		}
?>								
							</td>
							
<?
if($_SESSION["sess_power_id"] == 'EE' || $_SESSION["sess_power_id"] == 'AE'){
?>	

							<td  valign="top">
<?
		if($row['wa_is_complete'] == 'N'){
?>								
								<a href="index.php?page=218&work_id=<?php echo $row['work_id']?>&project_type=<?php echo $row['project_type']?>" class="lnsky2b" >Assign</a><br /><br />
<?
		}
?>							
							</td>
<?}?>							
							
 							<td  valign="top">
<?
		if($row['wa_is_complete'] == 'N'){
?>									
								<form action="index.php?page=191" method="post" name="edit_<?php echo $row['work_id']?>">
									<input type="hidden" name="work_id" value="<?php echo $row['work_id']?>" />
									<input type="hidden" name="opt" value="edit" />
									<input type="hidden" name="limit" value="<?php echo $limit; ?>" />
									<input type="hidden" name="page1" value="<?php echo $page1; ?>" />
									<input type="submit" name="edit" value="Edit" class="btn"/>
								</form>
<?
		}
?>									
							</td>
							<td valign="top">
								
								<a href="javascript:void(0);"  onclick="javascript:NewPopupWindow('index.php?page=211&wa_id=<?php echo $row['work_id']?>', 950,650);"  class="lnsky2b">Physical Detail</a>
	
							</td>
 							<td  valign="top">
<?
		if($row['wa_is_complete'] == 'N'){
?>								
								<form action="index.php?page=226" method="post" name="consti_<?php echo $row['work_id']?>">
									<input type="hidden" name="wid" value="<?php echo $row['work_id']?>" />
									<input type="submit" name="manage" value="Manage Constituency" class="btn"/>
								</form>
								
								<br/>

								<form name="issuefrmPMS_<?php echo $row['work_id']?>" action="index.php?page=249"  method="post" id="issuefrmPMS_<?php echo $row['work_id']?>">
									<input type="hidden" name="issue_work_id" id="issue_work_id"  value="<?php echo $row['work_id']?>"/>
									<input type="hidden" name="entry_type" id="entry_type"  value="F"/>
									<input type="submit" name="issue" value="Add Issue" class="btn"/>
								</form>								
<?
			
		}
?>								
							</td>
 							<td  valign="top">
<?
		if($row['wa_is_complete'] == 'N'){
			?>									
								<form action="index.php?page=132" method="post" name="complete_<?php echo $row['work_id']?>">
									<input type="hidden" name="wid" value="<?php echo $row['work_id']?>" />
									<input type="submit" name="manage" value="Financial Completion" class="btn"/>
								</form>
								<br/>
								
<?
		}
		else{
			$wa_complete_sql="select project_completion_date from pm_works_completion where work_id=".$row['work_id']."";
			$wa_complete_qry=pg_query($wa_complete_sql);
			$wa_complete_row=pg_fetch_assoc($wa_complete_qry);
			//<!-- REVERT THE WORK COMPLETION (F)  -->
			echo 'Financial Completion <br/>'.mysql2date($wa_complete_row['project_completion_date']).'<br/><br/>'; ?><br>
			
<?php	}
		

		if($row['wa_is_closed'] == 'N'){
?>
								<form action="index.php?page=253" method="post" name="physical_close_<?php echo $row['work_id']?>">
									<input type="hidden" name="wid" value="<?php echo $row['work_id']?>" />
									<input type="submit" name="manage" value="Physical Completion" class="btn"/>
								</form>
<?
		}
		else{
			$ph_complete_sql="select phy_comp_date from pm_works_physical_completion where work_id=".$row['work_id']."";
			$ph_complete_qry=pg_query($ph_complete_sql);
			$ph_complete_row=pg_fetch_assoc($ph_complete_qry);
			echo 'Physical  Completion <br/>'.mysql2date($ph_complete_row['phy_comp_date']);
			//<!-- REVERT THE WORK COMPLETION (P)  -->
			
			}
?>

							</td>
							
							
							
							
							
							<td  valign="top">
<?
		if($row['wa_is_complete'] == 'N'){
?>									
								<form action="index.php?page=223" method="post" name="mcomp_<?php echo $row['work_id']?>">
									<input type="hidden" name="work_id" value="<?php echo $row['work_id']?>" />
									<input type="hidden" name="opt" value="mcomponent" />
									<input type="submit" name="edit" value="Modify Component" class="btn"/>
								</form>
<?
		}

?>									
							</td> 
							
<?php 
	if(isset($scrollTo) && $scrollTo !='' && $_SESSION['worklistajaxfocus'] == '1'){
?>
<script type="text/javascript">
	document.getElementById('<?php echo $scrollTo; ?>').scrollIntoView();
</script>
<?php } ?>							
							
		        </tr>

<?
    }
//Set a Initiate Session for disable first auto focus
$_SESSION['worklistajaxfocus'] = '1';     
?>
		</table>


		



		<?php/*style="<?php echo (isset($_SESSION['work_updated_id']) && $_SESSION['work_updated_id'] == $row['work_id']) ? 'background-color: green' : ''; ?>"*/?>