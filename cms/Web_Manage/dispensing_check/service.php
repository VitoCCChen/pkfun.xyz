<?php
include_once('_config.php');
include_once('filterconfig.php');
$errorhandle=new coderErrorHandle();
try{
	coderAdmin::vaild($auth,'view');
	
	$db = Database::DB();
	$sHelp=new coderSelectHelp($db);
	$sHelp->select="t.*,m.`{$colname_m['member_id']}` as uid,m.`{$colname_m['name']}`,
					p.`{$colname_p['id']}` as platform,p.`{$colname_p['name']}`,
					b.`{$colname_b['id']}` as bank,b.`{$colname_b['name']}`,
	                bc.`{$colname_bc['id']}` as bank_card,bc.`{$colname_bc['name']}`";
	$sHelp->table=$table." t
				  LEFT JOIN $table_m m ON m.`{$colname_m['member_id']}` = t.`{$colname['member_id']}`
				  LEFT JOIN $table_p p ON p.`{$colname_p['id']}` = t.`{$colname['platform_id']}`
				  LEFT JOIN $table_b b ON b.`{$colname_b['id']}` = t.`{$colname['bank_id']}`
				  LEFT JOIN $table_bc bc ON bc.`{$colname_bc['id']}` = t.`{$colname['bank_card_id']}`";
	$sHelp->page_size=get("pagenum");
	$sHelp->page=get("page");
	$sHelp->orderby="created_time";
	//$sHelp->orderdesc=get("orderdesc",1);

	$sqlstr=$filterhelp->getSQLStr();
	$where = $sqlstr->SQL;


    $where = class_agent::getWhere_lv($colname_m,$where,"");
    /*if($adminuser['type'] > 1){
        if($adminuser['type'] == '4'){
            $where .= ($where == '' ? '' : ' AND ') . "`{$colname_u['agent_id']}` = " . $adminuser['serviceid'];
        }
        else {
            $where .= ($where == '' ? '' : ' AND ') . "`{$colname_u['agent_id']}` = " . $adminuser['id'];
        }
    }*/

	$sHelp->where=$where;

	$rows=$sHelp->getList();
	for($i=0;$i<count($rows);$i++){
        $rows[$i][$colname['is_pay']]='<span class="label label-'.$incary_labelstyle[$rows[$i][$colname['is_pay']]].'">'.coderHelp::getAryVal($langary_transfers,$rows[$i][$colname['is_pay']]).'</span>';
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