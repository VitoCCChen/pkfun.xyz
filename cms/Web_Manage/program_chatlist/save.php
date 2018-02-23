<?php
include_once('_config.php');
include_once('formconfig.php');

$errorhandle=new coderErrorHandle();
try{
    $db = Database::DB();
    $id = post($colname['id'],1);
    $pg_id = post($colname_ep['id'],1);
    if($id!=""){
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
    $data[$colname_ep['manage']]=$adminuser['username'];
    $data[$colname_ep['updatetime']]= $nowtime;

    $admin_title=isset($data[$colname['name']]) ? $data[$colname['name']] : '';

    if($method=='edit'){
        unset($data[$colname['name']]);
        $db->query_update($table_ep, $data," {$colname_ep['id']}='{$pg_id}'");
	}else{
		$data[$colname['createtime']]= $nowtime;
		$id=$db->query_insert($table,$data);
	}

    $db->close();

    echo showParentSaveNote($page_title,$active,$admin_title,"manage.php?id=".$id."&pgram_id=".$pg_id);
}
catch(Exception $e){
	$errorhandle->setException($e); // 收集例外
}

if ($errorhandle->isException()) {
    $errorhandle->showError();
}
?>