<?php
//404導向
function redirect_404(){
	//header("HTTP/1.1 404 Not Found");
	//include('404.php');
	header("Refresh: 0; url=/altrason/404.php");
	exit;
}

//設置email的樣板
function set_emailsample($body){
	$html = '';
	$html .= '<!doctype html>
	<head></head>
	<body>
		'.$body.'
	</body>
	</html>
	';

	return $html;
}

//增加指定天數(排除六日)
//亦可自訂$skipdates  排除日期
function addDays($date, $days, $skipdays = array("Saturday", "Sunday"), $skipdates = array()) {
	$i = 1;
	$timestamp = strtotime($date);
	while ($days >= $i) {
		$timestamp = strtotime("+1 day", $timestamp);
		if ( (in_array(date("l", $timestamp), $skipdays)) || (in_array(date("Y-m-d", $timestamp), $skipdates)) )
		{
			$days++;
		}
		$i++;
	}

	return date("Y/m/d",$timestamp);
}
function array_to1d($a,$name) { //二維轉1維
    $out = array();
    foreach ($a as $b) {
        $out[] = $b[$name];
    }
    return $out;
}

//=========api===========
function facebook_token($token){
    $facebook = new Facebook(array('appId'  => FB_APP_ID,'secret' => FB_APP_SECRECT));
    $facebook->setAccessToken($token);

    try {
        $fields = array('id', 'email', 'gender');
        //'id', 'name', 'first_name', 'last_name', 'link', 'website', 'locale', 'about', 'email', 'hometown', 'location'
        $user_profile = $facebook->api('/me?fields=' . implode(',', $fields));
        return $user_profile;
    } catch (FacebookApiException $e) {
        $user = null;
        return null;
    }
}

//=========Google===========
function google_token($token){
    $r = get_CURL("https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=".$token);

    return json_decode($r,true);
}

function time_range($start, $end, $interval = '5 min') { //179 期數 陣列
    date_default_timezone_set("PRC");
    $startTime = strtotime($start);
    $endTime   = strtotime($end);
    $returnTimeFormat = "H:i";

    $current   = time();
    $addTime   = strtotime('+'.$interval, $current);
    $diff      = $addTime - $current;

    $times = array();
    $i=1;
    while ($startTime < $endTime) {
        $times[$i] = date($returnTimeFormat, $startTime);
        $startTime += $diff;
        $i++;
    }
    $times[$i] = date($returnTimeFormat, $startTime);
    return $times;
}

function time_arraykey() { //判斷當前期數 KEY (這就是目前期數)
    date_default_timezone_set("PRC");
    $key = 0;
    $start = strtotime("09:07",time());
    $current = time();
    $addTime = strtotime('+5 min', $current);
    $five = $addTime - $current;
    $key = floor(($current-$start)/$five);
    return $key+1;
}
?>