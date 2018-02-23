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
        if($rows[$i][$colname['tag']] !="") {
            $ary_numbers = explode(",", $rows[$i][$colname['tag']]);
            $newary = array();
            foreach ($ary_numbers as $val) {
                $key = array_search( $val, array_column($tags_array, 'value') );
                //$newary [] = '<span class="badge badge-' . $incary_lotterystyle[2] . '">' . $tags_array[$key]['name'] . '</span>';
                if($key>=0)
                    $newary [] = '<span class="badge badge-' . $product_labelstyle[$tags_array[$key]['status']] . '">' . $tags_array[$key]['name'] . '</span>';
            }
            $rows[$i][$colname['tag']] = implode(" ", $newary);
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