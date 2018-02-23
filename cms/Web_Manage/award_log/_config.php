<?php
$inc_path="../../inc/";
$manage_path="../";
include('../_config.php');

$table=coderDBConf::$award_log;
$colname=coderDBConf::$col_award_log;

$table_m=coderDBConf::$member;
$colname_m=coderDBConf::$col_member;

$table_a=coderDBConf::$anchor;
$colname_a=coderDBConf::$col_anchor;

$orderColumn=$colname["id"];
$orderDesc='desc';
$page_title="會員打賞歷程";
$page=request_pag("page");
$page_desc="{$page_title}-您可將內容修改為希望呈現的內容。";
$mtitle='<li class="active">'.$page_title.'</li>';
$mainicon="icon-group";
