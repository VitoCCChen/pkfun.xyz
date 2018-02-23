<?php
$inc_path="../../inc/";
$manage_path="../";
include('../_config.php');

$main_auth_key='pay';
$fun_auth_key='mycard';

$auth=coderAdmin::Auth($fun_auth_key);

$table=coderDBConf::$mycard;
$colname=coderDBConf::$col_mycard;

$table_m=coderDBConf::$member; //會員
$colname_m=coderDBConf::$col_member;

$table_p=coderDBConf::$product; //產品
$colname_p=coderDBConf::$col_product;

$orderColumn=$colname["id"];
$orderDesc='desc';
$page_title=$auth['name'];
$page=request_pag("page");
$page_desc="{$page_title}-您可將內容修改為希望呈現的內容。";
$mtitle='<li class="active">'.$page_title.'</li>';
$mainicon=$auth['icon'];
