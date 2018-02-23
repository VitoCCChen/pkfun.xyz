<?php
//搜尋欄位
$help=new coderFilterHelp();
$obj=array();

$ary=array();
$ary[]=array('column'=>$colname['name'],'name'=>$langary_Web_Manage_all['r_name']);
$ary[]=array('column'=>$colname['admin'],'name'=>$langary_Web_Manage_all['admin']);
$obj[]=array('type'=>'keyword','name'=>$langary_Web_Manage_all['keyword'],'sql'=>true,'ary'=>$ary);

$obj[]=array('type'=>'select','name'=>$langary_Web_Manage_all['superadmin'],'column'=>$colname['superadmin'],'sql'=>true,
'ary'=>coderHelp::makeAryKeyToAryElement($langary_yn,'value','name')
);

/*$obj[]=array('type'=>'select','name'=>$langary_Web_Manage_all['r_agents'],'column'=>$colname['agents'],'sql'=>true,
    'ary'=>coderHelp::makeAryKeyToAryElement($langary_yn,'value','name')
);*/

$obj[]=array('type'=>'select','name'=>$langary_Web_Manage_all['r_service'],'column'=>$colname['service'],'sql'=>true,
    'ary'=>coderHelp::makeAryKeyToAryElement($langary_yn,'value','name')
);


$obj[]=array('type'=>'dategroup','sql'=>true,'column'=>'dategroup',
'ary'=>array(array('name'=>$langary_Web_Manage_all['update_time'],'column'=>$colname['updatetime']))
);

$help->Bind($obj);
?>