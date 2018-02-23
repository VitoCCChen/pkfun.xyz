<?php
$filterhelp = new coderFilterHelp();
$obj[] = array('type' => 'keyword', 'name' => '關鍵字', 'sql' => true, 'ary' => array(
    array('table'=>'t','column' => $colname['last_manager'], 'name' => '最後管理者')
));

$obj[] = array('type' => 'dategroup', 'column' => 'dategroup', 'sql' => true,'table'=>'t','ary' => array(array('column' => $colname['updated_time'], 'name' => '修改時間')));
$filterhelp->Bind($obj);
