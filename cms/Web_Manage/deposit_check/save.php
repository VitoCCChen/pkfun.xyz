<?php
include_once('_config.php');
include_once('formconfig.php');

$errorhandle = new coderErrorHandle();
try {
    $db = Database::DB();
    $id = post($colname['id'], 1);
    if ($id != "") {
        coderAdmin::vaild($auth, 'edit');
        $method = 'edit';
        $active = '編輯';
    } else {
        coderAdmin::vaild($auth, 'add');
        $method = 'add';
        $active = '新增';
    }

    $data = $fhelp->getSendData();
    $error = $fhelp->vaild($data);
    if (count($error) > 0) {
        $msg = implode('<br/>', $error);
        throw new Exception($msg);
    }

    //多圖圖片
    //$picgroup = $data[$colname['picgroup']];
    //$data[$colname['picgroup']] = json_encode($picgroup);

    /* ## coder [beforeModify] --> ## */
    /* ## coder [beforeModify] <-- ## */

    $nowtime = datetime();
    $data[$colname['manager']] = $adminuser['username'];
    $data[$colname['update_time']] = $nowtime;
    $data[$colname['check_time']]= $nowtime;    

    $nowstatus = post("nowstatus");
    if ($method == 'edit') {
        $row = $db->query_prepare_first("select * from $table  WHERE {$colname['id']}=:id", array(':id' => $id));
        if($row[$colname['status']] == 3){
            $data[$colname['status']] = 3;
        }else if(post('status',1)){
            $transPoint = new coderPointHelp();
            $transPoint->MoneyToPoint($row[$colname['member_id']],$row[$colname['point']]);
        }
 
        $db->query_update($table, $data, " {$colname['id']}='{$id}'");
    } else {
        /* ## coder [indInit] --> ## */
        //$data[$colname["ind"]]=coderListOrderHelp::getMaxInd($table,$colname["ind"]);
        /* ## coder [indInit] <-- ## */
        /* ## coder [insert] --> ## */
        /* ## coder [insert] <-- ## */

        $data[$colname['member_id']] = post($colname['member_id'],1);
        // if(!class_player::getList_agidone($pid,$data[$colname['member_id']])){
        //     throw new Exception("玩家錯誤!");
        // }


        //$data[$colname['amount']] = post($colname['amount'],1);
        $data[$colname['money']] = post($colname['money'],1);
        //$data[$colname['cash']] = post($colname['cash'],1);
        //$data[$colname['paycash']] = post($colname['paycash'],1);
        $data[$colname['company']] = post($colname['company'],1);
        $data[$colname['method']] = post($colname['method'],1);
        $data[$colname['create_time']] = $nowtime;
        //$data[$colname['type']] = $_type;
        $id = $db->query_insert($table, $data);
    }


    $admin_title = isset($data[$colname['id']]) ? $data[$colname['id']] : '';
    coderAdminLog::insert($adminuser['username'], $main_auth_key, $fun_auth_key, $method, "id:{$id}");


    $db->close();

    echo showParentSaveNote($page_title, $active, $admin_title, "manage.php?id=" . $id);
} catch (Exception $e) {
    $errorhandle->setException($e); // 收集例外
}

if ($errorhandle->isException()) {
    $errorhandle->showError();
}
?>