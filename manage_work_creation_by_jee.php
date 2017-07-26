<?php
checklogin();
require_once 'src/Mandrill.php'; //Not required with Composer
$mandrill = new Mandrill('GV5IkOSUhPXJeIwuRC_LdQ');



$user=$_SESSION["sess_user_id"];
$opt = (isset($_GET['opt']) && $_GET['opt'] != "")? $_GET['opt']:'';
$msg = (isset($_GET['msg']) && $_GET['msg'] != "")? base64_decode($_GET['msg']):'';
$id = (isset($_GET['id']) && $_GET['id'] != 0)?(int) $_GET['id']:0;
$budget_provision_row = (isset($_GET['budget_provision_row']) && $_GET['budget_provision_row'] != '')?(int)$_GET['budget_provision_row']:0;
$PrevBudgetTable_amount_row = (isset($_GET['PrevBudgetTable_amount_row']) && $_GET['PrevBudgetTable_amount_row'] != '')?(int)$_GET['PrevBudgetTable_amount_row']:0;
$sess_user_id = $_SESSION["sess_user_id"];
$sess_wing_id = $_SESSION["sess_wings_id"];
$session_circle_id = $_SESSION["session_circle_id"];
$session_division_id = $_SESSION["session_division_id"];
$session_sub_division_id = $_SESSION["session_sub_division_id"];
$session_section_id = $_SESSION["session_section_id"];
$session_district_id = $_SESSION["session_district_id"];
$building_type_name = 0;

if(count($_POST) > 0){
     extract($_POST);
     //print_r($_POST);
	 $vall['second'] = array();
     if($work_id != 0){
	  //get work detail
	  $query_Work_lising_sql="SELECT  ";
	  $query_Work_lising_sql .= " workms.*, (workms.work_creation_date::date) AS work_creation_date,CONDET.con_name,CONDET.con_agreement_amount,(CONDET.con_commencement_date::date) AS con_commencement_date, (CONDET.con_completion_date::date) AS con_completion_date,ALLOT.wa_id,ALLOT.aa_amount FROM pm_works workms ";
	  $query_Work_lising_sql .= " INNER JOIN pm_work_allotment ALLOT ON ALLOT.work_id = workms.work_id ";
	  $query_Work_lising_sql .= " INNER JOIN pm_contractor_details CONDET ON CONDET.con_work_id = workms.work_id ";
	  $query_Work_lising_sql.= " WHERE workms.work_id != 0";
	  $query_Work_lising_sql.= " AND workms.work_id = ".$work_id." ";
	  //echo $query_Work_lising_sql;
	  $query_Work_lising_res = pg_query($query_Work_lising_sql);
	  @extract(pg_fetch_assoc($query_Work_lising_res));
	  
	  
	  //get budget prvision listing
	  $query_budget_lising_sql="SELECT  ";
	  $query_budget_lising_sql .= " wpa_id,wpa_year,wpa_bp_amount FROM pm_works_budget_allotment  ";
	  $query_budget_lising_sql.= " WHERE wpa_work_id != 0";
	  $query_budget_lising_sql.= " AND wpa_work_id = ".$work_id." ";
	  $query_budget_lising_res = pg_query($query_budget_lising_sql);
	  while($query_budget_lising_row = pg_fetch_assoc($query_budget_lising_res)){
		 $vall['second'][$query_budget_lising_row['wpa_id']]['wpa_year'] 		= $query_budget_lising_row['wpa_year'];
		 $vall['second'][$query_budget_lising_row['wpa_id']]['wpa_bp_amount'] 	= $query_budget_lising_row['wpa_bp_amount'];
	  
	  }
	  

	  
     }
}


if(isset($_POST['submit']) && $_POST['submit'] == 'Save')
{
     //print_r($_POST);//exit;
     extract($_POST);
	 $vall['second'] = Array();
	 //echo "<pre>";print_r($_POST);//exit;
     if($work_name == "")
     {
         $error[] = "Please Enter Work Name.";
     }
     if(strlen($work_name)>500)
     {
     	$error[] = "Work Name Should Not Exceed 500 charcter.";
     }
     if($project_type == 0)
     {
        $error[] = "Please Enter Project Type.";
     }	 
     if($work_creation_date == '')
     {
        $error[] = "Please Select Admin. Approval Date.";
     }     
     if($project_head_demo == 0)
     {
        $error[] = "Please Enter Project Head.";
     }
     if($source_fund_id == 0)
     {
        $error[] = "Please Select Scheme .";
     }
     if($aa_amount == '')
     {
        $error[] = "Please Enter A/A Amount  .";
     }	 
     if($con_name == '')
     {
        $error[] = "Please Select Agency .";
     }
     if($con_agreement_amount == '')
     {
        $error[] = "Please Enter Agreement Value .";
     }	 
     if($wings_id == 0)
     {
        $error[] = "Please Select Wing .";
     }		 
     if($con_commencement_date == '')
     {
        $error[] = "Please Select Date of Commencement  .";
     }		 
     if($con_completion_date == '')
     {
        $error[] = "Please Select Completion Date  .";
     }		 
	 if($short_work_name == '')
     {
        $error[] = "Please Enter Project Code.";
     }
     
     $count_error = 0;
     if($error)
     {
        foreach($error as $val)
        {
            if($val){
            $count_error ++;
            }   
        } 
     }
     if($count_error == 0)
     {  
	     //echo ($project_type);exit;
        //MS SQL Escape double quotes
        $gmailid = '';
        $user_name_sql = " SELECT email AS gmailid,full_name AS FULLNAME FROM pm_auth_user ";
        $user_name_sql .= " WHERE user_id = ".$_SESSION["sess_user_id"]." ";
        $user_name_res = pg_query($user_name_sql);
        extract(pg_fetch_assoc($user_name_res));   		

        $work_name = escapeSingleQuotes($work_name);
        $work_creation_date=date2mysql($work_creation_date);
        $con_commencement_date=date2mysql($con_commencement_date);
        $con_completion_date=date2mysql($con_completion_date);
		$short_work_name = escapeSingleQuotes($short_work_name); 
		$budProvision = array();
		if(!empty($data)){
		 foreach($data as $key => $val){
			 if(!empty($val) && $val['prev_year'] != '' && $val['prev_rs'] != ''){
				 $budProvision[] = $val['prev_year'].'@'.$val['prev_rs'];
			 }
		 }
		}



        $approveuserarr = array();
        $approveuserarr = array('SE','EE');
        foreach($approveuserarr AS  $APPROVEUSERVAL){

                $gmailid = '';
                $full_name = '';
                $user_name_sql = " SELECT email AS gmailid,full_name AS FULLNAME FROM pm_auth_user ";
                if($APPROVEUSERVAL == 'PMU'){
                    $user_name_sql .= " WHERE power_id = 'PMU' ";
                }                      
                if($APPROVEUSERVAL == 'CE'){
                    $user_name_sql .= " WHERE wings_id = ".$wings_id."  AND  power_id = 'CE' ";
                } 
                if($APPROVEUSERVAL == 'SE'){
                    $user_name_sql .= " WHERE circle_id = ".$session_circle_id."  AND  power_id = 'SE' ";
                } 
                if($APPROVEUSERVAL == 'EE'){
                    $user_name_sql .= " WHERE division_id = ".$session_division_id."  AND  power_id = 'EE' ";
                }  
                                                                                      
                $user_name_res = pg_query($user_name_sql);
                extract(pg_fetch_assoc($user_name_res)); 
                //echo $gmailid."-----".$full_name."<br/>";
                if($gmailid == ''){
                    $gmailid = 'dipti47@gmail.com';
                }	

            ////********************************8 sent through mail *******************************************//
            //echo $gmailid;exit;


                     
            $html = '<html><body>';
            $html .= '<table bgcolor="#cccccc" cellspacing="0">';
            $html .= '<tr>';
            $html .= '<td>';
            $html .= '<table bgcolor="#cccccc" cellspacing="0">';
            $html .= '<tr bgcolor="#317ebf">';
            $html .= '<td width="600px" >';
            $html .= '<tr bgcolor="#317ebf">';
            $html .= '<td>';
            $html .= '<p><font size="5" color="#FFFFFF">e-NIrman(Online Project Monitoring System)</font></p>';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '</tr>';
            $html .= '<tr bgcolor="#FFFFFF" height="20px">';
            $html .= '<td>';
            $html .= '<p><font size="4" >'.'Dear '.$FULLNAME.' ,'.'</p>';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '<tr bgcolor="#FFFFFF">';
            $html .= '<td width="600px" >';
            $html .= '<table>';
            $html .= '<tr>';
            $html .= '<td>';
            $html .= '<p><font size="4" >'.$work_name.'  has been created successfully.'.'</p>';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '</table>';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= ' </table>';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '</table>';
               
            $message = array(
                    'html' => $html,
                    'subject' => 'Work Creation ',
                    'text' => 'Contents of email goes here', // or just use 'html' to support HTMl markup
                    'from_email' => 'info.enirman@gmail.com',
                    'from_name' => 'Support E-Nirman', //optional
                    'to' => array(
                            array( // add more sub-arrays for additional recipients
                                    'email' => $gmailid,
                                    'name' => $FULLNAME, // optional
                                    'type' => 'to' //optional. Default is 'to'. Other options: cc & bcc
                                    )
                    ),
     
                    /* Other API parameters (e.g., 'preserve_recipients => FALSE', 'track_opens => TRUE',
                      'track_clicks' => TRUE) go here */
            );
             

            //$result = $mandrill->messages->send($message);
            //print_r($result); //only for debugging

        }

    ////********************************8 sent through mail *******************************************//


			
	  $strBudProvision = implode(",",$budProvision);
	  //echo $sess_user_id.','.$session_circle_id.','.$session_division_id.','.$session_sub_division_id.','.$session_section_id.','.$session_district_id;
	  //echo "<pre>".$strBudProvision;exit;
	  $query 		= "select * from USP_JEMODULE_INSERT_UPDATE ($sess_user_id,$session_circle_id,$session_division_id,$session_sub_division_id,$session_section_id,'".$session_district_id."','0',".$wings_id.",".$project_type.",'".$work_name."','".$work_creation_date."','".$short_work_name."',$project_head_demo,$source_fund_id,$aa_amount,$con_name,$con_agreement_amount,'".$con_commencement_date."','".$con_completion_date."','".$strBudProvision."',0 ) ";
	  //echo $query;exit;
	  $data_res 	= pg_query($query);
	  $dataArr = pg_fetch_assoc($data_res);
	  
	  //print_r($dataArr);
	  /*
	  $workid = $dataArr['WORKID'];
	  $rec_id = $workid;
	  //echo $query;
	  $pcode = "PMS".$rec_id;
	  $update_proj_code_sql = "UPDATE pm_works SET pcode = '".$pcode."' WHERE work_id = ".$rec_id."";    
	  pg_query($update_proj_code_sql);
	  //get the JE NO
	  $context = "New project ".$pcode." Assigned to you successfully .Please confrom TYPE ".$pcode." Y/N ";
	  $get_je_no_sql = "SELECT mobile_num AS MOBILENO,user_name AS USERNAME FROM pm_auth_user  WHERE user_id = ".$_SESSION["sess_user_id"]." ";
	  //echo $get_je_no_sql;
	  $get_je_no_res = pg_query($get_je_no_sql);
	  $get_je_no_cnt = pg_num_rows($get_je_no_res);
		
		if($get_je_no_cnt > 0){
		    @extract(pg_fetch_assoc($get_je_no_res));
		    if($MOBILENO != ''){
			
			
			 $context = addslashes($context);
			 $context = addQuoteMS($context);
			 //echo $context;
			 $query_insert_msg_detail = "INSERT INTO pms_work_assign_sms_tracker ";
			 $query_insert_msg_detail .=" (to_ph_no,sent_date,sent_time,sms_content,user_id,work_id)  ";
			 $query_insert_msg_detail .=" VALUES ";
			 $query_insert_msg_detail .=" ('".$MOBILENO."',GETDATE(),'".date("h:i a")."','".$context."',".$_SESSION["sess_user_id"].",".$workid.") ";
			 pg_query($query_insert_msg_detail);
			 */
			 //$context = urlencode(trim($context));
			 /*
			 $context = "Dear ".$USERNAME.", Project ".$short_work_name." is assigned to you.";
			 $context = urlencode(trim($context));
			 $shortcode = "56767";
			 $keyword =  "prpsms";
			 $url =  "http://103.247.98.91/API/SendMsg.aspx?uname=20130795&pass=diptiranjan&send=NIRMAN&dest=".$MOBILENO."&msg=".$context;
			 $ch = curl_init($url);
			 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			 $curl_scraped_page = curl_exec($ch);
			 curl_close($ch);
			 
			 
			 
		    }
		}
		*/

		//echo $query;
		$msg = "New Work has been Saved Successfully.";
		$msg= base64_encode($msg);
		header("Location:index.php?page=192&msg=".urlencode($msg));
			
		exit(0);    

                 
       } 
}	   

if(isset($_POST['edit']) && $_POST['edit'] == 'Edit')
{
    extract($_POST);
}
 
if(isset($_POST['submit']) && $_POST['submit'] == 'Update')
{
     extract($_POST);
	 //echo "<pre>";print_r($_POST);
     if($work_name == "")
     {
         $error[] = "Please Enter Work Name.";
     }
     if(strlen($work_name)>500)
     {
     	$error[] = "Work Name Should Not Exceed 500 charcter.";
     }
     if($project_type == 0)
     {
        $error[] = "Please Enter Project Type.";
     }	 
     if($work_creation_date == '')
     {
        $error[] = "Please Select Admin. Approval Date.";
     }     
     if($project_head_demo == 0)
     {
        $error[] = "Please Enter Project Head.";
     }
     if($source_fund_id == 0)
     {
        $error[] = "Please Select Scheme .";
     }
     if($aa_amount == '')
     {
        $error[] = "Please Enter A/A Amount  .";
     }	 
     if($con_name == '')
     {
        $error[] = "Please Select Agency .";
     }
     if($con_agreement_amount == '')
     {
        $error[] = "Please Enter Agreement Value .";
     }	 
     if($wings_id == 0)
     {
        $error[] = "Please Select Wing .";
     }		 
     if($con_commencement_date == '')
     {
        $error[] = "Please Select Date of Commencement  .";
     }		 
     if($con_completion_date == '')
     {
        $error[] = "Please Select Completion Date  .";
     }		 
	 if($short_work_name == '')
     {
        $error[] = "Please Enter Project Code.";
     }
     
     $count_error = 0;
     if(isset($error))
     {
        foreach($error as $val)
        {
            if($val){
            $count_error ++;
            }   
        } 
     }
     //echo $count_error;
     if($count_error == 0)
     {  
	     //echo ($project_type);exit;
        //MS SQL Escape double quotes
        $work_name = escapeSingleQuotes($work_name);
        $work_creation_date=date2mysql($work_creation_date);
        $con_commencement_date=date2mysql($con_commencement_date);
        $con_completion_date=date2mysql($con_completion_date);
		$short_work_name = escapeSingleQuotes($short_work_name); 
		$budProvision = array();
		if(!empty($data)){
		 foreach($data as $key => $val){
			 if(!empty($val)){
				 $budProvision[] = $val['prev_year'].'@'.$val['prev_rs'];
			 }
		 }
		}
	
	  $strBudProvision = implode(",",$budProvision);
	  //echo $sess_user_id.','.$session_circle_id.','.$session_division_id.','.$session_sub_division_id.','.$session_section_id.','.$session_district_id;
	  //echo "<pre>".$strBudProvision;exit;
      

	  $query 		= "select * from USP_JEMODULE_INSERT_UPDATE  ($sess_user_id,$session_circle_id,$session_division_id,$session_sub_division_id,$session_section_id,'".$session_district_id."','0',".$wings_id.",".$project_type.",'".$work_name."','".$work_creation_date."','".$short_work_name."',$project_head_demo,$source_fund_id,$aa_amount,$con_name,$con_agreement_amount,'".$con_commencement_date."','".$con_completion_date."','".$strBudProvision."',".$work_id.")";
      
      $currDate = date('Y-m-d h:i:s');
      $DateUpdate = "update pm_works set modified='".$currDate."' where work_id='".$work_id."'";
      $DateUpdateRun = pg_query($DateUpdate);
	  //echo $query;exit;
	  $data_res 	= pg_query($query);
	  $datasucvcval = pg_fetch_assoc($data_res);	  
	  
	  
      //print_r($datasucvcval['val']);
	  if($datasucvcval['val'] == 1){
		$msg = "Work has been updated Successfully.";
		$msg= base64_encode($msg);
        ?>
        <script type="text/javascript">
            document.location='<?php echo "index.php?page=192&limit=".$limit."&page1=".$page1."&work_updated_id=".$work_id."&msg=".$msg."#workid_".$work_id; ?>';
        </script>
        <?php
			//header("Location:index.php?page=192&limit=".$limit."&page1=".$page1."&msg=".urlencode($msg)."#workid_".$work_id);		
	  }else{
		$msg = "Work has been updated Successfully.";
		$msg= base64_encode($msg);
        ?>
            <script type="text/javascript">
                document.location='<?php echo "index.php?page=192&limit=".$limit."&page1=".$page1."&work_updated_id=".$work_id."&msg=".$msg."#workid_".$work_id; ?>';
            </script>
        <?php 
			//header("Location:index.php?page=192&limit=".$limit."&page1=".$page1."&msg=".urlencode($msg)."#workid_".$work_id);			
	  }
		
		

			
		exit(0);    

                 
       } 
}	 
 
 
 

include_once ('view/manage_work_creation_by_jee.html');
?>