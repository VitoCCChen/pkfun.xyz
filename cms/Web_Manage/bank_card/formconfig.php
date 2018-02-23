<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]=array("type"=>"hidden","name"=>"ID","column"=>$colname["id"],"sql"=>false);
$fobj[$colname["name"]]=array("type"=>"text","name"=>"名稱","column"=>$colname["name"],'placeholder'=>'請輸入帳戶名稱',"validate"=>array('required' => 'yes','maxlength' => '50'));
$fobj[$colname['bank_id']] = array(
    'type' => 'select', 'name' => $langary_Web_Manage_all['bank'], 'column' => $colname['bank_id'], 'ary' => $bank_array, 'validate' => array(
        'required' => 'yes'
    )
);
$fobj[$colname["bank_card_no"]]=array("type"=>"text","name"=>"卡號","column"=>$colname["bank_card_no"],'placeholder'=>'請輸入卡號',"validate"=>array('required' => 'yes','maxlength' => '50'));
$fhelp->Bind($fobj);
