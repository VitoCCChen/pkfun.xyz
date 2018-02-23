<?php
$filterhelp = new coderFilterHelp();
$obj[] = array(
            'type' => 'keyword', 'name' => $langary_Web_Manage_all['keyword'], 'sql' => true, 'ary' =>
            array(
                array('column' => $colname['id'], 'name' => $langary_Web_Manage_all['id']),
                array('column' => $colname['name'], 'name' => $langary_Web_Manage_all['pgram_name']),
                array('column' => $colname['manager'], 'name' => $langary_Web_Manage_all['manager'])
            )
        );

$obj[] = array(
            'type' => 'dategroup', 'column' => 'dategroup', 'sql' => true, 'ary' =>
            array(
                array('column' => $colname['createtime'], 'name' => $langary_Web_Manage_all['create_time']),
                array('column' => $colname['updatetime'], 'name' => $langary_Web_Manage_all['update_time'])
            )
        );
$filterhelp->Bind($obj);
