<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname['id']]=array('type'=>'hidden','name'=>$langary_Web_Manage_all['id'],'column'=>$colname['id'],'sql'=>false);
$fobj[$colname['ispublic']]=array('type'=>'checkbox','name'=>$langary_Web_Manage_all['ispublic'],'column'=>$colname['ispublic'],'value'=>'1','default'=>'1');
$fobj[$colname['username']]=array('type'=>'text','name'=>$langary_Web_Manage_all['username'],'column'=>$colname['username'],'autocomplete'=>'off','placeholder'=>$langary_Web_Manage_all['username_p'],'help'=>$langary_Web_Manage_all['username_h'],'validate'=>array('required'=>'yes','maxlength'=>'20','minlength'=>'3'),'icon'=>'<i class="icon-user"></i>');
$fobj[$colname['password']]=array('type'=>'password','name'=>$langary_Web_Manage_all['password'],'column'=>$colname['password'],'autocomplete'=>'off','placeholder'=>$langary_Web_Manage_all['password_p'],'help'=>$langary_Web_Manage_all['password_h'],'validate'=>array('maxlength'=>'30','minlength'=>'6'),'icon'=>'<i class="icon-key"></i>');
$fobj['repassword']=array('type'=>'password','name'=>$langary_Web_Manage_all['repassword'],'column'=>$colname['password'],'autocomplete'=>'off','placeholder'=>$langary_Web_Manage_all['repassword_p'],'help'=>$langary_Web_Manage_all['repassword_h'],'sql'=>false,'icon'=>'<i class="icon-check-sign"></i>');
$fobj[$colname['name']]=array('type'=>'text','name'=>"管理員名稱",'column'=>$colname['name'],'placeholder'=>$langary_Web_Manage_all['name_p'],'validate'=>array('required'=>'yes'));
$fobj[$colname['email']]=array('type'=>'text','name'=>$langary_Web_Manage_all['email'],'column'=>$colname['email'],'placeholder'=>$langary_Web_Manage_all['email_p'],'validate'=>array('required'=>'yes','email'=>'yes'));

$fobj[$colname['r_id']] = array(
    'type' => 'select', 'name' => $langary_Web_Manage_all['r_id'], 'column' => $colname['r_id'], 'ary' => $rules_array, 'validate' => array(
        'required' => 'yes'
    )
);
/*$fobj[$colname['pic']]=array('type'=>'pic','name'=>$langary_Web_Manage_all['pic'],'column'=>$colname['pic'], 'validate' => array(
        'required' => 'yes'
    ));*/
$fhelp->Bind($fobj);
?>