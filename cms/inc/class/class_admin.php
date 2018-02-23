<?php
class class_admin
{
    private static $_ary1 = null;

    public static function getList()
    { //
        global $db;
        $colname = coderDBConf::$col_admin;
        if (self::$_ary1 == null) {
            $sql = "select {$colname['username']} as username,{$colname['name']} as name,{$colname['id']} as value
                    from " . coderDBConf::$admin . "
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

    public static function getName2($_val)
    {
        $ary = self::getList();
        return coderHelp::getArrayPropertyVal($ary, 'value', $_val, 'name');
    }

    public static function getList_one($id)
    {
        global $db;
        $colname = coderDBConf::$col_admin;
        $sql = "select {$colname['username']} as name,{$colname['id']} as value,{$colname['level']} as level,
                       {$colname['games_id']} as games_id,{$colname['all_upid']} as all_upid,{$colname['first_upid']} as first_upid
                from " . coderDBConf::$admin . "
                where {$colname['id']} = $id
                ORDER BY `{$colname['id']}` DESC";
        return $db->query_prepare_first($sql);
    }

    public static function getList_addodds() //要新增賠率的 總代&代理 ID
    {
        global $db;
        $colname = coderDBConf::$col_admin;
        $sql = "select {$colname['id']} as id
                from " . coderDBConf::$admin . "
                where `{$colname['level']}`= 2 || `{$colname['level']}`= 3
                ORDER BY `{$colname['id']}` DESC";
        return $db->fetch_all_array($sql);
    }

    //刪除 底下階級遊戲
    //修改的 總代 or 代理 ID
    //$addary 所選遊戲
    public static function del_games($id,$addary){
        global $db;
        $delary = array(); //要被移除的ID
        $table = coderDBConf::$admin;
        $colname = coderDBConf::$col_admin;
        $row_oldgames = self::getList_one($id); //查詢舊的玩法
        $oldary = ($row_oldgames['games_id']!="")?explode(",",$row_oldgames['games_id']):array(); //舊有的ID
        foreach ($oldary as $_oldval){
            if(!in_array($_oldval,$addary)){ //沒在新陣列裡 就是被移除
                $delary[] = $_oldval;
            }
        }
        $rows_ag = self::getList_games($id); //此人下層 有哪些代理人
        foreach ($rows_ag as $row_ag) {
            $data = array();
            $gary = ($row_ag['games_id']!="")?explode(",",$row_ag['games_id']):array();
            if($gary > 0) { //原本需要有值
                $data[$colname['games_id']] = implode(",",array_diff($gary, $delary));
                $db->query_update($table,$data," {$colname['id']}=:id ",array(':id'=>$row_ag['id']));
            }
        }
    }

    public static function getList_games($id) //尋找此人下層 有哪些代理人
    {
        global $db;
        $colname = coderDBConf::$col_admin;
        $sql = "select `{$colname['id']}` as id,`{$colname['games_id']}` as games_id
                from " . coderDBConf::$admin . "
                where FIND_IN_SET($id,{$colname['all_upid']}) and `{$colname['level']}`!=4 and {$colname['games_id']}!='' and `{$colname['id']}`!=$id
                      and `{$colname['level']}`!=1 
                ORDER BY `{$colname['id']}` DESC";
        return $db->fetch_all_array($sql);
    }

    public static function getList_type($id) //尋找此人下層 有哪些代理人 改 代理人類型&代理人上分類型 使用
    {
        global $db;
        $colname = coderDBConf::$col_admin;
        $sql = "select `{$colname['id']}` as id,`{$colname['games_id']}` as games_id
                from " . coderDBConf::$admin . "
                where FIND_IN_SET($id,{$colname['all_upid']}) and `{$colname['level']}`!=4 and `{$colname['id']}`!=$id
                      and `{$colname['level']}`!=1 
                ORDER BY `{$colname['id']}` DESC";
        return $db->fetch_all_array($sql);
    }
}