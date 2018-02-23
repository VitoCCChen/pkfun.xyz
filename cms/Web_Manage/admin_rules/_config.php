<?php
$inc_path="../../inc/";
$manage_path="../";
$main_auth_key='auth';
$fun_auth_key='auth_rules';
include('../_config.php');

//$pagename=request_basename();

$file_path=$admin_path_admin;

$auth=coderAdmin::Auth($fun_auth_key);

$table=coderDBConf::$rules;
$colname=coderDBConf::$col_rules;
$table_auth=coderDBConf::$rules_auth;
$colname_auth=coderDBConf::$col_rules_auth;
$table_admin=coderDBConf::$admin;
$colname_admin=coderDBConf::$col_admin;

$page=request_pag("page");
$page_title=$auth['name'];
$page_desc=$page_title." - ".$langary_config['page_desc4'];
$mtitle='<li class="active">'.$auth['name'].$langary_config['mtitle'].'</li>';
$mainicon=$auth['icon'];

function getAuthStr($id,$isadmin){
    global $langary_Web_Manage_all;
	if($isadmin==1){
		return  ' <span class="label label-important"><li class="icon-ok"> '.$langary_Web_Manage_all['superadmin'].' </li></span>';
	}

	$ary_hasauth=coderAdmin::getAuthListAryByInt($id);
	$str='';
	
	foreach($ary_hasauth as $item){
		//$item['auth'] 操作權限
		if($item['ck_auth']){
			$str.= ' <span class="label label-deepblue authbtn"><li class="icon-ok-sign"> '.$item['name'].' </li></span>';
		}else{
			$str.= ' <span class="label label-info authbtn"><li class="icon-ok-sign"> '.$item['name'].' </li></span>';
		}
	}
	return $str;
}
?>