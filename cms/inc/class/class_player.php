<?php
class class_player{
    public static function getList(){ //
        global $db;
        $colname = coderDBConf::$col_member;
        $sql = "select `{$colname['name']}` as name,`{$colname['member_id']}` as value
                    from ".coderDBConf::$member."
                    ORDER BY `{$colname['member_id']}` DESC";

        return $db->fetch_all_array($sql);
    }
    public static function getList_game(){ //
        global $db;
        $colname = coderDBConf::$col_game;
        $sql = "select `{$colname['name']}` as name,`{$colname['id']}` as value
                    from ".coderDBConf::$game."
                    ORDER BY `{$colname['id']}` DESC";

        return $db->fetch_all_array($sql);
    }
    public static function getList_pay(){ //
        global $db;
        $colname = coderDBConf::$col_deposit_pay;
        $sql = "select `{$colname['name']}` as name,`{$colname['id']}` as value
                    from ".coderDBConf::$deposit_pay."
                    ORDER BY `{$colname['id']}` DESC";

        return $db->fetch_all_array($sql);
    }

    public static function getName($_val){
        $ary = self::getList();
        return coderHelp::getArrayPropertyVal($ary, 'value', $_val, 'name');
    }
    public static function getName_game($_val){
        $ary = self::getList_game();
        return coderHelp::getArrayPropertyVal($ary, 'value', $_val, 'name');
    }
    public static function getName_pay($_val){
        $ary = self::getList_pay();
        return coderHelp::getArrayPropertyVal($ary, 'value', $_val, 'name');
    }
    public static function getList_agid($agid){ //判斷代理人或總代 有哪些玩家
        $db = Database::DB();
        $colname = coderDBConf::$col_users;
        $where = "";
        if($agid > 1){
            $where .= "where `{$colname['agent_id']}` = $agid";
        }

        $sql = "select `{$colname['nickname']}` as name,`{$colname['id']}` as value
                from ".coderDBConf::$users."
                $where
                ORDER BY `{$colname['id']}` DESC";

        return $db->fetch_all_array($sql);
    }

    public static function getList_agidone($agid,$member_id){ //判斷代理人或總代 有哪些玩家　尋找單一玩家
        $db = Database::DB();
        $colname = coderDBConf::$col_player;
        $where = "";
        if($agid > 1){
            $where .= "and `{$colname['agent_id']}` = $agid";
        }

        $sql = "select `{$colname['nickname']}` as name,`{$colname['id']}` as value
                from ".coderDBConf::$player."
                where `{$colname['id']}`=$member_id $where
                ORDER BY `{$colname['id']}` DESC";

        return $db->query_prepare_first($sql);
    }

    public static function getList_addodds() //要新增賠率的 玩家ID
    {
        global $db;
        $colname = coderDBConf::$col_users;
        $sql = "select {$colname['id']} as id
                from " . coderDBConf::$users . "
                ORDER BY `{$colname['id']}` DESC";
        return $db->fetch_all_array($sql);
    }

    public static function getList_one($member_id){
        global $db;
        $colname = coderDBConf::$col_users;
        $sql = "select *
                from ".coderDBConf::$users."
                where `{$colname['id']}`=$member_id 
                ORDER BY `{$colname['id']}` DESC";

        return $db->query_prepare_first($sql);
    }
}