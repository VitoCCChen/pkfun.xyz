<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]=array("type"=>"hidden","name"=>"ID","column"=>$colname["id"],"sql"=>false);
$fobj[$colname["name"]]=array("type"=>"text","name"=>"名稱","column"=>$colname["name"],'placeholder'=>'請輸入名稱',"validate"=>array('required' => 'yes','maxlength' => '60'));


$fhelp->Bind($fobj);
