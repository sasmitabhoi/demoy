<?php
require_once 'src/Mandrill.php'; //Not required with Composer
$mandrill = new Mandrill('GV5IkOSUhPXJeIwuRC_LdQ');
if(count($_POST) == 0){
    header("Location: index.php?page=217");	
}
 $issued_work_name="";
if(count($_POST) > 0){
     extract($_POST);
      //print_r($_POST);

}
if(isset($_POST['submit']) && $_POST['submit'] == 'Add Issue'){
    extract($_POST);
    //print_r($_POST);

      //enter issue detail
	/* Email Configuration Here */
    /*
	$worksql = " SELECT work_name FROM pm_works ";
			$worksql .= " WHERE work_id = ".$issue_work_id."";
			$workres = pg_query($worksql);
			@extract(pg_fetch_assoc($workres));
		//echo $worksql;exit;
	 		$approveuserarr = array();
            $approveuserarr = array('CE','SE','EE','EIC');
            foreach($approveuserarr AS  $APPROVEUSERVAL){
                
                    $gmailid = '';
                    $full_name = '';
                    $gmailid = '';
                    $full_name = '';
                    $user_name_sql = " SELECT email AS gmailid,full_name AS FULLNAME FROM pm_auth_user ";
                    if($APPROVEUSERVAL == 'EIC'){
                        $user_name_sql .= " WHERE power_id = 'EIC' ";
                    }
                    if($APPROVEUSERVAL == 'CE'){
                        $user_name_sql .= " WHERE wings_id = ".$_SESSION["sess_wings_id"]."  AND  power_id = 'CE' ";
                    } 
                    if($APPROVEUSERVAL == 'SE'){
                        $user_name_sql .= " WHERE circle_id = ".$_SESSION["session_circle_id"]."  AND  power_id = 'SE' ";
                    } 
                    if($APPROVEUSERVAL == 'EE'){
                        $user_name_sql .= " WHERE division_id = ".$_SESSION["session_division_id"]."  AND  power_id = 'EE' ";
                    }  
                    if($APPROVEUSERVAL == 'AE'){
                        $user_name_sql .= " WHERE sub_division_id = ".$_SESSION["session_sub_division_id"]."  AND  power_id = 'AE' ";
                    }    
                    if($APPROVEUSERVAL == 'JE'){
                        $user_name_sql .= " WHERE section_id = ".$_SESSION["session_section_id"]."  AND  power_id = 'JE' ";
                    }         
                                                                                          
                    $user_name_res = pg_query($user_name_sql);
                    extract(pg_fetch_assoc($user_name_res)); 
              					
                    if($gmailid == ''){
                        $gmailid = 'dipti47@gmail.com';
                    }	
  
         try{
                         
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
            $html .= '<p><font size="4" > New Issue added for :- <span style="color:#006633; font-size:22px; font-weight:bold;">'.base64_decode( $issued_work_name).'</span> on date '.$work_issue_date.'</p><p><font size="4" >Issue Details:-</p><p><font size="3" >'.$work_issue_detail.'</p>';
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
                        'subject' => ' Issue Assignment',
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
         
                       
                );
         

            $result = $mandrill->messages->send($message);
           

           
        } catch(Mandrill_Error $e) {
         
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
         
            throw $e;
        }
	}
    */
	/* End Email Configuration Here */

    $work_issue_detail = addslashes($work_issue_detail);
    $work_issue_detail = addQuoteMS($work_issue_detail);    
    $work_issue_date = date2mysql($work_issue_date);
     $insert_issue_detail_sql = "INSERT INTO pm_issue_detail
                                (
                                 issue_type_id
                                ,issue_stage_id
                                ,work_id
                                ,entry_type
                                ,work_issue_detail
                                ,work_issue_date
                                ,work_issue_file
                                ,is_work_issue_solved                               
                                ,power_id
                                ,wings_id                                
                                ,circle_id
                                ,division_id
                                ,sub_division_id
                                ,section_id
                                ,user_id
                                )";
    $insert_issue_detail_sql.= "VALUES ";
    $insert_issue_detail_sql.= "(
                                ".$issue_type_id."
                                ,0
                                ,".$issue_work_id."
                                ,'".$entry_type."'
                                ,'".$work_issue_detail."'
                                ,'".$work_issue_date."'
                                ,'".$work_issue_file."'
                                ,'N'                                
                                ,'".$_SESSION["sess_power_id"]."'
                                ,".$_SESSION["sess_wings_id"]."
                                ,".$_SESSION["session_circle_id"]."
                                ,".$_SESSION["session_division_id"]."
                                ,".$_SESSION["session_sub_division_id"]."
                                ,".$_SESSION["session_section_id"]."
                                ,".$_SESSION["sess_user_id"]."
                                )
                                ";
         //echo $insert_issue_detail_sql;exit;                       
        pg_query($insert_issue_detail_sql);
        //exit();
      
        $get_inserted_id_sql = "SELECT lastval() AS inserted_id";
        $get_inserted_id_res  = pg_query($get_inserted_id_sql);
        extract(pg_fetch_assoc($get_inserted_id_res));
        $ins_detail_id = $inserted_id;
        //print_r($_FILES);
        //echo $ins_detail_id;exit;
        //print_r($compliance_to_given_by);
            
        if($_FILES['work_issue_file']['name'] != '' && $_FILES['work_issue_file']['size'] > 0)
        {
            
            //Find extension and Rename file 
            $fileName = "issue_".date("Y-m-d")."_".$ins_detail_id."-".rand();
            $ext ="";
            $actual_file_name = basename($_FILES['work_issue_file']['name']);
            $ext= findextenson($actual_file_name);
            $fileName = $fileName.'.'.$ext;

            //upload file to server
            $path = "./writereaddata/issue_file/".$fileName;
            //resize_image($_FILES['work_issue_file']['tmp_name'], $path, 600, 600, false);
            //chmod($path, 0666);
            move_uploaded_file($_FILES['work_issue_file']['tmp_name'],$path);
            
            

            //Add File Name to Allotment Table
            $query = "UPDATE  pm_issue_detail SET ";
            $query.= " work_issue_file = '".$fileName."'";
            $query.= " WHERE issue_detail_id = ".$ins_detail_id; 
            //echo $query;exit;
            pg_query($query);



        }  //exit;
             //echo $compliance_to_given_by[0];
     
        if($ins_detail_id != 0){
            //echo "count--".count($compliance_to_given_by);
            if(count($compliance_to_given_by)>0){
              for($i=0; $i<count($compliance_to_given_by); $i++){
                  $toid=$compliance_to_given_by[$i];
              
                $userarr = explode("*",$toid); 
                //print_r($userarr); exit();
                $wingidval = $userarr[0];
                $circleidval = $userarr[1];
                $divisionidval = $userarr[2];
                $subdividval = $userarr[3];
                $secidval = $userarr[4];
                $poweridval = $userarr[5];
             $user_detail=getuserInfo($poweridval,$wingidval,$circleidval,$divisionidval,$subdividval, $secidval); 
           //print_r($user_detail);
               $insert_issue_fwd_detail = "INSERT INTO pm_issue_fwd_detail
                                        (                                         
                                        issue_detail_id
                                        ,to_power_id
                                        ,to_wings_id
                                        ,to_circle_id
                                        ,to_division_id
                                        ,to_sub_division_id
                                        ,to_section_id
                                        ,to_user_id
                                        )";
                $insert_issue_fwd_detail.= "VALUES ";
                $insert_issue_fwd_detail.= "(
                                        ".$ins_detail_id."
                                        ,'".$poweridval."'
                                        ,".$wingidval."
                                        ,".$circleidval."
                                        ,".$divisionidval."
                                        ,".$subdividval."
                                        ,".$secidval."
                                        ,".$user_detail['userid']."
                                        )
                                      ";
               // echo "###".$insert_issue_fwd_detail_history_sql; 
                                     // echo "Heloo--".$insert_issue_fwd_detail;
                pg_query($insert_issue_fwd_detail); 
                 }
          }           

        }   
          //exit; 
        $msg = "Issue detail has been added successfully.";
        $msg= base64_encode($msg);
        header("Location:index.php?page=323&msg=".urlencode($msg));
        exit(0);    

        /*
        $msg= base64_encode($msg);
        if($entry_type == 'F')
            header("Location: index.php?page=192&msg=".urlencode($msg));
        if($entry_type == 'P')
            header("Location: index.php?page=266&msg=".urlencode($msg));
          
        exit(0);
        */
}

// if(isset($_POST['submit']) && $_POST['submit'] == 'Update Issue'){
//     extract($_POST);
   
//     //enter issue detail

//     $edit_work_issue_detail = addslashes($edit_work_issue_detail);
//     $edit_work_issue_detail = addQuoteMS($edit_work_issue_detail);    
//     $edit_work_issue_date = date2mysql($edit_work_issue_date);
//     $update_issue_detail_sql = " UPDATE pm_issue_detail SET work_issue_detail = '".$edit_work_issue_detail."',work_issue_date = '".$edit_work_issue_date."' ";
//     $update_issue_detail_sql.= " WHERE issue_type_id = ".$issue_type_id." ";   
//     $update_issue_detail_sql.= " AND work_id = ".$issue_work_id." ";
//     $update_issue_detail_sql.= " AND entry_type = '".$entry_type."' ";
//     //echo $update_issue_detail_sql;exit;
//     pg_query($update_issue_detail_sql);
//     $msg = "Issue detail updated successfully";
        
// }


// if(isset($_POST['submit']) && $_POST['submit'] == 'Add Completion Detail'){
//     extract($_POST);
//     //print_r($_POST);
//     //enter issue detail

//     $issue_resolve_detail = addslashes($issue_resolve_detail);
//     $issue_resolve_detail = addQuoteMS($issue_resolve_detail);    
//     $issue_resolve_date   = date2mysql($issue_resolve_date);
//     $insert_issue_detail_sql = "INSERT INTO pm_issue_resolve_detail
//                                 (
//                                 issue_type_id
//                                 ,issue_stage_id
//                                 ,work_id
//                                 ,entry_type
//                                 ,issue_resolve_detail
//                                 ,issue_resolve_date
//                                 ,power_id
//                                 ,wings_id                                
//                                 ,circle_id
//                                 ,division_id
//                                 ,sub_division_id
//                                 ,section_id
//                                 )";
//     $insert_issue_detail_sql.= "VALUES ";
//     $insert_issue_detail_sql.= "(
//                                 ".$issue_type_id."
//                                 ,0
//                                 ,".$issue_work_id."
//                                 ,'".$entry_type."'
//                                 ,'".$issue_resolve_detail."'
//                                 ,'".$issue_resolve_date."'

//                                 ,'".$_SESSION["sess_power_id"]."'
//                                 ,".$_SESSION["sess_wings_id"]."
//                                 ,".$_SESSION["session_circle_id"]."
//                                 ,".$_SESSION["session_division_id"]."
//                                 ,".$_SESSION["session_sub_division_id"]."
//                                 ,".$_SESSION["session_section_id"]."
//                                 )
//                                 ";
                                
//         pg_query($insert_issue_detail_sql);
        
        
//         $update_issue_detail_sql = "UPDATE   pm_issue_detail SET  resolved_date = '".$issue_resolve_date."',is_work_issue_solved =  'Y'
//         WHERE work_id = ".$issue_work_id."  AND entry_type = '".$entry_type."' AND issue_type_id = ".$issue_type_id."  ";
//         @pg_query($update_issue_detail_sql);
//         $msg = "Issue completion detail  added successfully";
        
//         /*
//         $msg = "Issue completion detail  added successfully";
//         $msg= base64_encode($msg);
//         if($entry_type == 'F')
//             header("Location: index.php?page=192&msg=".urlencode($msg));
//         if($entry_type == 'P')
//             header("Location: index.php?page=266&msg=".urlencode($msg));
          
//         exit(0);
//         */
// }

// if(isset($_POST['submit']) && $_POST['submit'] == 'Add Current Status'){
//     extract($_POST);
//     //print_r($_POST);
//     //enter issue detail

//     $issue_curr_status_detail = addslashes($issue_curr_status_detail);
//     $issue_curr_status_detail = addQuoteMS($issue_curr_status_detail);    
//     $issue_curr_status_date   = date2mysql($issue_curr_status_date);
//     $insert_issue_detail_sql = "INSERT INTO pm_issue_curr_status_detail
//                                 (
//                                 issue_type_id
//                                 ,issue_stage_id
//                                 ,work_id
//                                 ,entry_type
//                                 ,issue_curr_status_detail
//                                 ,issue_curr_status_date
//                                 ,power_id
//                                 ,wings_id                                
//                                 ,circle_id
//                                 ,division_id
//                                 ,sub_division_id
//                                 ,section_id
//                                 )";
//     $insert_issue_detail_sql.= "VALUES ";
//     $insert_issue_detail_sql.= "(
//                                 ".$issue_type_id."
//                                 ,0
//                                 ,".$issue_work_id."
//                                 ,'".$entry_type."'
//                                 ,'".$issue_curr_status_detail."'
//                                 ,'".$issue_curr_status_date."'

//                                 ,'".$_SESSION["sess_power_id"]."'
//                                 ,".$_SESSION["sess_wings_id"]."
//                                 ,".$_SESSION["session_circle_id"]."
//                                 ,".$_SESSION["session_division_id"]."
//                                 ,".$_SESSION["session_sub_division_id"]."
//                                 ,".$_SESSION["session_section_id"]."
//                                 )
//                                 ";
                                
//         pg_query($insert_issue_detail_sql);
//         $msg = "Issue current status detail added successfully";
//         /*
//         $msg = "Issue current status detail added successfully";
//         $msg= base64_encode($msg);
//         if($entry_type == 'F')
//             header("Location: index.php?page=192&msg=".urlencode($msg));
//         if($entry_type == 'P')
//             header("Location: index.php?page=266&msg=".urlencode($msg));
          
//         exit(0);
//         */
// }

// if(isset($_POST['submit']) && $_POST['submit'] == 'Add Description'){
//     extract($_POST);
//     //print_r($_POST);
//     //enter issue detail

//     $issue_curr_status_detail = addslashes($issue_curr_status_detail);
//     $issue_curr_status_detail = addQuoteMS($issue_curr_status_detail);    
//     $insert_issue_detail_sql = "INSERT INTO pm_issue_desc_detail
//                                 (
//                                 issue_type_id
//                                 ,work_id
//                                 ,entry_type
//                                 ,issue_desc_detail
//                                 ,power_id
//                                 ,wings_id                                
//                                 ,circle_id
//                                 ,division_id
//                                 ,sub_division_id
//                                 ,section_id
//                                 )";
//     $insert_issue_detail_sql.= "VALUES ";
//     $insert_issue_detail_sql.= "(
//                                 ".$issue_type_id."
//                                 ,".$issue_work_id."
//                                 ,'".$entry_type."'
//                                 ,'".$issue_desc_detail."'

//                                 ,'".$_SESSION["sess_power_id"]."'
//                                 ,".$_SESSION["sess_wings_id"]."
//                                 ,".$_SESSION["session_circle_id"]."
//                                 ,".$_SESSION["session_division_id"]."
//                                 ,".$_SESSION["session_sub_division_id"]."
//                                 ,".$_SESSION["session_section_id"]."
//                                 )
//                                 ";
                                
//         pg_query($insert_issue_detail_sql);
//          $msg = "Issue descriptiion detail added successfully";
//         /*
//         $msg = "Issue descriptiion detail added successfully";
//         $msg= base64_encode($msg);
//         if($entry_type == 'F')
//             header("Location: index.php?page=192&msg=".urlencode($msg));
//         if($entry_type == 'P')
//             header("Location: index.php?page=266&msg=".urlencode($msg));
          
//         exit(0);
//         */
// }
// if(isset($_POST['submit']) && $_POST['submit'] == 'Update Description'){
//     extract($_POST);
//     //print_r($_POST);
//     //enter issue detail


//     $issue_curr_status_detail = addslashes($issue_curr_status_detail);
//     $issue_curr_status_detail = addQuoteMS($issue_curr_status_detail);   
//     $update_issue_detail_sql = " UPDATE pm_issue_desc_detail SET issue_desc_detail = '".$issue_desc_detail."' ";
//     $update_issue_detail_sql.= " WHERE issue_type_id = ".$issue_type_id." ";
//     $update_issue_detail_sql.= " AND work_id = ".$issue_work_id." ";
//     $update_issue_detail_sql.= " AND entry_type = '".$entry_type."' ";
//     //echo $update_issue_detail_sql;exit;
//     pg_query($update_issue_detail_sql);
//     $msg = "Issue description detail updated successfully";
        
// }

// if(isset($_POST['submit']) && $_POST['submit'] == 'Add Status'){
//     extract($_POST);
//     //print_r($_POST);
//     //enter issue detail

//     $issue_type_status = addslashes($issue_type_status);
//     $issue_type_status = addQuoteMS($issue_type_status);    
//     $insert_issue_detail_sql = "INSERT INTO pm_issue_type_curr_status
//                                 (
//                                 issue_type_id
//                                 ,work_id
//                                 ,entry_type
//                                 ,issue_type_status
//                                 ,power_id
//                                 ,wings_id                                
//                                 ,circle_id
//                                 ,division_id
//                                 ,sub_division_id
//                                 ,section_id
//                                 )";
//     $insert_issue_detail_sql.= "VALUES ";
//     $insert_issue_detail_sql.= "(
//                                 ".$issue_type_id."
//                                 ,".$issue_work_id."
//                                 ,'".$entry_type."'
//                                 ,'".$issue_type_status."'

//                                 ,'".$_SESSION["sess_power_id"]."'
//                                 ,".$_SESSION["sess_wings_id"]."
//                                 ,".$_SESSION["session_circle_id"]."
//                                 ,".$_SESSION["session_division_id"]."
//                                 ,".$_SESSION["session_sub_division_id"]."
//                                 ,".$_SESSION["session_section_id"]."
//                                 )
//                                 ";
                                
//         pg_query($insert_issue_detail_sql);

//          $msg = "Current status detail has been added successfully";
//         /*
//         $msg = "Issue descriptiion detail added successfully";
//         $msg= base64_encode($msg);
//         if($entry_type == 'F')
//             header("Location: index.php?page=192&msg=".urlencode($msg));
//         if($entry_type == 'P')
//             header("Location: index.php?page=266&msg=".urlencode($msg));
          
//         exit(0);
//         */
// }


// if(isset($_POST['submit']) && $_POST['submit'] == 'Add Compliance'){
//     extract($_POST);
   
//     //enter issue detail

//     $issue_compliance_remark = addslashes($issue_compliance_remark);
//     $issue_compliance_remark = addQuoteMS($issue_compliance_remark);    
//     $issue_compliance_date   = date2mysql($issue_compliance_date);
    
//     $insert_issue_detail_sql = "INSERT INTO pm_issue_compliance
//                                 (
//                                 issue_detail_id
//                                 ,issue_compliance_date
//                                 ,issue_compliance_remark
//                                 ,power_id
//                                 ,wings_id    
//                                 ,circle_id
//                                 ,division_id
//                                 ,sub_division_id
//                                 ,section_id
//                                 )";
//     $insert_issue_detail_sql.= "VALUES ";
//     $insert_issue_detail_sql.= "(
//                                 ".$issue_detail_id."
//                                 ,'".$issue_compliance_date."'
//                                 ,'".$issue_compliance_remark."'                                
//                                 ,'".$_SESSION["sess_power_id"]."'
//                                 ,".$_SESSION["sess_wings_id"]."
//                                 ,".$_SESSION["session_circle_id"]."
//                                 ,".$_SESSION["session_division_id"]."
//                                 ,".$_SESSION["session_sub_division_id"]."
//                                 ,".$_SESSION["session_section_id"]."
//                                 )
//                                 ";   
//         //echo $insert_issue_detail_sql;
//         pg_query($insert_issue_detail_sql);
//         $msg = "Issue compliance  detail added successfully";
//         $msg= base64_encode($msg);
//         header("Location: index.php?page=266&msg=".urlencode($msg));
//         exit(0);      
    
// }   
// if(isset($_POST['submit']) && $_POST['submit'] == 'Add Resolved Detail'){
//     extract($_POST);
//     $resolved_date = date2mysql($resolved_date);
//     $update_issue_detail_sql = "UPDATE   pm_issue_detail SET  resolved_date = '".$resolved_date."',is_work_issue_solved =  'Y' WHERE issue_detail_id = ".$issue_detail_id." ";
//     pg_query($update_issue_detail_sql);
//     $msg = "Issue compliance  resolved successfully";
//     $msg= base64_encode($msg);
//     header("Location: index.php?page=266&msg=".urlencode($msg));
//     exit(0);                                      

    
// }
// if(isset($opt) && $opt == 'Delete Issue' && isset($issue_detail_id) && $issue_detail_id != 0){
//     extract($_POST);
//     //print_r($_POST);
    
//     $del_sql = "DELETE FROM pm_issue_detail WHERE issue_detail_id = ".$issue_detail_id." ";
//     pg_query($del_sql);
    
//     $del_sql = "DELETE FROM pm_issue_compliance WHERE issue_detail_id = ".$issue_detail_id." ";
//     pg_query($del_sql);
    
//     $msg = "Issue has been deleted successfully";
//     //$msg= base64_encode($msg);   
    
// }


include_once ('./view/add_issue_detail.html');
?>
