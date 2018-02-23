<?php
$inc_path="../../inc/";
$manage_path="../";
$main_auth_key='admin';
$fun_auth_key='adminlog';
include('../_config.php');


$file_path=$admin_path_admin;
//$username = get("username", 1);

$auth=coderAdmin::Auth($fun_auth_key);

$table=coderDBConf::$admin_log;
$colname=coderDBConf::$col_admin_log;
$page=request_pag("page");
$page_title=$auth['name'];
$page_desc=$langary_config['page_desc2'];
$mtitle='<li class="active">'.$auth['name'].'<span class="divider"><i class="icon-angle-right"></i></span>'.$langary_Web_Manage_all['mtitle_log'].'</li>';
$mainicon=$auth['icon'];

$help=new coderFilterHelp();
$obj=array();

$ary=array();
$ary[]=array('column'=>$colname['username'],'name'=>$langary_Web_Manage_all['username']);
$ary[]=array('column'=>$colname['ip'],'name'=>$langary_Web_Manage_all['ip']);
$obj[]=array('type'=>'keyword','name'=>$langary_Web_Manage_all['keyword'],'sql'=>true,'ary'=>$ary);

$obj[]=array('type'=>'select','name'=>$langary_Web_Manage_all['main_key'],'column'=>$colname['main_key'],'sql'=>true,'ary'=>coderAdmin::getAuthMainKeyAry());
$obj[]=array('type'=>'datearea','sql'=>true,'column'=>$colname['createtime'],'name'=>$langary_Web_Manage_all['createdata']);
$obj[]=array('type'=>'hidden','sql'=>true,'column'=>$colname['username'],'name'=>'');
$help->Bind($obj);
?>