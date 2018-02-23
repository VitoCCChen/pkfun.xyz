<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]=array("type"=>"hidden","name"=>"ID","column"=>$colname["id"],"sql"=>false);
    $fobj[$colname['member_id']]=array('type'=>'text','name'=>'登入帳號','column'=>$colname['member_id'],'autocomplete'=>'off','placeholder'=>'請輸入登入帳號', array('required' => 'yes'));
    $fobj[$colname['name']]     =array('type'=>'text','name'=>'會員暱稱','column'=>$colname['name'],'autocomplete'=>'off','placeholder'=>'請輸入會員暱稱','icon'=>'<i class="icon-user"></i>', array('required' => 'yes'));
    $fobj[$colname['platform_id']] = array(
        'type' => 'select', 'name' => '平台名稱', 'column' => $colname['platform_id'], 'ary' => $group_array,"sql"=>false, 'readonly'=> true
    );
    $fobj[$colname['email']]=array('type'=>'text','name'=>'E-mail','column'=>$colname['email'],'autocomplete'=>'off','placeholder'=>'請輸入E-mail', array('required' => 'yes'));
    $fobj[$colname['point']]=array('type'=>'text','name'=>'點數','column'=>$colname['point'],'autocomplete'=>'off','placeholder'=>'請輸入點數',array('required' => 'yes'));
    $fobj[$colname["create_time"]]=array("type"=>"hidden","name"=>"建立時間","column"=>$colname["create_time"],"sql"=>false);
    

$fhelp->Bind($fobj);
