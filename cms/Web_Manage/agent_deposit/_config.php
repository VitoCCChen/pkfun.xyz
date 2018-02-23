<?php
$inc_path="../../inc/";
$manage_path="../";
include('../_config.php');


$table=coderDBConf::$deposit;
$colname=coderDBConf::$col_deposit;

$table_m=coderDBConf::$member; //會員
$colname_m=coderDBConf::$col_member;

$table_p=coderDBConf::$platform; //平台
$colname_p=coderDBConf::$col_platform;


$table_third=coderDBConf::$deposit_pay; //第三方支付
$colname_third= coderDBConf::$col_deposit_pay;


$table_product=coderDBConf::$product; //商品
$colname_product=coderDBConf::$col_product;

$table_a=coderDBConf::$agent; //代理
$colname_a=coderDBConf::$col_agent;


$product_array = class_mycard::getList_deposit(); //產品

$orderColumn=$colname["id"];
$orderDesc='desc';
$page_title="代理下入款";
$page=request_pag("page");
$page_desc="{$page_title}-您可將內容修改為希望呈現的內容。";
$mtitle='<li class="active">'.$page_title.'</li>';
$mainicon="icon-usd";