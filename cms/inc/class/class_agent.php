<?php
class class_agent
{
    private static $_ary1 = null;

    public static function getList()
    { //
        global $db;
        $colname = coderDBConf::$col_agent;
        if (self::$_ary1 == null) {
            $sql = "select {$colname['name']} as name,{$colname['id']} as value
                    from " . coderDBConf::$agent . "
                    ORDER BY `{$colname['id']}` DESC";

            self::$_ary1 = $db->fetch_all_array($sql);
        }
        return self::$_ary1;
    }

    public static function getName($_val)
    {
        $ary = self::getList();
        return coderHelp::getArrayPropertyVal($ary, 'value', $_val, 'username');
    }

    public static function getList_one($id)
    {
        global $db;
        $colname = coderDBConf::$col_agent;
        $sql = "select *
                from " . coderDBConf::$agent . "
                where {$colname['id']} = $id
                ORDER BY `{$colname['id']}` DESC";
        return $db->query_prepare_first($sql);
    }

    public static function getList_admin($id)
    {
        global $db;
        $colname = coderDBConf::$col_agent;
        $sql = "select *
                from " . coderDBConf::$agent . "
                where {$colname['admin_id']} = $id
                ORDER BY `{$colname['id']}` DESC";
        return $db->query_prepare_first($sql);
    }

    public static function getList_agent($id)
    {
        global $db;
        $colname = coderDBConf::$col_agent;
        $sql = "select *
                from " . coderDBConf::$agent . "
                where {$colname['id']} = $id
                ORDER BY `{$colname['id']}` DESC";
        return $db->query_prepare_first($sql);
    }

    /**
     *  $colname 為陣列 如果登入為客服 就讀取 serviceid ID
     *  first 前贅詞
     **/
    public static function getWhere_lv($colname,$where,$first)
    {
        global $db,$adminuser;
        if($adminuser['type'] > 1){
            if($adminuser['type'] == '4'){
                $where .= ($where == '' ? '' : ' AND ') . $first."`{$colname['agent_id']}` = " . $adminuser['serviceid'];
            }
            else {
                $where .= ($where == '' ? '' : ' AND ') . $first."`{$colname['agent_id']}` = " . $adminuser['id'];
            }
        }
        return $where;
    }

    public static function getWhere_lv_upid($colname,$where,$text,$first)
    {
        global $db,$adminuser;
        if($adminuser['type'] > 1){
            $where .= ($where==''?'':' AND ').$first."{$colname[$text]} = ".($adminuser['type'] == '4'?$adminuser['serviceid']:$adminuser['id']);
        }
        return $where;
    }

    public static function getnow_adid() //客服也會來新增 判斷要抓的ID
    {
        global $adminuser;
        return ($adminuser['type'] == '4'?$adminuser['serviceid']:$adminuser['id']);
    }

}