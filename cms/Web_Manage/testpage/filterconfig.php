<?php
$filterhelp = new coderFilterHelp();
$obj[] =
    array('type' => 'keyword', 'name' => $langary_Web_Manage_all['keyword'], 'sql' => true, 'ary' => array(
        array('column' => $colname['id'], 'name' => $langary_Web_Manage_all['id']),
        array('column' => $colname['name'], 'name' => $langary_Web_Manage_all['parnername']),
        array('column' => $colname['age'], 'name' => $langary_Web_Manage_all['parnerage']),
        array('column' => $colname['weight'], 'name' => $langary_Web_Manage_all['parnerweight'])
));

//$obj[] = array('type' => 'dategroup', 'column' => 'dategroup', 'sql' => true, 'ary' => array(array('column' => $colname['create_time'], 'name' => $langary_Web_Manage_all['create_time']), array('column' => $colname['update_time'], 'name' => $langary_Web_Manage_all['update_time'])));
$filterhelp->Bind($obj);
