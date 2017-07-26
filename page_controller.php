<?php
if(isset($_REQUEST['page'])){
    $page = $_REQUEST['page'];
}else{
    $page='';
}

switch($page)
{
    case '':
        $page_title = "WELCOME TO ONLINE PROJECT MONITORING SYSTEM";
        include('./controller/login.php'); break;

    case 1:
        $page_title = "My Home";
        include('./controller/admin_home.php'); break;

    case 2:
        $page_title = "Manage User";
        include('./controller/manage_user.php'); break;

    case 3:
        $page_title = "Manage Work Creation";
        include('./controller/manage_work_creation.php'); break;

    case 4:
        $page_title = "Work Allotment";
        include('./controller/manage_work_allotment.php'); break;     

    case 5:
        $page_title = "Monthly Target Expenditure";
        include('./controller/monthly_proposed_expenditure.php'); break;

    case 6:
        $page_title = " Monthly Updation";
        include('./controller/accepted_work_allotment_lists.php'); break;  

    case 7:
        $page_title = "My Profile";
        include('./controller/my_profile.php'); break;

    case 8:
        $page_title = "Update Work Allotment";
        include('./controller/update_work_allotment.php'); break;          

    case 9:
        $page_title = "Monthly Expenditure Report(Division Wise)";
        include('./controller/monthly_expenditure_report.php'); break;          

    case 10:
        $page_title = "Master Report Department Wise";
        include('./controller/master_report_dept_wise.php'); break;

    case 11:
        $page_title = "";
        include('./controller/logout.php'); break; 

    case 12:
        $page_title = "Year Wise Work Allotment Report";
        include('./controller/master_report_year_wise.php'); break;    

    case 13:
        $page_title = "Work Completed Report ";
        include('./controller/work_complete_report.php'); break; 

    case 14:
        $page_title = "Monthly Financial Report ";
        include('./controller/monthly_report.php'); break;     

    case 15:
        $page_title = "Work Closed Report";
        include('./controller/work_close_report.php'); break;    

    case 16:
        $page_title = "Work In Progress Physical Report";
        include('./controller/work_in_progress_report.php'); break;    

    case 17:
        $page_title = "Work With Delay Report";
        include('./controller/work_with_delay_report.php'); break;

    case 18:
        $page_title = "Work Closure Report";
        include('./controller/work_closure_report.php'); break;    

    case 19:
        $page_title = "Less Expenditure Report";
        include('./controller/less_expenditure_report.php'); break; 

    case 20:
        $page_title = "Monthly Target Expenditure Plan Report ";
        include('./controller/monthly_expenditure_plan_report.php'); break;         

    case 21:
        $page_title = "Monthly Phy & Financial Progress Report";
        include('./controller/physical_financial_report.php'); break;

    case 22:
        $page_title = "Change Password";
        include('./controller/change_password.php'); break; 

    case 23:
        $page_title = "Add Power to User";
        include('./controller/manage_power.php'); break;

    case 24:
        $page_title = "Manage Category";
        include('./controller/manage_category.php'); break; 

    case 25:
        $page_title = "Manage Office";
        include('./controller/manage_office.php'); break;  

    case 26:
        $page_title = "Manage Scheme  ";
        include('./controller/manage_fund.php'); break;   

    case 27:
        $page_title = "Manage Demand";
        include('./controller/manage_demand.php'); break;

    case 28:
        $page_title = "Manage Major Head";
        include('./controller/manage_major_head.php'); break;   

    case 29:
        $page_title = "Manage Sub Head";
        include('./controller/manage_sub_head.php'); break;

    case 30:
        $page_title = "Manage Minor Head";
        include('./controller/manage_minor_head.php'); break;

    case 31:
        $page_title = "Manage Sub Sub Head";
        include('./controller/manage_sub_sub_head.php'); break; 

    case 32:
        $page_title = "Manage Sub Major Head";
        include('./controller/manage_sub_minor_head.php'); break;

    case 33:
        $page_title = "Manage Constituency";
        include('./controller/manage_constituency.php'); break;

    case 34:
        $page_title = "Update Work Allotment";
        include('./controller/update_work_allotment_ee.php'); break;

    case 35:
        $page_title = "View Work Detail";
        include('./controller/details_work_information.php'); break;                

    case 36:
        $page_title = "Monthly Actual Expenditure";
        include('./controller/monthly_actual_expenditure.php'); break;

    case 37:
        $page_title = "New Work Allotment List";
        include('./controller/new_work_allotment.php'); break;

    case 38:
        $page_title = "Download File";
        include('./controller/download_allotment_file.php'); break;

    case 39:
        $page_title = "Show Work Details";
        include('./controller/show_work_details.php'); break;       

    case 40:
        $page_title = "Work Allotment Details";
        include('./controller/allotment_work_details.php'); break;       

    case 41:
        $page_title = "Work Allotment Acceptance Status(Division Wise)";
        include('./controller/work_allotment_lists.php'); break; 

    case 42:
        $page_title = "Request For Work Closure";
        include('./controller/work_closure.php'); break;         

    case 43:
        $page_title = "Work Completion";
        include('./controller/work_closure_ee.php'); break;   

    case 44:
        $page_title = "Download";
        include('./controller/download_file.php'); break;

    case 45:
        $page_title = "Work Allotment List";
        include('./controller/work_allotment_listing.php'); break; 

    case 46:
        $page_title = "Work Creation List";
        include('./controller/work_listing_detail.php'); break;    

    case 47:
        $page_title = "Manage Physical Work Progress Status";
        include('./controller/manage_physical_work_progress_status.php'); break; 

    case 48:
        $page_title = "Department Wise No Of Works";
        include('./controller/graph_department_wise_works.php'); break; 

    case 49:
        $page_title = "Timeline And Physical Progress";
        include('./controller/timeline_physical_progress.php'); break;   

    case 50:
        $page_title = "Timeline And Financial Progress";
        include('./controller/timeline_financial_progress.php'); break;            

    case 51:
        $page_title = "Work Wise Status";
        include('./controller/work_wise_status.php'); break;            

    case 52:
        $page_title = "Monthly Work Progress Graph";
        include('./controller/bar_graph.php'); break;  

    case 53:
        $page_title = "Forward Work Allotment";
        include('./controller/forward_work_allotment.php'); break;          

//    case 54:
//        $page_title = "Expenditure Report";
//        include('./controller/expenditure_graph.php'); break;

    case 55:
        $page_title = "Target /Actual Expenditure Graph";
        include('./controller/proposed_actual_graph.php'); break; 

    case 56:
        $page_title = "Execution for Tender";
        include('./controller/accepted_new_work_allotment.php'); break; 

    case 57:
        $page_title = "Monthly Expenditure Report";
        include('./controller/monthly_exp_plan.php'); break; 

    case 58:
        $page_title = "Quaterly Expenditure Report";
        include('./controller/quarterly_exp_plan.php'); break; 

    case 59:
        $page_title = "Work Progress Monthly Updation";
        include('./controller/global_work_allotment_updation.php'); break;

    case 60:
        $page_title = "Monthly Work allotment Updation";
        include('./controller/global_monthly_update_allotment.php'); break;  

    case 61:
        $page_title = "Divison Wise Work Statistics";
        include('./controller/division_wise_report.php'); break;   

    case 62:
        $page_title = "Monthly Report Print";
        include('./controller/monthly_report_print.php'); break;     

    case 63:
        $page_title = "Work Closure Report Print";
        include('./controller/work_closure_report_print.php'); break; 

    case 64:
        $page_title = "Less Expenditure Report Print";
        include('./controller/less_expenditure_report_print.php'); break;     

    case 65:
        $page_title = "Monthly Expenditure Plan Report Print";
        include('./controller/monthly_expenditure_plan_report_print.php'); break; 

    case 66:
        $page_title = "";
        include('./controller/common_excel_report.php'); break;   

    case 67:
        $page_title = "Physical Financial Report Print";
        include('./controller/physical_financial_report_print.php'); break;    

    case 68:
        $page_title = "Monthly Expenditure Report  Print";
        include('./controller/monthly_exp_plan_print.php'); break;        

    case 69:
        $page_title = "Quaterly Expenditure Report  Print";
        include('./controller/quarterly_exp_plan_print.php'); break; 

    case 70:
        $page_title = "Monthly Excel Report";
        include('./controller/monthly_report_excel.php'); break;  

    case 71:
        $page_title = "Work Closure Excel Report";
        include('./controller/work_closure_report_excel.php'); break;   

    case 72:
        $page_title = "Work Closure Excel Report";
        include('./controller/less_expenditure_report_excel.php'); break;  

    case 73:
        $page_title = "Montly Expenditure Plan Excel Report";
        include('./controller/monthly_expenditure_plan_report_excel.php'); break;

    case 74:
        $page_title = "Export Graph";
        include('./controller/export_graph.php'); break;

    case 75:
        $page_title = "Division Wise Work Status";
        include('./controller/pie_chart_project_wise_status.php'); break;

    case 76:
        $page_title = "Agreement Detail";
        include('./controller/work_order.php'); break;        

    case 77:
        $page_title = "Monthly Target Expenditure Graph";
        include('./controller/graph_monthly_proposed_expenditure.php'); break;

    case 78:
        $page_title = "Work Forward List";
        include('./controller/work_forward_list.php'); break;       
    
    case 79:
        $page_title = "Request For Update";
        include('./controller/request_for_update.php'); break;
    
    case 80:
        $page_title = "Request For EOT";
        include('./controller/request_for_eot.php'); break;
    
    case 81:
        $page_title = "Request For Revised Amount";
        include('./controller/request_for_revised_amount.php'); break;    
    
    case 82:
        $page_title = "Updation Request List";
        include('./controller/request_for_update_listing.php'); break;
    
    case 83:
        $page_title = "Additional Amount Over Budget Provision";
        include('./controller/request_for_revise_amount_listing.php'); break;  
   
    case 84:
        $page_title = "Approve Request For Update";
        include('./controller/approve_request_for_update.php'); break;     
    
    case 85:
        $page_title = "Forward Work List";
        include('./controller/forward_work_list.php'); break;          
    
    case 86:
        $page_title = "EOT Request List";
        include('./controller/request_for_eot_listing.php'); break; 
        
    case 87:
        $page_title = "Approve EOT Request";
        include('./controller/approve_request_for_eot.php'); break;  
    
    case 88:
        $page_title = "Approve Revised Amount Request";
        include('./controller/approve_request_for_revised_amount.php'); break;
        
    case 89:
        $page_title = "Target Details";
        include('./controller/view_proposed_details.php'); break;
        
    case 90:
        $page_title = "Physical Execution Process Details";
        include('./controller/view_prev_allotment_updation_details.php'); break;    
    
    case 91:
        $page_title = "Date Tracker Report";
        include('./controller/date_tracker_report.php'); break; 

    case 92:
        $page_title = "Create Your Own Report";
        include('./controller/dynamic_report.php'); break; 
        
    case 93:
        $page_title = "Department Wise No Of Works";
        include('./controller/graph_department_wise_works_print.php'); break;
        
    case 94:
        $page_title = "Monthly Propose Expenditure Graph";
        include('./controller/graph_monthly_proposed_expenditure_print.php'); break;
    
    case 95:
        $page_title = "Dynamic excel report";
        include('./controller/dynamic_excel_report.php'); break; 
    
    case 96:
        $page_title = "Target /Actual Expenditure Graph";
        include('./controller/proposed_actual_graph_print.php'); break;        
    
    case 97:
        $page_title = "Monthly Work Progress Graph Print";
        include('./controller/bar_graph_print.php'); break;        
    
    case 98:
        $page_title = "Timelines and Financial Progress Graph";
        include('./controller/timeline_financial_progress_graph.php'); break;        
    
    case 99:
        $page_title = "Timelines and Physical Progress Graph";
        include('./controller/timeline_physical_progress_graph.php'); break;
    
    case 100:
        $page_title = "Division Wise Excel Report ";
        include('./controller/excel_report_division_wise.php'); break;
    
    case 101:
        $page_title = "Timeline Physical Progress Graph Print";
        include('./controller/timeline_physical_progress_graph_print.php'); break;
    
    case 102:
        $page_title = "Timeline Financial Progress Graph Print";
        include('./controller/timeline_financial_progress_graph_print.php'); break;        
    
    case 103:
        $page_title = "Re-Allotment";
        include('./controller/re_work_allotment.php'); break;     
    
    case 104:
        $page_title = "Contractor Detail";
        include('./controller/approve_contractor_detail.php'); break;     
    
    case 105:
        $page_title = "Physical Financial Excel Report";
        include('./controller/physical_financial_report_excel.php'); break;     
   
    case 106:
        $page_title = "Monthly Expenditure Excel Report ";
        include('./controller/monthly_expenditure_report_excel.php'); break;     
    
    case 107:
        $page_title = "Change Password ";
        include('./controller/manage_change_password.php'); break;     
    
    case 108:
        $page_title = "Work Complete Report Print ";
        include('./controller/work_complete_report_print.php'); break;     
    
    case 109:
        $page_title = "Work Complete Report Excel ";
        include('./controller/work_complete_report_excel.php'); break;     
    
    case 110:
        $page_title = "Work Close Report Print ";
        include('./controller/work_close_report_print.php'); break;     
   
    case 111:
        $page_title = "Work Close Report Excel ";
        include('./controller/work_close_report_excel.php'); break;    
    
    case 112:
        $page_title = "Manage Sector ";
        include('./controller/manage_sector.php'); break;
    
    case 113:
        $page_title = "Manage Object ";
        include('./controller/manage_object_head.php'); break;    
    
    case 114:
        $page_title = "Manage Detail Head ";
        include('./controller/manage_detail_head.php'); break;
    
    case 115:
        $page_title = "Manage Project Type ";
        include('./controller/manage_project_type.php'); break;
    
    case 116:
        $page_title = "BackLog Entry ";
        include('./controller/back_log_entry.php'); break;       

    case 117:
        $page_title = "Un Authorised Access";
        include('./controller/unauthorized.php'); break;
    
    case 118:
        $page_title = "Update Block and Constituency Details";
        include('./controller/add_block_constituency_details.php'); break;           

    case 119:
        $page_title = "Work Acceptacnce Report";
        include('./controller/work_acceptance_report.php'); break;
        
    case 120:
        $page_title = "All Report Center";
        include('./controller/all_report_center.php'); break;               
    
    case 121:
        $page_title = "Work Acceptacnce Print Report";
        include('./controller/work_acceptance_print_report.php'); break;               
    
    case 122:
        $page_title = "Work Acceptacnce Print Report";
        include('./controller/work_acceptance_excel_report.php'); break; 
        
    case 123:
        $page_title = "Work Acceptance Print Report";
        include('./controller/work_acceptance_excel_report.php'); break;
        
    case 124:
        $page_title = "Work Details Report Plan and Type Wise";
        include('./controller/work_report_plan_and_type_wise.php'); break;
        
    case 125:
        $page_title = "Request for Re-tendering";
        include('./controller/re_tendering.php'); break;
        
    case 126:
        $page_title = "Request for Retendering";
        include('./controller/req_for_re_tendering.php'); break;
        
    case 127:
        $page_title = "Re-Tendering Request List";
        include('./controller/re_tendering_req_list_ce.php'); break;
        
    case 128:
        $page_title = "Approve Re-Tendering Request";
        include('./controller/approv_re_tendering_bank.php'); break;
        
    case 129:
        $page_title = "Close Work [For Retendering]";
        include('./controller/work_close_re_tendering.php'); break;
        
    case 130:
        $page_title = "Re-Tendered Work Report";
        include('./controller/re_tendered_work_report.php'); break; 
        
    case 131:
        $page_title = "Work Re-Tendered Report";
        include('./controller/re_tendered_work_tracker.php'); break;                                                     

    case 132:
        $page_title = "Financial Completion";
        include('./controller/work_close.php'); break;                                                     

    case 133:
        $page_title = "Manage Components";
        include('./controller/manage_components.php'); break;   
                                                          
    case 134:
        $page_title = "Add Physical Target Detail";
        include('./controller/add_target_detail.php'); break;   
        
    case 135:
        $page_title = "Cumulative Target Vs Achievement Expenditure";
        include('./controller/cumulative_propose_actual_graph.php'); break;                                                     
    
    case 136:
        $page_title = "Cumulative Target Vs Achievement Expenditure";
        include('./controller/print_cumulative_propose_actual_graph.php'); break;    
        
    case 137:
        $page_title = "Cumulative Target Vs Achievement Expenditure";
        include('./controller/cumulative_propose_actual_report.php'); break;                                                     

    case 138:
        $page_title = "Cumulative Target Vs Achievement Expenditure Print Report";
        include('./controller/cumulative_propose_actual_report_print.php'); break;                                                     

    case 139:
        $page_title = "Cumulative Target Vs Achievement Expenditure Grpah Report";
        include('./controller/cumulative_propose_actual_report_excel.php'); break;                                                     
    
    case 140:
        $page_title = "Stage Wise Analysis Report";
        include('./controller/stage_wise_analysis.php'); break;                                                     

    case 141:
        $page_title = "Work Wise Abstract Report";
        include('./controller/project_wise_abstract_report.php'); break;                                                     

    case 142:
        $page_title = "Stage Wise Analysis Report";
        include('./controller/stage_wise_analysis.php'); break;                                                     

    case 143:
        $page_title = "Manage Contractor Detail";
        include('./controller/manage_contractor.php'); break;                                                     

   case 144:
        $page_title = "Manage Page";
        include('./controller/manage_page.php'); break;                                                     

   case 145:
        $page_title = "Division Wise Stage Analysis Report";
        include('./controller/progress_wise_graph_report.php'); break;                                                     

   case 146:
        $page_title = "EOT Abstract Report";
        include('./controller/eot_abstract_report.php'); break;                                                     

   case 147:
        $page_title = "Request For Revised Amount Report";
        include('./controller/req_for_revised_amt_report.php'); break;                                                     

   case 148:
        $page_title = "Work Wise Amount Tracker";
        include('./controller/full_amount_tracker.php'); break;
        
   case 149:
        $page_title = "";
        include('./controller/full_amount_tracker_excel_report.php'); break;
        
   case 150:
        $page_title = "";
        include('./controller/full_amount_tracker_excel_report.php'); break;     

   case 151:
        $page_title = "Monthly Cumulative Wise Physical Progress";
        include('./controller/monthly_cumulative_wise_physical_progress.php'); break;
        
   case 152:
        $page_title = "Component Wise Physcial Progress";
        include('./controller/component_wise_physical_progress.php'); break;
        
   case 153:
        $page_title = "Component Wise Physcial Progress Print";
        include('./controller/component_wise_physical_progress_print.php'); break;                

   case 154:
        $page_title = "Monthly Cumulative Wise Physical Progress Print";
        include('./controller/monthly_cumulative_wise_physical_progress_print.php'); break;

   case 155:
        $page_title = "Monthly Expenditure Excel Report";
        include('./controller/monthly_exp_plan_excel.php'); break;

   case 156:
        $page_title = "Quarterly Expenditure Excel Report";
        include('./controller/quarterly_exp_plan_excel.php'); break;

   case 157:
        $page_title = "Component Wise Monthly Physical Progress Report ";
        include('./controller/component_wise_monthly_physical_progress.php'); break;

   case 158:
        $page_title = "Component Wise Monthly Physical Progress Report Print ";
        include('./controller/component_wise_monthly_physical_progress_print.php'); break;

   case 159:
        $page_title = "Component Wise Monthly Physical Progress Report Excel ";
        include('./controller/component_wise_monthly_physical_progress_excel.php'); break;
        
   case 160:
        $page_title = "Financial Physical Progress Graph";
        include('./controller/phy_financial_graph.php'); break;     
        
   case 161:
        $page_title = "Division Wise Stage Analysis Report Print";
        include('./controller/division_wise_stage_analysis_report_print.php'); break;
        
   case 162:
        $page_title = "Financial Physical Progress Graph Print";
        include('./controller/phy_financial_graph_print.php'); break;
        
   case 163:
        $page_title = "Physical Work Progress Graph";
        include('./controller/work_progress_graph.php'); break;               

   case 164:
        $page_title = "Division Wise Stage Analysis Report";
        include('./controller/div_wise_stage_analysis.php'); break;
        
   case 165:
        $page_title = "Project Deletion";
        include('./controller/project_delete.php'); break;                

   case 166:
        $page_title = "Mapping projects";
        include('./controller/project_work_mapping.php'); break;

   case 167:
        $page_title = "Mapping Block";
        include('./controller/manage_block.php'); break;

   case 168:
        $page_title = "Mapping Allot Amount";
        include('./controller/manage_allot_amount.php'); break;
        
   case 169:
        $page_title = "Update Agreement Detail";
        include('./controller/update_agreement_detail.php'); break;

   case 170:
        $page_title = "Mapping Execution Process";
        include('./controller/mapping_execution_process.php'); break;

   case 171:
        $page_title = "Print Date Tracker Report";
        include('./controller/print_date_tracker_report.php'); break;

   case 172:
        $page_title = "Print Work In Progress Report";
        include('./controller/print_work_in_progress_report.php'); break;

   case 173:
        $page_title = "Excel Work In Progress Report";
        include('./controller/excel_work_in_progress_report.php'); break;



   case 174:
        $page_title = "Print Work With Delay Report";
        include('./controller/print_work_with_delay_report.php'); break;

   case 175:
        $page_title = "Excel Work In Progress Report";
        include('./controller/excel_work_with_delay_report.php'); break;


   case 176:
        $page_title = "Print Work Forward List";
        include('./controller/print_work_forward_list.php'); break;

   case 177:
        $page_title = "Print Work Re-Tendered Report";
        include('./controller/print_re_tendered_work_tracker.php'); break;

   case 178:
        $page_title = "Print Work Creation List Report";
        include('./controller/print_work_listing_detail.php'); break;

   case 179:
        $page_title = "Excel Work Creation List Report";
        include('./controller/excel_work_listing_detail.php'); break;

   case 180:
        $page_title = "Print Work Allotment List Report";
        include('./controller/print_work_allotment_listing.php'); break;

   case 181:
        $page_title = "Excel Work Allotment List Report";
        include('./controller/excel_work_allotment_listing.php'); break;

   case 182:
        $page_title = "Print Work Allotment Acceptance Status(Division Wise) Report";
        include('./controller/print_work_allotment_lists.php'); break;
   case 183:
        $page_title = "Excel Work Allotment Acceptance Status(Division Wise) Report";
        include('./controller/excel_work_allotment_lists.php'); break;

   case 184:
        $page_title = "Work Wise Details Report";
        include('./controller/work_wise_details_report.php'); break;
        
   case 185:
        $page_title = "";
        include('./controller/excel_work_wise_details_report.php'); break;
		
   case 186:
        $page_title = "Manage RIDF";
        include('./controller/manage_ridf.php'); break;
        
    case 187:
        $page_title = "Back up";
        include('./controller/backup.php'); break;	       
        
    case 188:
        $page_title = "Manage Messege Alert";
        include('./controller/manage_messege_alert.php'); break;	       

   case 189:
        $page_title = "Set Reallotment";
        include('./controller/set_reallotment_page.php'); break;	       
 
   case 190:
        $page_title = "Manage Profile";
        include('./controller/manage_profile.php'); break; 	       
 
   case 191:
        $page_title = "Manage Work Creation ";
        include('./controller/manage_work_creation_by_jee.php'); break;  	       
 
   case 192:
        $page_title = "Work Creation Listing ";
        include('./controller/work_listing_detail_jee.php'); break;          
        
  case 193:
        $page_title = "Expenditure Planner";
        include('./controller/expenditure_planner.php'); break;  
		
		
		
   case 195:
        $page_title = "Abstract Report";
        include('./controller/module_abstract_repot.php'); break; 
		

   case 196:
        $page_title = "ABSRACT OF EXPENDITURE TARGETS AND ACHIEVEMENTS ";
        include('./controller/module_abstract_exp_report.php'); break; 
        
   case 197:
        $page_title = "EXCEL ABSRACT OF EXPENDITURE TARGETS AND ACHIEVEMENTS ";
        include('./controller/excel_module_abstract_exp_report.php'); break; 
        
  case 198:
        $page_title = "Excel Abstract Report ";
        include('./controller/excel_module_abstract_repot.php'); break;
        
        
         
  case 199:
        $page_title = "Project wise Target and Achievement Report ";
        include('./controller/exp_updateion_report.php'); break; 
 
 
  case 200:
        $page_title = "Project wise Target and Achievement Updation Report ";
        include('./controller/exp_updateion_report_performance.php'); break;
        
        
  case 201:
        $page_title = "Master subdivision ";
        include('./controller/master_subdivision.php'); break;
                
   case 202:
        $page_title = "Master section ";
        include('./controller/master_section.php'); break;
       
    case 203:
        $page_title =" Abstract Detail Report";
        include('./controller/module_abstract_repot_detail.php'); break;
       
     case 204:
        $page_title =" ";
        include('./controller/setprojectcode.php'); break;
       
      case 205:
        $page_title =" ";
        include('./controller/send_updation_messege.php'); break;
       
      case 206:
        $page_title =" ";
        include('./controller/view_send_updation_messege.php'); break;
        
       case 207:
        $page_title =" ";
        include('./controller/setjeproject.php'); break;     

		
       case 208:
        $page_title =" ";
        include('./controller/view_user_detail.php'); break;         

       case 209:
        $page_title =" ";
        include('./controller/query.php'); break;
        
       case 210:
        $page_title =" Assign Work";
        include('./controller/assign_work_jee.php'); break;        
        
        case 211:
        $page_title =" Work Detail";
        include('./controller/show_work_detail.php'); break;        
 
        case 212:
        $page_title =" Physical Target Detail";
        include('./controller/physical_target_detail.php'); break;        

        case 213:
        $page_title =" Monthly Physical Updation";
        include('./controller/monthly_physical_updation.php'); break;        

       case 214:
        $page_title =" Dashboard Panel";
        include('./controller/dashboard_panel.php'); break;        

      case 215:
        $page_title =" Abstract Report";
        include('./controller/module_abstract_repot_procedure.php'); break;        

     case 216:
        $page_title =" View Detail";
        include('./controller/scheme_breakup_report.php'); break;        

	case 217:
        $page_title ="Dashboard ";
        include('./controller/admin_home_procedure.php'); break;
        
	case 218:
        $page_title ="Assign Project";
        include('./controller/assign_project_detail.php'); break;        

 	case 219:
        $page_title ="Contractor Work Detail";
        include('./controller/con_work_detail.php'); break;
        
  	case 220:
        $page_title ="Manage Budget Provision";
        include('./controller/manage_budget_provision.php'); break;       
        
   	case 221:
        $page_title ="User Excel Report";
        include('./controller/user_excel_report.php'); break;
        
    	case 222:
        $page_title ="Manage Project Detail";
        include('./controller/manage_project_detail.php'); break;
        
        
    	case 223:
        $page_title ="Manage Component";
        include('./controller/manage_project_component.php'); break;
        
    	case 224:
        $page_title ="Manage Menu";
        include('./controller/manage_menu.php'); break;
        
    	case 225:
        $page_title ="Division Performance Reoprt";
        include('./controller/division_performance_report.php'); break;        
        
    	case 226:
        $page_title ="Manage Constituency";
        include('./controller/manage_costituency_detail.php'); break;
         
    	case 227:
        $page_title ="Master Page";
        include('./controller/master_page.php'); break;
        
    	case 228:
        $page_title ="Manage Project Completion";
        include('./controller/work_close.php'); break;
        
    	case 229:
        $page_title ="Generate Performance Report";
        include('./controller/section_wise_performance_report.php'); break;          
        
    	case 230:
        $page_title ="Send Messege";
        include('./controller/send_message.php'); break;
        
     	case 231:
        $page_title =" Add Scheme ";
        include('./controller/add_scheme.php'); break;       
        
    	case 232:
        $page_title =" Print Performance Report ";
        include('./controller/print_division_performance_report.php'); break;       
         
     	case 233:
        $page_title =" Periodic Abstract Report ";
        include('./controller/periodic_abstract_report.php'); break;       
        
    	case 234:
        $page_title =" Periodic Abstract Report Detail";
        include('./controller/periodic_abstract_report_detail.php'); break;
        
    	case 235:
        $page_title =" Dashboard Print Report";
        include('./controller/dashboard_print_report.php'); break;        
        
    	case 236:
        $page_title =" Contractor Print Report";
        include('./controller/contractor_print_report.php'); break;        
        
     	case 237:
        $page_title =" Constituency Print Report";
        include('./controller/constituency_print_report.php'); break;        
        
     	case 238:
        $page_title =" Abstarct Print Report";
        include('./controller/abstract_print_report.php'); break;        
        
   	    case 239:
        $page_title =" Abstract Print Report Detail";
        include('./controller/abstract_print_report_detail.php'); break;        
        
     	case 240:
        $page_title ="Print Periodic Abstract Report ";
        include('./controller/print_periodic_abstract_report.php'); break;
        
      	case 241:
        $page_title ="Add Inspection Note";
        include('./controller/add_inspection_note.php'); break;       
        
      	case 242:
        $page_title ="Periodical Grphical Abstract Report(Monthly  Basis)";
        include('./controller/periodical_abstract_graphical_report.php'); break;       
       
     	case 243:
        $page_title ="Periodical Grphical Abstract Report(Scheme Wise)";
        include('./controller/periodical_abstract_scheme_graphical_report.php'); break;
        
     	case 244:
        $page_title ="Contractor Performance Report";
        include('./controller/contractor_performance_graph_report.php'); break;        
        
     	case 245:
        $page_title ="Expenditure Planner(Previous Financial Year)";
        include('./controller/expenditure_planner_prev.php'); break;
        
     	case 246:
        $page_title ="View Previous Target & Expenditure";
        include('./controller/prev_expenditure_detail.php'); break;
                
     	case 247:
        $page_title =" Add Issue Type ";
        include('./controller/add_issue_type.php'); break;
        
      	case 248:
        $page_title =" Add Issue Stage ";
        include('./controller/add_issue_stage.php'); break;
        
        case 249:
        $page_title =" Add Issue Detail ";
        include('./controller/add_issue_detail.php'); break;
        
        case 250:
        $page_title =" Add Issue Compliance ";
        include('./controller/add_issue_compliance_detail.php'); break;
        
         case 251:
        $page_title =" Issue Work Name ";
        include('./controller/add_issue_work_name.php'); break;       
        
        case 252:
        $page_title =" View Issue Compliance Detail ";
        include('./controller/view_issue_compliance.php'); break;       
        
        case 253:
        $page_title =" Physical Completion ";
        include('./controller/work_physical_completion.php'); break;          
        
        case 254:
        $page_title =" Generate Performance Report ";
        include('./controller/generate_performance_report.php'); break;
        
         case 255:
        $page_title ="Email Generate Performance Report ";
        include('./controller/email_generate_performance_report.php'); break;         

         case 256:
        $page_title ="Circle Wise Analysis Absatrct Report(Scheme Wise)";
        include('./controller/print_abstract_report_circle.php'); break;
        
         case 257:
        $page_title ="Report for DC/CS";
        include('./controller/dc_level_scheme_analysis_graph.php'); break;
        
        case 258:
        $page_title ="Add Other Issue";
        include('./controller/add_other_issue_detail.php'); break;
        
       case 259:
        $page_title ="Division Wise Analysis Absatrct Report(Scheme Wise)";
        include('./controller/print_abstract_report_division.php'); break;
        
        case 260:
        $page_title ="Other Issue Listing (Forwarded from user)";
        include('./controller/view_other_issue_detail.php'); break;
        
        case 261:
        $page_title ="Print Periodic Abstract Report Circle Wise";
        include('./controller/periodic_abstract_report_circle_print.php'); break;
        
       case 262:
        $page_title ="Print Periodic Abstract Report Division Wise";
        include('./controller/print_periodic_abstract_report_division.php'); break;   

       case 263:
        $page_title ="Manage Circle";
        include('./controller/manage_circle.php'); break; 
		
       case 264:
        $page_title ="Manage Division";
        include('./controller/manage_division.php'); break;   
		
       case 265:
        $page_title ="HIERCHY OF CIRCLE/DIVISION/SUB DIVISION/SECTION";
        include('./controller/manage_heirchy.php'); break; 		

       case 266:
        $page_title =" Add New Project [Pre Award Stage]";
        include('./controller/add_new_project.php'); break;
        
       case 267:
        $page_title =" New Project [Pre Award Stage] Listing";
        include('./controller/new_project_listing.php'); break; 	        
 
        case 268:
        $page_title =" Add Remark";
        include('./controller/add_issue_remark.php'); break; 

        case 269:
        $page_title =" View Remark/Compliance Detail";
        include('./controller/view_remark_listing.php'); break;
        
        case 270:
        $page_title =" Add Compliance To Remark";
        include('./controller/add_comp_to_remark.php'); break;
        
        case 271:
        $page_title =" Add Profile";
        include('./controller/add_profile.php'); break;
        
        case 272:
        $page_title =" Manage Location";
        include('./controller/manage_location.php'); break;
        
        case 273:
        $page_title =" Financial Updation Detail";
        include('./controller/fin_updation_detail.php'); break;
        
        case 274:
        $page_title =" Add Approve Tender";
        include('./controller/add_approve_tender.php'); break;         
        
        case 275:
        $page_title =" Approve Tender Listing";
        include('./controller/approve_tender_listing.php'); break;         

        case 276:
        $page_title =" Tender Report";
        include('./controller/abstract_tender_report.php'); break;
        
        case 277:
        $page_title =" Add Road Data Sheet";
        include('./controller/add_road_data_sheet.php'); break;

       case 278:
        $page_title =" Add Bridge Data Sheet";
        include('./controller/add_bridge_data_sheet.php'); break;

       case 279:
        $page_title =" Add Building Data Sheet";
        include('./controller/add_building_data_sheet.php'); break;
        
       case 280:
        $page_title =" Estimation ";
        include('./controller/add_estimation.php'); break;
        
       case 281:
        $page_title =" Estimation2 ";
        include('./controller/add_estimation2.php'); break;        
        
       case 282:
        $page_title =" Estimation Libreary ";
        include('./controller/estimation_library.php'); break;        
       case 283:
        $page_title =" Add Component ";
        include('./controller/add_component.php'); break;        
       case 284:
        $page_title =" Add Sub Component ";
        include('./controller/add_subcomponent.php'); break;   

       case 285:
        $page_title =" Estimation Detail ";
        include('./controller/estimation_listing_detail.php'); break;   
       case 286:
        $page_title =" Item Detail ";
        include('./controller/add_item.php'); break;   
 
        case 287:
        $page_title =" Administrative Approval Report  ";
        include('./controller/print_adm_approval_report.php'); break;         

        case 288:
        $page_title =" Work Detail Report   ";
        include('./controller/project_detail_report.php'); break;  

        case 289:
        $page_title =" Excel Work Detail Report  ";
        include('./controller/excel_project_detail_report.php'); break;            

        case 290:
        $page_title =" Data Sheet Report ";
        include('./controller/datasheet_report.php'); break;  


        case 291:
        $page_title =" Print Tender Report";
        include('./controller/print_approve_tender.php'); break; 

        case 292:
        $page_title =" Print Tender Report(Division Wise Report)";
        include('./controller/print_approve_tender_division.php'); break;   

        case 293:
        $page_title =" Print Tender Report(Scheme Wise Report)";
        include('./controller/print_approve_tender_scheme.php'); break;  

        case 294:
        $page_title =" View Datasheet Report";
        include('./controller/view_datasheet_report.php'); break; 

        case 295:
        $page_title =" Check Mandrill";
        include('./controller/check_mandrill.php'); break; 
		
		 case 296:
        $page_title =" Get All Circle";
        include('./controller/get_all_circle.php'); break;

         case 297:
        $page_title =" Tender Detail Report";
        include('./controller/tender_detail_report.php'); break;

         case 298:
        $page_title =" Print Tender Listing";
        include('./controller/print_add_approve_tender.php'); break;
		
	   case 299:
        $page_title =" Add Inspection";
        include('./controller/manage_inspection.php'); break;

        case 300:
        $page_title =" Approved Running Bill Entry";
        include('./controller/approved_running_bill_entry.php'); break;
		
	   case 301:
        $page_title ="Add Compliance ";
        include('./controller/manage_compliance.php'); break;

	   case 302:
        $page_title =" Add  Compliance";
        include('./controller/add_compliance.php'); break;

        case 303:
        $page_title =" Print Approved Running Bill Report";
        include('./controller/print_approved_running_bill.php'); break;  

        case 304:
        $page_title =" Print Approved Running Bill Report";
        include('./controller/print_approved_running_bill.php'); break;        

        case 305:
        $page_title ="View Inspection Detail";
        include('./controller/view_inspection_listing.php'); break;                   

        case 306:
        $page_title =" Inspection Report";
        include('./controller/inspection_report.php'); break;
        
        case 307:
        $page_title ="Add Remark";
        include('./controller/view_compliance_history.php'); break;  
		
	   case 308:
        $page_title =" View Inspection Compliance Detail ";
        include('./controller/view_inspection_compliance_detail.php'); break;  
		
	   case 309:
        $page_title =" Ajax Upload File ";
        include('./controller/ajax_file_upload.php'); break;  
		
        case 310:
        $page_title =" Issue Listing Detail ";
        include('./controller/issue_listing_detail.php'); break;
        
        case 311:
        $page_title =" Add Issue Remarks ";
        include('./controller/new_issue_remark.php'); break;
        
        case 312:
        $page_title =" View Issue Detail ";
        include('./controller/view_new_issue_detail.php'); break;
        
         case 313:
        $page_title =" Take Action ";
        include('./controller/take_issue_action.php'); break;

         case 314:
        $page_title =" Financial Expenditure Updation ";
        include('./controller/financial_exp_updation.php'); break;        
        
         case 315:
        $page_title =" Physical Target/Achievement Updation ";
        include('./controller/physical_exp_updation.php'); break;  
        
         case 316:
        $page_title =" Physical Abstract Report ";
        include('./controller/physical_abstract_report.php'); break;  

        case 317:
        $page_title =" Idco Login ";
        include('./controller/idco_login.php'); break; 

        case 318:
        $page_title =" Read FIle ";
        include('./controller/read_file.php'); break; 
       
        case 319:
        $page_title =" Inspection Report ";
        include('./controller/inspection_report_autopaging.php'); break; 

        case 320:
        $page_title =" Issue Listing ";
        include('./controller/issue_listing.php'); break; 

        case 321:
        $page_title =" Issue Listing ";
        include('./controller/search_issue_listing.php'); break; 

        case 322:
        $page_title =" Action Against Issue ";
        include('./controller/add_issue_complience.php'); break; 	

        case 323:
        $page_title =" Issue Forward Listing ";
        include('./controller/issue_forward_listing.php'); break;     

        case 324:
        $page_title =" Download Issue FIle";
        include('./controller/download_issue_file.php'); break;   

        case 325:
        $page_title =" Issue Forward Listing";
        include('./controller/search_issue_fwd_listing.php'); break;   

        case 326:
        $page_title =" Issue Details";
        include('./controller/issue_detail_report.php'); break;   

        case 327:
        $page_title =" Inspection Abstract Report";
        include('./controller/issue_inspection_detail_report.php'); break; 

        case 328:
        $page_title =" Print Issue Details";
        include('./controller/print_issue_detail_report.php'); break;   

        case 329:
        $page_title =" Print Issue Details";
        include('./controller/print_inspection_detail_report.php'); break;   

        case 330:
        $page_title ="Expenditure Planner(Previous Financial Year)";
        include('./controller/expenditure_planner_prev_new.php'); break;  

        case 331:
        $page_title ="Work Transfer ";
        include('./controller/work_transfer.php'); break;  

        case 332:
        $page_title ="Accidental Information ";
        include('./controller/accidental_infromation.php'); break;  

        case 333:
        $page_title ="Accidental Report ";
        include('./controller/accidental_listing.php'); break;  

        case 334:
        $page_title ="Accidental Information ";
        include('./controller/accidental_totallisting.php'); break; 

        case 335:
        $page_title ="Accidental Information ";
        include('./controller/accidental_update.php'); break; 

        case 336:
        $page_title ="Accidental Summary Report ";
        include('./controller/accidental_summary_report.php'); break; 

        case 337:
        $page_title ="Audit Trial ";
        include('./controller/audit_trial_physical_update.php'); break; 

        case 338:
        $page_title ="Accidental Information ";
        include('./controller/accidental_totalalisting.php'); break;

        case 339:
        $page_title ="Validation";
        include('./controller/checkUnique.php'); break; 

   


}
?>