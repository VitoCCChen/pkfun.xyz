<?php
include('_config.php');
include_once('formconfig.php');
$errorhandle=new coderErrorHandle();
try{
	if(post($colname['id'])>0){
		$method='edit';
		$active=$langary_edit_add['edit'];
	}else{
		coderAdmin::vaild($auth,'add');
		$method='add';
		$active=$langary_edit_add['add'];
		$fhelp->setAttr($colname['password'],'validate',array('required'=>'yes','maxlength'=>'30','minlength'=>6));
	}

	$data=$fhelp->getSendData();
	$error=$fhelp->vaild($data);

	if(count($error)>0){
		$msg=implode('\r\n',$error);
		throw new Exception($msg);
	}
    $newdatetime = datetime();
	$data[$colname['admin']]=$adminuser['username'];
	$data[$colname['updatetime']]=$newdatetime;
    $data[$colname['level']]=1;

	$db = Database::DB();
	if($method=='edit'){
		$username=$data[$colname['username']];
		$s_username = $adminuser['username'];

		unset($data[$colname['username']]);
		
		//非修改自己的資料需要驗證權限
		if($s_username!=$username){
			coderAdmin::vaild($auth,'edit');
		}

		//非有修改會員區權限者不可改權限角色
		if(!coderAdmin::isAuth($auth,coderAdminLog::getActionKey('edit'))){
			unset($data[$colname['ispublic']]);
			unset($data[$colname['r_id']]);
		}
		
		if($data[$colname['password']]==''){
			unset($data[$colname['password']]);
		}else{
			$data[$colname['password']]=coderAdmin::pwHash($data[$colname['password']]);
		}

		$id=$db->query_update($table,$data," {$colname['username']}=:username ",array(':username'=>$username));
		if($s_username===$username){coderAdmin::change_admin_data($username);}
	}else{
		$username=$data[$colname['username']];
		$data[$colname['mid']]=coderAdmin::getmid();
		$data[$colname['password']]=coderAdmin::pwHash($data[$colname['password']]);
        $data[$colname['createtime']]=$newdatetime;
        //紀錄被哪支帳號新增的
        $data[$colname['add_adminid']] = $adminuser['id'];

		if($db->isExisit($table,$colname['username'],$username)){
			throw new Exception($langary_Web_Manage_all['exception'].$username.$langary_Web_Manage_all['exception2']);
		}
		$id=$db->query_insert($table,$data);
	}

	//coderFormHelp::moveCopyPic($data[$colname['pic']],$admin_path_temp,$file_path,'s');

	echo showParentSaveNote($auth['name'],$active,$username,"manage.php?username=".$username);
	coderAdminLog::insert($adminuser['username'],$main_auth_key,$fun_auth_key,$method,$username);
	$db->close();
exit;
}catch(Exception $e){
	$errorhandle->setException($e); // 收集例外
}

if ($errorhandle->isException()) {
	$errorhandle->showError();
}
?>