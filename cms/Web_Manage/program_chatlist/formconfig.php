<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]       =array("type"=>"hidden","name"=>$langary_Web_Manage_all['id'],       "column"=>$colname["id"],"sql"=>false);
$fobj[$colname_ep["id"]]       =array("type"=>"hidden","name"=>$langary_Web_Manage_all['id'],       "column"=>$colname_ep["id"],"sql"=>false);
$fobj[$colname["name"]]        =array("type"=>"text","name"=>$langary_Web_Manage_all['pgram_name'], "column"=>$colname["name"],             'placeholder'=>$langary_Web_Manage_all['name2_p'],'autocomplete'=>'off','icon'=>'<i class="icon-user"></i>',"validate"=>array('required' => 'yes','maxlength' => '255'));
$fobj[$colname_ep['anchors']]  =array("type"=>"selectmutile","name"=>'節目主播',                       "column"=>$colname_ep['anchors'],       'placeholder'=>'請點選主播', 'ary' => $anchors_array, 'autocomplete'=>'off', 'equal'=>'=', 'mode'=>'no',"validate"=>array('required' => 'yes'));

$fhelp->Bind($fobj);
