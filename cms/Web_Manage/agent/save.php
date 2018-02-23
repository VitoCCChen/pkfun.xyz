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

    if(count($error)>0){
        $msg=implode('<br/>',$error);
        throw new Exception($msg);
    }


    $nowtime = datetime();
    $data[$colname['manager']]=$adminuser['username'];
    $data[$colname['updated_time']]= $nowtime;



    if($method=='edit'){
        $db->query_update($table,$data," {$colname['id']}='{$id}'");
	}else{
        for($j=0;$j<pow(16,4);$j++){
            for($i=0;$i<4;$i++){
                @$num .=strtoupper(dechex(rand(0,15)));
            }
            $avoidrepeat = $db->query_prepare_first("SELECT COUNT({$colname["agent_id"]}) FROM $table WHERE {$colname["agent_id"]}=:agent_id",array(':agent_id' => $num));
            if($avoidrepeat['COUNT(agent_id)'] == 0 )
                break;
        }

        $data[$colname['created_time']]= $nowtime;
        $data[$colname['agent_id']] = $num;
        $data[$colname['name']] = post($colname['name'],1); 
        $data[$colname['email']] = post($colname['email'],1);
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