<?php
include_once('_config.php');
$errorhandle=new coderErrorHandle();
try{
	$success=false;
	$count=0;
	$msg=$langary_delservice['msg'];

	$id=request_ary('id',0);

	if(count($id)>0){
		$db = Database::DB();
		$idlist="'".implode("','",$id)."'";

		$count=$db->exec("delete from $table_ep where `{$colname_ep['id']}` in($idlist)");
        $count_2=$db->exec("delete from $table_cl where `{$colname_cl['record_id']}` in($idlist)");
		if($count>0){
			$success=true;
		}
		else{
            echo "<script>alert('update error')</script>";
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