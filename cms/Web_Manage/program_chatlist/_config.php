<?php
$inc_path="../../inc/";
$manage_path="../";
include('../_config.php');

$table=coderDBConf::$program;
$colname=coderDBConf::$col_program;

$table_cl=coderDBConf::$chatlog;
$colname_cl=coderDBConf::$col_chatlog;

$table_ep=coderDBConf::$episode;
$colname_ep=coderDBConf::$col_episode;

$anchors_array = getList_all();

$orderDesc='desc';
$page_title="節目開播紀錄";
$page=request_pag("page");
$page_desc="{$page_title}-您可將內容修改為希望呈現的內容。";
$mtitle='<li class="active">'.$page_title.'</li>';
$mainicon="icon-group";

function getList_all($in_id=""){ //全部 or 部分
    global $db;
    $colname = coderDBConf::$col_anchor;
    $where = "";
    if($in_id!==""){
        $where .= "where `{$colname['id']}` in(".$in_id.")";
    }
    $sql = "select {$colname['name']} as name,{$colname['id']} as value
                from ".coderDBConf::$anchor."
                $where
                ORDER BY `{$colname['id']}` DESC";
    return $db->fetch_all_array($sql);
}
