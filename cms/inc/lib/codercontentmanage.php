<?php
class coderContentManage {

	public static $type= array( 'member_register'=>'email1.php','member_password'=>'email2.php');
    //public static $type= array( 'member_register'=>'email1.php','member_success'=>'mail_member_success.php','member_password'=>'email2.php','order'=>'mail_order.php','birthday'=>'mail_member_birthday.php','payment_success'=>'mail_payment_success.php' );

	public static function getMailContent($type, $search, $replace, $lang){
        //return self::_getContent(self::getContent($type, $search, $replace, $lang), $search, $replace);
        return self::getContent($type, $search, $replace, $lang);
	}

	public static function getContent($type, $search, $replace, $lang){
		global $weburl;
        $template_path = dirname(dirname(dirname(__FILE__)))."/layout/".$lang."/".self::$type[$type];
        //$template_path = $weburl.self::$type[$type];
		$content = '';
		if(!array_key_exists ( $type , self::$type)){
            self::_oops('內容類別錯誤');
        }
        $content = file_get_contents($template_path);

        return self::_getContent($content,$search,$replace,$lang);	
	}
    private static function _getContent($content, $search, $replace, $lang) {
        global $weburl, $webname;
        $weburl = $weburl.$lang."/";
        $search = array_merge($search, array(
            '{$weburl}',
            '{$webname}'
        ));
        $replace = array_merge($replace, array(
            $weburl,
            $webname
        ));
        
        return str_replace($search, $replace, $content);
    }

	private static function _oops($msg){
		throw new Exception('contentManage:'.$msg);
	}
}