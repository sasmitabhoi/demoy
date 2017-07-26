<script language="javascript" type="text/javascript">
	jQuery19(document).ready(function(){
			var urlrefno1 = sitePath+"/controller/getmagicWorkName.php";
            window.magicSuggObjrefno = jQuery19('#work_id').magicSuggest({
                width: 1000,
                displayField: 'value',                
                data: urlrefno1,
                hideTrigger: true,
                allowFreeEntries: false,
                maxSelection: 1,
                typeDelay:200,
                selectionCls: 'customSelection',
                emptyText: 'Search Work Here',
                emptyTextCls: 'customEmptyTextCls',
                noSuggestionText: "Invalid Work Name",
                infoMsgCls: 'customMsgCls',
            });   
	});    
    
function getSubdiv(divid)
{
		
		if(document.getElementById('sub_division_id'))
		{
			var ajax = new AJAX();
			var arrParam = new Array();
			arrParam['divid'] = divid;
			arrParam['page'] = 'mu';
			ajax.getRequest('./controller/get_sub_division.php', arrParam, responseSubdivList);	
		}
	

}
function responseSubdivList(retVaL)
{
	document.getElementById('SubdivList').innerHTML = retVaL;
	
	resetSecData = '<select id="section_id" name="section_id" disabled="disabled">';
	resetSecData += '<option>--select section--</option>'; 
	resetSecData += '</select>';
	
	if(document.getElementById('sectiondivList'))
	{
		document.getElementById('sectiondivList').innerHTML = resetSecData;
	}
}

function getsectionname(subdivid)
{
	
		if(document.getElementById('section_id'))
		{
			var ajax = new AJAX();
			var arrParam = new Array();
			arrParam['subdivid'] = subdivid;
			arrParam['page'] = 'mu';
			ajax.getRequest('./controller/get_section_name.php', arrParam, responseSectionList);	
		}
	

}

function workStatushide()
{
        var val=document.getElementById("work_completion").value;
            document.getElementById("work_status").value='';
	    document.getElementById("work_status").disabled=true;
	    if(val==''){document.getElementById("work_status").disabled=false;}
}
function responseSectionList(retVaL)
{
	document.getElementById('sectiondivList').innerHTML = retVaL;
}
</script>



<input type="hidden" name="work_status2" id="work_status2" value=""/>
					<tr>
							<td>
								<table width="100%" cellspacing="2" cellpadding="4" style="margin-bottom:20px;"  border="0" align="left" class="searchtable">
									<tr bgcolor="">
										<td align="left" colspan="5">
											<table cellpadding="2" cellspacing="1" border="0" width="100%">
																							
                                             <tr style="height:100px;">
													<td align="left" class="blk1">Work Namesss :</td>
													<td align="left" class="blk1" colspan="3">
                                                          <input type="text" name="work_id" id="work_id"  />
                                                    </td>
                                               
                                             </tr>                                              
                                             <tr>
													<td align="left" class="blk1">Wing :</td>
													<td align="left" class="blk1"  >														
														<select name="wings_id" id="wings_id" class="tbox">
<?php
if($_SESSION["sess_power_id"] != 'CE'){
?>															
															<option value="0">--Select--</option>
<?php }
?>
															
<?php
    $wing_sql = "SELECT * FROM pm_wings ";
	if($_SESSION["sess_power_id"] == 'CE'){
		$wing_sql.= " WHERE wings_id = ".$_SESSION["sess_wings_id"]." ";
	}
    $wing_res = pg_query($wing_sql);    
    if(@pg_num_rows($wing_res) != 0)
    {
        while($row_wing = pg_fetch_assoc($wing_res))
        {
        	if(isset($_SESSION["wings_id"]))
        	{
        		?>
        		<option value="<?php echo $row_wing['wings_id']?>" <?php echo ($_SESSION["wings_id"] == $row_wing['wings_id'])? 'selected="selected"': '' ?>><?php echo $row_wing['wings_name']?></option>
        		<?php

        	}
        	else
        	{
?>
															 <option value="<?php echo $row_wing['wings_id']?>" <?php echo ($wings_id == $row_wing['wings_id'])? 'selected="selected"': '' ?>><?php echo $row_wing['wings_name']?></option>
<?php
			}
	}
     }	
?>
														</select>
													</td>
																	
													<td align="left" class="blk2">Scheme  :</td>
													<td align="left">
														<input type="hidden" id="source_fund_id_hide" value="Source of Fund Name" />
														<select name="source_fund_id" id="source_fund_id" class="tbox" >
														   <option value="0">--All Scheme--</option>
<?php
$query_fund = "select * from proc_select_fund()";
$res_fund = pg_query($query_fund);
if(@pg_num_rows($res_fund) != 0)
{
    while($row_fund = pg_fetch_assoc($res_fund))
    {
?>
                                            <option value="<?php echo $row_fund['fund_id']?>" <?if($row_fund['fund_id'] == $_SESSION["source_fund_id"]){?>selected = "selected" <?}?> ><?php echo $row_fund['fund_name']."-".$row_fund['fund_code']?></option>
<?php
    }
}
?>
													</select>
												  </td>													
												</tr>                                                                                           
												<tr>
													<td align="left" class="blk1">Circle :</td>
													<td align="left" class="blk1"  >
														<input type="hidden" id="circle_id_hide" value="Circle" />
														<select name="circle_id" id="circle_id" class="tbox" onChange="getDivisionSearch(this.value);">
<?
echo "Session--".$_SESSION["sess_power_id"];
if($_SESSION["sess_power_id"] == 'EIC' || $_SESSION["sess_power_id"] == 'CE')
{
?>
                                <option value="0">--Select--</option>
<?
}
else
{
    $circle_name = "";
    $cid = 0;
    //Get circle name from DB

    
    $query_user_cid = "SELECT district_id AS DISTID, division_id AS DIVID, circle_id AS CID FROM pm_auth_user";
    $query_user_cid.= " WHERE user_id = ".$_SESSION["sess_user_id"];
    $res_user_cid = pg_query($query_user_cid);
    if(@pg_num_rows($res_user_cid) != 0)
        @extract(pg_fetch_assoc($res_user_cid));
}
    //Get circle name from DB
    
    $query = "SELECT * FROM circle";
    if($cid != 0)
        $query.= " WHERE circle_id = ".$cid;
    $query.= " ORDER BY circle_name";
    $res_circle = pg_query($query);
    if(@pg_num_rows($res_circle) != 0)
    {
        while($row_circle = pg_fetch_assoc($res_circle))
        {
?>
                                <option value="<?php echo $row_circle['circle_id']?>" <?php echo ($_SESSION["circle_id"] == $row_circle['circle_id'])? 'selected="selected"': '' ?>><?php echo $row_circle['circle_name']?></option>
<?
        }
    }
?>
                            </select>
                        </td>
                        <td align="left" class="blk1" >Division :</td>
                        <td align="left" class="blk1">
                        <div id="division_list">
                        <input type="hidden" id="division_id_hide" value="Division" />
<?

if($_SESSION["sess_power_id"] == 'EIC' || $_SESSION["sess_power_id"] == 'CE')
{
    if($submit == 'Show')
    {
?>
                            <select name="division_id" class="tbox"  id="division_id" class="tbox" >
                                <option value="0">--Select--</option>
<?
        if($circle_id != 0)
        {
            $query = "SELECT * FROM division";
            $query .= " WHERE circle_id = $circle_id";

            $res = @pg_query($query);
            if(@pg_num_rows($res)!= 0)
            {
                while($row = pg_fetch_assoc($res))
                {
?>
                                <option value="<?php echo $row["division_id"]?>" <?php echo ($row['division_id'] == $_SESSION["division_id"])? 'selected="selected"': '' ?>>
<? 
                     $sub_query = "SELECT division_name FROM division WHERE division_id = ".$row['division_id'];
                     @extract(pg_fetch_assoc(pg_query($sub_query)));  
                     echo $division_name;
?>
                                </option>
<?
                }
            }
        }
?>
                            </select>
<?
    }
    else
    {
?>         
                            <select id="division_id" name="division_id" disabled="disabled" class="tbox" >
                                <option value="0">--Select--</option>
                            </select>
<?
    }
}
else
{
    //Get all Division name from database
    if($cid != 0 )
    {
        $query = "SELECT * FROM division";
        if($_SESSION["sess_power_id"] == 'SE')
            $query.= " WHERE circle_id = ".$cid;
        else
            $query.= " WHERE division_id = ".$divid;
    }
    $query.= " ORDER BY division_name ";
    $res = @pg_query($query);
    if(@pg_num_rows($res)!= 0)
    {
?>
                            <select name="division_id" class="tbox"  id="division_id"  style="width:200px" OnChange="getDistrictSearch(this.value);">
<?
if($_SESSION["sess_power_id"] == 'EIC' || $_SESSION["sess_power_id"] == 'CE' || $_SESSION["sess_power_id"] == 'SE')
{
?> 
                                <option value="0">--Select--</option>
<?
}
        while($row = pg_fetch_assoc($res))
        {
?>
                                <option value="<?php echo $row["division_id"]?>" <?php echo ($row['division_id'] == $_SESSION["division_id"])? 'selected="selected"': '' ?>>
<? 
              
             $sub_query = "SELECT division_name FROM division WHERE division_id = ".$row['division_id'];
             @extract(pg_fetch_assoc(pg_query($sub_query)));  
             echo $division_name;
?>
                                </option>
<?
        }
    }
?>
                            </select>
<?
}
?>            
                            </div>
                        </td>
					</tr>
					<tr>
						<td class="blk2">Sub Division : </td>
						<td>
							<div id="SubdivList">
<?
if($submit == 'Show')
{
		if($division_id !=0)
		{
						$get_sub_div_sql = "SELECT * FROM subdivision WHERE division_id = ".$division_id." ";
						if($_SESSION["sess_power_id"] == 'AE')
						{		
							$get_sub_div_sql .= " AND sub_division_id = ".$_SESSION["session_sub_division_id"]." ";
						}	
						if($_SESSION["sess_power_id"] == 'JE')
						{		
							$get_sub_div_sql .= " AND sub_division_id = ".$_SESSION["session_sub_division_id"]." ";
						}						
						$get_sub_div_res = pg_query($get_sub_div_sql);
				if(@pg_num_rows($get_sub_div_res)!= 0)
				{
?>
							<select name="sub_division_id" class="tbox"  id="sub_division_id"  style="width:200px" onchange="javascript : getsectionname(this.value);">
								
<?
if($_SESSION["sess_power_id"] != 'JE' && $_SESSION["sess_power_id"] != 'AE')
{
?>							
							<option value="0">--Select--</option>
<?
}
?>
<?
						while($get_sub_div_row = pg_fetch_assoc($get_sub_div_res))
						{
    
?>
								 <option value="<?php echo $get_sub_div_row["sub_division_id"]?>" <?php echo ($get_sub_div_row["sub_division_id"] == $_SESSION["sub_division_id"])? 'selected="selected"':'' ?>><?php echo $get_sub_div_row['sub_division_name']?></option>
<?

						}
				}
   
?>
						        </select>
<?
		}
		else
		{
?>	
						       <select name="sub_division_id"  id="sub_division_id"   disabled="disabled">
									<option value="0">--Select Sub Division--</option>		
							</select>
<?
		}
}
else
{
		$get_sub_div_sql = "SELECT * FROM subdivision WHERE division_id = ".$_SESSION["session_division_id"]." ";
		if($_SESSION["sess_power_id"] == 'AE')
		{		
			$get_sub_div_sql .= " AND sub_division_id = ".$_SESSION["session_sub_division_id"]." ";
		}
		if($_SESSION["sess_power_id"] == 'JE')
		{		
			$get_sub_div_sql .= " AND sub_division_id = ".$_SESSION["session_sub_division_id"]." ";
		}		
		//echo $get_sub_div_sql;
		$get_sub_div_res = pg_query($get_sub_div_sql);		
		if(@pg_num_rows($get_sub_div_res)!= 0)
		{
?>

					<select name="sub_division_id" class="tbox"  id="sub_division_id"  style="width:200px" onchange="javascript : getsectionname(this.value);">
<?
if($_SESSION["sess_power_id"] != 'JE' && $_SESSION["sess_power_id"] != 'AE')
{
?>							
							<option value="0">--Select--</option>
<?
}
?>						
<?
				while($get_sub_div_row = pg_fetch_assoc($get_sub_div_res))
				{

?>
						 <option value="<?php echo $get_sub_div_row["sub_division_id"]?>" <?php echo ($get_sub_div_row["sub_division_id"] == $_SESSION["sub_division_id"])? 'selected="selected"':'' ?>><?php echo $get_sub_div_row['sub_division_name']?></option>
<?

				}
?>
					 </select>		
<?
		}
		else
		{
?>	
						       <select name="sub_division_id"  id="sub_division_id"   disabled="disabled">
									<option value="0">--Select Sub Division--</option>		
							</select>
<?
		}


}
?>
							</div>
						</td>
						<td class="blk2">Section : </td>
						<td>
							<div id="sectiondivList">
							
<?															
if($submit == 'Show')
{
		
		if($sub_division_id !=0)
		{		
				$get_section_sql = "SELECT * FROM section WHERE sub_division_id = ".$sub_division_id." ";
				if($_SESSION["sess_power_id"] == 'JE')
				{		
					$get_section_sql .= " AND section_id = ".$_SESSION["session_section_id"]." ";
				}				
				$get_section_res = pg_query($get_section_sql);
				if(@pg_num_rows($get_section_res)!= 0)
				{
?>
						<select name="section_id" class="tbox"  id="section_id"  style="width:200px">
<?
if($_SESSION["sess_power_id"] != 'JE')
{
?>							
							<option value="0">--Select--</option>
<?
}
?>							
<?
								while($get_section_row = pg_fetch_assoc($get_section_res))
								{
    
?>
										<option value="<?php echo $get_section_row["section_id"]?>" <?php echo ($get_section_row["section_id"] == $section_id)? 'selected="selected"':'' ?> ><?php echo $get_section_row['section_name']?></option>
<?

								}
				}
   
?>
						</select>							
<?
		}
		else
		{
?>
							
							
							
								<select name="section_id"  id="section_id"   disabled="disabled">
									<option value="0">--Select Section--</option>		
								</select>
								
<?
		}
}
else
{
	
		$get_section_sql = "SELECT * FROM section WHERE sub_division_id = ".$_SESSION["session_sub_division_id"]." ";
		if($_SESSION["sess_power_id"] == 'JE')
		{		
			$get_section_sql .= " AND section_id = ".$_SESSION["session_section_id"]." ";
		}		
		$get_section_res = pg_query($get_section_sql);
		if(@pg_num_rows($get_section_res)!= 0)
		{
?>
				<select name="section_id" class="tbox"  id="section_id"  style="width:200px">
<?
if($_SESSION["sess_power_id"] != 'JE')
{
?>				
								<option value="0">--Select--</option>
<?
}
?>								
<?
						while($get_section_row = pg_fetch_assoc($get_section_res))
						{

?>
								<option value="<?php echo $get_section_row["section_id"]?>" <?php echo ($get_section_row["section_id"] == $_SESSION["section_id"])? 'selected="selected"':'' ?> ><?php echo $get_section_row['section_name']?></option>
<?

						}
		

?>
				</select>			
<?
		}
		else
		{
?>	
				<select name="section_id"  id="section_id"   disabled="disabled">
					<option value="0">--Select Section--</option>		
				</select>
<?
		}


}
?>								
							</div>
						</td>
					</tr>					
					
					
					
					
					
					<tr>
						


						<td style="font-size:12px;">Work Status</td>
						<td>
							<select name="work_status" id="work_status" style="height:34px;">
						<option value="">Select</option>
						<option value="1" <?php if(isset($_SESSION['work_status'])){if($_SESSION['work_status']==1){echo 'selected="selected"';}} else{echo 'selected="selected"';}?>>Ongoing Works</option>
						<option value="2" <?php if(isset($_SESSION['work_status'])){if($_SESSION['work_status']==2){echo 'selected="selected"';}}?>>Completion Work</option>

 </select>


						</td>
                     <td colspan="2">&nbsp;</td>
						<!--<td style="font-size:12px;">Work Completed</td>
						<td><select name="work_completion" id="work_completion" style="height:34px;" onchange="workStatushide()">
						<option value="">Select</option>
						<option value="1">Physical Completed</option>
						<option value="2">Financial Completed</option>

 </select>

						</td>-->
								</tr>
                    
								<tr>
										
								</tr>
							</table>										
										
										
										
										</td>
									</tr>

									<tr>
										<td align="center" colspan="4">
											<input type="submit" name="submit" value="Show" class="btn" onClick="javascript: getworklisting();" />											
										</td>
									</tr>
								</table>
							</td>
						</tr>

						