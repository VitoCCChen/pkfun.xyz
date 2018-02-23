<?php
include('_config.php');
$errorhandle=new coderErrorHandle();
try{
	coderAdmin::vaild($auth,'del',1);
	$success=false;
	$count=0;
	$msg=$langary_delservice['msg'];

	$id=request_ary('id',0);

	if(count($id)>0){
		$db = Database::DB();
		$idlist="'".implode("','",$id)."'";
		$row=$db->query_first("select * from $table_admin where {$colname_admin['r_id']} in($idlist) LIMIT 1");
		//if($row){throw new Exception($langary_Web_Manage_all['del2']);}

		$count=$db->exec("delete from $table where {$colname['id']} in($idlist)");

		if($count>0){
			coderAdminLog::insert($adminuser['username'],$main_auth_key,$fun_auth_key,'del',$count.$langary_delservice['insert'].'('.$idlist.')');
			$success=true;
		}
		else{
			throw new Exception($langary_delservice['exception']);
		}
		$db->close();
	}
	else{
		$msg=$langary_delservice['msg2'];
	}

	$result['result']=$success;
	$result['count']=$count;
	$result['msg']=hc($errorhandle->getErrorMessage());
	echo json_encode($result);
}
catch(Exception $e){
	$errorhandle->setException($e); // 收集例外
}

if ($errorhandle->isException()) {
	$result['result']=false;
    $result['msg']=$errorhandle->getErrorMessage();
	echo json_encode($result);
}

?>