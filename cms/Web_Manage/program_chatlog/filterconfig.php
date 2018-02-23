<?php
$filterhelp = new coderFilterHelp();
$obj[] = array('type' => 'keyword', 'name' => '關鍵字', 'sql' => true, 'ary' => array(
    array('column' => $colname_cl['id'], 'name' => '聊天紀錄ID'),
    array('column' => $colname_cl['chatlog'], 'name' => '聊天紀錄')
));
$obj[] = array('type' => 'dategroup', 'column' => 'dategroup', 'sql' => true,'table'=>'t', 'ary' => array(array('column' => $colname_cl['createtime'], 'name' => '建立時間')));
$filterhelp->Bind($obj);