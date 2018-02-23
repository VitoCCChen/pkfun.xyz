<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]     =array("type"=>"hidden","name"=>$langary_Web_Manage_all['id'],       "column"=>$colname["id"],"sql"=>false);
$fobj[$colname["name"]]   =array("type"=>"text","name"=>$langary_Web_Manage_all['tag_name'], "column"=>$colname["name"],  'placeholder'=>'請輸入標籤名稱','autocomplete'=>'off','icon'=>'<i class="icon-tag"></i>',"validate"=>array('required' => 'yes'));
$fobj[$colname["status"]] =array("type"=>"radio","name"=>$langary_Web_Manage_all['status'],  "column"=>$colname["status"],'ary'=>coderHelp::makeAryKeyToAryElement($langary_agents_link,'key','name'),'mode'=>'no', 'placeholder'=>'請設定標籤狀態',"equal"=>"=","validate"=>array('required' => 'yes'));

$fhelp->Bind($fobj);
