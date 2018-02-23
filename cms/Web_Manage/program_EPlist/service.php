<?php
include_once('_config.php');
include_once('filterconfig.php');
$errorhandle=new coderErrorHandle();
try{
	
	$db = Database::DB();
	$sHelp=new coderSelectHelp($db);

    $getid = (get('id')!="")?get('id'):-1;

    //select
    $sHelp->select="e.`{$colname_ep['id']}`, p.`{$colname['name']}`, e.`{$colname_ep['anchors']}`, e.`{$colname_ep['start_time']}`, e.`{$colname_ep['end_time']}`,
    SEC_TO_TIME( TIMESTAMPDIFF(SECOND, e.`{$colname_ep['start_time']}`, e.`{$colname_ep['end_time']}`) ) AS episode_length,
    (SELECT COUNT(*) FROM ".$table_cl." a WHERE a.`{$colname_cl['record_id']}`=e.`{$colname_ep['id']}`) AS chatlog_count,"
    ."p.`{$colname['id']}`, e.`{$colname_ep['updatetime']}`, e.`{$colname_ep['createtime']}`, e.`{$colname_ep['manage']}`";


    //from
    $sHelp->table=$table_ep." e LEFT JOIN ".$table." p ON e.`{$colname_ep['pgram_id']}`=p.`{$colname['id']}`";

    //where
    $sqlstr=$filterhelp->getSQLStr();
    $where = $sqlstr->SQL;
    $where .= ($where==''?'':' AND ')."e.`{$colname_ep['pgram_id']}` = ".$getid;
    $sHelp->where=$where;

    //some order setting
    $sHelp->page_size=get("pagenum");
    $sHelp->page=get("page");
    $sHelp->orderby=get("orderkey",1);
    $sHelp->orderdesc=get("orderdesc",1);

    $rows=$sHelp->getList();

    for($i=0;$i<count($rows);$i++){
        if($rows[$i][$colname_ep['anchors']] !="") {
            $ary_numbers = explode(",", $rows[$i][$colname_ep['anchors']]);
            $newary = array();
            foreach ($ary_numbers as $val) {
                $key = array_search( $val, array_column($anchors_array, 'value') );
                $newary [] = '<span class="badge badge-' . $incary_lotterystyle[/*$val%10*/2] . '">' . $anchors_array[$key]['name'] . '</span>';
            }
            $rows[$i][$colname_ep['anchors']] = implode(" ", $newary);
        }
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