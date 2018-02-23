<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]    =array("type"=>"hidden","name"=>$langary_Web_Manage_all['id'],        "column"=>$colname["id"],"sql"=>false);
$fobj[$colname["name"]]  =array("type"=>"text","name"=>$langary_Web_Manage_all['name2'],       "column"=>$colname["name"],'placeholder'=>$langary_Web_Manage_all['name2_p'],'autocomplete'=>'off','icon'=>'<i class="icon-user"></i>',"validate"=>array('required' => 'yes','maxlength' => '255'));
$fobj[$colname["age"]]   =array("type"=>"text","name"=>$langary_Web_Manage_all['parnerage'],   "column"=>$colname["age"],'placeholder'=>'請輸入年紀','autocomplete'=>'off',"validate"=>array('required' => 'no'));
$fobj[$colname["weight"]]=array("type"=>"text","name"=>$langary_Web_Manage_all['parnerweight'],"column"=>$colname["weight"],'placeholder'=>'請描述身材','autocomplete'=>'off',"validate"=>array('required' => 'no'));


$fhelp->Bind($fobj);
