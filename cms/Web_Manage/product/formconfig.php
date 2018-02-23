<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]=array("type"=>"hidden","name"=>"ID","column"=>$colname["id"],"sql"=>false);
    $fobj[$colname['name']]=array('type'=>'text','name'=>'產品名稱','column'=>$colname['name'],'autocomplete'=>'off','placeholder'=>'請輸入產品名稱','validate'=>array('required'=>'yes'));
    $fobj[$colname['amount']]=array('type'=>'text','name'=>'金額','column'=>$colname['amount'],'autocomplete'=>'off','placeholder'=>'請輸入產品金額','validate'=>array('required'=>'yes'));
    $fobj[$colname['point']]=array('type'=>'text','name'=>'點數','column'=>$colname['point'],'autocomplete'=>'off','placeholder'=>'請設定點數','validate'=>array('required'=>'yes'));
    $fobj[$colname['bonus']]=array('type'=>'text','name'=>'紅利','column'=>$colname['bonus'],'autocomplete'=>'off','placeholder'=>'請設定紅利點數','validate'=>array('required'=>'yes'));
    $fobj[$colname['ratio']]=array('type'=>'hidden','name'=>'比值','column'=>$colname['ratio']);
    $fobj[$colname["create_time"]]=array("type"=>"hidden","name"=>"建立時間","column"=>$colname["create_time"],"sql"=>false);
    $fobj[$colname["status"]]=array("type"=>"radio","name"=>"狀態","column"=>$colname["status"],'ary'=>coderHelp::makeAryKeyToAryElement($langary_transfers_product,'key','name'),'mode'=>'no',"placeholder"=>"請設定狀態","equal"=>"=");
$fhelp->Bind($fobj);
