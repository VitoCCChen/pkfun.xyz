<?php
	
class CoderMemberItem{
	public $id = "";
	public $acc = "";
	public $password = "";
	public $fname = "";
	public $lname = "";
	public $email = "";
	public $gender = "";
	public $phone = "";
	public $country = "";
	public $area = "";
	public $city = "";
	public $addr = "";
	public $where = "";
	public $where_text = "";
	public $create_time = "";
	public $update_time = "";
	public $isreg = "";
	public $regcode = "";
	public $reg_time = "";
	public $lang = "";
}


class CoderMember{
	static $table = "member";

	public function __construct(){
	}
	
	//檢查帳號是否存在
	static function isExisit($acc){
		global $db;
		if($db -> query_first("SELECT member_id FROM ".CoderMember::$table." WHERE member_acc = '$acc'")){
			return true;
		}else{
			return false;
		}
	}
	
	//檢查帳號是否重覆
	public function chkAcc(CoderMemberItem $member){
		global $db;	
		if($this -> isExisit($member -> acc)){
			throw new Exception('會員帳號已存在,請重新輸入');
		}
	}

	//會員新增
	public function Insert(CoderMemberItem $member){ 
		// print_r($member);
		switch($member -> lang){
			case  "tw":
				$msg1="此會員帳號已被使用";
				break;
			case  "cn":
				$msg1="此会员帐号已被使用";
				break;
			case  "en":
				$msg1="Email address is already being used.";
				break;
			default:
				$msg1="此會員帳號已被使用";
				break;
		}
		global $db;
		if($this -> isExisit($member -> acc)){
			throw new Exception($msg1);
		}else{			
			$data["member_acc"] = $member -> acc;
			$data["member_password"] = coderAdmin::pwHash($member -> password);
			$data["member_email"] = $member -> acc;
			$data["member_createtime"] = request_cd();
			$data["member_updatetime"] = request_cd();
			$data["member_isreg"] = 0;
			$data["member_regcode"] = self::createCode();
			$data["member_regtime"] = request_cd();
			
			$member_id = $db -> query_insert(CoderMember::$table, $data);

			if($member_id == 0){
				throw new Exception('建立會員資料時發生錯誤!');
			}else{
				self::_sendRegisterMail("Altrason會員", $data["member_regcode"], $data["member_acc"], $member -> lang);
			}
		}
		return $member_id;
	}

	//會員登入
	public function MemberLogin(CoderMemberItem $member){ 
		global $db;
		switch($member -> lang){
			case  "tw":
				$msg1="1登入失敗，帳號或密碼不正確";
				$msg2='2此帳號尚未完成Email驗證程序，點擊<a class="re_mail_btn" style="color:#b40d0d;text-decoration:underline;" mail_info="">這裡</a>以再次驗證';
				break;
			case  "cn":
				$msg1="1登入失败，帐号或密码不正确";
				$msg2='2此帐号尚未完成Email验证程序，点击<a class="re_mail_btn" style="color:#b40d0d;text-decoration:underline;" mail_info="">这裡</a>以再次验证';
				break;
			case  "en":
				$msg1="1Username and password doesn't match.";
				$msg2='2This account has not been verified. Click <a class="re_mail_btn" style="color:#b40d0d;text-decoration:underline;" mail_info="">here </a>to verify.';
				break;
			default:
				$msg1="1登入失敗，帳號或密碼不正確";
				$msg2='2此帳號尚未完成Email驗證程序，點擊<a class="re_mail_btn" style="color:#b40d0d;text-decoration:underline;" mail_info="">這裡</a>以再次驗證';
				break;
		}
		$sql = "SELECT * FROM ".CoderMember::$table." WHERE member_acc ='".$member -> acc."' AND member_password='".coderAdmin::pwHash($member -> password)."'";
		$row = $db -> query_first($sql);
		$_SESSION['re_mail_id'] = "";
		if(!$row){
			throw new Exception($msg1);
		}
		if($row['member_isreg'] == 0){
			//self::_sendRegisterMail("Altrason會員", $row["member_regcode"], $row["member_acc"], $member -> lang);
			//throw new Exception('此帳號尚未完成Email認證程序,無法登入!');
			$_SESSION['re_mail_id'] = $row['member_id'];
			throw new Exception($msg2);
		}
		
		return self::_login($row);
	}
	private static function _login($row){
        global $db;
        $table = CoderMember::$table;
        $user = array(
            'id' => $row['member_id'],
            'account' => $row['member_acc'],
            'password' => $row['member_password'],
        );
        self::_setUser($user);
        
        $data["member_ip"] = request_ip();
        $db -> query_update($table, $data, ' member_id=' . $row['member_id']);
    }
	private static function _setUser($user) {
        $_SESSION['login_user'] = serialize($user);
    } 
	public static function isLogin(){
        $user=self::getLoginUser();
        return $user==null ? false : true;
    }
	public static function getLoginUser(){
		global $db;
        if(isset($_SESSION['login_user'])){
			$login_user = unserialize($_SESSION['login_user']);
    	}else{
			$login_user = null;
		}
		return $login_user;
	}
	public static function getLoginUserInfo($m_id){
		global $db;
        $sql = "SELECT * FROM ".CoderMember::$table." WHERE member_id = '$m_id'";
		$row = $db -> query_first($sql);
		return $row;
	}

	//會員註冊認證信
	public static function _sendRegisterMail($name, $regcode, $email, $lang) {
        global $sys_email, $webname;
		switch($lang){
			case  "tw":
				$title="Altrason - 電子郵件驗證";
				break;
			case  "cn":
				$title="Altrason - 电子邮件验证";
				break;
			case  "en":
				$title="Altrason - Verify your email address";
				break;
			default:
				$title="Altrason - 電子郵件驗證";
				break;
		}
        
        $body = coderContentManage::getMailContent('member_register', array(
            '{$name}',
            '{$regcode}'
        ) , array(
            $name,
            $regcode
        ),$lang);
        
        return sendmail($sys_email, $webname, $email, '', $title, $body);
    }
	private static function _sendPasswordMail($name, $pwdcode, $email, $lang) {
        global $sys_email, $webname;
		switch($lang){
			case  "tw":
				$title="重設您的 Altrason 密碼";
				break;
			case  "cn":
				$title="重设您的 Altrason 密码";
				break;
			case  "en":
				$title="Reset your Altrason password";
				break;
			default:
				$title="重設您的 Altrason 密碼";
				break;

		}

        $body = coderContentManage::getMailContent('member_password', array(
            '{$name}',
            '{$pwdcode}'
        ) , array(
            $name,
            $pwdcode
        ),$lang);
        
        return sendmail($sys_email, $webname, $email, '', $title, $body);
    }
	public static function reMail(CoderMemberItem $member){
		global $db;
		$m_acc = "";
		$sql = "SELECT * FROM ".CoderMember::$table." WHERE member_id ='".$member -> id."' ";
		$row = $db -> query_first($sql);
		if($row){
			$data["member_regcode"] = self::createCode();
			$data["member_regtime"] = request_cd();
			
			$db -> query_update(CoderMember::$table, $data, "member_id = ".$member -> id);
			$m_acc = $row['member_acc'];
			self::_sendRegisterMail("Altrason會員", $data["member_regcode"], $row["member_acc"], $member -> lang);

		}else{
			throw new Exception("資料傳送錯誤,請再試一次");
		}
		return $m_acc;
	}

	//會員登出
	public static function loginOut(){
        unset($_SESSION['login_user']);				
    }

	public static function createCode() {       
        return md5(uniqid(rand()));
    }

	//檢查認證
	public static function chkVaild($code, $lang) {
        global $db, $register_effective_time;
		switch($lang){
			case  "tw":
				$msg1="查無此驗證碼紀錄，請重新申請";
				$msg2="驗證碼連結已失效";
				$msg3="您的Email 帳號已有註冊記錄，請直接登入";
				break;
			case  "cn":
				$msg1="查无此验证码纪录，请重新申请";
				$msg2="验证码连结已失效";
				$msg3="您的Email 帐号已有注册记录，请直接登入";
				break;
			case  "en":
				$msg1="Verification Failed. Please register again.";
				$msg2="The verification link is no longer valid.";
				$msg3="Your email account is already activated. Please log in.";
				break;
			default:
				$msg1="查無此驗證碼紀錄，請重新申請";
				$msg2="驗證碼連結已失效";
				$msg3="您的Email 帳號已有註冊記錄，請直接登入";
				break;
		}
        $user = $db->query_first('SELECT * FROM ' . CoderMember::$table . ' WHERE member_regcode = :code', array(
            ':code' => $code
        ));

        if(!$user){
            throw new Exception($msg1);
        }
        if($user['member_isreg'] == 0){
			if(!self::_chkTime($user)){
				throw new Exception($msg2);
			}else{
				try{ 
					     
					$db -> begin();
					$db->exec('UPDATE ' . CoderMember::$table . ' SET member_isreg=1 WHERE member_id=' . $user['member_id']);
					if($user['member_isnew']==1){
						
						class_mailchimp::getsubscribed($user['member_acc'],1);
					}
					$db -> commit();
				}catch(Exception $e){
					$db -> rollback();
					throw new Exception('加入會員時發生錯誤:'.$e->getMessage());
				}
			}      
        }else{
			throw new Exception($msg3);
		}
        
        return true;
    }
	public static function chkVaild2($code, $lang) {
        global $db, $register_effective_time;
		switch($lang){
			case  "tw":
				$msg1="查無此驗證碼紀錄，請重新申請";
				$msg2="驗證碼連結已失效";
				$msg3="您的Email 帳號已有註冊記錄，請直接登入";
				break;
			case  "cn":
				$msg1="查无此验证码纪录，请重新申请";
				$msg2="验证码连结已失效";
				$msg3="您的Email 帐号已有注册记录，请直接登入";
				break;
			case  "en":
				$msg1="Verification Failed. Please register again.";
				$msg2="The verification link is no longer valid.";
				$msg3="Your email account is already activated. Please log in.";
				break;
			default:
				$msg1="查無此驗證碼紀錄，請重新申請";
				$msg2="驗證碼連結已失效";
				$msg3="您的Email 帳號已有註冊記錄，請直接登入";
				break;
		}
        $user = $db->query_first('SELECT * FROM ' . CoderMember::$table . ' WHERE member_pwdcode = :code', array(
            ':code' => $code
        ));

        if(!$user){
            throw new Exception($msg1);
        }
        //if($user['member_isreg'] == 0){
			if(!self::_chkTime2($user)){
				throw new Exception($msg2);
			}else{
				self::_setUser2($user);
			}      
        // }else{
		// 	throw new Exception("您的Email 帳號已有註冊記錄，請直接登入!");
		// }
        
        return true;
    }
	private static function _chkTime($user){
		global $db, $register_effective_time;
		if(strtotime("now") > strtotime("+$register_effective_time days", strtotime($user['member_regtime']))){//過期
			return false;
		}
		return true;
	}
	private static function _chkTime2($user){
		global $db, $register_effective_time;
		if(strtotime("now") > strtotime("+$register_effective_time days", strtotime($user['member_pwdtime']))){//過期
			return false;
		}
		return true;
	}
	private static function _setUser2($row) {
		$user = array(
            'id' => $row['member_id'],
            'account' => $row['member_acc']
        );
        $_SESSION['pwd_user'] = serialize($user);
    } 
	public static function getPwdUser(){
        if(isset($_SESSION['pwd_user'])){
			$pwd_user = unserialize($_SESSION['pwd_user']);
    	}else{
			$pwd_user = false;
		}
		return $pwd_user;
	}

	//註冊填寫會員
	public function Register_Update(CoderMemberItem $member){ 
		global $db;
		switch($member -> lang){
			case  "tw":
				$msg1="您已經登出系統，請重新登入";
				break;
			case  "cn":
				$msg1="您已经登出系统，请重新登入";
				break;
			case  "en":
				$msg1="You have been logged out. Please log in again.";
				break;
			default:
				$msg1="您已經登出系統，請重新登入";
				break;
		}
		if(!self::isLogin()){
			throw new Exception($msg1);
		}else{
			$m_info = self::getLoginUser();
			$m_id = $m_info["id"];
			$m_account = $m_info["account"];
			$data["member_fname"] = $member -> fname;
			$data["member_lname"] = $member -> lname;
			$data["member_gender"] = $member -> gender;
			$data["member_phone"] = $member -> phone;
			$data["member_country"] = $member -> country;
			$data["member_area"] = $member -> area;
			$data["member_city"] = $member -> city;								
			$data["member_addr"] = $member -> addr;
			$data["member_wherefrom"] = $member -> where;
			$data["member_wherefrom_text"] = $member -> where_text;
			$data["member_isnew"] = $member -> isnew;
			$data["member_updatetime"] = request_cd();
			
			$db -> query_update(CoderMember::$table, $data, "member_id = ".$m_id);

			$data["member_isnew"]==1?class_mailchimp::getsubscribed($m_account,1):class_mailchimp::getunsubscribed($m_account);
		}
	}

	//修改會員資料
	public function Update(CoderMemberItem $member){ 
		global $db;
		switch($member -> lang){
			case  "tw":
				$msg1="您已經登出系統，請重新登入";
				break;
			case  "cn":
				$msg1="您已经登出系统，请重新登入";
				break;
			case  "en":
				$msg1="You have been logged out. Please log in again.";
				break;
			default:
				$msg1="您已經登出系統，請重新登入";
				break;
		}
		if(!self::isLogin()){
			throw new Exception($msg1);
		}else{
			$m_info = self::getLoginUser();
			$m_id = $m_info["id"];
			$m_account = $m_info["account"];
			$data["member_fname"] = $member -> fname;
			$data["member_lname"] = $member -> lname;
			$data["member_gender"] = $member -> gender;
			$data["member_phone"] = $member -> phone;
			$data["member_country"] = $member -> country;
			$data["member_area"] = $member -> area;
			$data["member_city"] = $member -> city;								
			$data["member_addr"] = $member -> addr;
			$data["member_isnew"] = $member -> isnew;
			$data["member_updatetime"] = request_cd();
			
			$db -> query_update(CoderMember::$table, $data, "member_id = ".$m_id);

			$data["member_isnew"]==1?class_mailchimp::getsubscribed($m_account,1):class_mailchimp::getunsubscribed($m_account);
		}
	}

	//修改會員email
	public function UpdateEmail(CoderMemberItem $member){
		global $db;
		switch($member -> lang){
			case  "tw":
				$msg1="您已經登出系統，請重新登入";
				$msg2="此會員帳號已被使用";
				break;
			case  "cn":
				$msg1="您已经登出系统，请重新登入";
				$msg2="此会员帐号已被使用";
				break;
			case  "en":
				$msg1="You have been logged out. Please log in again.";
				$msg2="Email address is already being used.";
				break;
			default:
				$msg1="您已經登出系統，請重新登入";
				$msg2="此會員帳號已被使用";
				break;
		}
		if(!self::isLogin()){
			throw new Exception($msg1);
		}elseif($this -> isExisit($member -> acc)){
			throw new Exception($msg2);
		}else{
			$m_info = self::getLoginUser();
			$m_id = $m_info["id"];
			$data["member_acc"] = $member -> acc;
			$data["member_email"] = $member -> acc;
			$data["member_isreg"] = 0;
			$data["member_regcode"] = self::createCode();
			$data["member_regtime"] = request_cd();
			$data["member_updatetime"] = request_cd();
			$num = $db -> query_update(CoderMember::$table, $data, "member_id = ".$m_id);
			if($num){
				//self::loginOut();//如已更新密碼則登出
				
				self::_sendRegisterMail("Altrason會員", $data["member_regcode"], $data["member_acc"], $member -> lang);

				//取消訂閱
				class_mailchimp::getunsubscribed($m_info['account']);

				$m_info['account'] = $data["member_acc"];
				self::_setUser($m_info);
			}
		}
	}

	//修改會員密碼(登入修改)
	public function UpdatePW(CoderMemberItem $member,$nowpassword){
		global $db;
		switch($member -> lang){
			case  "tw":
				$msg1="密碼錯誤，請重新輸入";
				$msg2="您已經登出系統，請重新登入";
				break;
			case  "cn":
				$msg1="密码错误，请重新输入";
				$msg2="您已经登出系统，请重新登入";
				break;
			case  "en":
				$msg1="The current password you supplied was not correct. Please try again.";
				$msg2="You have been logged out. Please log in again.";
				break;
			default:
				$msg1="密碼錯誤，請重新輸入";
				$msg2="您已經登出系統，請重新登入";
				break;
		}
		if(!self::isLogin()){
			throw new Exception($msg2);
		}else{
			$m_info = self::getLoginUser();
			$m_id = $m_info["id"];

			$sql = "SELECT * FROM ".CoderMember::$table." WHERE member_id = '$m_id'";
			$row = $db -> query_first($sql);
			if($row && (
					(	empty($row['member_password']) && //社群帳號無須驗證原密碼
						(!empty($row['member_fbid']) || !empty($row['member_gplusid'])) 
					) || 
					$row['member_password'] == coderAdmin::pwHash($nowpassword) //密碼驗證一致
				)
			){
				$data["member_password"] = coderAdmin::pwHash($member -> password);
				$data["member_updatetime"] = request_cd();
				$num = $db -> query_update(CoderMember::$table, $data, "member_id = ".$m_id);
				if($num){//如已更新密碼則登出
					self::loginOut();
				}
			}else{
				throw new Exception($msg1);
			}
		}
	}
	
	//忘記密碼
	public function forget_pwd(CoderMemberItem $member){ 
		global $db;
		switch($member -> lang){
			case  "tw":
				$msg1="查無此電子郵件帳號";
				break;
			case  "cn":
				$msg1="查无此电子邮件帐号";
				break;
			case  "en":
				$msg1="No account with that email address.";
				break;
			default:
				$msg1="查無此電子郵件帳號";
				break;
		}
		if(!$this -> isExisit($member -> acc)){
			throw new Exception($msg1);
		}else{
			$sql = "SELECT * FROM ".CoderMember::$table." WHERE member_acc ='".$member -> acc."'";
			$row = $db -> query_first($sql);
			$m_id = $row["member_id"];
			
			$data["member_pwdcode"] = self::createCode();
			$data["member_pwdtime"] = request_cd();
			
			$db -> query_update(CoderMember::$table, $data, "member_id = ".$m_id);

			self::_sendPasswordMail("Altrason會員", $data["member_pwdcode"], $member -> acc, $member -> lang);
		}
	}

	//會員重設密碼
	public function re_pwd(CoderMemberItem $member){ 
		global $db;
		
		$data["member_password"] = coderAdmin::pwHash($member -> password);
		$data["member_updatetime"] = request_cd();
		$data["member_pwdcode"] = "";
		$data["member_pwdtime"] = "";
		
		$db -> query_update(CoderMember::$table, $data, "member_id = ".$member -> id);

		unset($_SESSION['pwd_user']);
		self::loginOut();	
		
	}

	//會員修改密碼
	public function pwd_Update(CoderMemberItem $member){ 
		global $db;
		switch($member -> lang){
			case  "tw":
				$msg1="您已經登出系統，請重新登入";
				break;
			case  "cn":
				$msg1="您已经登出系统，请重新登入";
				break;
			case  "en":
				$msg1="You have been logged out. Please log in again.";
				break;
			default:
				$msg1="您已經登出系統，請重新登入";
				break;
		}
		if(!isset($_SESSION["session_cln_acc"]) || !isset($_SESSION["session_cln_name"]) || !isset($_SESSION["session_cln_id"])){
			throw new Exception($msg1);
		}else{
			$data["member_password"] = coderAdmin::pwHash($member -> password);
			$data["member_updatetime"] = request_cd();
			$data["member_pwdcode"] = "";
			$data["member_pwdtime"] = "";
			
			$db -> query_update(CoderMember::$table, $data, "member_id = ".$_SESSION["session_cln_id"]);

		}
	}
	
	
	

	

	
	
	
	
}

