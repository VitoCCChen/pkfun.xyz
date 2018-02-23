<?php
include_once('_config.php');
include_once('formconfig.php');

$errorhandle=new coderErrorHandle();
try{
    $db = Database::DB();
    $id = post($colname['id'],1);
    $chat_id = post($colname_cl['id'],1);
    $ep_id = post($colname_cl['record_id'],1);

    if($id!="" && $chat_id!=""){
        //coderAdmin::vaild($auth,'edit');
        $method='edit';
        $active=$langary_edit_add['edit'];
    }else{
        //coderAdmin::vaild($auth,'add');
        $method='add';
        $active=$langary_edit_add['add'];
    }

    $data=$fhelp->getSendData();
    $error=$fhelp->vaild($data);
    if(count($error)>0){
        $msg=implode('<br/>',$error);
        throw new Exception($msg);
    }

    $nowtime = datetime();
    $data[$colname_cl['manage']]=$adminuser['username'];
    $data[$colname_cl['updatetime']]= $nowtime;

    $admin_title=isset($data[$colname['name']]) ? $data[$colname['name']] : '';

    if($method=='edit'){
        unset($data[$colname['name']]);
        $db->query_update($table_cl, $data," {$colname_cl['id']}='{$chat_id}'");
        echo showParentSaveNote($page_title,$active,$admin_title,"manage.php?id=".$id."&chat_id=".$chat_id);
	}else{
        unset($data[$colname['name']]);
        $data[$colname_cl['pgram_id']] = $id;
        $data[$colname_cl['record_id']] = $ep_id;
		$data[$colname_cl['createtime']]= $nowtime;
		$db->query_insert($table_cl,$data);
        echo '<script>parent.closeBox()</script>';
        //$ep_id = $db->query_prepare_first("123select {$colname_ep['id']} from $table_ep WHERE {$colname_ep['pgram_id']}=:id", array( ':id' => $id) );


        //echo showParentSaveNote($page_title,$active,$admin_title,"manage.php?id=".$ep_id."&pgram_id=".$id);
	}

    $db->close();


    //echo showParentSaveNote($page_title,$active,$admin_title,"manage.php?id=".$id."&pgram_id=".$pg_id);
}
catch(Exception $e){
	$errorhandle->setException($e); // 收集例外
}

if ($errorhandle->isException()) {
    $errorhandle->showError();
}
?>