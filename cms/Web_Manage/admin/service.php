<?php
include('_config.php');
include_once('filterconfig.php');
$errorhandle=new coderErrorHandle();
try{
	coderAdmin::vaild($auth,'view',1);
	$db = Database::DB();
	$sHelp=new coderSelectHelp($db);
	$sHelp->select="a.* , r.{$colname_rules['name']}";
	$sHelp->table = $table." a 
					LEFT JOIN $table_rules r ON a.`{$colname['r_id']}` = r.`{$colname_rules['id']}`
					";
	$sHelp->page_size=get("pagenum");
	$sHelp->page=get("page");
	$sHelp->orderby=get("orderkey",1);
	$sHelp->orderdesc=get("orderdesc",1);

	$sqlstr=$help->getSQLStr();
	$wheresql = $sqlstr->SQL;
    $wheresql .= ($wheresql==''?'':' AND ')."`{$colname['level']}` = 1";

	$sHelp->where=$wheresql;

	$rows=$sHelp->getList();
	for($i=0;$i<count($rows);$i++){
		$rows[$i][$colname['ispublic']]=$incary_yn_layout[$rows[$i][$colname['ispublic']]];
		$rows[$i][$colname['pic']]=$rows[$i][$colname['pic']];
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