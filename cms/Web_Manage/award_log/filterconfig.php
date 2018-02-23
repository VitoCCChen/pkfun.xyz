<?php
$filterhelp = new coderFilterHelp();
$obj[] = array('type' => 'keyword', 'name' => '關鍵字', 'sql' => true, 'ary' => array(
    array('column' => $colname_m['name'], 'name' => '會員名稱'),
    array('column' => $colname_a['name'], 'name' => '主播名稱')
));
$obj[] = array('type' => 'dategroup', 'column' => 'dategroup', 'sql' => true,'table'=>'t', 'ary' => array(array('column' => $colname['created_date'], 'name' => '申請時間')));
$filterhelp->Bind($obj);