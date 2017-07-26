<?
require_once("../common/globali.php");

$term 		= $_REQUEST['query'];
$query_Work_lising_sql="SELECT ";
$query_Work_lising_sql .= " workms.work_name,workms.work_id FROM pm_works workms ";
$query_Work_lising_sql .= " INNER JOIN pm_work_allotment ALLOT ON ALLOT.work_id = workms.work_id ";
$query_Work_lising_sql .= " INNER JOIN pm_contractor_details CONDET ON CONDET.con_work_id = workms.work_id ";
$query_Work_lising_sql.= " WHERE workms.work_id != 0";
$query_Work_lising_sql.= " AND ALLOT.work_id != 0";
if($_SESSION["sess_power_id"] == 'CE')
	$query_Work_lising_sql.= " AND workms.wings_id = ".$_SESSION["sess_wings_id"]."  ";
if($_SESSION["sess_power_id"] == 'SE')
	$query_Work_lising_sql.= " AND ALLOT.wa_circle_id = ".$_SESSION["session_circle_id"]."  ";
if($_SESSION["sess_power_id"] == 'EE')
	$query_Work_lising_sql.= " AND ALLOT.wa_division_id = ".$_SESSION["session_division_id"]."  ";
if($_SESSION["sess_power_id"] == 'AE')
	$query_Work_lising_sql.= " AND ALLOT.wa_sub_division_id = ".$_SESSION["session_sub_division_id"]."  ";
if($_SESSION["sess_power_id"] == 'JE')
	$query_Work_lising_sql.= " AND ALLOT.wa_section_id = ".$_SESSION["session_section_id"]." ";
$query_Work_lising_sql.=" AND workms.work_name LIKE '%$term%' LIMIT 10";
$query_Work_lising_res = pg_query($query_Work_lising_sql);
$query_Work_lising_cnt = pg_num_rows($query_Work_lising_res);

$new_arr = array();
if($query_Work_lising_cnt > 0){
        while($query_Work_lising_row = pg_fetch_assoc($query_Work_lising_res)){
                $workid = $query_Work_lising_row['work_id'];
                $workname = $query_Work_lising_row['work_name'];
                $new_arr[] = array(
                                    'id'=>$workid,
                                    'value'=>$workname                                   
                                   );
                
        }   
}
print json_encode($new_arr);
?>
