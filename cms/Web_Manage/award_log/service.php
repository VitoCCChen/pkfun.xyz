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

	$sHelp->select="t.*,m.`{$colname_m['member_id']}` as uid,m.`{$colname_m['name']}`
					,a.`{$colname_a['id']}` as author_name,a.`{$colname_a['name']}`";
	$sHelp->table=$table." t
				  LEFT JOIN $table_m m ON m.`{$colname_m['member_id']}` = t.`{$colname['member_id']}`
				  LEFT JOIN $table_a a ON a.`{$colname_a['id']}` = t.`{$colname['anchor_id']}`";
	$sHelp->page_size=get("pagenum");
	$sHelp->page=get("page");
	$sHelp->orderby=$colname["created_date"];
//	$sHelp->orderdesc=get("orderdesc",1);

	$sqlstr=$filterhelp->getSQLStr();
	$where = $sqlstr->SQL;
	$where .= ($where==''?'':' AND ')."m.`{$colname_m['id']}` = ".$getid;

    /*if($adminuser['type'] > 1){
        $where .= ($where==''?'':' AND ')."u.`{$colname['agent_id']}` = ".$adminuser['id'];
    }*/

	$sHelp->where=$where;

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