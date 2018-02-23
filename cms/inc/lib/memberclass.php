<?php
	
class memberClassrItem{
	public $acc = "";
	public $password = "";
	public $fname = "";
	public $lname = "";
	public $email = "";
	public $gender = "";
	public $phone = "";
	public $mobile = "";
	public $address = "";
	public $create_time = "";
	public $update_time = "";
}


class memberClass{
	static $table = "member";

	public function __construct(){
	}
	
	//會員新增
	public function Insert($member){ 
		global $db, $member_id;
		if($this -> isExisit($member -> email)){
			throw new Exception('會員電子郵件重覆,請重新輸入');
		}else{
			//$data["member_account"] = $member -> account;
			$data["member_password"] = coderAdmin::pwHash($member -> password);
			//$data["member_name"] = $member -> name;
			$data["member_acc"] = $member -> email;
			$data["member_email"] = $member -> email;
			//$data["member_phone"] = $member -> phone;
			$data["member_createtime"] = request_cd();
			$data["member_updatetime"] = request_cd();
			
			$member_id = $db -> query_insert(memberClass::$table, $data);
		}
	}
	//檢查帳號是否存在
	static function isExisit($acc){
		global $db;
		if($db -> query_first("SELECT member_id FROM ".memberClass::$table." WHERE member_acc = '$acc'")){
			return true;
		}else{
			return false;
		}
	}
	//檢查帳號是否重覆
	public function chkAcc(memberClassrItem $member){
		global $db;
		if($this -> isExisit($member -> email)){
			throw new Exception('會員電子郵件重覆,請重新輸入!');
		}
	}
	//檢查email是否重覆
	/*public function chkEmail(memberClassrItem $member){
		global $db;
		if($this -> isExisit($member -> email)){
			throw new Exception('會員email重覆,請重新輸入');
		}
	}*/
	//會員登入
	public function MemberLogin(memberClassrItem $member){ 
		global $db;
		$sql = "SELECT * FROM ".memberClass::$table." WHERE member_account = '".$member -> acc."' AND member_password = '".md5($member -> pwd)."'";
		$row = $db -> query_first($sql);
		if(!$row){
			throw new Exception('登入失敗,帳號或密碼不正確!');
		}
		else{
			$_SESSION["session_acc"] = $row["member_account"];
	 		$_SESSION["session_name"] = $row["member_name"];
			$_SESSION["session_id"] = $row["member_id"];
		}
	}
	//會員修改
	public function Update(memberClassrItem $member){ 
		global $db;
		if(!isset($_SESSION["session_acc"]) || !isset($_SESSION["session_name"]) || !isset($_SESSION["session_id"])){
			throw new Exception('您已經登出系統，請重新登入');
		}else{
			$data["member_name"] = $member -> name;
			$data["member_email"] = $member -> email;
			$data["member_phone"] = $member -> phone;
			$data["member_mobile"] = $member -> mobile;
			$data["member_gender"] = $member -> gender;
			$data["member_age"] = $member -> age;
			$data["member_birthday"] = $member -> birthday;
			$data["member_address"] = $member -> address;
			$data["member_id_number"] = $member -> id_number;
			$data["member_emergency_contact"] = $member -> emergency_contact;
			$data["member_emergency_telephone"] = $member -> emergency_telephone;
			$data["member_emergency_contact_relationship"] = $member -> emergency_contact_relationship;
			$data["member_introducer"] = $member -> introducer;
			$data["member_baptized_date"] = $member -> baptized_date;
			
			$data["member_update_time"] = request_cd();
			$db -> query_update(memberClass::$table, $data, "member_id = ".$_SESSION["session_id"]);
		}
	}
	//會員修改密碼
	public function changePassword($mid, $password){ 
		global $db;
		if(!isset($_SESSION["session_acc"]) || !isset($_SESSION["session_name"]) || !isset($_SESSION["session_id"])){
			throw new Exception('您已經登出系統，請重新登入');
		}else{
			$data["member_password"] = md5($password);
			$data["member_update_time"] = request_cd();
			$db -> query_update(memberClass::$table, $data, "member_id = ".$_SESSION["session_id"]);
		}
	}
	
	

}

