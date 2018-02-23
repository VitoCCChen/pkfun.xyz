<?php
$inc_path="../../inc/";
$manage_path="../";
$main_auth_key='test';
$fun_auth_key='parner2';
include('../_config.php');

$auth=coderAdmin::Auth($fun_auth_key);

$table=coderDBConf::$test_table2;
$colname=coderDBConf::$col_test_table2;

$orderDesc='desc';
$page_title=$auth['name'];
$page=request_pag("page");
$page_desc="{$page_title}-".$langary_config['page_desc3'];
$mtitle='<li class="active">'.$page_title.'</li>';
$mainicon=$auth['icon'];
