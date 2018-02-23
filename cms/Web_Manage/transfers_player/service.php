<?php
include_once('_config.php');
include_once('filterconfig.php');
$errorhandle=new coderErrorHandle();
try{
	
	$db = Database::DB();
	$sHelp=new coderSelectHelp($db);
	// $sHelp->select="*";
	// $sHelp->table=$table;

	$sHelp->select="m.* , p.`{$colname_p['name']}` as platform_name";
	$sHelp->table = $table." m 
					LEFT JOIN $table_p p ON m.`{$colname['platform_id']}` = p.`{$colname_p['id']}`
					";
	$sHelp->page_size=get("pagenum");
	$sHelp->page=get("page");
	$sHelp->orderby=get("orderkey",1);
	$sHelp->orderdesc=get("orderdesc",1);

	$sqlstr=$filterhelp->getSQLStr();
	$where = $sqlstr->SQL;


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