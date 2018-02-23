<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]=array("type"=>"hidden","name"=>"ID","column"=>$colname["id"],"sql"=>false);
$fobj[$colname["is_pay"]]=array("type"=>"checkbox","name"=>"是否出款","column"=>$colname["is_pay"],"value"=>"1");
$fobj[$colname["member_id"]]=array("type"=>"hidden","name"=>"會員","column"=>$colname["member_id"],"sql"=>false);
$fobj[$colname["platform_id"]]=array("type"=>"hidden","name"=>"平台名稱","column"=>$colname["platform_id"],"sql"=>false);

$fobj[$colname['bank_id']] = array(
    'type' => 'select', 'name' => '會員銀行', 'column' => $colname['bank_id'], 'ary' => $bank_array,"sql"=>false
);
$fobj[$colname["num"]]=array("type"=>"text","name"=>"會員銀行卡號","column"=>$colname["num"],'placeholder'=>'請輸入會員銀行卡號',"validate"=>array('maxlength' => '50','number' => 'yes'),"sql"=>false);
$fobj[$colname["money"]]=array("type"=>"text","name"=>"出款金額","column"=>$colname["money"],'placeholder'=>'請輸入金額',"validate"=>array('maxlength' => '11','number' => 'yes'),"sql"=>false);
//$fobj[$colname["create_time"]]=array("type"=>"text","name"=>"申請時間","column"=>$colname["create_time"],'placeholder'=>'請輸入申請時間',"validate"=>array('required' => 'yes','maxlength' => '11','number' => 'yes'));
//$fobj[$colname["update_time"]]=array("type"=>"text","name"=>"審核時間","column"=>$colname["update_time"],'placeholder'=>'請輸入審核時間',"validate"=>array('required' => 'yes','maxlength' => '11','number' => 'yes'));
$fobj[$colname["contents"]]=array("type"=>"textarea","name"=>"意見","column"=>$colname["contents"],'placeholder'=>'請輸入意見');


$fhelp->Bind($fobj);
