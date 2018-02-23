<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]       =array("type"=>"hidden","name"=>$langary_Web_Manage_all['id'],       "column"=>$colname["id"],"sql"=>false);
$fobj[$colname_ep["id"]]       =array("type"=>"hidden","name"=>$langary_Web_Manage_all['id'],       "column"=>$colname_ep["id"],"sql"=>false);
$fobj[$colname["name"]]        =array("type"=>"text","name"=>$langary_Web_Manage_all['pgram_name'], "column"=>$colname["name"],             'placeholder'=>$langary_Web_Manage_all['name2_p'],'autocomplete'=>'off','icon'=>'<i class="icon-user"></i>',"validate"=>array('required' => 'yes','maxlength' => '255'));
$fobj[$colname_ep['anchors']]  =array("type"=>"selectmutile","name"=>'節目主播',                       "column"=>$colname_ep['anchors'],       'placeholder'=>'請點選主播', 'ary' => $anchors_array, 'autocomplete'=>'off', 'equal'=>'=', 'mode'=>'no',"validate"=>array('required' => 'yes'));
$fobj[$colname_ep['start_time']]  =array("type"=>"text","name"=>'開始時間',                       "column"=>$colname_ep['start_time'],       'placeholder'=>'請點選開始時間', 'autocomplete'=>'off',"validate"=>array('required' => 'yes', 'timePicker' => 'yes'));
$fobj[$colname_ep['end_time']]  =array("type"=>"text","name"=>'結束時間',                       "column"=>$colname_ep['end_time'],       'placeholder'=>'請點選結束時間', 'autocomplete'=>'off',"validate"=>array('required' => 'yes', 'timePicker' => 'yes') );
$fobj[$colname_ep['updatetime']]  =array("type"=>"hidden","name"=>'更新時間',                       "column"=>$colname_ep['updatetime']);
$fobj[$colname_ep['createtime']]  =array("type"=>"hidden","name"=>'建立時間',                       "column"=>$colname_ep['createtime']);

$fhelp->Bind($fobj);
