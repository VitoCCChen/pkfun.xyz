<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]=array("type"=>"hidden","name"=>"ID","column"=>$colname["id"],"sql"=>false);
$fobj[$colname["name"]]=array("type"=>"text","name"=>"銀行名稱","column"=>$colname["name"],'placeholder'=>'請輸入名稱',"validate"=>array('required' => 'yes','maxlength' => '60'));
$fobj[$colname["bank_no"]]=array("type"=>"text","name"=>"銀行代碼","column"=>$colname["bank_no"],'placeholder'=>'請輸入代碼',"validate"=>array('required' => 'yes','maxlength' => '50'));
$fobj[$colname["create_time"]]=array("type"=>"text","name"=>"申請時間","column"=>$colname["create_time"],'placeholder'=>'請輸入申請時間',"validate"=>array('required' => 'yes','maxlength' => '11','number' => 'yes'));



$fhelp->Bind($fobj);
