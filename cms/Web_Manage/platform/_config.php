<?php
$inc_path="../../inc/";
$manage_path="../";
$main_auth_key='member';
$fun_auth_key='platform';
include('../_config.php');

$auth=coderAdmin::Auth($fun_auth_key);

$table=coderDBConf::$platform;
$colname=coderDBConf::$col_platform;

$orderDesc='desc';
$page_title=$auth['name'];
$page=request_pag("page");
$page_desc="{$page_title}-".$langary_config['page_desc3'];
$mtitle='<li class="active">'.$page_title.'</li>';
$mainicon=$auth['icon'];
