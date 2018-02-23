<?php
class coderLang
{
    private static $_lang='';
    private static $_cookie_name='site_lang';
    public static $_dic=null;

    private static function getlangary(){
        global $incary_lang;
        $_lang_ary = array();
        foreach ($incary_lang as $key => $value) {
            $_lang_ary[$key] = $value['name'];
        }
        return $_lang_ary;
    }

    public static function getDic(){
        if(self::$_dic!=null){
            return self::$_dic;
        }
        $lang=self::get();
        self::confDic($lang);
        return self::$_dic;
    }
    private static function confDic($lang){
        $path=CONFIG_DIR.'lang/'.$lang.'.php';
        if(!file_exists ($path)){
            $path=CONFIG_DIR.'lang/'.DEF_LANG.'.php';
        }
        include_once($path);
        self::$_dic=$_dic_lang;
    }
    public static function set($lang)
    {
        global $rootpath;
        $_lang_ary = self::getlangary();

        if(array_key_exists( $lang, $_lang_ary ) ){
            coderWebHelp::saveCookie(self::$_cookie_name, $lang,  $rootpath, $httponly=true);
            self::$_lang=$lang;
        }
    }
    public static function get(){
        $_lang_ary = self::getlangary();
        if(self::$_lang!='' && array_key_exists(self::$_lang, $_lang_ary)){
            return self::$_lang;
        }
        if(get('lang',1)!=''){
            $lang=get('lang',1);
        }else{
            $lang=coderWebHelp::getCookie(self::$_cookie_name);
        }
        if(trim($lang)=="" || !array_key_exists($lang,  $_lang_ary)){
            self::set(DEF_LANG);
            $lang=DEF_LANG;
        }
        return $lang;
    }

}