<?php
$help=new coderFilterHelp();
$obj=array();

$ary=array();
$ary[]=array('column'=>$colname['name'],'name'=>$langary_Web_Manage_all['name']);
$ary[]=array('column'=>$colname['username'],'name'=>$langary_Web_Manage_all['username']);
$ary[]=array('column'=>$colname['email'],'name'=>$langary_Web_Manage_all['email']);
$ary[]=array('column'=>$colname['admin'],'name'=>$langary_Web_Manage_all['admin']);
$obj[]=array('type'=>'keyword','name'=>$langary_Web_Manage_all['keyword'],'sql'=>true,'ary'=>$ary);

$obj[]=array('type'=>'select','name'=>$langary_Web_Manage_all['ispublic'],'column'=>$colname['ispublic'],'sql'=>true,
'ary'=>coderHelp::makeAryKeyToAryElement($langary_yn,'value','name')
);

$obj[]=array('type'=>'select','name'=>$langary_Web_Manage_all['r_id'],'column'=>$colname['r_id'],'table'=>'a','sql'=>true,'ary'=>$rules_array, 'default'=>$rules_name);

$help->Bind($obj);
?>