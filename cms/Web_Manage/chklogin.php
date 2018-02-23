<?php
$inc_path="../inc/";
include($inc_path.'_config.php');
$errorhandle=new coderErrorHandle();
$username=trim(post('username',1));
$password=trim(post('password',1));
$code=trim(post('code',1));
$remember_me = post('remember_me');
$actype=post('actype'); //權限等級
//語系陣列
$user_lang = class_lang::getlang();
if($_SERVER['HTTP_HOST'] == 'localhost'){
    include_once(dirname(__FILE__).'\alllang\/'.$user_lang.".php");
}
else{
    include_once(dirname(__FILE__).'/alllang/'.$user_lang.".php");
}
try
{
	//把log清掉
	coderAdminLog::clearSession();
	$_SESSION['loginfo']='';
	/*if(!isset($_SESSION["VaildImgCode"])){throw new Exception('超時，請重整頁面重新登入!');}
	if($code=='' || $code!=$_SESSION["VaildImgCode"])
	{
		throw new Exception('圖形驗證碼不正確!');
	}*/
	if($actype<=0){
        throw new Exception('請輸入身份!');
    }
	if($username=="" || $password=="")
	{
		throw new Exception('請輸入帳號與密碼!');
	}

	$db = Database::DB();

	coderAdmin::login($username,$password,$actype,$remember_me);
	$db->close();
	$code!=$_SESSION["VaildImgCode"]="";

}
catch(Exception $e)
{
	$errorhandle->setException($e);
}
if ($errorhandle->isException()) 
{
	$_SESSION["VaildImgCode"]="";
	$result['result']=false;
    $result['msg']=$errorhandle->getErrorMessage(false);
}
else
{
	$result['result']=true;
}
echo json_encode($result);
?>