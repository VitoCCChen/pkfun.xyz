<?php
include_once('_config.php');
include_once('filterconfig.php');
$errorhandle=new coderErrorHandle();
try{
	
	$db = Database::DB();
	$sHelp=new coderSelectHelp($db);

    $getid = (get('id')!="")?get('id'):-1;
    $getrid=(get('r_id')!="")?get('r_id'):-1;

    //select
	$sHelp->select="t.`{$colname_cl['id']}`,p.`{$colname['name']}`,t.`{$colname_cl['chatlog']}`,t.`{$colname_cl['createtime']}`,t.`{$colname_cl['updatetime']}`,t.`{$colname_cl['manage']}`";
    //from
    $sHelp->table=$table_cl." t, ".$table." p";

    //where
    $sqlstr=$filterhelp->getSQLStr();
    $where = $sqlstr->SQL;
    $where .= ($where==''?'':' AND ')."p.`{$colname['id']}` = ".$getid . " AND t.`{$colname_cl['pgram_id']}` = ".$getid." AND t.`{$colname_cl['record_id']}` = ".$getrid;
    $sHelp->where=$where;

    //some order setting
    $sHelp->page_size=get("pagenum");
    $sHelp->page=get("page");
    $sHelp->orderby=get("orderkey",1);
    $sHelp->orderdesc=get("orderdesc",1);

    $rows=$sHelp->getList();



	$result['result']=true;
	$result['data']=$rows;
	$result['page']=$sHelp->page_info;
	echo json_encode($result);
}
catch(Exception $e){
	$errorhandle->setException($e); // 收集例外
}

if ($errorhandle->isException()) {
	$result['result']=false;
    $result['data']=$errorhandle->getErrorMessage();
	echo json_encode($result);
}

?>