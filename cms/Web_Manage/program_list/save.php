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
        $active=$langary_edit_add['edit'];
        $current_pic = $db->query_prepare_first("SELECT {$colname['thumbnail']} FROM $table WHERE {$colname['id']}=:id",array(':id' => $id));
    }else{
        coderAdmin::vaild($auth,'add');
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
    $data[$colname['manager']]=$adminuser['username'];
    $data[$colname['updatetime']]= $nowtime;


    if($method=='edit'){
        $db->query_update($table,$data," {$colname['id']}='{$id}'");
        //若上傳了新圖，刪掉舊的
        /*if($data[$colname['thumbnail']] != $current_pic[$colname['thumbnail']])
        {
            if(is_file($file_path . $current_pic[$colname['thumbnail']])){
                unlink($file_path.$current_pic[$colname['thumbnail']]);
            }
            if(is_file($file_path . 's'.$current_pic[$colname['thumbnail']])){
                unlink($file_path . 's'.$current_pic[$colname['thumbnail']]);
            }
        }*/
	}else{
        /* ## coder [indInit] --> ## */
        /* ## coder [indInit] <-- ## */
        /* ## coder [insert] --> ## */
        /* ## coder [insert] <-- ## */        
		$data[$colname['createtime']]= $nowtime;
		$id=$db->query_insert($table,$data);
	}

    //coderFormHelp::moveCopyPic($data[$colname['thumbnail']],$admin_path_temp,$file_path,'s');

    //上傳成功，移除temp資料夾的圖檔
    /*if(is_file($admin_path_temp . $data[$colname['thumbnail']])){
        unlink($admin_path_temp.$data[$colname['thumbnail']]);
    }
    if(is_file($admin_path_temp . 's'.$data[$colname['thumbnail']])){
        unlink($admin_path_temp . 's'.$data[$colname['thumbnail']]);
    }*/

    $admin_title=isset($data[$colname['name']]) ? $data[$colname['name']] : '';
    coderAdminLog::insert($adminuser['username'],$main_auth_key,$fun_auth_key,$method,"{$data[$colname['name']]} id:{$id}");


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