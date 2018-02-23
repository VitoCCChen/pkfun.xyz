<?php
include_once('_config.php');
include_once('filterconfig.php');
$errorhandle=new coderErrorHandle();
try{
	coderAdmin::vaild($auth,'view');
	
	$db = Database::DB();
	$sHelp=new coderSelectHelp($db);
	$sHelp->select="t.*,m.`{$colname_m['member_id']}` as uid,m.`{$colname_m['name']}`
					,p.`{$colname_p['id']}` as platform,p.`{$colname_p['name']}`
					,third.`{$colname_third['name']}` as third_pay_name
					,product.`{$colname_product['name']}` as product_name";
	$sHelp->table=$table." t
				  LEFT JOIN $table_m m ON m.`{$colname_m['member_id']}` = t.`{$colname['member_id']}`
				  LEFT JOIN $table_p p ON p.`{$colname_p['id']}` = t.`{$colname['platform_id']}`
				  LEFT JOIN $table_third third ON t.`{$colname['deposit_pay_id']}` = third.`{$colname_third['id']}`
				  LEFT JOIN $table_product product ON t.`{$colname['product_id']}` = product.`{$colname_product['product_id']}`";
	$sHelp->page_size=get("pagenum");
	$sHelp->page=get("page");
	$sHelp->orderby="id";
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
	//print_r($rows);exit;
	for($i=0;$i<count($rows);$i++){
		/* ## coder [modify] --> ## */
		//$rows[$i][$colname['is_public']]='<span class="label label-'.$incary_labelstyle[$rows[$i][$colname['is_public']]].'">'.coderHelp::getAryVal($langary_yn,$rows[$i][$colname['is_public']]).'</span>';

        $rows[$i][$colname['status']]='<span class="label label-'.$incary_labelstyle[$rows[$i][$colname['status']]].'">'.coderHelp::getAryVal($langary_transfers,$rows[$i][$colname['status']]).'</span>';
		
		/* ## coder [modify] <-- ## */
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