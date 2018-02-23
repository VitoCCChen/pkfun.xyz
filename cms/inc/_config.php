<?php
ini_set('display_errors', 1);   # 0不顯示 1顯示
error_reporting(E_ALL);         # report all errors
date_default_timezone_set("Asia/Taipei");
mb_internal_encoding("UTF-8");
ini_set("magic_quotes_runtime", 0);
$iCache_ExpireHour=24;//小時
$iCookMainExpireDay=30;
$null_date='-0001-11-30';

//$null_date='1999-11-30';
/*$slash = (strstr(dirname(__FILE__), '/'))?"/":"\\";
define("CONFIG_DIR",dirname(__FILE__).$slash);*/
define("CONFIG_DIR",dirname(__FILE__).DIRECTORY_SEPARATOR);
define("ROOT_DIR",substr(CONFIG_DIR, 0, strpos(CONFIG_DIR, DIRECTORY_SEPARATOR."inc".DIRECTORY_SEPARATOR)+1));
define("DEF_LANG","tw");

ob_start();
//↓↓↓↓↓↓↓↓↓↓此區請依主機實際狀況修正↓↓↓↓↓↓↓↓↓↓↓↓
require_once(CONFIG_DIR."_cusconfig.php");
//↑↑↑↑↑↑↑↑↑此區請依主機實際狀況更動↑↑↑↑↑↑↑↑↑↑↑↑↑
//if (!isset($_SESSION)){
//    ini_set("session.cookie_domain", $session_domain);
    session_start();
//}

header("Content-type: text/html; charset=utf-8");

/*Upload path*/
$admin_path_temp="../../upload/temp/";
include '_filepath_config.php';

/*Cache path*/
$cache_path='upload/cache/';
$cache_path_web=$cache_path;
$cache_path_mob='../'.$cache_path;
$cache_path_do='../'.$cache_path;
$cache_path_admin='../../'.$cache_path;

//ckeditor
$path_ckeditor=$weburl.'upload/editor/';//ckeditor中路徑
$admin_path_ckeditor="../../upload/editor/";//上傳放置(以後台位置來看)
$db_path_ckeditor='upload/editor/';//存入資料庫時改為

/*Image setup*/
//產品
$product_pic_w = 453;
$product_pic_h = 238;

//fb圖
$fb_pic_w=470;
$fb_pic_h=246;

//色票圖
$colorpic_pic_w=25;
$colorpic_pic_h=25;

/*Cache name*/
$web_cache=array('web_meta'=>'web_meta','games_player'=>'games_player','offer_type'=>'offer_type');

/*創建資料夾列表*/
$ary_mkdir = array('manage'=>'Web_Manage/', 'upload'=>'upload/');

$register_effective_time = 30;//認證信有效時間

/*資料用ARY*/
//*常用↓↓↓↓
$incary_YNE=array('No','Yes');
$incary_isshow=array( 1=>'顯示',0 =>'隱藏');
$incary_sex = $incary_gender = array('女','男');
$incary_yn=array(0 =>'否', 1=>'是');
$incary_pay=array('<span class="label">未出款</span>','<span class="label label-success">已出款</span>');
$incary_pay_check=array('<span class="label">等待支付</span>','<span class="label label-success">已支付</span>');
$incary_yn_layout = array('<span class="label">否</span>','<span class="label label-success">是</span>');
$test_ary = array('1'=>'測試1', '2'=>'測試2', '3'=>'測試3', '4'=>'測試4','5'=>'測試5');
$incary_labelstyle=array(0=>'default',1=>'success',2=>'warning',3=>'important',4=>'inverse',5=>'pink',6=>'yellow',7=>'lime',8=>'magenta',9=>'gray');
$mycard_labelstyle=array(0=>'default',1=>'success',2=>'warning',3=>'success',4=>'inverse',5=>'pink',6=>'yellow',7=>'lime',8=>'magenta',9=>'gray');
$product_labelstyle=array(0=>'default',1=>'success',2=>'warning');

//可匯入序號 IP
$incary_psnoIP = array("::1",'59.127.37.46');

//時間
$incary_time = array(1=>'00:00',2=>'01:00',3=>'02:00',4=>'03:00',5=>'04:00',6=>'05:00',7=>'06:00',8=>'07:00',9=>'08:00',10=>'09:00',11=>'10:00',12=>'11:00',13=>'12:00',14=>'13:00',15=>'14:00',16=>'15:00',17=>'16:00',18=>'17:00',19=>'18:00',20=>'19:00',21=>'20:00',22=>'21:00',23=>'22:00',24=>'23:00');

$incary_lotterystyle=array(0=>'pink',1=>'yellow',2=>'deepblue',3=>'gray',4=>'warning',5=>'info',6=>'magenta',7=>'default',8=>'important',9=>'brown',10=>'success');

$inc_loginlevel =  array(1=>'loginad.php',2=>"loginaag.php",3=>"loginag.php",4=>"logins.php");












/* 語系相關陣列 ↓ */
//後臺右上轉換語系 key檔名 val顯示名稱
$incary_lang = array('tw'=>'繁中','cn'=>'简中','en'=>'English');




/* 語系相關陣列 ↑ */
















//*常用↑↑↑↑


require_once(CONFIG_DIR."_func.php");
require_once(CONFIG_DIR."_func_cache.php");
require_once(CONFIG_DIR."_errormsg.php");
require_once(CONFIG_DIR."_database.class.php");
require_once(CONFIG_DIR."_func_smtp.php");

/*FB*/





//lib的autoload
//採用spl_autoload_register載入(用__autoload會跟phpmailer的spl_autoload_register衝突)
function incautoload($classname){
    if(strlen($classname)>9 && mb_substr(strtolower($classname), 0, 9)=='phpexcel_'){
        return false;
    }
    $filename = '';
    if(strlen($classname)>6 && (strtolower(mb_substr($classname, 0, 6))=='class_' || strtolower(mb_substr($classname, 0, 8))=='classdb_')){
        $filename = CONFIG_DIR . "class/" . strtolower($classname) . ".php";
    }
    else if(strlen($classname)>5 && strtolower(mb_substr($classname, 0, 5))=='coder'){
        $filename = CONFIG_DIR . "lib/" . strtolower($classname) . ".php";
    }
    if($filename!=''){
        if ( file_exists($filename) ){
            include_once $filename;
        }else{
            echo 'notfound:'.$filename;
        }
    }
}

if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
    //SPL autoloading was introduced in PHP 5.1.2
    if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
        spl_autoload_register('incautoload', true, true);
    } else {
        spl_autoload_register('incautoload');
    }
} else {
    function __autoload($classname)
    {
        incautoload($classname);
    }
}
?>