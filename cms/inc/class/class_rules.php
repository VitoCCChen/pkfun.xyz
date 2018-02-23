<?php
class class_rules{
    public static function getList(){
        global $db;
        $table = coderDBConf::$rules;
        $colname = coderDBConf::$col_rules;
        $sql = "select {$colname['name']} as name,{$colname['id']} as value 
                from $table
                ORDER BY `{$colname['id']}` DESC";

        return $db -> fetch_all_array($sql);
    }

    public static function getList_agents(){ //代理人帳號使用
        global $db;
        $table = coderDBConf::$rules;
        $colname = coderDBConf::$col_rules;
        $sql = "select {$colname['name']} as name,{$colname['id']} as value 
                from $table
                where `{$colname['agents']}` = 1
                ORDER BY `{$colname['id']}` DESC";

        return $db -> fetch_all_array($sql);
    }

    public static function getList_service(){ //客服帳號使用
        global $db;
        $table = coderDBConf::$rules;
        $colname = coderDBConf::$col_rules;
        $sql = "select {$colname['name']} as name,{$colname['id']} as value 
                from $table
                where `{$colname['service']}` = 1
                ORDER BY `{$colname['id']}` DESC";

        return $db -> fetch_all_array($sql);
    }
}
?>