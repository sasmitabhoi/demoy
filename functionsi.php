<?php 
//--------------------------------------------------
//SQL SERVER CHECK.
//--------------------------------------------------

define('BUILDIND_ID',14);
/*$mss = "mamata_lv_ocac_testing.dbo";
define('MSS','mamata_lv_ocac_testing.dbo');
*/

$mss = "pms_v3_wpms.dbo";
define('MSS','pms_v3_wpms.dbo');

function addQuoteMS($str)
{
    $temp_val = stripslashes(str_replace("'","''",$str));
    return $temp_val;
}
function stripQuoteMS($str)
{
    return stripslashes(str_replace("''","'",$str));
}
function getGmailId($userid){
    global $mss;
    if($userid != 0)
    {
        $EMAIL = '';
        $user_name_sql = " SELECT email AS EMAIL FROM pm_auth_user ";
        $user_name_sql .= " WHERE user_id = ".$userid;
        $user_name_res = pg_query($user_name_sql);
        extract(pg_fetch_assoc($user_name_res));
        return $email;
    }    
}

/*function generateNewIcon($id){
    $getQuery = "SELECT aa_amount from division where division_id = '$id'";
    $getResult = pg_fetch_assoc(pg_query($getQuery));
    extract($getResult);
    echo $created;
    if(isset($created)){
            $date1 = $created;
            $date2 = date('Y-m-d');

            $diff = abs(strtotime($date2) - strtotime($date1));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            if((int)$months > 0 && (int)$months <= 2){
               return $newIcon = ' <span class="blink">*New</span>';
            }
    }
}*/
//Get Scheme name from wph_id 

function getParamNameFromID($value , $id, $name, $table){
    $year = date('Y');
    $getQuery = "SELECT $name from $table where $id = ".$value." ";
    //select * from pm_work_allotment where wa_division_id='17' and DATEPART(yyyy, aa_date) = '2016'
    $getResult = pg_fetch_assoc(pg_query($getQuery));
    extract($getResult);
   return $$name;
 
}

function generateNewIcon($id){
    $year = date('Y');
    $getQuery = "SELECT count(*) as TOTAL_ROW from pm_work_allotment where wa_division_id='$id' and 
    extract(year from aa_date::date) = '$year'";
    //select * from pm_work_allotment where wa_division_id='17' and DATEPART(yyyy, aa_date) = '2016'
    $getResult = pg_fetch_assoc(pg_query($getQuery));
    extract($getResult);
    $total_c = $total_row;
    if(isset($total_c) && (int)$total_c > 0){
        return $newIcon = ' <span class="blink">*New</span>';
    }else{
        
    }
 
}
function getAllotmentID($wph_id){
    global $mss;
    if($wph_id){
        $fetch_scheme = "SELECT wa_id FROM pm_work_allotment WHERE work_id =".$wph_id;
		$fetch_scheme_res = pg_query($fetch_scheme);
        if(pg_num_rows($fetch_scheme_res)>0){
           extract(pg_fetch_assoc($fetch_scheme_res));
           return $wa_id;
        }else{
           return '';   
        }
    }else{
        return '';
    }
}

//Get Scheme name from wph_id 
function getSchemeName($wph_id){
    global $mss;
    if($wph_id){
        $fetch_scheme = "SELECT work_scheme_id FROM pm_works_project_head WHERE wph_id =".$wph_id; 
        $fetch_scheme_res = pg_query($fetch_scheme);
        if(pg_num_rows($fetch_scheme_res)>0){
           extract(pg_fetch_assoc($fetch_scheme_res));
           return $work_scheme_id;
        }else{
           return '';   
        }
    }else{
        return '';
    }
}

function getWorkName($pid)
{
    global $mss;
	$get_wing_name_sql = "select work_name as workname from pm_works where work_id = ".$pid." ";
    $get_wing_name_res = pg_query($get_wing_name_sql);
    @extract(pg_fetch_assoc($get_wing_name_res));
    return $workname;
}
function getTargaetsts($tid)
{
    global $mss;
	$get_status_sql = "SELECT archivement_type AS ACHIEVEMENT FROM archivement_details WHERE archivement_percentage = ".$tid." ";
    $get_status_res = pg_query($get_status_sql);
    @extract(pg_fetch_assoc($get_status_res));
    return $achievement;
}


function getWingName($wingid)
{
    global $mss;
	$get_wing_name_sql = "SELECT wings_name AS WINGNAME FROM pm_wings WHERE wings_id = ".$wingid." ";
    $get_wing_name_res = pg_query($get_wing_name_sql);
    @extract(pg_fetch_assoc($get_wing_name_res));
    return $wingname;
}

function getworkWisewing($wid)
{
    global $mss;
	$get_wing_name_sql = "SELECT WINGS.wings_name AS WINGNAME  FROM pm_works WORKS INNER JOIN pm_wings WINGS ON WORKS.wings_id = WINGS.wings_id WHERE work_id = ".$wid." ";
    $get_wing_name_res = pg_query($get_wing_name_sql);
    @extract(pg_fetch_assoc($get_wing_name_res));
    return $wingname;
}
function getworkWiseScheme($wid)
{
    global $mss;
	$get_wing_name_sql = "SELECT FUND.fund_name AS FUNDNAME  FROM pm_works WORKS INNER JOIN pm_fund FUND ON WORKS.source_fund_id = FUND.fund_id WHERE work_id = ".$wid." ";
    $get_wing_name_res = pg_query($get_wing_name_sql);
    @extract(pg_fetch_assoc($get_wing_name_res));
    return $fundname;
}

function getworkWiseptype($wid)
{
    global $mss;
	$get_project_type_sql = "SELECT PTYPE.project_type_name AS PTYPENENAME  FROM pm_works WORKS INNER JOIN pm_project_type PTYPE ON WORKS.project_type = PTYPE.project_id WHERE WORKS.work_id = ".$wid." ";
    $get_project_type_res = pg_query($get_project_type_sql);
    @extract(pg_fetch_assoc($get_project_type_res));
    return $ptypenename;
}
function getworkWisename($wid)
{
    global $mss;
	$get_project_type_sql = "SELECT WORKS.work_name  AS WORKNAME FROM pm_works WORKS  WHERE WORKS.work_id = ".$wid." ";
    $get_project_type_res = pg_query($get_project_type_sql);
    @extract(pg_fetch_assoc($get_project_type_res));
    return $workname;
}
function getAllotmentamt($pid)
{
    global $mss;
	$get_project_type_sql = "SELECT aa_amount  FROM  pm_work_allotment   WHERE work_id = ".$pid." ";
    $get_project_type_res = pg_query($get_project_type_sql);
    @extract(pg_fetch_assoc($get_project_type_res));
    return $aa_amount;
}
function getAgreementamt($pid)
{
    global $mss;
	$get_project_type_sql = "SELECT con_agreement_amount  FROM  pm_contractor_details   WHERE con_work_id = ".$pid." ";
    $get_project_type_res = pg_query($get_project_type_sql);
    @extract(pg_fetch_assoc($get_project_type_res));
    return $con_agreement_amount;
}
function getSecname($secid)
{
    global $mss;
    $SECNAME = '';
	if($secid)
	{
    $get_section_sql = "SELECT section_name  AS SECNAME FROM  section   WHERE section_id = ".$secid." ";
    $get_section_res = pg_query($get_section_sql);
    @extract(pg_fetch_assoc($get_section_res));
	}
    return $secname;
}
function getCirname($id)
{
    global $mss;
    $CIRNAME = '';
	if($id)
	{
    $get_detail_sql = "SELECT circle_name  AS CIRNAME FROM  circle WHERE circle_id = ".$id." ";
    $get_detail_res = pg_query($get_detail_sql);
    @extract(pg_fetch_assoc($get_detail_res));
	}
    return $cirname;
}
 function getDivname($id)
{
    global $mss;
    $DIVNAME = '';
	if($id)
	{
    $get_detail_sql = "SELECT division_name  AS DIVNAME FROM  division WHERE division_id = ".$id." ";
    $get_detail_res = pg_query($get_detail_sql);
    @extract(pg_fetch_assoc($get_detail_res));
	}
    return $divname;
}
 function getSubDivname($id)
{
    global $mss;
    $SUBDIVNAME = '';
	if($id)
	{
    $get_detail_sql = "SELECT sub_division_name  AS SUBDIVNAME FROM  subdivision WHERE sub_division_id = ".$id." ";
    $get_detail_res = pg_query($get_detail_sql);
    @extract(pg_fetch_assoc($get_detail_res));
	}
    return $subdivname;
} 
 
 
function getcommdate($pid)
{
    global $mss;
	$get_project_type_sql = "SELECT con_commencement_date  FROM  pm_contractor_details   WHERE con_work_id = ".$pid." ";
    $get_project_type_res = pg_query($get_project_type_sql);
    @extract(pg_fetch_assoc($get_project_type_res));
    return $con_commencement_date;
}
function getcompdate($pid)
{
    global $mss;
	$get_project_type_sql = "SELECT con_completion_date  FROM  pm_contractor_details   WHERE con_work_id = ".$pid." ";
    $get_project_type_res = pg_query($get_project_type_sql);
    @extract(pg_fetch_assoc($get_project_type_res));
    return $con_completion_date;
}
function getPcode($pid)
{
    global $mss;
	$get_pcode_sql = "SELECT short_work_name  FROM  pm_works   WHERE work_id = ".$pid." ";
    $get_pcode_res = pg_query($get_pcode_sql);
    @extract(pg_fetch_assoc($get_pcode_res));
    return $short_work_name;
}


function getCreationdate($pid)
{
    global $mss;
	$get_creation_date_sql = "SELECT work_creation_date AS creationdate FROM pm_works WHERE work_id = ".$pid." ";
    $get_creation_date_res = pg_query($get_creation_date_sql);
    @extract(pg_fetch_assoc($get_creation_date_res));
    return $creationdate;
}
function getFUND($fund_id)
{
    global $mss;
	$get_creation_date_sql = "SELECT fund_name FROM pm_fund WHERE fund_id = ".$fund_id." ";
    $get_creation_date_res = pg_query($get_creation_date_sql);
    @extract(pg_fetch_assoc($get_creation_date_res));
    return $fund_name;
}
function getSubCompName($sub_comp_id)
{
    global $mss;
	$get_creation_date_sql = "SELECT sub_comp_name FROM pm_sub_components WHERE sub_comp_id = ".$sub_comp_id." ";
    $get_creation_date_res = pg_query($get_creation_date_sql);
    @extract(pg_fetch_assoc($get_creation_date_res));
    return $sub_comp_name;
}

function getCONName($pid)
{
    global $mss;
	$get_creation_date_sql = "SELECT con_name FROM pm_contractor_details WHERE con_work_id = ".$pid." ";
    $get_creation_date_res = pg_query($get_creation_date_sql);
    @extract(pg_fetch_assoc($get_creation_date_res));
    if((int)$con_name >= 0)
	{
			$get_creation_date_sql = "SELECT contractor_name FROM pm_contractor WHERE contractor_id = ".$con_name." ";
			$get_creation_date_res = @pg_query($get_creation_date_sql);
			@extract(pg_fetch_assoc($get_creation_date_res));
			return $contractor_name;
	}
	else
	{
		return $con_name;
	}
}
function getAllotDetail($pid)
{
    global $mss;
	$user_name = '';$mobile_num='';
    $get_assign_detail_sql  = "SELECT PAU.user_name,PAU.mobile_num  FROM pm_auth_user PAU LEFT JOIN pm_work_allotment PWA ON PAU.section_id = PWA.wa_section_id WHERE work_id = ".$pid." AND PAU.section_id != 0";
	$get_assign_detail_res = pg_query($get_assign_detail_sql);
	$get_assign_detail_cnt = pg_num_rows($get_assign_detail_res);
	if($get_assign_detail_cnt > 0){
		 @extract(pg_fetch_assoc($get_assign_detail_res));
	}
	if($user_name != '')
		return $user_name."[".$mobile_num."]";
	else
	return '';
}

function getexistConname($conid){
	$get_creation_date_sql = "SELECT contractor_name FROM pm_contractor WHERE contractor_id = ".$conid." ";
	$get_creation_date_res = @pg_query($get_creation_date_sql);
	@extract(pg_fetch_assoc($get_creation_date_res));
	return $contractor_name;  
}

function getuserSpecification1($useridval){
    if($useridval != 0 && is_numeric($useridval)){
        $gmailid = '';
        $FULLNAME = '';
        $DESIGNAME = '';
        $gmailid   = '';
        $user_name_sql = " SELECT AU.full_name AS FULLNAME,PD.desg_name AS DESIGNAME,AU.email AS gmailid,PMWING.wings_name AS WINGNAME,CIR.circle_name AS CRINAME,DIV.division_name AS DIVNAME FROM pm_auth_user AU INNER JOIN pm_designation PD  ON AU.power_id = PD.desg_value ";
        $user_name_sql.= " LEFT JOIN circle CIR ON AU.circle_id = CIR.circle_id ";
        $user_name_sql.= " LEFT JOIN division DIV ON AU.division_id = DIV.division_id ";
        $user_name_sql.= " LEFT JOIN pm_wings PMWING ON AU.wings_id = PMWING.wings_id ";        
        $user_name_sql .= " WHERE AU.user_id = ".$useridval."";
        $user_name_res = pg_query($user_name_sql);
        @extract(pg_fetch_assoc($user_name_res));
        return $fullname.'**'.$designame.'**'.$gmailid.'**'.$criname.'**'.$divname.'**'.$wingname;       
    }else{
        return '';
    }

}
function getUserDetailthroughId($useridval){
    if($useridval != 0 && is_numeric($useridval)){
        $gmailid = '';
        $FULLNAME = '';
        $DESIGNAME = '';
        $user_name_sql = " SELECT AU.full_name AS FULLNAME,PD.desg_name AS DESIGNAME , AU.email AS gmailid FROM pm_auth_user AU INNER JOIN pm_designation PD  ON AU.power_id = PD.desg_value ";
        $user_name_sql .= " WHERE AU.user_id = ".$useridval."";
        $user_name_res = pg_query($user_name_sql);
       return(pg_fetch_assoc($user_name_res));
               
    }else{
        return '';
    }

}

function getuserSpecificationDetail($useridval){
    if($useridval != 0 && is_numeric($useridval)){
        $gmailid = '';
        $FULLNAME = '';
        $DESIGNAME = '';
        $gmailid   = '';
        $SUBDIVNAME='';
        $SECNAME='';
        $user_name_sql = " SELECT AU.full_name AS FULLNAME,PD.desg_name AS DESIGNAME,AU.email AS gmailid,PMWING.wings_name AS WINGNAME,CIR.circle_name AS CRINAME,DIV.division_name AS DIVNAME,SUBDIV.sub_division_name AS SUBDIVNAME,SEC.section_name AS SECNAME FROM pm_auth_user AU INNER JOIN pm_designation PD  ON AU.power_id = PD.desg_value ";
        $user_name_sql.= " LEFT JOIN circle CIR ON AU.circle_id = CIR.circle_id ";
        $user_name_sql.= " LEFT JOIN division DIV ON AU.division_id = DIV.division_id ";
        $user_name_sql.= " LEFT JOIN pm_wings PMWING ON AU.wings_id = PMWING.wings_id "; 
        $user_name_sql.= " LEFT JOIN subdivision SUBDIV ON AU.sub_division_id = SUBDIV.sub_division_id ";
        $user_name_sql.= " LEFT JOIN section SEC ON AU.section_id = SEC.section_id ";       
        $user_name_sql .= " WHERE AU.user_id = ".$useridval."";
        $user_name_res = pg_query($user_name_sql);
        @extract(pg_fetch_assoc($user_name_res));
        return $FULLNAME.'**'.$DESIGNAME.'**'.$gmailid.'**'.$CRINAME.'**'.$DIVNAME.'**'.$WINGNAME.'**'.$SUBDIVNAME.'**'.$SECNAME;       
    }else{
        return '';
    }

}
function getuserSpecification($APPROVEUSERVAL,$wings_id,$circle_id,$division_id){
    $FULLNAME = '';
    $DESIGNAME = '';
    $CRINAME = '';
    $DIVNAME = '';
    $WINGNAME = '';
    if($APPROVEUSERVAL != ''){
        $user_name_sql = " SELECT AU.full_name AS FULLNAME,AU.email AS EMAIL,PMWING.wings_name AS WINGNAME,PD.desg_name AS DESIGNAME,CIR.circle_name AS CRINAME,DIV.division_name AS DIVNAME FROM pm_auth_user AU INNER JOIN pm_designation PD  ON AU.power_id = PD.desg_value";
        $user_name_sql.= " LEFT JOIN circle CIR ON AU.circle_id = CIR.circle_id ";
        $user_name_sql.= " LEFT JOIN division DIV ON AU.division_id = DIV.division_id ";
        $user_name_sql.= " LEFT JOIN pm_wings PMWING ON AU.wings_id = PMWING.wings_id ";
        if($APPROVEUSERVAL == 'EIC'){
            $user_name_sql .= " WHERE AU.power_id = 'EIC' ";
        }
        if($APPROVEUSERVAL == 'PMU'){
            $user_name_sql .= " WHERE AU.power_id = 'PMU' ";
        }                
        if($APPROVEUSERVAL == 'CE'){
            $user_name_sql .= " WHERE AU.wings_id = ".$wings_id."  AND  power_id = 'CE' ";
        } 
        if($APPROVEUSERVAL == 'SE'){
            $user_name_sql .= " WHERE AU.circle_id = ".$circle_id."  AND  power_id = 'SE' ";
        } 
        if($APPROVEUSERVAL == 'EE'){
            $user_name_sql .= " WHERE AU.division_id = ".$division_id."  AND  power_id = 'EE' ";
        }  
        if($APPROVEUSERVAL == 'AE'){
            $user_name_sql .= " WHERE AU.sub_division_id = ".$sub_division_id."  AND  power_id = 'AE' ";
        }    
        if($APPROVEUSERVAL == 'JE'){
            $user_name_sql .= " WHERE AU.section_id = ".$section_id."  AND  power_id = 'JE' ";
        }
        //echo $user_name_sql;                                                                           
        $user_name_res = pg_query($user_name_sql);
        $myArr = pg_fetch_assoc($user_name_res);
        extract($myArr);
        return $fullname.'**'.$designame.'**'.$criname.'**'.$divname.'**'.$wingname;        
    }else{
        return '';
    }
}

function getuserInfo($APPROVEUSERVAL,$wings_id,$circle_id,$division_id,$sub_division_id = 0,$section_id = 0){
    $FULLNAME = '';
    $DESIGNAME = '';
    $CRINAME = '';
    $DIVNAME = '';
    $WINGNAME = '';

    if($APPROVEUSERVAL != ''){
        $user_name_sql = " SELECT  AU.user_id AS USERID,AU.full_name AS FULLNAME,AU.email AS gmailid,PMWING.wings_name AS WINGNAME,PD.desg_name AS DESIGNAME,CIR.circle_name AS CRINAME,DIV.division_name AS DIVNAME ,SUBDIV.sub_division_name as SUBDIVNAME , SEC.section_name as SECNAME FROM pm_auth_user AU INNER JOIN pm_designation PD  ON AU.power_id = PD.desg_value";
        $user_name_sql.= " LEFT JOIN circle CIR ON AU.circle_id = CIR.circle_id ";
        $user_name_sql.= " LEFT JOIN division DIV ON AU.division_id = DIV.division_id ";
        $user_name_sql.= " LEFT JOIN subdivision SUBDIV ON AU.sub_division_id = SUBDIV.sub_division_id ";
        $user_name_sql.= " LEFT JOIN section SEC ON AU.section_id = SEC.section_id ";
        $user_name_sql.= " LEFT JOIN pm_wings PMWING ON AU.wings_id = PMWING.wings_id ";
        if($APPROVEUSERVAL == 'EIC'){
            $user_name_sql .= " WHERE AU.power_id = 'EIC' ";
        }
        if($APPROVEUSERVAL == 'PMU'){
            $user_name_sql .= " WHERE AU.power_id = 'PMU' ";
        }                
        if($APPROVEUSERVAL == 'CE'){
            $user_name_sql .= " WHERE AU.wings_id = ".$wings_id."  AND  power_id = 'CE' ";
        } 
        if($APPROVEUSERVAL == 'SE'){
            $user_name_sql .= " WHERE AU.circle_id = ".$circle_id."  AND  power_id = 'SE' ";
        } 
        if($APPROVEUSERVAL == 'EE'){
            $user_name_sql .= " WHERE AU.division_id = ".$division_id."  AND  power_id = 'EE' ";
        }  
        if($APPROVEUSERVAL == 'AE'){
            $user_name_sql .= " WHERE AU.sub_division_id = ".$sub_division_id."  AND  power_id = 'AE' ";
        }    
        if($APPROVEUSERVAL == 'JE'){
            $user_name_sql .= " WHERE AU.section_id = ".$section_id."  AND  power_id = 'JE' ";
        }
        //echo $user_name_sql;                                                                           
        $user_name_res = pg_query($user_name_sql);
        return (pg_fetch_assoc($user_name_res));        
    }else{
        return '';
    }
}
//get the own power
function getComplianceDetail($inspid,$userid){
    $get_complience_cnt = 0;
    $get_complience_sql = " SELECT compliance_date,compliance_detail,compliance_file FROM pm_inspection_compliance WHERE inspection_id = ".$inspid." AND compliance_by = ".$userid." ";
    $get_complience_res = pg_query($get_complience_sql);
    $get_complience_cnt = pg_num_rows($get_complience_res);    
    if($get_complience_cnt > 0){
        extract(pg_fetch_assoc($get_complience_res)); 
        return $get_complience_cnt.'**'.$compliance_date.'**'.$compliance_detail.'**'.$compliance_file;               
    }else{
        return $get_complience_cnt.'**'.''.'**'.''.'**'.'';               
    }

}

//MS SQL SERVER FUNCTIONS
function escapeSingleQuotes($str)
{
    return stripslashes(str_replace("'","''",$str));
}

function handleDate($dt,$format='')
{
	if(trim($dt) != '')
	{
		if($format == '')
			$format = 'd/m/Y';

		$countFormatSlash   = explode("/",$dt);
		$countFormatHighPen = explode("-",$dt);
		if(count($countFormatSlash) > 1 && $dt != '01/01/1900')
		{
			//All in slash format and its in d/m/y format
			return $dt;

		}
		else if(count($countFormatHighPen) > 1 && $dt != '1900-01-01')
		{
			//All in Highpen format and its in Y-m-d format 0-year ,1-month , 2-date
			$newDt = $countFormatHighPen[2].'/'.$countFormatHighPen[1].'/'.$countFormatHighPen[0];
			return $newDt;
		}
		else
		{
			return;
		}

	}
}
//Get work alloted by only through knowing their work ID
function getWorkAllotedBy($wid)
{
	global $mss;
    if($wid != 0)
	{
		$show_work_allted_by_sql = "SELECT wa_alloted_by FROM pm_work_allotment WHERE work_id=".$wid;
		$show_work_allted_by_res = pg_query($show_work_allted_by_sql);
		if(pg_num_rows($show_work_allted_by_res) > 0)
		{
			while($show_work_allted_by_rows = pg_fetch_assoc($show_work_allted_by_res))
			{
				$ALLOTED_BY = getUserName($show_work_allted_by_rows['wa_alloted_by']);
				return $ALLOTED_BY;
			}
		}
	}
}

//Get Name of User according to their User ID
function getUserName($uid)
{
	global $mss;
    if($uid != 0)
	{
		$user_name_sql = " SELECT full_name AS USERNAME FROM pm_auth_user ";
		$user_name_sql .= " WHERE user_id = ".$uid;
		$user_name_res = pg_query($user_name_sql);
		extract(pg_fetch_assoc($user_name_res));
		return $USERNAME;
	}
}

//Show all the Work/Scheme Id for each Work ID
function showSchemeIdofDiffWorkId($wid)
{
	global $mss;
	if($wid != '')
    {
		$show_scheme_sql = "SELECT work_scheme_id FROM pm_works_project_head WHERE wph_work_id=".$wid; 
		$show_scheme_res = pg_query($show_scheme_sql);
		if(pg_num_rows($show_scheme_res) > 0)
		{
			while($wa_rows = pg_fetch_assoc($show_scheme_res))
			{
				$scheme_id =  removeSchemeId($wa_rows['work_scheme_id']);
				echo $scheme_id."</br>";
			}
		}
	}
}

//Remove Database id from scheme_id of WMS
function removeSchemeId($x)
{
    $break_scheme_id = explode("-",$x);
    array_pop($break_scheme_id);
    $new_scheme_id = implode("-",$break_scheme_id);
    return $new_scheme_id;
}


//http://blog.hao909.com/how-to-get-a-list-of-month-between-two-dates-using-php/
//*********************************** GET MONTH BETWEEN 2 DATE *************************//
function get_next_month($tstamp) {
    return (strtotime('+1 months', strtotime(date('Y-m-01', $tstamp))));
}
function get_month_between_two_datetime($start, $end){
    $start = $start=='' ? time() : strtotime($start);
    $end = $end=='' ? time() : strtotime($end);
    $months = array();
     
    for ($i = $start; $i <= $end; $i = get_next_month($i)) {
        $months[] = date('Y-m', $i);
    }
     
    return $months;
}
//*****************************GET MONTH BETWEEN 2 DATE *************************//



function getAllotmentAmount($workid,$allotid,$isrevised,$mss)
{
    
    //*****TOTAL ALLOTMENT AMOUNT CALCULATION******************//    
    $final_total_allotment_amount = 0;
    if($isrevised == '')
    {
        $isrevised = 'N';
    }
    //[STEP-1]:Total Allotment Amount whose work is not accepted
    $Total_finance = 0;
    $budget_notaccepted_sql = "SELECT SUM(wa_amount) AS Total_finance FROM pm_work_allotment WHERE work_id=".$workid." AND wa_is_accepted ='N'";
    if($allotid != '')
    {
        $budget_notaccepted_sql .= "  AND wa_id =".$allotid;
    }
    $budget_notaccepted_res = pg_query($budget_notaccepted_sql);
    if(pg_num_rows($budget_notaccepted_res) > 0)
        extract(pg_fetch_assoc($budget_notaccepted_res));

    //[STEP-2]:Total Allotment Amount whose work is Accepted but No data in Finance Table (re_allotment table)
    $Accpeted_With_NO_FINANCE = 0;
    $budget_notaccepted_sql = "SELECT wa_id,wa_amount FROM pm_work_allotment WHERE work_id=".$workid." AND wa_is_accepted ='Y'";
    if($allotid != '')
    {
        $budget_notaccepted_sql .=" AND wa_id =".$allotid;
    }
    $budget_notaccepted_res = pg_query($budget_notaccepted_sql);
    if(pg_num_rows($budget_notaccepted_res) > 0)
    {
        while($wa_rows = pg_fetch_assoc($budget_notaccepted_res))
        {
             $query  = " SELECT re_allotment_amount AS X FROM pm_re_work_allotment FIANNCE";
             $query .= " WHERE FIANNCE.re_wa_id =".$wa_rows['wa_id'];
             $res = pg_query($query);
             if(pg_num_rows($res) == 0)
                $Accpeted_With_NO_FINANCE = $Accpeted_With_NO_FINANCE + $wa_rows['wa_amount'];          
        }
    } 

    //[STEP-3]:Total Allotment Amount,if work is accepted and finance amount is generated
    $Total_WA = 0;               
    $budget_aa_sql  = " SELECT SUM(FIANNCE.re_allotment_amount) AS Total_WA FROM pm_re_work_allotment FIANNCE";
    $budget_aa_sql .= " INNER JOIN pm_work_allotment ALLOT ON ALLOT.wa_id = FIANNCE.re_wa_id ";
    $budget_aa_sql .= " INNER JOIN pm_works WORKS ON WORKS.work_id = ALLOT.work_id";
    $budget_aa_sql .= " WHERE WORKS.work_id=".$workid; 
    if($allotid != '')
    {
        $budget_aa_sql .=" AND ALLOT.wa_id =".$allotid;
    }
    
    $budget_aa_res = pg_query($budget_aa_sql);
    if(pg_num_rows($budget_aa_res) > 0)
        extract(pg_fetch_assoc($budget_aa_res));             

    
    //[STEP-4] Get total Revied allotment amount From Revised allotment table
    $REVISEDAMOUNT = 0;
    if($isrevised == 'Y')
    {
        $revised_sql = " SELECT SUM(REV.rev_aa_amount) AS REVISEDAMOUNT FROM pm_rev_work_allotment_details REV INNER JOIN pm_work_allotment WA";
        $revised_sql .= " ON  REV.rev_wa_id = WA.wa_id";
        $revised_sql .= " WHERE WA.work_id = ".$workid;
        if($allotid != '')
        {
            $revised_sql .=" AND WA.wa_id =".$allotid;
        }
        $revised_res = pg_query($revised_sql);
        extract(pg_fetch_assoc($revised_res));
    }
    $final_total_allotment_amount = $Total_finance + $Accpeted_With_NO_FINANCE + $Total_WA+$REVISEDAMOUNT;

    return $final_total_allotment_amount;
}
function getRevisedReqAmount($workid,$allotid,$isrevised,$mss)
{
    //These r the sum of Total Req Amount for a perticular Work or Division
    $revised_sql = " SELECT SUM(REV.rev_aa_amount) AS REVISEDAMOUNT FROM pm_rev_work_allotment_details REV INNER JOIN pm_work_allotment WA";
    $revised_sql .= " ON  REV.rev_wa_id = WA.wa_id";
    $revised_sql .= " WHERE WA.work_id = ".$workid;
    if($allotid != '')
    {
        $revised_sql .=" AND WA.wa_id =".$allotid;
    }
    $revised_res = pg_query($revised_sql);
    extract(pg_fetch_assoc($revised_res));
    return $REVISEDAMOUNT;
}
function getRevisedApprovedAmount($workid,$allotid,$isrevised,$mss)
{
    //These r the sum of Total Approved Amount for a perticular Work or Division
    $revised_sql = " SELECT SUM(REV.rev_aa_amount) AS REVISEDAMOUNT FROM pm_rev_work_allotment_details REV INNER JOIN pm_work_allotment WA";
    $revised_sql .= " ON  REV.rev_wa_id = WA.wa_id";
    $revised_sql .= " WHERE WA.work_id = ".$workid;
    if($allotid != '')
    {
        $revised_sql .=" AND WA.wa_id =".$allotid;
    }
    $revised_res = pg_query($revised_sql);
    extract(pg_fetch_assoc($revised_res));
    return $REVISEDAMOUNT;
}


//--------------------------------------------------
//Prevent unotherised users.
//--------------------------------------------------
function checklogin()
{
        if(!isset($_SESSION['sess_user_id']))
        {
               header('location:index.php');
               exit(0);
        }
}

function checklogin_admin()
{
       if(!isset($_SESSION['sess_user_id']) && $_SESSION["sess_user_type"] != 'ADMIN')
       {
               header('location:index.php');
               exit(0);
       }
       check_bad_words();
       
}
function checklogin_pa()
{
       if(!isset($_SESSION['sess_user_id']) && $_SESSION["sess_user_type"] != 'DEPT_USER')
       {
               header('location:index.php');
               exit(0);
       } 
       check_bad_words();
}
//-------------------------------------------
function check_bad_words()
{
    
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on")
    {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80")
    {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    }
    else 
    {
         $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    $bad_words = array('script','iframe','drop','alert','src','img','..');  
    foreach($bad_words as $key => $val)
    { 
       if(stristr($pageURL, $val) != FALSE) 
       { 
           header('location:logout.php');
           exit(0);
       }
    }   
}

function calculateFiscalYearForDate($inputDate, $fyStart, $fyEnd)
{
    $date = strtotime($inputDate);
    $inputyear = strftime('%Y',$date);
    $nextinputyear = $inputyear+1;


    $fystartdate = strtotime($fyStart.'/'.$inputyear);
    $fyenddate = strtotime($fyEnd.'/'.$nextinputyear);

    $start = "start  financial year  ".$fyStart.'/'.$inputyear;
    $end = "end  financial year  ".$fyEnd.'/'.$nextinputyear;

    if($date <= $fyenddate && $date >= $fystartdate ){
        $fy = intval($inputyear);
    }else{
        $fy = intval(intval($inputyear) - 1);
    }

    return $fy;
    //return $fy."--".$start."---".$end;
    //return $fystartdate."----".$fyenddate."-----".$date;
}
function calculateFiscalYearForSingleDate($inputDate, $fyStart, $fyEnd)
{
    $date = strtotime($inputDate);
    $inputyear = strftime('%Y',$date); // Extract Year(%Y) from short time


    $nextinputyear = $inputyear+1;
    $reqadmdatearr = Array();
    $reqadmdatearr = explode("-",$inputDate);



    $fystartdate = strtotime($fyStart.'/'.$inputyear);
    $fyenddate = strtotime($fyEnd.'/'.$nextinputyear);

    $start = "start  financial year  ".$fyStart.'/'.$inputyear;
    $end = "end  financial year  ".$fyEnd.'/'.$nextinputyear;

    if($date <= $fyenddate && $date >= $fystartdate ){
        $fy = intval($inputyear);
    }else{
        $fy = intval(intval($inputyear) - 1);
    }

    $startfinacialdate = $fyStart."/".$fy;
    $endfinacialdate = $fyEnd."/".intval(intval($fy) + 1);

    $startfinacialdate = date("Y-m-d",strtotime($startfinacialdate));
    $endfinacialdate = date("Y-m-d",strtotime($endfinacialdate));
	return $startfinacialdate.','.$endfinacialdate;
}
function tanmays(){
    return "got u";
}
function calculateFiscalYearForSingleDateWC($inputDate, $fyStart, $fyEnd)
{
    $date = strtotime($inputDate);
    $inputyear = strftime('%Y',$date); // Extract Year(%Y) from short time


    $nextinputyear = $inputyear+1;
    $reqadmdatearr = Array();
    $reqadmdatearr = explode("-",$inputDate);



    $fystartdate = strtotime($fyStart.'/'.$inputyear);
    $fyenddate = strtotime($fyEnd.'/'.$nextinputyear);

    $start = "start  financial year  ".$fyStart.'/'.$inputyear;
    $end = "end  financial year  ".$fyEnd.'/'.$nextinputyear;

    if($date <= $fyenddate && $date >= $fystartdate ){
        $fy = intval($inputyear);
    }else{
        $fy = intval(intval($inputyear) - 1);
    }

    $startfinacialdate = $fyStart."/".$fy;
    $endfinacialdate = $fyEnd."/".intval(intval($fy) + 1);

    $startfinacialdate = date("Y-m-d",strtotime($startfinacialdate));
    $endfinacialdate = date("Y-m-d",strtotime($endfinacialdate));
    return $startfinacialdate.','.$endfinacialdate;
}
function firstDay($month = '', $year = ''){
	if(empty($month)){
		$month = date('m');
	}
	if(empty($year)){
		$year = date('Y');
	}
	$result = strtotime("{$year}-{$month}-01");
	return date('Y-m-d', $result);
}
function lastday($month = '', $year = ''){
	if(empty($month)){
		$month = date('m');
	}
	if(empty($year)){
		$year = date('Y');
	}
	$result = strtotime("{$year}-{$month}-01");
	$result = strtotime('-1 second', strtotime('+1 month', $result));
	return date('Y-m-d', $result);
}
 
//--------------------------------------------------
//Display a variable taking
//--------------------------------------------------
function putval($var)
{
       global $$var;
       $val = (isset($$var))?${$var}:"";
       echo htmlentities(stripslashes($val));
}

//---------------------------------------------------------------------------------
//date2mysql(date) -> Convert a date to mysql format for inserting into database.
//---------------------------------------------------------------------------------

function date2mysql($date)
{
       $date = explode('/',$date);      
       return($date[2].'-'.$date[1].'-'.$date[0]);
}

//---------------------------------------------------------------------------------
//mysql2date(date) -> Convert a mysql date into php format.
//---------------------------------------------------------------------------------
function mysql2date($date)
{
       return(date('d/m/Y', strtotime($date)));
}

//---------------------------------------------------------------------------------
//mysql2date(date) -> Convert a mysql date into php format.
//---------------------------------------------------------------------------------
function date_after_days($from_date,$days)
{
    $timeStamp = strtotime($from_date);
    $timeStamp += 24 * 60 * 60 * $days; 
    return date("Y-m-d", $timeStamp); 
}

function date_before_days($from_date,$days)
{
    $timeStamp = strtotime($from_date);
    $timeStamp -= 24 * 60 * 60 * $days; 
    return date("Y-m-d", $timeStamp); 
}
//---------------------------------------------------------------------------------
//generate unique id for e filing cases
//---------------------------------------------------------------------------------
function set_unique_id($office_id)
{
//here we generate a id for each efiling cases
//wheather it is online, depertment user or associate user
    global $link;
    $query = "INSERT INTO e_filing_unique_id SET";
    $query .= " office_id = ".$office_id;
    $query .= ", date = '".date('Y-m-d')."'";   
    mysqli_query($link,$query);
    return $office_id.'-'.date('d').date('m').date('y').'-'.mysqli_insert_id($link);
}
//---------------------------------------------------------------------------------
//Puts an email link to hide it from SpamBots
//---------------------------------------------------------------------------------
function put_email_link($email, $class = "")
{
        $mail_to = "mailto:$email";
        $str_mailto = ''; //Initialize
        $str_email = ''; //Initialize
        for($i = 0; $i < strlen($mail_to); $i++)
               $str_mailto.= '&#'.ord(substr($mail_to, $i, 1)).';';
        for($i = 0; $i < strlen($email); $i++)
               $str_email.= '&#'.ord(substr($email, $i, 1)).';';
        return('<a href="'.$str_mailto.'"'.(($class)?' class="'.$class.'"':'').'>'.$str_email.'</a>');
}

//-------------------------------------------------------------------
//function get_content() -> gets content of a page
//-------------------------------------------------------------------
function get_content($page_code)
{
       global $link;
       $query = "SELECT content FROM contents WHERE page_code = '$page_code'";
       extract(pg_fetch_assoc(pg_query($link,$query)));
       return $content;
}

//----------------------------------------------------------------------------
//function resize_image() -> Function that will resize image with cropping
//----------------------------------------------------------------------------
function resize_image($src_file, $dst_file, $dst_w, $dst_h, $crop = false)
{
       $src_img = imagecreatefromjpeg($src_file); //Create image from binary data supplied
       //Get the height and width of the source image
       $src_w = imagesx($src_img);
       $src_h = imagesy($src_img);
       //Compute the width & height ratios
       $ratio_w = $src_w / $dst_w;
       $ratio_h = $src_h / $dst_h;
       if($crop)
       {
               $ratio = min($ratio_w, $ratio_h);
               $x = (int)($src_w - ($dst_w * $ratio)) / 2;
               $y = (int)($src_h - ($dst_h * $ratio)) / 2;
               $out_img = imagecreatetruecolor($dst_w, $dst_h);
               imageantialias($out_img, true);
               imagecopyresampled($out_img, $src_img, 0, 0, $x, $y, $dst_w, $dst_h, $src_w - (2 * $x), $src_h - (2 * $y));
               //echo "Source width:".($src_w - (2 * $x))."\nSource Height:".($src_h - (2 * $y));
       }
       else
       {
               $ratio = max($ratio_w, $ratio_h);
               $dst_w = (int)($src_w / $ratio);
               $dst_h = (int)($src_h / $ratio);
               $out_img = imagecreatetruecolor($dst_w, $dst_h);
               imageantialias($out_img, true);
               imagecopyresampled($out_img, $src_img, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
       }
       imagejpeg($out_img, $dst_file, 100);
}


function generateUniqueString($length, $seeds)
{
    
    // Possible seeds
    $seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
    $seedings['numeric'] = '0123456789';
    $seedings['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
    $seedings['hexidec'] = '0123456789abcdef';
    
    // Choose seed
    if (isset($seedings[$seeds]))
    {
        $seeds = $seedings[$seeds];
    }
    
    // Seed generator
    list($usec, $sec) = explode(' ', microtime());
    $seed = (float) $sec + ((float) $usec * 100000);
    mt_srand($seed);
    
    // Generate
    $str = '';
    $seeds_count = strlen($seeds);
    for ($i = 0; $length > $i; $i++)
    {
        $str .= $seeds
        {
            mt_rand(0, $seeds_count - 1)
            };
    }
    
    return $str;
}
 //---------------------------------------------------------------------------------
//wrap_mail(string content) -> formats mail content with a designed html wrapper
//---------------------------------------------------------------------------------
function wrap_mail($content)
{
    ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo WEB_SERVER?>/styles.css" />
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" bgcolor="#FFFFFF">
  <tr>
    <td><img src="<?php echo WEB_SERVER?>/images/mail_header.gif" alt="" width="988" height="153" border="0" /></td>    
  </tr>
  <tr>
    <td colspan="2" class="blk1" style="padding:20px;"><?php echo $content?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><img src="<?php echo WEB_SERVER?>/images/mail_header.gif" alt="" width="987" height="47" border="0" /></td>
  </tr>
</table>
</body>
</html>
<?
    return ob_get_clean();
}
//---------------------------------------------------------------------------------
//send_mail(string content) -> send mail with html content.
//---------------------------------------------------------------------------------
function send_mail($from, $to, $subject, $template, $arr_vals, $cc = "", $bcc = "")
{
    //Read the template file
    $body = file_get_contents($template);

    //Substitute values
    foreach($arr_vals as $key => $val)
    {
        $body = str_replace("#$key#", $val, $body);
    }

    //Wrap it with mail design template
    $html_body = wrap_mail(stripslashes($body));
    $plain_body = trim(strip_tags($html_body));
    //echo $plain_body;
    //exit;
    //Create a unique boundary
    $boundary = '==SRP='.md5(uniqid(rand(), true));

    //Form the headers
    $headers = "MIME-Version: 1.0\n";
    $headers.= "Content-Type: multipart/alternative;\n";
    $headers.= "        boundary=\"$boundary\"\n";
    $headers.= "From: $from\n";
    $headers.= ($cc)?"Cc: $cc\n":"";
    $headers.= ($bcc)?"Bcc: $bcc\n":"";
    $headers.= "Reply-To: $from\n";
    $headers.= "Return-Path: $from\n";
    $headers.= "X-Mailer: PHP". phpversion()."\n";

    //Form the message body in multipart
    $msg = "This is a multi-part message in MIME format.\n\n";
    $msg.= "--$boundary\n";
    $msg.= "Content-Type: text/plain;\n";
    $msg.= "        charset=\"iso-8859-1\"\n";
    $msg.= "Content-Transfer-Encoding: 8bit\n\n";
    $msg.= $plain_body."\n\n";
    $msg.= "--$boundary\n";
    $msg.= "Content-Type: text/html;\n";
    $msg.= "        charset=\"iso-8859-1\"\n";
    $msg.= "Content-Transfer-Encoding: 8bit\n\n";
    $msg.= $html_body."\n";

    //Finally send the mail
    return(@mail($to, $subject, $msg, $headers));
}


//---------------------------------------------------------------------------------
//send_text_mail(string content) -> send mail with simple text.
//---------------------------------------------------------------------------------
function send_text_mail($from, $to, $subject, $template, $arr_vals, $cc = "", $bcc = "")
{

       //Read the template file
       $body = file_get_contents($template);
       //Substitute values
       foreach($arr_vals as $key => $val)
       {
               $body = str_replace("#$key#", $val, $body);
       }
       //Prepare headers
       $headers = "MIME-Version: 1.0\r\n";
       $headers.= "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n";
       $headers.= "From: $from\r\n";
       $headers.= "Reply-To: $from\r\n";
       $headers.= "X-Mailer: PHP". phpversion()."\r\n";
       if($cc != "")
               $headers.= "Cc: $cc";
       if($bcc != "")
               $headers.= "Bcc: $bcc";
       //Send the email
       return(mail($to, $subject, $body, $headers));
}

 //---------------------------------------------------------------------------------
////Checks for user's permission on a group & permission
//---------------------------------------------------------------------------------
function chk_perm($group, $permission = "")
{
    //Access page level linkection
    $query = "SELECT * FROM ".MSS.".pm_permission_groups PG";
    $query.= " INNER JOIN ".MSS.".pm_permissions P ON PG.group_id = P.group_id";
    $query.= " INNER JOIN ".MSS.".pm_user_permissions UP ON P.permission_id = UP.permission_id";
    $query.= " WHERE UP.power_id = '". $_SESSION['sess_power_id']."'";
    $query.= " AND UP.user_id =".$_SESSION['sess_user_id'];
    $query.= " AND PG.group_code = '$group'";
    if($permission)
        $query.= " AND P.permission_code = '$permission'";
    $res = pg_query($query);
    return @pg_num_rows($res);
}

//---------------------------------------------------------------------------------
//Checks for user's authority or redirects to unauthorized
//---------------------------------------------------------------------------------
function chk_auth($group, $permission = "")
{
    if(!chk_perm($group, $permission))
    {
        header("Location: ".WEB_SERVER."/index.php?page=27");
        exit(0);
    }
}

//-----------------------------------------
//set tracking
//-----------------------------------------
function track_action($page,$section_id,$action)
{
    //set the values
    
    
    //get the user id
    $user_id = $_SESSION["sess_user_id"];
    
    $query = "INSERT INTO tracker SET";
    $query .= " user_id = $user_id";
    $query .= ", page_id = $page";
    $query .= ", sec_id = $section_id ";
    $query .= ", action = '$action'";   
    $query .= ", date_time = NOW() ";   
    
    global $link;
    mysqli_query($link,$query);
}


//-------------------------------------------

//-------------------------------------------
function cur_page_url()
{
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on")
    {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80")
    {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    }
    else 
    {
         $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

//---------------------------------------------------------------------------------
//watermark_image(string source)
//Watermarks an image using ImageMagick composite tool
//---------------------------------------------------------------------------------
function watermark_image($source)
{
    list($width, $height, $type, $attr) = getimagesize($source);
    $cmd = "composite -gravity center images/watermark.png $source $source";
    exec($cmd, $output, $retval);
    return $retval;
}
//---------------------------------------------------------------------
//no records message
//----------------------------------------------------------------------
function no_record($name)
{
?>
    <div style="z-index: 10000000; position: relative; background-color: rgb(255,255,255);">
    <table cellspacing=0 cellpadding=5 width="60%" border=0>
        <tr>
          <td width="25%" rowspan=0><img height=60 src="./images/empty.jpg" width=61></td>
          <td nowrap width="100%"><span class=red2b>No <?php echo $name?> found ! </span></td>
        </tr>
    </table>
    </div>
<?
}

//-------------------------------------
//Track IP
//---------------------------------------
function ip_track()
{
    global $link;
    //get the ip first;
    $ip = $_SERVER['REMOTE_ADDR'];
    $query = "SELECT * FROM ip_track";
    $query .= " WHERE ip = '".$ip."'";
    $query .= " AND date = '".date('Y-m-d')."'";
    
    $res = pg_query($link,$query);
    pg_close($link);
    $link = conOpen();
    if(pg_num_rows($res) == 0)
    {
       $ip_insert = "INSERT INTO ip_track SET";
       $ip_insert .= " ip = '".$ip."',";
       $ip_insert .= " date = '".date('Y-m-d')."',";
       $ip_insert .= " date_added = NOW()";
       
       pg_query($link,$ip_insert);
       pg_close($link);
       $link = conOpen();       
       
    }
}
function getDBMaxValue($col_name, $table_name){
    $query = "Select MAX($col_name) as max_count from $table_name";
    $exec = pg_query($query);
    @extract(pg_fetch_assoc($exec));
    return $max_count;
}
//server side validation
//Deprecated
function isValidEmail__OLD($email)
{
    return preg_match("^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$", $email);
    //Old code : "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$"
}

//New COde
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function findextenson($filename) 
{ 
    $filename = strtolower($filename) ; 
    $exts = split("[/\\.]", $filename) ; 
    $n = count($exts)-1; 
    $exts = $exts[$n]; 
    //echo $exts;
    return $exts; 
}
function check_download($file_path)
{       
    $data = explode('/',$file_path);
    //print_r($data);
    //exit();
    $check_file = array_pop($data);
    $check_folder = array_pop($data);
    global $download_folder,$download_file;
    if(!in_array($check_folder,$download_folder) && !in_array(findextenson($check_file),$download_file))
    {
        session_destroy();
        header("location:index.php");
        exit;
    }   
}
//---------------------------------------------------------------------------------
//show_calendar(string content) -> Show the tasks according to the calendar
//---------------------------------------------------------------------------------
function show_calendar($month, $year, $view, $person)
{
    //determine width heights
    switch($view)
    {
        case "monthly":
            $tbl_width =  '970';
            $day_hdr_height =  '15';
            $cal_blank_width = '85';
            $day_cel_width = '135';
            $day_cel_height = '80';
            break;
        case "quarterly":
            $tbl_width =  '310';
            $day_hdr_height =  '15';
            $cal_blank_width = '40';
            $day_cel_width = '40';
            $day_cel_height = '40';
            break;
        case "halfyearly":
            $tbl_width =  '230';
            $day_hdr_height =  '';
            $cal_blank_width = '';
            $day_cel_width = '';
            $day_cel_height = '';
            break;
        case "yearly":
            $tbl_width =  '230';
            $day_hdr_height =  '15';
            $cal_blank_width = '';
            $day_cel_width = '';
            $day_cel_height = '';
            break;
    }

    //Access page level connection
    global $link;
    //Calendar parameters
    $arr_weekdays = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
    $first_date = mktime(0 ,0, 0, $month, 1, $year); //Timestamp of first date of month-year
    $num_days = date('t',$first_date); //Number of days in this month
    $date_info = getdate($first_date); //Get the date info associative array
    $month_name = $date_info['month']; //Month's full name
    $weekday = $date_info['wday']; //Index of weekday (0-6) of first day of month
    $prev_month = date("m", mktime(0, 0, 0, $month - 1, 1, $year));
    $prev_year = date("Y", mktime(0, 0, 0, $month - 1, 1, $year));
    $prev_month_name = date("F", mktime(0, 0, 0, $month - 1, 1, $year));
    $next_month = date("m", mktime(0, 0, 0, $month + 1, 1, $year));
    $next_year = date("Y", mktime(0, 0, 0, $month + 1, 1, $year));
    $next_month_name = date("F", mktime(0, 0, 0, $month + 1, 1, $year));
?>
<table border="0" cellspacing="1" cellpadding="2" class="calTable" width="<?php echo $tbl_width?>" height="150" <?if($view == 'monthly')?>>
  <tr>
    <?if($view == 'monthly'){?><td class="calPrev"><a href="<?php echo $_SERVER['PHP_SELF']?>?view=monthly&month=<?php echo $prev_month?>&year=<?php echo $prev_year?>" class="calNav">&laquo; <?php echo $prev_month_name?></td><?}?>
    <td colspan="<?php echo (isset($view) && $view == 'monthly')? 5: 7?>" class="calHeader"><a href="calendar.php?view=monthly&month=<?php echo $date_info['mon']?>&year=<?php echo $date_info['year']?>" class="lnblk2b"><?php echo $month_name?></a> - <?php echo $year?></td>
    <?if($view == 'monthly'){?><td class="calNext"><a href="<?php echo $_SERVER['PHP_SELF']?>?view=monthly&month=<?php echo $next_month?>&year=<?php echo $next_year?>" class="calNav"><?php echo $next_month_name?> &raquo;</td><?}?>
  </tr>
  <tr>
<?
    foreach($arr_weekdays as $day)
    {
?>
    <td class="dayHeader" height="<?php echo $day_hdr_height?>"><?php echo $day?></td>
<?
    }
?>
  </tr>
  <tr>
<?
    // Create the rest of the calendar
    $curr_day = 1; // Initiate the day counter, starting with the 1st.
    //Put blank cells till first weekday
    if ($weekday > 0)
    {
        for($i = 0; $i < $weekday; $i++)
        {
?>
    <td class="calBlank" width="<?php echo $cal_blank_width?>">&nbsp;</td>
<?
        }
    }
    while ($curr_day <= $num_days)
    {
        //If seventh column (Saturday) reached, start a new row.
        if ($weekday == 7)
        {
            $weekday = 0;
?>
  </tr>
  <tr>
<?
        }
        //Get the tasks for this store & this month/year
        $task_date = "$year-$month-".sprintf("%02d", $curr_day);
        //echo $task_date;
        $query = "SELECT * FROM tasks WHERE task_date = '$task_date'";
        if(isset($person) && $person != "")
            $query.= " AND assigned_to = '$person'";
        $res = mysql_query($query, $conn);
?>
    <td width="<?php echo $day_cel_width?>" height="<?php echo $day_cel_height?>" style="padding:1px;margin:1px;" class="dayCell" id="day_cell" onmouseover="this.className='dayCellOver'" onmouseout="this.className='dayCell'"><a href="calendar.php?view=weekly&day=<?php echo $curr_day?>&month=<?php echo $date_info['mon']?>&year=<?php echo $date_info['year']?>" class="lnblk1"><?php echo $curr_day?></a>
<?
        if(mysql_num_rows($res) != 0)
        {
            if($view == 'monthly')
            {

?>
    <br />
    <ul style="padding:2px;margin:2px;list-style-type:none;">
<?
                while($row = mysql_fetch_assoc($res))
                {
                    if($row['description'] != "")
                        $tooltip = 'Duration: '.$row['duration'].'<br />'.'Assigned To: '.$row['assigned_to'].'<br />'.'Status: '.$row['status'].'<br /><br />'.addslashes(substr(str_replace("\r", '', str_replace("\n", ' ', $row['description'])), 0, 120)).'...';
                    else
                        $tooltip = 'Duration: '.$row['duration'].'<br />'.'Assigned To: '.$row['assigned_to'].'<br />'.'Status: '.$row['status'];

                    if($row['type'] == 'MEETING')
                    {
                        if($view == 'monthly')
                            $image = 'images/meeting_icon.gif';
                        else
                            $image = 'images/red_star.gif';
                        $alt = "Meeting";
                    }
                    elseif($row['type'] == 'CALL')
                    {
                        if($view == 'monthly')
                            $image = 'images/call_icon.gif';
                        else
                            $image = 'images/red_star.gif';
                        $alt = "Phone Call";
                    }
                    elseif($row['type'] == 'FOLLOWUP')
                    {
                        if($view == 'monthly')
                            $image = 'images/follow_up_icon.gif';
                        else
                            $image = 'images/red_star.gif';
                        $alt = "Follow Up";
                    }
                    else
                    {
                        if($view == 'monthly')
                            $image = 'images/task_icon.gif';
                        else
                            $image = 'images/red_star.gif';
                        $alt = "Other Task";
                    }


                    if($row['status'] == 'Cancelled')
                    {
                        $class = 'postTitle';
                    }
                    elseif($row['status'] == 'Completed')
                    {
                        $class = 'heldTitle';
                    }
                    else
                    {
                        $class = 'title';
                    }
?>
      <li style="margin-left:2px;padding-left:2px;"><img src="<?php echo $image?>" border="0" align="absmiddle" alt="<?php echo $alt?>" title="<?php echo $alt?>" /><br />
      <a href="task_detail.php?id=<?php echo $row['task_id']?>"
      class="<?php echo $class?>" onmouseover="showTip('<?php echo $tooltip?>')" onmouseout="hideTip()"><?php echo $row['subject']?></a></li>
<?
                }
?>
    </ul>
<?
            }
            else
            {
?>
    <a href="calendar.php?view=daily&day=<?php echo $curr_day?>&month=<?php echo $date_info['mon']?>&year=<?php echo $date_info['year']?>"><img src="images/red_star.gif" border="0" alt="Daily View" title="daily View" /></a>
<?
            }
        }
?>
    </td>
<?
        // Increment counters
        $curr_day++;
        $weekday++;
    }

    // Complete the row of the last week in month, if necessary
    if ($weekday != 7)
    {
        $last_days = 7 - $weekday;
        for($i = 0; $i < $last_days; $i++)
        {
?>
    <td class="calBlank">&nbsp;</td>
<?
        }
    }
?>
</table>
<?
}


function DateSelector($inName, $useDate=0,$selmonth,$selyear) 
    { 
        /* create array so we can name months */ 
        $monthName = ARRAY(1=> "January", "February", "March", 
            "April", "May", "June", "July", "August", 
            "September", "October", "November", "December"); 
 
        /* if date invalid or not supplied, use current time */ 
        IF($useDate == 0) 
        { 
            $useDate = TIME(); 
        } 
 
        /* make month selector */ 
        echo '<SELECT id="'.$inName.'Month"
         NAME="'.$inName.'Month">\n'; 
        FOR($currentMonth = 1; $currentMonth <= 12; $currentMonth++) 
        { 
            echo "<OPTION VALUE=\""; 
            echo INTVAL($currentMonth); 
            echo "\"";
	    if($selmonth != ''){
		IF(INTVAL($selmonth)==$currentMonth) 
		{ 
		    echo " SELECTED"; 
		}		
	    }else{
		IF(INTVAL(DATE( "m", $useDate))==$currentMonth) 
		{ 
		    echo " SELECTED"; 
		}		
	    }	    
            echo ">" . $monthName[$currentMonth] . "\n"; 
        } 
        echo "</SELECT>"; 
 
        /* make day selector */
	/*
        echo "<SELECT NAME=" . $inName . "Day>\n"; 
        FOR($currentDay=1; $currentDay <= 31; $currentDay++) 
        { 
            echo "<OPTION VALUE=\"$currentDay\""; 
            IF(INTVAL(DATE( "d", $useDate))==$currentDay) 
            { 
                echo " SELECTED"; 
            } 
            echo ">$currentDay\n"; 
        } 
        echo "</SELECT>";
        */
 
        /* make year selector */ 
        echo '<SELECT id="'.$inName.'Year" NAME="'.$inName.'Year">\n'; 
        $startYear = DATE( "Y", $useDate); 
        FOR($currentYear = $startYear - 5; $currentYear <= $startYear+5;$currentYear++) 
        { 
            echo "<OPTION VALUE=\"$currentYear\"";
	    if($selyear != ''){
		IF(INTVAL($selyear)==$currentYear) 
		{ 
		    echo " SELECTED"; 
		}		
	    }else{
		IF(DATE( "Y", $useDate)==$currentYear) 
		{ 
		    echo " SELECTED"; 
		}
	    }
            echo ">$currentYear\n"; 
        } 
        echo "</SELECT>"; 
 
    } 

function get_parentname($id)
{

        $getca="select item_name from pm_component where item_id IN (".$id.")";
        $getqry=pg_query($getca);
        if(pg_num_rows($getqry)>0)
        {
            $pc=pg_fetch_assoc($getqry);
            $pcn=$pc['item_name'];
        }
    return $pcn;
}

function IsParentAvailable($id)
{

        $getca="select * from pm_component where parent_id =".$id."";
		//echo  $getca;
		//exit;
        $getqry=pg_query($getca);
		if(pg_num_rows($getqry)>0)
		{
		
			return 1;
		}
		else
		{
			return 0;
		}
}
function get_itemDetail($id)
{

        $getca="select * from pm_component where item_id =".$id."";
        $getqry=pg_query($getca);
        if(pg_num_rows($getqry)>0)
        {
            return pg_fetch_assoc($getqry);
   		}	
    return 0;
}
function managesubstring($string)
{
//$WidgetText = substr($string, 0, strrpos(substr($string, 0, 50), '........'));
$WidgetText=substr($string, 0, strpos(wordwrap($string, 30), "\n"));
var_dump($WidgetText);
return $WidgetTex;
}
?>