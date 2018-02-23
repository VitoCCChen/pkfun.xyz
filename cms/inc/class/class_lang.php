<?php
class class_lang{
    public static function getlang(){ //
        $user_lang = (getCookie('user-lang') !="")?getCookie('user-lang'):'tw'; //轉換語系
        if(getCookie('user-lang') == ""){
            saveCookie('user-lang', 'tw','/');
        }
        return $user_lang;
    }



}