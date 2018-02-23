<?php
$filterhelp = new coderFilterHelp();
$obj[] = array('type' => 'keyword', 'name' => '關鍵字', 'sql' => true, 'ary' => array(
    array('table'=>'t','column' => $colname['manager'], 'name' => '最後管理者'),
    array('column' => $colname_m['name'], 'name' => '會員名稱'),
    array('column' => $colname['deposit_id'], 'name' => '入款ID')
));

$obj[] = array('type' => 'dategroup', 'column' => 'dategroup', 'sql' => true,'table'=>'t', 'ary' => array(array('column' => $colname['updated_time'], 'name' => '修改時間')));
$filterhelp->Bind($obj);
