<?php
$filterhelp = new coderFilterHelp();
$obj[] = array('type' => 'keyword', 'name' => '關鍵字', 'sql' => true, 'ary' => array(
    array('column' => $colname_m['name'], 'name' => '玩家名稱'),
));
//$obj[] = array('type' => 'select', 'name' => '公開', 'column' => $colname['is_public'], 'sql' => true, 'ary' => coderHelp::makeAryKeyToAryElement($langary_yn,'value','name'));

$obj[] = array('type' => 'select', 'name' => '交易狀態', 'column' => $colname['ReturnCode'],'table'=>'t', 'sql' => true, 'ary' => coderHelp::makeAryKeyToAryElement($langary_mycard, 'value', 'name'));
$obj[] = array('type' => 'select', 'name' => '請款狀態', 'column' => $colname['PayResult'],'table'=>'t', 'sql' => true, 'ary' => coderHelp::makeAryKeyToAryElement($langary_mycard_pay, 'value', 'name'));
$obj[] = array('type' => 'dategroup', 'column' => 'dategroup', 'sql' => true,'table'=>'t', 'ary' => array(array('column' => $colname['Created_date'], 'name' => '交易時間'), array('column' => $colname['Check_time'], 'name' => '請款時間')));
$filterhelp->Bind($obj);
