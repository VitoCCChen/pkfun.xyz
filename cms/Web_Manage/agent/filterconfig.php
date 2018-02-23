<?php
$filterhelp = new coderFilterHelp();
$obj[] = array('type' => 'keyword', 'name' => '關鍵字', 'sql' => true, 'ary' => array(
    array('column' => $colname['agent_id'], 'name' => '代理ID'),
    array('column' => $colname['name'], 'name' => '代理名稱')
));
$obj[] = array('type' => 'dategroup', 'column' => 'dategroup', 'sql' => true, 'table'=>'m','ary' => array(array('column' => $colname['created_time'], 'name' => '申請時間')));
$filterhelp->Bind($obj);
