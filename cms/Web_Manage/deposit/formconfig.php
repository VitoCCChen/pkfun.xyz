<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]=array("type"=>"hidden","name"=>"ID","column"=>$colname["id"],"sql"=>false);
$fobj[$colname["contents"]]=array("type"=>"textarea","name"=>"備註","column"=>$colname["contents"],'placeholder'=>'請輸入備註',"validate"=>array('maxlength' => '255'));

$fobj[$colname["member_id"]]=array("type"=>"hidden","name"=>"會員","column"=>$colname["member_id"],"sql"=>false);
$fobj[$colname["platform_id"]]=array("type"=>"hidden","name"=>"平台名稱","column"=>$colname["platform_id"],"sql"=>false);

$fobj[$colname["money"]]=array("type"=>"text","name"=>"入款金額","column"=>$colname["money"],'placeholder'=>'請輸入金額',"validate"=>array('maxlength' => '50','digits'=>'yes'),'sql'=>false);
$fobj[$colname["point"]]=array("type"=>"hidden","name"=>"點數","column"=>$colname["point"],'sql'=>false);
$fobj[$colname["agent_id"]]=array("type"=>"text","name"=>"代理ID","column"=>$colname["agent_id"],"sql"=>false);
$fobj[$colname["create_time"]]=array("type"=>"hidden","name"=>"申請時間","column"=>$colname["create_time"],"sql"=>false);

$fhelp->Bind($fobj);
