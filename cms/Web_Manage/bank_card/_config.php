<?php
$inc_path="../../inc/";
$manage_path="../";
$main_auth_key='dispensing';
$fun_auth_key='bank_card';
include('../_config.php');

$auth=coderAdmin::Auth($fun_auth_key);

$table=coderDBConf::$bank_card;
$colname=coderDBConf::$col_bank_card;

$table_b=coderDBConf::$bank;
$colname_b=coderDBConf::$col_bank;

$bank_array = class_bank::getList(); //銀行
$orderColumn=$colname["id"];
$orderDesc='desc';
$page_title=$auth['name'];
$page=request_pag("page");
$page_desc="{$page_title}-管理現有銀行卡。";
$mtitle='<li class="active">'.$page_title.'</li>';
$mainicon=$auth['icon'];
