<?php
include_once('_config.php');
include_once('filterconfig.php');
$errorhandle=new coderErrorHandle();
try{
    coderAdmin::vaild($auth,'view');

    $db = Database::DB();
    $sHelp=new coderSelectHelp($db);
    $sHelp->select="t.*,m.`{$colname_m['member_id']}` as uid,m.`{$colname_m['name']}`
					,p.`{$colname_p['product_id']}` as product,p.`{$colname_p['name']}` as product_name";
    $sHelp->table=$table." t
					LEFT JOIN $table_m m ON m.`{$colname_m['member_id']}` = t.`{$colname['member_id']}`
					LEFT JOIN $table_p p ON p.`{$colname_p['product_id']}` = t.`{$colname['product_id']}`";
    $sHelp->page_size=get("pagenum");
    $sHelp->page=get("page");
    $sHelp->orderby="Created_date";
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
        $rows[$i][$colname['Redeposit']]='<span class="label label-'.$incary_labelstyle[$rows[$i][$colname['Redeposit']]].'">'.coderHelp::getAryVal($langary_yn,$rows[$i][$colname['Redeposit']]).'</span>';
        $rows[$i][$colname['ReturnCode']]='<span class="label label-'.$mycard_labelstyle[$rows[$i][$colname['ReturnCode']]].'">'.coderHelp::getAryVal($langary_mycard,$rows[$i][$colname['ReturnCode']]).'</span>';
        $rows[$i][$colname['PayResult']]='<span class="label label-'.$mycard_labelstyle[$rows[$i][$colname['PayResult']]].'">'.coderHelp::getAryVal($langary_mycard_pay,$rows[$i][$colname['PayResult']]).'</span>';

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