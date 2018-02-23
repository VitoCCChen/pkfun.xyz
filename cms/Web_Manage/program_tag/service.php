<?php
include_once('_config.php');
include_once('filterconfig.php');
$errorhandle=new coderErrorHandle();
try{
	coderAdmin::vaild($auth,'view');
	
	$db = Database::DB();
	$sHelp=new coderSelectHelp($db);
	$sHelp->select="*";
	$sHelp->table=$table;
	$sHelp->page_size=get("pagenum");
	$sHelp->page=get("page");
	$sHelp->orderby=get("orderkey",1);
	$sHelp->orderdesc=get("orderdesc",1);

	$sqlstr=$filterhelp->getSQLStr();
	$where = $sqlstr->SQL;
	$sHelp->where=$where;

	$rows=$sHelp->getList();

    for($i=0;$i<count($rows);$i++){
        //if($rows[$i][$colname['status']] == "1") {
            $rows[$i][$colname['status']] = '<span class="badge badge-' . $incary_labelstyle[$rows[$i][$colname['status']]] . '">'.$langary_agents_link[$rows[$i][$colname['status']]].'</span>';
        /*}
        else
            $rows[$i][$colname['status']] = '<span class="badge badge-' . $incary_labelstyle[0] . '">未啟用</span>';*/
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