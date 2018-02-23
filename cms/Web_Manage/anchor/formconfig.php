<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]=array("type"=>"hidden","name"=>"ID","column"=>$colname["id"],"sql"=>false);
    $fobj[$colname['name']]=array('type'=>'text','name'=>'主播名稱','column'=>$colname['name'],'autocomplete'=>'off','placeholder'=>'請輸入主播名稱','icon'=>'<i class="icon-user"></i>');
    $fobj[$colname['email']]=array('type'=>'text','name'=>'E-mail','column'=>$colname['email'],'autocomplete'=>'off','placeholder'=>'請輸入E-mail');
    $fobj[$colname['point']]=array('type'=>'text','name'=>'積分','column'=>$colname['point'],'autocomplete'=>'off','placeholder'=>'請輸入積分','icon'=>'<i class="icon-user"></i>');
    $fobj[$colname["create_time"]]=array("type"=>"hidden","name"=>"建立時間","column"=>$colname["create_time"],"sql"=>false);
    

$fhelp->Bind($fobj);
