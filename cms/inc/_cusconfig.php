<?PHP
$webname="遊戲財務";//網站名稱
$web_project_name='遊戲財務'; //專案名稱



/*Database 資料庫*/
/*$HS = "128.199.90.121";
$ID = "root";
$PW = "wtsr#r00wXtu";
$DB = "dg02_old";*/
$WebDeployLocation = dirname(__FILE__);
$WebServerHostName = gethostname();

$session_domain = "www.pkfun.xyz";
$HS = "127.0.0.1";
$ID = "pkbar";
$PW = "ZwxhAV8e";
$DB = "manage";

$HS_read = "127.0.0.1";
$ID_read = "root";
$PW_read = "";
$DB_read = "manage_read";

$weburl_root="/manage/";//前台cookie紀錄路徑
$webmanageurl_root=$webmanageurl_cookiepath=$weburl_root."Web_Manage/";//後台cookie紀錄路徑
$weburl="http://".$session_domain.$weburl_root;//指定網域  最後須加【/】 ex.http://www.wmch.com.tw/


/*SMTP Server*/
$smtp_auth = false;
$smtp_host = "127.0.0.1";
$smtp_port = 25;
$smtp_id   = "";
$smtp_pw   = "";
$smtp_secure = "";

/*Email(系統發信的寄件人)*/
$sys_email="service@coder.com.tw";
$sys_name="測試後台";
?>