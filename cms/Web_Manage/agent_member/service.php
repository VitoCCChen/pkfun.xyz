<?php
include_once('_config.php');
include_once('filterconfig.php');
$errorhandle=new coderErrorHandle();
try{

	$db = Database::DB();
	$sHelp=new coderSelectHelp($db);
    $getid = (get('id')!="")?get('id'):0;
	// $sHelp->select="*";
	// $sHelp->table=$table;

	$sHelp->select="a.`{$colname_a['agent_id']}`, a.`{$colname_a['name']}`, m.`{$colname['id']}`, m.`{$colname['member_id']}`, m.`{$colname['name']}`, m.`{$colname['email']}`, m.`{$colname['point']}`, m.`{$colname['create_time']}`, m.`{$colname['update_time']}`, SUM(c.`{$colname_c['point']}`) as totalcon";
	$sHelp->table = $table." m 
					LEFT JOIN $table_a a ON m.`{$colname['agent_id']}` = a.`{$colname_a['agent_id']}`
					LEFT JOIN $table_c c ON c.`{$colname_c['member_id']}` = m.`{$colname['member_id']}`
					";
	$sHelp->page_size=get("pagenum");
	$sHelp->page=get("page");
    $sHelp->orderby=get("orderkey",1);
	//$sHelp->orderdesc=get("orderdesc",1);

	$sqlstr=$filterhelp->getSQLStr();
	$where = $sqlstr->SQL;
    $where .= ($where==''?'':' AND ')."a.`{$colname_a['id']}` = ".$getid;
    $groupby = "m.`{$colname['id']}`";
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