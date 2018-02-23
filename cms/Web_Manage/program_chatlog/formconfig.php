<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]       =array("type"=>"hidden","name"=>$langary_Web_Manage_all['id'],       "column"=>$colname["id"],"sql"=>false);
$fobj[$colname_cl["id"]]       =array("type"=>"hidden","name"=>$langary_Web_Manage_all['id'],       "column"=>$colname_cl["id"],"sql"=>false);
$fobj[$colname_cl["record_id"]]       =array("type"=>"hidden","name"=>$langary_Web_Manage_all['id'],       "column"=>$colname_cl["record_id"],"sql"=>false);
$fobj[$colname["name"]]        =array("type"=>"text","name"=>$langary_Web_Manage_all['pgram_name'], "column"=>$colname["name"],             'placeholder'=>$langary_Web_Manage_all['name2_p'],'autocomplete'=>'off','icon'=>'<i class="icon-user"></i>',"validate"=>array('required' => 'yes','maxlength' => '255'));
$fobj[$colname_cl['chatlog']]  =array("type"=>"text","name"=>'聊天紀錄',                       "column"=>$colname_cl['chatlog'],       'placeholder'=>'請輸入聊天紀錄', 'autocomplete'=>'off', 'equal'=>'=',"validate"=>array('required' => 'yes'));

$fhelp->Bind($fobj);
