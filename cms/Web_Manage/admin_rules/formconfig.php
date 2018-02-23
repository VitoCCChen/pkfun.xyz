<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname['id']]=array('type'=>'hidden','name'=>$langary_Web_Manage_all['id'],'column'=>$colname['id'],'sql'=>false);
$fobj[$colname['name']]=array('type'=>'text','name'=>$langary_Web_Manage_all['r_name'],'column'=>$colname['name'],'placeholder'=>$langary_Web_Manage_all['r_name_p'],'validate'=>array('required'=>'yes'));
$fobj[$colname['superadmin']]=array('type'=>'checkbox','name'=>$langary_Web_Manage_all['superadmin'],'column'=>$colname['superadmin'],'value'=>'1','default'=>'0','help'=>$langary_Web_Manage_all['superadmin_h']);
$fobj[$colname['depiction']]=array('type'=>'textarea','name'=>$langary_Web_Manage_all['depiction'],'column'=>$colname['depiction'],'placeholder'=>$langary_Web_Manage_all['depiction_p']);

//$fobj[$colname['agents']]=array('type'=>'checkbox','name'=>$langary_Web_Manage_all['r_agents'],'column'=>$colname['agents'],'value'=>'1','default'=>'0','help'=>$langary_Web_Manage_all['r_agents_h']);

$fobj[$colname['service']]=array('type'=>'checkbox','name'=>$langary_Web_Manage_all['r_service'],'column'=>$colname['service'],'value'=>'1','default'=>'0','help'=>$langary_Web_Manage_all['r_service_h']);
$fhelp->Bind($fobj);
?>