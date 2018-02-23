<?php
include_once('_config.php');
include_once('filterconfig.php');

$errorhandle=new coderErrorHandle();
try{
	coderAdmin::vaild($auth,'view',1);
	$db = Database::DB();
	$sHelp=new coderSelectHelp($db);
	$sHelp->select="*,(SELECT count(*) FROM $table_admin admin WHERE $table.{$colname['id']} = admin.`r_id` and admin.{$colname_admin['level']} = 1) as num";
	$sHelp->table=$table;
	$sHelp->page_size=get("pagenum");
	$sHelp->page=get("page");
	$sHelp->orderby=get("orderkey",1);
	$sHelp->orderdesc=get("orderdesc",1);

	$sqlstr=$help->getSQLStr();
	$wheresql = $sqlstr->SQL;
	$sHelp->where=$wheresql;

	$rows=$sHelp->getList();
	 for($i=0;$i<count($rows);$i++){
	 	$rows[$i]['auth']=getAuthStr($rows[$i][$colname['id']],$rows[$i][$colname['superadmin']]);

         $rows[$i][$colname['agents']]='<span class="label label-'.$incary_labelstyle[$rows[$i][$colname['agents']]].'">'.coderHelp::getAryVal($incary_yn,$rows[$i][$colname['agents']]).'</span>';
         $rows[$i][$colname['service']]='<span class="label label-'.$incary_labelstyle[$rows[$i][$colname['service']]].'">'.coderHelp::getAryVal($langary_yn,$rows[$i][$colname['service']]).'</span>';
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