<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]=array("type"=>"hidden","name"=>$langary_Web_Manage_all['id'],"column"=>$colname["id"],"sql"=>false);
$fobj[$colname["name"]]=array("type"=>"text","name"=>$langary_Web_Manage_all['name2'],"column"=>$colname["name"],'placeholder'=>$langary_Web_Manage_all['name2_p'],"validate"=>array('required' => 'yes','maxlength' => '255'));

$fhelp->Bind($fobj);
