<?php
class class_platform{
    public static function getList(){ //
        global $db;
        $colname = coderDBConf::$col_platform;
        $sql = "select {$colname['name']} as name,{$colname['id']} as value
                from ".coderDBConf::$platform."
                ORDER BY `{$colname['id']}` DESC";
        return $db->fetch_all_array($sql);
    }

    public static function getName($_val){
        $ary = self::getList();
        return coderHelp::getArrayPropertyVal($ary, 'value', $_val, 'name');
    }

}