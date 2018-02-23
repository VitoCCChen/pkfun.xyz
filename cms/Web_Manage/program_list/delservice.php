<?php
include_once('_config.php');
$errorhandle=new coderErrorHandle();
try{
	coderAdmin::vaild($auth,'del');
	
	$success=false;
	$count=0;
	$msg=$langary_delservice['msg'];

	$id=request_ary('id',0);


	if(count($id)>0){
		$db = Database::DB();
		$idlist="'".implode("','",$id)."'";
        $imglist = $db->fetch_all_array("select `{$colname['thumbnail']}` from $table  WHERE `{$colname['id']}` in ($idlist)");

		$count=$db->exec("delete from $table where `{$colname['id']}` in($idlist)");
        for($i=0;$i<count($imglist);$i++) {
            if ($imglist[$i][$colname['thumbnail']] != "")
            {
                @unlink($file_path.$imglist[$i][$colname['thumbnail']]);
                @unlink($file_path.'s'.$imglist[$i][$colname['thumbnail']]);
            }
	    }

		if($count>0){
			$success=true;
			coderAdminLog::insert($adminuser['username'],$main_auth_key,$fun_auth_key,'del',$count.$langary_delservice['insert'].'('.$idlist.')');
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