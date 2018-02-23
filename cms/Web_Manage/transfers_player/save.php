<?php
include_once('_config.php');
include_once('formconfig.php');

$errorhandle=new coderErrorHandle();
try{
    $db = Database::DB();
    $id = post($colname['id'],1);
    if($id!=""){
        coderAdmin::vaild($auth,'edit');
        $method='edit';
        $active='編輯';
    }else{
        coderAdmin::vaild($auth,'add');
        $method='add';
        $active='新增';
    }

    $data=$fhelp->getSendData();
    $error=$fhelp->vaild($data);
    if(count($error)>0){
        $msg=implode('<br/>',$error);
        throw new Exception($msg);
    }

    $data_ud=$fhelp_ud->getSendData();
    $error=$fhelp_ud->vaild($data_ud);
    if(count($error)>0){
        $msg=implode('<br/>',$error);
        throw new Exception($msg);
    }

    //多圖圖片
    //$picgroup = $data[$colname['picgroup']];
    //$data[$colname['picgroup']] = json_encode($picgroup);

    /* ## coder [beforeModify] --> ## */
    /* ## coder [beforeModify] <-- ## */

    $nowtime = datetime();
    $data[$colname['manager']]=$adminuser['username'];
    $data[$colname['update_time']]= $nowtime;

    $pay_type = post($colname_ag['pay_type']); //代理人上分類型 [1]現金制[2]信用制
    if($pay_type == '2'){
        $data_ud[$colname_ud['quota']] = post($colname_ud['quota'],1);
    }


    if($method=='edit'){
        $db->query_update($table,$data," {$colname['id']}='{$id}'");
        $db->query_update($table_ud,$data_ud," {$colname_ud['id']}='{$id}'");
	}else{
        die('<script>parent.closeBox();parent.showNotice("alert","'.$page_title.'","'.$langary_Web_Manage_all['die_error'].'")</script>');
        /* ## coder [indInit] --> ## */
        //$data[$colname["ind"]]=coderListOrderHelp::getMaxInd($table,$colname["ind"]);
        /* ## coder [indInit] <-- ## */
        /* ## coder [insert] --> ## */
        /* ## coder [insert] <-- ## */        
		$data[$colname['create_time']]= $nowtime;
		$id=$db->query_insert($table,$data);
	}


    $admin_title=isset($data[$colname['id']]) ? $data[$colname['id']] : '';
    coderAdminLog::insert($adminuser['username'],$main_auth_key,$fun_auth_key,$method,"id:{$id}");


    $db->close();

    echo showParentSaveNote($page_title,$active,$admin_title,"manage.php?id=".$id);
}
catch(Exception $e){
	$errorhandle->setException($e); // 收集例外
}

if ($errorhandle->isException()) {
    $errorhandle->showError();
}
?>