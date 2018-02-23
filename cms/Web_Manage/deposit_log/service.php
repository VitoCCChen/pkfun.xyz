<?php
include_once('_config.php');
include_once('filterconfig.php');
$errorhandle=new coderErrorHandle();
try{
	coderAdmin::vaild($auth,'view');
	$db = Database::DB();
	$sHelp=new coderSelectHelp($db);
	$sHelp->select="t.*,m.`{$colname_m['member_id']}` as uid,m.`{$colname_m['name']}`
					,p.`{$colname_p['id']}` as platform,p.`{$colname_p['name']}`";
	$sHelp->table=$table." t
				LEFT JOIN $table_m m ON m.`{$colname_m['member_id']}` = t.`{$colname['member_id']}`
				LEFT JOIN $table_p p ON p.`{$colname_p['id']}` = t.`{$colname['platform_id']}`";
	$sHelp->page_size=get("pagenum");
	$sHelp->page=get("page");
	$sHelp->orderby="updated_time";
	// $sHelp->orderdesc=get("orderdesc",1);

	$sqlstr=$filterhelp->getSQLStr();
	
	$where = $sqlstr->SQL;

	$sHelp->where=$where;

	$rows=$sHelp->getList();
	for($i=0;$i<count($rows);$i++){
		$rows[$i][$colname['status']]=coderHelp::getAryVal($langary_transfers,$rows[$i][$colname['status']]);
	}
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