function validateForm()
{
    var work_name=document.getElementById('road_name').value;
    var x = checkWorkIdReport(work_name);
    $(document).ready(function() { 
           $.growlUI('Please wait', 'Sending Request to Server'); 
    }); 
}
function showShortName(schemeid)
{
//alert(schemeid);
	if(schemeid != 0)
	{
		var ajax = new AJAX();
		var arrParam = new Array();
		arrParam['schemeid'] = schemeid;
		ajax.getRequest('./controller/get_short_work_code.php', arrParam, responseShortname);
	}
}

function responseShortname(retVaL)
{
	document.getElementById('show_short_name').innerHTML = retVaL;
}

function showSchemeId(shortname)
{
	if(shortname != '')
	{
		var ajax = new AJAX();
		var arrParam = new Array();
		arrParam['shortname'] = shortname;
		ajax.getRequest('./controller/get_work_scheme_id.php', arrParam, responseSchemeId);
	}
}

function responseSchemeId(retVaL)
{
	document.getElementById('show_scheme_id').innerHTML = retVaL;
}
