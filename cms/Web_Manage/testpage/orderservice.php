<?php
include_once('_config.php');
include_once('filterconfig.php');
$errorhandle=new coderErrorHandle();
try{
    coderAdmin::vaild($auth,'edit',1);
    
    $success=false;
    $count=0;
    $msg=$langary_orderservice['msg'];

    $method=post('method',1);//up,down,sortable
    $order_dataary=coderlistorderhelp::getOrderData($method);
    $order_id=$order_dataary['order_id'];
    $order_key=$order_dataary['order_key'];
    $prev_id=$order_dataary['prev_id'];

    $where='';
    $sqlstr=$filterhelp->getSQLStr();
    $where .= $sqlstr->SQL!=''?' AND '.$sqlstr->SQL:'';

    if($order_id>0 && $order_id!=""){
        $db = Database::DB();
        try{
            coderlistorderhelp::dochangeOrder($method,$orderDesc,$table,$orderColumn,$order_id,$order_key,$prev_id,$where);

            coderAdminLog::insert($adminuser['username'],$main_auth_key,$fun_auth_key,'edit',$langary_orderservice['insert']);
            $success=true;
        }
        catch(Execption $e){
            $msg=$e->getMessage();
        }
    }
    else{
        $msg=$langary_orderservice['msg2'];
    }

    $result['result']=$success;
    $result['count']=$count;
    $result['msg']=$msg;
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