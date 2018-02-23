<?php
include_once('_config.php');
include_once('filterconfig.php');
$errorhandle=new coderErrorHandle();
try{
	coderAdmin::vaild($auth,'view');
	
	$db = Database::DB();
	$sHelp=new coderSelectHelp($db);
	// $sHelp->select="*";
	// $sHelp->table=$table;

	$sHelp->select="m.* , SUM(d.`{$colname_d['money']}`) as totaldeposit";
	$sHelp->table = $table." m
	                LEFT JOIN $table_d d ON m.`{$colname['agent_id']}` = d.`{$colname_d['agent_id']}`";
	$sHelp->page_size=get("pagenum");
	$sHelp->page=get("page");
	$sHelp->orderby="totaldeposit";
	//$sHelp->orderdesc=get("orderdesc",1);

	$sqlstr=$filterhelp->getSQLStr();
	$where = $sqlstr->SQL;
    $groupby = "m.`{$colname['agent_id']}`";

    /*if($adminuser['type'] > 1){
        $where .= ($where==''?'':' AND ')."u.`{$colname['agent_id']}` = ".$adminuser['id'];
    }*/

	$sHelp->where=$where;
	$sHelp->groupby=$groupby;

	$rows=$sHelp->getList();
	//print_r($rows);exit;
	for($i=0;$i<count($rows);$i++){
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