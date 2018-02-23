<?php
$inc_path="../../inc/";
$manage_path="../";
include('../_config.php');

$main_auth_key='dispensing';
$fun_auth_key='dispencheck';


$auth=coderAdmin::Auth($fun_auth_key);

$table=coderDBConf::$dispensing;
$colname=coderDBConf::$col_dispensing;

$table_bc=coderDBConf::$bank_card;
$colname_bc=coderDBConf::$col_bank_card;

$table_m=coderDBConf::$member; //玩家
$colname_m=coderDBConf::$col_member;

$table_p=coderDBConf::$platform; //平台名稱
$colname_p=coderDBConf::$col_platform;

$table_b=coderDBConf::$bank;
$colname_b=coderDBConf::$col_bank;

$bank_array = class_bank::getList(); //銀行

$bankcard_array = class_bank::getListCard(); //銀行卡


$orderColumn=$colname["id"];
$orderDesc='desc';
$page_title=$auth['name'];
$page=request_pag("page");
$page_desc="{$page_title}-您可將內容修改為希望呈現的內容。";
$mtitle='<li class="active">'.$page_title.'</li>';
$mainicon=$auth['icon'];
