<?php
$filterhelp = new coderFilterHelp();
$obj[] = array('type' => 'keyword', 'name' => '關鍵字', 'sql' => true,'table'=>'t', 'ary' => array(
    array('column' => $colname_m['name'], 'name' => '玩家名稱'),
    array('column' => $colname['manager'], 'name' => '最後管理者')
));
$obj[] = array('type' => 'select', 'name' => '狀態', 'column' => $colname['is_pay'],'table'=>'t', 'sql' => true, 'ary' => coderHelp::makeAryKeyToAryElement($langary_transfers, 'value', 'name'));
$obj[] = array('type' => 'dategroup', 'column' => 'dategroup','table'=>'t', 'sql' => true, 'ary' => array(array('column' => $colname['create_time'], 'name' => '申請時間'), array('column' => $colname['update_time'], 'name' => '審核時間')));
$filterhelp->Bind($obj);
