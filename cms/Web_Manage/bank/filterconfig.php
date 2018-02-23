<?php
$filterhelp = new coderFilterHelp();
$obj[] = array('type' => 'keyword', 'name' => '關鍵字', 'sql' => true, 'ary' => array(
    array('column' => $colname['name'], 'name' => '銀行名稱'),
    array('column' => $colname['manager'], 'name' => '最後管理者')
));
$filterhelp->Bind($obj);
