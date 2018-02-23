<?php
class coderAdminLog{
	private static $_type=NULL;
	private static $_action=NULL;

	//key為2的次方
    public static $action;
    public static function init(){
        global $langary_action;
        self::$action = array(
            'login' => array('key' => 1, 'name' => $langary_action['login']),
            'view' => array('key' => 2, 'name' => $langary_action['view']),
            'add' => array('key' => 4, 'name' => $langary_action['add']),
            'edit' => array('key' => 8, 'name' => $langary_action['edit']),
            'del' => array('key' => 16, 'name' => $langary_action['del']),
            //'import'=>array('key'=>32,'name'=>'匯入'),
            //'export'=>array('key'=>64,'name'=>'匯出')
        );
    }
	/*public static $action=array(
		'login'=>array('key'=>1,'name'=>'登入'),
		'view'=>array('key'=>2,'name'=>'瀏覽'),
		'add'=>array('key'=>4,'name'=>'新增'),
		'edit'=>array('key'=>8,'name'=>'編輯'),
		'del'=>array('key'=>16,'name'=>'刪除'),
		//'import'=>array('key'=>32,'name'=>'匯入'),
		//'export'=>array('key'=>64,'name'=>'匯出')
	);*/
	
	public static function clearSession(){
		unset($_SESSION['loginfo']);
	}
	
	public static function insert($username,$main,$fun,$act,$descript=""){
	    global $langary_coderAdminLog_all;
		$db=Database::DB();
		$colname_admin_log=coderDBConf::$col_admin_log;

		if($act === 1){
			$main_key = $main;
			$fun_key = $fun;
			$log_key = $act;
		}else{
			$user=coderAdmin::getUser();
			$auth=coderAdmin::$Auth;
			if(!isset($auth[$main])){
				self::oops($langary_coderAdminLog_all['insert_msg']);
			}
			$main_key=$auth[$main]['key'];
			if(!isset($auth[$main]["list"][$fun])){
				self::oops($langary_coderAdminLog_all['insert_msg2']);
			}
			$fun_key=$auth[$main]["list"][$fun]['key'];
			$log_key=self::getActionKey($act);
		}
		$session_loginfo = "{$main_key}_{$fun_key}_{$log_key}_{$descript}";
		if(!isset($_SESSION['loginfo']) || $_SESSION['loginfo']!=$session_loginfo){
			$data=array();
			$data[$colname_admin_log['username']]=$username;
			$data[$colname_admin_log['main_key']]=$main_key;
			$data[$colname_admin_log['fun_key']]=$fun_key;
			$data[$colname_admin_log['action']]=$log_key;
			$data[$colname_admin_log['createtime']]=request_cd();
			$data[$colname_admin_log['ip']]=request_ip();
			$data[$colname_admin_log['descript']]=$descript;
			if($db->query_insert(coderDBConf::$admin_log,$data)){
				 $_SESSION['loginfo']=$session_loginfo;
			}
		}
	}
	public static function getLogByUser($username,$limit=10){
		global $db;
		$colname_admin_log=coderDBConf::$col_admin_log;
		$rows=$db->fetch_all_array("
			select {$colname_admin_log['main_key']}, {$colname_admin_log['fun_key']}, {$colname_admin_log['action']}, {$colname_admin_log['descript']}, {$colname_admin_log['createtime']} 
			from ".coderDBConf::$admin_log."
			where {$colname_admin_log['username']}=:username 
			order by {$colname_admin_log['createtime']} desc 
			limit ".$limit,array(':username'=>$username));
		$len=count($rows);
		for ($i=0;$i<$len ;$i++)
		{
			$rows[$i]['main_key']='';
			$rows[$i]['action']=self::getActionNameByKey($rows[$i][$colname_admin_log['action']]);
		}
		return $rows;
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