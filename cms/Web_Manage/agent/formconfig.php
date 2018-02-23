<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]=array("type"=>"hidden","name"=>"ID","column"=>$colname["id"],"sql"=>false);
    $fobj[$colname['agent_id']]=array('type'=>'hidden','name'=>'代理ID','column'=>$colname['agent_id'],'autocomplete'=>'off','placeholder'=>'請輸入代理ID');
    $fobj[$colname['name']]     =array('type'=>'text','name'=>'代理名稱','column'=>$colname['name'],'autocomplete'=>'off','placeholder'=>'請輸入代理名稱','icon'=>'<i class="icon-user"></i>', 'validate' => array('required' => 'yes'));
    $fobj[$colname['email']]=array('type'=>'text','name'=>'E-mail','column'=>$colname['email'],'autocomplete'=>'off','placeholder'=>'請輸入E-mail', 'validate' => array('required' => 'yes'));
    $fobj[$colname["created_time"]]=array("type"=>"hidden","name"=>"建立時間","column"=>$colname["created_time"],"sql"=>false);
$fhelp->Bind($fobj);
