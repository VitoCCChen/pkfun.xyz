<?php
include('_config.php');
$errorhandle=new coderErrorHandle();
try{  
	coderAdmin::vaild($auth,'view',1);
	$db = Database::DB();
	$sHelp=new coderSelectHelp($db);
	$sHelp->select="*";
	$sHelp->table=$table;
	$sHelp->orderby="id";
	$sHelp->page_size=get("pagenum");
	$sHelp->page=get("page");
	$sHelp->orderby=get("orderkey",1);
	$sHelp->orderdesc=get("orderdesc",1);
	
	$sqlstr=$help->getSQLStr();
	$sHelp->where=$sqlstr->SQL;
	
	$rows=$sHelp->getList();
	//print_r($rows);
	for($i=0;$i<count($rows);$i++){
		$authname = coderAdmin::getAuthName($rows[$i][$colname['main_key']],$rows[$i][$colname['fun_key']]);
		$rows[$i][$colname['main_key']]=$authname['main'];  
		$rows[$i][$colname['fun_key']]=$authname['fun'];  
		$rows[$i][$colname['action']]=coderAdminLog::getActionNameByKey($rows[$i][$colname['action']]);  
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