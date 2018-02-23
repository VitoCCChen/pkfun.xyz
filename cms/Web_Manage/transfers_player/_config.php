<?php
$inc_path="../../inc/";
$manage_path="../";
include('../_config.php');


$table=coderDBConf::$member;
$colname=coderDBConf::$col_member;

$table_p=coderDBConf::$platform;
$colname_p=coderDBConf::$col_platform;

$table_a = coderDBConf::$admin; //管理員
$colname_a = coderDBConf::$col_admin;

$colname_t=coderDBConf::$col_dispensing;

$platform_array = class_platform::getList(); //遊戲

$orderColumn=$colname["id"];
$orderDesc='desc';
$page_title="會員資料";
$page=request_pag("page");
$page_desc="{$page_title}-您可將內容修改為希望呈現的內容。";
$mtitle='<li class="active">'.$page_title.'</li>';
$mainicon="icon-group";
