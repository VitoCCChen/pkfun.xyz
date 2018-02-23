<?php
$filterhelp = new coderFilterHelp();
$obj[] = array('type' => 'keyword', 'name' => '關鍵字', 'sql' => true, 'ary' => array(
    array('column' => $colname['name'], 'name' => '名稱'),
    array('column' => $colname['manager'], 'name' => '最後管理者')
));
$obj[]=array('type'=>'select','name'=>$langary_Web_Manage_all['bank'],'column'=>$colname['bank_id'],'table'=>'bc','sql'=>true,'ary'=>$bank_array);
$filterhelp->Bind($obj);
