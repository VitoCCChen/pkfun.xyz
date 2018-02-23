<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]=array("type"=>"hidden","name"=>"ID","column"=>$colname["id"],"sql"=>false);
$fobj[$colname["contents"]]=array("type"=>"textarea","name"=>"備註","column"=>$colname["contents"],'placeholder'=>'請輸入備註',"validate"=>array('maxlength' => '255'));

$fobj[$colname["member_id"]]=array("type"=>"hidden","name"=>"會員","column"=>$colname["member_id"],"sql"=>false);
$fobj[$colname["platform_id"]]=array("type"=>"hidden","name"=>"平台名稱","column"=>$colname["platform_id"],"sql"=>false);
$fobj[$colname["pay_code"]]=array("type"=>"hidden","name"=>"第三方支付序號","column"=>$colname["pay_code"],"sql"=>false);
$fobj[$colname["agent_id"]]=array("type"=>"hidden","name"=>"代理ID","column"=>$colname["agent_id"],"sql"=>false);
$fobj[$colname["money"]]=array("type"=>"text","name"=>"金額","column"=>$colname["money"],'placeholder'=>'請輸入金額',"validate"=>array('maxlength' => '50','digits'=>'yes'),'sql'=>false);
$fobj[$colname["point"]]=array("type"=>"hidden","name"=>"點數","column"=>$colname["point"],"sql"=>false);
$fobj[$colname["status"]]=array("type"=>"radio","name"=>"狀態","column"=>$colname["status"],'ary'=>coderHelp::makeAryKeyToAryElement($langary_transfers_manage,'key','name'),'mode'=>'no',"placeholder"=>"請設定狀態","equal"=>"=");
$fhelp->Bind($fobj);
