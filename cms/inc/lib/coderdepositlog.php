<?php
class coderdepositLog{
	private static $_type=NULL;
	private static $_action=NULL;
	
	public static function clearSession(){
		unset($_SESSION['loginfo']);
	}
	
	public static function insert($username,$descript=""){
	    global $langary_coderAdminLog_all;
		$db=Database::DB();
		$colname_deposit_log=coderDBConf::$col_deposit_log;

		$session_loginfo = "{$descript}";
		if(!isset($_SESSION['loginfo']) || $_SESSION['loginfo']!=$session_loginfo){
			$data=array();
			$data[$colname_deposit_log['username']]=$username;
			$data[$colname_deposit_log['createtime']]=request_cd();
			$data[$colname_deposit_log['descript']]=$descript;
			if($db->query_insert(coderDBConf::$deposit_log,$data)){
				 $_SESSION['loginfo']=$session_loginfo;
			}
		}
	}

	public static function getTypeIndex($value)
	{
	    global $langary_coderAdminLog_all;
		if(self::$_type==NULL){
			self::$_type=coderHelp::makeAryKeyValue(self::$type,'key');
		}
		if(!isset(self::$_type[$value])){
			self::oops($langary_coderAdminLog_all['getTypeIndex_msg']);
		}
		return self::$_type[$value];
	}
	public static function getActionIndex($value){
        global $langary_coderAdminLog_all;
		if(self::$_action==NULL){
			self::$_action=coderHelp::makeAryKeyValue(self::$action,'key');
		}
		if(!isset(self::$_action[$value])){
			self::oops($langary_coderAdminLog_all['getActionIndex_msg']);
		}
		return self::$_action[$value];
	}
	public static function getTypeNameByKey($key){
		return self::$type[self::getTypeIndex($key)]['name'];
	}
	public static function getActionNameByKey($key){

		return self::$action[self::getActionIndex($key)]['name'];
	}
	public static function getTypeName($type){
		return (isset(self::$type[$type])) ? self::$type[$type]['name'] : '' ;
	}
	public static function getActionName($act){
		return (isset(self::$action[$act])) ? self::$action[$act]['name'] : '' ;
	}
	public static function getActionKey($act)
	{
        global $langary_coderAdminLog_all;
		if(isset(self::$action[$act])){
			return self::$action[$act]['key'] ;
		}
		else{
			self::oops($langary_coderAdminLog_all['getActionKey_msg']);
		}
	}
	private static function getItem($type)
	{
		foreach(self::$type as $key=>$item)
		{
			if($key==$type)
			{
				return $item;
			}
		}
		return false;
	}

	private static function oops($msg){
		throw new Exception($msg, 1);
	}
}