<?php
$filterhelp = new coderFilterHelp();
$obj[] = array('type' => 'keyword', 'name' => '關鍵字', 'sql' => true, 'ary' => array(
    array('column' => $colname['name'], 'name' => '產品名稱'),
));
$obj[] = array('type' => 'dategroup', 'column' => 'dategroup', 'sql' => true, 'table'=>'g','ary' => array(array('column' => $colname['create_time'], 'name' => '建立時間'), array('column' => $colname['update_time'], 'name' => '最後修改時間')));
$filterhelp->Bind($obj);
