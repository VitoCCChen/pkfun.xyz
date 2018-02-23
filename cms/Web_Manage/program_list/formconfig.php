<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]          =array("type"=>"hidden","name"=>$langary_Web_Manage_all['id'],       "column"=>$colname["id"],"sql"=>false);
$fobj[$colname["name"]]        =array("type"=>"text","name"=>$langary_Web_Manage_all['pgram_name'], "column"=>$colname["name"],         'placeholder'=>$langary_Web_Manage_all['name2_p'],'autocomplete'=>'off','icon'=>'<i class="icon-user"></i>',"validate"=>array('required' => 'yes','maxlength' => '255'));
$fobj[$colname["description"]] =array("type"=>"textarea","name"=>$langary_Web_Manage_all['depiction'],  "column"=>$colname["description"],  'placeholder'=>$langary_Web_Manage_all['depiction_p'],'autocomplete'=>'off',"validate"=>array('required' => 'yes'));
$fobj[$colname["thumbnail"]]   =array("type"=>"text","name"=>$langary_Web_Manage_all['pic2'],  "column"=>$colname["thumbnail"]);
$fobj[$colname["url"]]         =array("type"=>"text","name"=>$langary_Web_Manage_all['url'],        "column"=>$colname["url"],          'placeholder'=>'請輸入'.$langary_Web_Manage_all['url'],'autocomplete'=>'off',"validate"=>array('required' => 'yes'));
$fobj[$colname["tag"]]         =array("type"=>"selectmutile","name"=>$langary_Web_Manage_all['tag'],      "column"=>$colname["tag"],          'placeholder'=>'請輸入'.$langary_Web_Manage_all['tag'],'ary' => $tags_array,'autocomplete'=>'off','equal'=>'=','mode'=>'no',"validate"=>array('required' => 'yes'));
$fobj[$colname["showtime"]]    =array("type"=>"text","name"=>$langary_Web_Manage_all['showtime'],   "column"=>$colname["showtime"],     'placeholder'=>'請輸入'.$langary_Web_Manage_all['showtime'],'autocomplete'=>'off',"validate"=>array('required' => 'yes'));

$fhelp->Bind($fobj);
