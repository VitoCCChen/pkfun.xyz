<?php
$filterhelp = new coderFilterHelp();
$obj[] = array('type' => 'keyword', 'name' => '關鍵字', 'sql' => true, 'ary' => array(
    array('column' => $colname['name'], 'name' => '主播名稱')
));
$obj[] = array('type' => 'dategroup', 'column' => 'dategroup', 'sql' => true, 'ary' => array(array('column' => $colname['create_time'], 'name' => $langary_Web_Manage_all['create_time']), array('column' => $colname['update_time'], 'name' => $langary_Web_Manage_all['update_time'])));
$filterhelp->Bind($obj);
