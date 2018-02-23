<?php
class coderWebHelp
{
    public static function getIP() {
        return $_SERVER["REMOTE_ADDR"];
    }
    public static function cookie($name) {
    if (isset($_COOKIE[$name]) || !empty($_COOKIE[$name])) {
        return phpUnescape($_COOKIE[$name]);
    }
    else {
        return "";
    }
    }
    //取得cookie
     public static function getCookie($name) {
        return self::cookie($name);
    }
    //清除cookie
     public static function unCookie($name, $path = "") {
       setcookie($name, "", time() - 60*60*24*365,$path);
    }
     public static function saveCookieHour($name, $val, $h, $path = "/",$httponly=false) {
        $expire = time() + $h * 60 * 60;
        self::unCookie($name);
        setcookie($name, urlencode($val), $expire, $path,"",false,$httponly);
    }

     public static function saveCookie($name, $val, $path = "/",$httponly=false, $iCookMainExpireDay=30) {
        $expire = time() + $iCookMainExpireDay * 24 * 60 * 60;
        self::unCookie($name);
        setcookie($name, urlencode($val), $expire, $path,"",false,$httponly);
    }
}