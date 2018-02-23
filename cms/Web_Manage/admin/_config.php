<?php
$inc_path="../../inc/";
$manage_path="../";
$main_auth_key='admin';
$fun_auth_key='admin';
include('../_config.php');

$pagename=request_basename();
$file_path=$admin_path_admin;

$auth=coderAdmin::Auth($fun_auth_key);

$table=coderDBConf::$admin;
$colname=coderDBConf::$col_admin;
$colname_log=coderDBConf::$col_admin_log;
$table_rules=coderDBConf::$rules;
$colname_rules=coderDBConf::$col_rules;

$rules_name = get('rules',1);

$page=request_pag("page");
$page_title=$auth['name'];
$page_desc=$langary_config['page_desc'];
$mtitle='<li class="active">'.$auth['name'].$langary_config['mtitle'].'</li>';
$mainicon=$auth['icon'];

$rules_array = class_rules::getList(); //角色ary

function isDateNotExisit($type,$val,$id='')
{
    global $db,$table,$colname;
    switch ($type) {
        case 'username':
            if (strlen($val)>2 && !$db->query_first("select {$colname['id']} from $table where `{$colname['level']}` = 1 and `{$colname['username']}`='".hc($val)."'")){
                return true;
            }else {
                return false;
            }
        break;
        case 'email':
            if (strlen($val)>2 && !$db->query_first("select {$colname['id']} from $table where `{$colname['level']}` = 1 and `{$colname['email']}`='".hc($val)."' AND `{$colname['id']}`!='$id'")){
                return true;
            }else{
                return false;
            }
        break;
        default:
            return false;
            break;
    }
}
?>