<?php

class coderAdmin
{
    private static $admin_code = 1099511627775;
    private static $authNameAry;

    public static function get_adminField()
    {//取得帳號欄位
        $colname = coderDBConf::$col_admin;
        return "{$colname['username']} as username, {$colname['service']} as serviceid, {$colname['name']} as name, {$colname['id']} as id, {$colname['mid']} as mid, {$colname['ispublic']} as ispublic, {$colname['pic']} as pic, {$colname['level']} as level, {$colname['r_id']},{$colname['games_id']} as games_id,`{$colname['first_upid']}` as first_upid";
    }

    /**
     * [權限驗證判斷&設定]
     * 第一層索引與list第二層索引不能重複
     */
    public static $Auth;
    public static function init(){
        global $langary_auth,$adminuser;
        self::$Auth = array(
            'admin' => array('key' => 1, 'name' => $langary_auth['admin']['name'], 'icon' => 'icon-lock', 'auth' => 30,
                'list' => array(
                    'admin' => array('key' => 1, 'name' => $langary_auth['admin']['list']['admin'], 'icon' => 'icon-lock', 'path' => 'admin/index.php', 'auth' => 30),
                    'adminlog' => array('key' => 2, 'name' => $langary_auth['admin']['list']['adminlog'], 'icon' => 'icon-lock', 'path' => 'adminlog/index.php', 'auth' => 2)
                )
            ),
            'auth' => array('key' => 2, 'name' => $langary_auth['auth']['name'], 'icon' => 'icon-lock', 'auth' => 30,
                'list' => array(
                    'auth_rules' => array('key' => 1, 'name' => $langary_auth['auth']['list']['auth_rules'], 'icon' => 'icon-lock', 'path' => 'admin_rules/index.php', 'auth' => 30)
                )
            ),
            'member' => array('key' => 6, 'name' => $langary_auth['member']['name'], 'icon' => 'icon-lock', 'auth' => 30,
                'list' => array(
                    'platform' => array('key' => 1, 'name' => $langary_auth['member']['list']['platform'], 'icon' => 'icon-lock', 'path' => 'platform/index.php', 'auth' => 30),
                    'agent' => array('key' => 2, 'name' => $langary_auth['member']['list']['agent'], 'icon' => 'icon-lock', 'path' => 'agent/index.php', 'auth' => 30),
                    'player' => array('key' => 3, 'name' => $langary_auth['member']['list']['player'], 'icon' => 'icon-lock', 'path' => 'member/index.php', 'auth' => 30),
                    'anchor' => array('key' => 4, 'name' => $langary_auth['member']['list']['anchor'], 'icon' => 'icon-lock', 'path' => 'anchor/index.php', 'auth' => 30)
                )
            ),
            'dispensing' => array('key' => 3, 'name' => $langary_auth['dispensing']['name'], 'icon' => 'icon-usd', 'auth' => 30,
                'list' => array(
                    'bank' => array('key' => 1, 'name' => $langary_auth['dispensing']['list']['bank'], 'icon' => 'icon-usd', 'path' => 'bank/index.php', 'auth' => 30),
                    'bank_card' => array('key' => 2, 'name' => $langary_auth['dispensing']['list']['bank_card'], 'icon' => 'icon-usd', 'path' => 'bank_card/index.php', 'auth' => 30),
                    'app' => array('key' => 3, 'name' => $langary_auth['dispensing']['list']['application'], 'icon' => 'icon-usd', 'path' => 'dispensing/index.php', 'auth' => 30),
                    'dispencheck' => array('key' => 4, 'name' => $langary_auth['dispensing']['list']['check'], 'icon' => 'icon-usd', 'path' => 'dispensing_check/index.php', 'auth' => 30),
                    'dislog' => array('key' => 5, 'name' => $langary_auth['dispensing']['list']['log'], 'icon' => 'icon-usd', 'path' => 'dispensing_log/index.php', 'auth' => 30)
                )
            ),
            'deposit' => array('key' => 4, 'name' => $langary_auth['deposit']['name'], 'icon' => 'icon-usd', 'auth' => 30,
                'list' => array(
                    'application' => array('key' => 4, 'name' => $langary_auth['deposit']['list']['application'], 'icon' => 'icon-usd', 'path' => 'deposit/index.php', 'auth' => 30),
                    'deposit_check' => array('key' => 5, 'name' => $langary_auth['deposit']['list']['check'], 'icon' => 'icon-usd', 'path' => 'deposit_check/index.php', 'auth' => 30),                  
                    'deposit_log' => array('key' => 6, 'name' => $langary_auth['deposit']['list']['log'], 'icon' => 'icon-usd', 'path' => 'deposit_log/index.php', 'auth' => 30)
                )
            ),
            'product' => array('key' => 7, 'name' => $langary_auth['product']['name'], 'icon' => 'icon-usd', 'auth' => 30,
                'list' => array(
                    'product_data' => array('key' => 1, 'name' => $langary_auth['product']['list']['product_data'], 'icon' => 'icon-usd', 'path' => 'product/index.php', 'auth' => 30),
                    'product_log' => array('key' => 2, 'name' => $langary_auth['product']['list']['product_log'], 'icon' => 'icon-usd', 'path' => 'product_log/index.php', 'auth' => 30)
                )
            ),
            'pay' => array('key' => 5, 'name' => $langary_auth['pay']['name'], 'icon' => 'icon-usd', 'auth' => 30,
                'list' => array(
                    'mycard' => array('key' => 2, 'name' => $langary_auth['pay']['list']['mycard'], 'icon' => 'icon-usd', 'path' => 'mycard/index.php', 'auth' => 30),                  
                )
            ),
            'program' => array('key' => 8, 'name' => $langary_auth['program']['name'], 'icon' => 'icon-lock', 'auth' => 30,
                'list' => array(
                    'program_list' => array('key' => 1, 'name' => $langary_auth['program']['list']['program_list'], 'icon' => 'icon-lock', 'path' => 'program_list/index.php', 'auth' => 30),
                    'program_tag' => array('key' => 1, 'name' => $langary_auth['program']['list']['program_tag'], 'icon' => 'icon-lock', 'path' => 'program_tag/index.php', 'auth' => 30)

                )
            )
        );
    }

    //獲得權限的名稱
    public static function getAuthName($main_key, $fun_key)
    {
        if (!is_array(self::$authNameAry)) {
            $authary = array();
            $temp = self::$Auth;
            foreach ($temp as $rowtemp) {
                $listtemp = array();
                if (isset($rowtemp['list'])) {
                    foreach ($rowtemp['list'] as $tt) {
                        $listtemp[$tt['key']] = $tt['name'];
                    }
                }
                $authary[$rowtemp['key']] = array('name' => $rowtemp['name'], 'sub' => $listtemp);
            }
            self::$authNameAry = $authary;
        }

        $authNameAry = self::$authNameAry;
        $main = isset($authNameAry[$main_key]['name']) ? $authNameAry[$main_key]['name'] : '';
        $fun = isset($authNameAry[$main_key]['sub'][$fun_key]) ? $authNameAry[$main_key]['sub'][$fun_key] : '';
        return array('main' => $main, 'fun' => $fun);
    }

    //回傳主功能陣列
    public static function getAuthMainKeyAry()
    {
        $temp = self::$Auth;
        $data = array();
        foreach ($temp as $key => $row) {
            $data[] = array('name' => $row['name'], 'value' => $row['key']);
        }
        return $data;
    }

    //權限驗證 (fun_key=0 , log_key=0 代表有所有子權限、操作權限)
    //項目權限驗證
    public static function Auth($_key)
    {
        global $langary_coderadmin_all;
        /*if(isset(self::$Auth[$_key])){//第一階
            $auth=self::$Auth[$_key];
            $auth['main_key']=$auth['key'];
            $auth['fun_key']=0;
            return $auth;
        }else{*/
        foreach (self::$Auth as $key => $item) {
            if (isset($item['list']) && array_key_exists($_key, $item['list'])) {//第二階
                $auth = $item['list'][$_key];
                $auth['main_key'] = $item['key'];
                $auth['fun_key'] = $auth['key'];
                return $auth;
            }
        }
        die($langary_coderadmin_all['error']);
        /*}*/
    }

    //操作權限驗證
    public static function vaild($auth, $log_type = '', $throwException = 0)
    {
        global $langary_coderadmin_all;
        $throwException = (int)$throwException;
        $log_key = ($log_type != '' ? coderAdminLog::getActionKey($log_type) : 0);

        if (!self::isAuth($auth, $log_key)) {
            $msg = $langary_coderadmin_all['msg'];
            if ($throwException === 0) {
                self::drawBody($langary_coderadmin_all['msg2'], $msg);
            } elseif ($throwException === 1) {
                throw new Exception($msg);
            } elseif ($throwException === 2) {
                echo $msg;
                exit;
            } elseif ($throwException === 3) {
                return false;
            }
        }
        return true;
    }

    public static function isAuth($auth, $log_key = 0)
    {
        $user = self::getUser();
        if (self::isInAuth($user['auth'], $auth['main_key'], $auth['fun_key'], $log_key)) {
            return true;
        }

        return false;
    }

    /*
    判斷是否有權限
    $ary_auth user的權限列表
    $main_key 主功能
    $fun_key  副功能
    $log_key  操作類型,對應coderAdminLog中的$active
    */
    public static function isInAuth($ary_auth, $main_key, $fun_key = 0, $log_key = 0)
    {
        if ($ary_auth === self::$admin_code) {//超級管理員
            return true;
        }
        foreach ($ary_auth as $key => $item) {
            if ($item['main_key'] == $main_key && ($fun_key == 0 || $fun_key == $item['fun_key']) && ($log_key == 0 || $item['auth'] & $log_key)) {
                return true;
            }
        }
        return false;
    }

//取得符合條件的使用者資訊 From db
    public static function getUserData($type, $data)
    {
        global $db, $admin_path_admin,$langary_coderadmin_all;
        $table_admin = coderDBConf::$admin;
        $colname_admin = coderDBConf::$col_admin;
        $fild = self::get_adminField();
        $where = '';
        $wheredata = array();
        switch ($type) {//設置取得的條件
            case 'usernameAndPsw'://用username和密碼登入
                if (empty($data['username']) || empty($data['password']) || empty($data['actype'])) {
                    throw new Exception($langary_coderadmin_all['exception']);
                }
                $where = "`{$colname_admin['username']}`=:username and `{$colname_admin['password']}`=:password and `{$colname_admin['level']}`=:type";
                $wheredata = array(':username' => $data['username'], ':password' => $data['password'], ':type' => $data['actype']);
                break;
            case 'mid'://記住我 檢測cookid的mid
                if (empty($data['mid'])) {
                    throw new Exception($langary_coderadmin_all['exception']);
                }
                $where = "`{$colname_admin['mid']}`=:mid";
                $wheredata = array(':mid' => $data['mid']);
                break;
            case 'username'://取得使用者資料
                if (empty($data['username'])) {
                    throw new Exception($langary_coderadmin_all['exception']);
                }
                $where = "`{$colname_admin['username']}`=:username";
                $wheredata = array(':username' => $data['username']);
                break;
            default:
                throw new Exception($langary_coderadmin_all['exception2']);
                break;
        }

        //$table_ag=coderDBConf::$agent; //代理人
        //$colname_ag=coderDBConf::$col_agent;
        $sql = "SELECT $fild FROM $table_admin WHERE $where";
        $row = $db->query_first($sql, $wheredata);
        $auth_ary = self::getRulesAuth($row['r_id']);
        if ($row) {
            $mypic = ($row['pic']!="")?$admin_path_admin . 's' . $row['pic']:'../images/nouser.jpg';
            saveCookie("level_type",$row['level']);
            if($row['level'] == '4'){
                $sql2 = "SELECT `{$colname_admin['games_id']}` as games_id FROM $table_admin
                        WHERE `{$colname_admin['id']}`=:id";
                $row2 = $db->query_first($sql2,array(':id'=>$row['serviceid']));
                $row['games_id'] = $row2['games_id'];
            }
            return array('username' => $row['username'],
                'name' => $row['name'],
                'pic' => $mypic,
                'time' => datetime('A H:i'),
                'system' => ($auth_ary === self::$admin_code ? 'supermanage' : (isset($auth_ary[0]) && isset($auth_ary[0]['system']) ? $auth_ary[0]['system'] : '')),
                'auth' => $auth_ary,
                'ispublic' => $row['ispublic'],
                'type' => $row['level'],
                'id' => $row['id'],
                //'serviceid' => $row['serviceid'], //客服 對應代理人
                //'first_upid' => $row['first_upid'] //第一個總代ID
            );
        }
        return false;
    }

//登入
    public static function login($username, $password, $actype, $remember_me = '')
    {
        global $db, $webmanageurl_cookiepath, $admin_path_admin,$langary_coderadmin_all;

        $password = self::pwHash($password);
        $user = self::getUserData('usernameAndPsw', array('username' => $username, 'password' => $password, 'actype' => $actype));
        if (!$user) {
            coderAdminLog::insert($username, 0, 0, 1, $username.$langary_coderadmin_all['login_insert']);
            throw new Exception($langary_coderadmin_all['login_exception']);
        } else if ($user['ispublic'] != 1) {
            coderAdminLog::insert($username, 0, 0, 1, $username.$langary_coderadmin_all['login_insert2']);
            throw new Exception($langary_coderadmin_all['login_exception2']);
        } else {
            $mid_sessionid = self::getmid();
            self::change_admin_logindata(array('username' => $username, 'mid' => $mid_sessionid));

            if ($remember_me === 1) {
                saveCookieHour('mid', $mid_sessionid, 24 * 7, $webmanageurl_cookiepath, true);
            } else {
                unCookie('mid', $webmanageurl_cookiepath);
            }
            self::setUser($user);
            coderAdminLog::insert($username, 0, 0, 1, $username.$langary_coderadmin_all['login_insert3']);
        }

    }

//設置使用者資訊
    public static function setUser($ary)
    {
        global $langary_coderadmin_all;
        if (!is_array($ary)) {
            throw new Exception($langary_coderadmin_all['setUser_exception']);
        } else {
            $_SESSION['manage_loginuser'] = serialize($ary);
        }
    }

//從session cookie db取得使用者資訊
    public static function getUser()
    {
        if (!isset($_SESSION['manage_loginuser']) || $_SESSION['manage_loginuser'] == null) {
            if (self::getUser_cookie()) {
                return self::getUser();
            } else {
                self::showLoginPage();
            }
        } else {
            $user = unserialize($_SESSION['manage_loginuser']);
            if (!is_array($user)) {
                self::showLoginPage();
            } else {
                return $user;
            }
        }
    }

    public static function getUser_cookie()
    {//勾選記住我抓cookie
        global $db, $webmanageurl_cookiepath, $admin_path_admin;
        $mid = getCookie('mid');
        if ($mid != '' && empty($_SESSION['manage_loginuser'])) {
            $user = self::getUserData('mid', array('mid' => $mid));
            if ($user && $user['ispublic'] == 1) {
                $mid_sessionid = self::getmid();
                self::change_admin_logindata(array('username' => $user['username'], 'mid' => $mid_sessionid));
                self::setUser($user);
                saveCookieHour('mid', $mid_sessionid, 24 * 7, $webmanageurl_cookiepath, true);
                return true;
            } else {
                unCookie('mid', $webmanageurl_cookiepath);
            }
        }
        return false;
    }

    //取得角色的權限列表
    public static function getRulesAuth($r_id)
    {
        $table = coderDBConf::$rules;
        $col = coderDBConf::$col_rules;
        $table_auth = coderDBConf::$rules_auth;
        $col_auth = coderDBConf::$col_rules_auth;
        $db = Database::DB();
        $authdata = $db->fetch_all_array("
    		select  ra.{$col_auth['main_key']} as main_key,
    				ra.{$col_auth['fun_key']} as fun_key,
    				ra.{$col_auth['auth']} as auth ,
    				r.{$col['superadmin']},
    				r.{$col['system']} as system
    		FROM $table r 
    		LEFT JOIN $table_auth ra ON r.{$col['id']} = ra.{$col_auth['r_id']}
    		where r.{$col['id']}=:id",
            array(':id' => $r_id));

        return isset($authdata[0][$col['superadmin']]) && $authdata[0][$col['superadmin']] === '1' ? self::$admin_code : $authdata;
    }

    //取得某角色的權限清單
    public static function getAuthListAryByInt($r_id)
    {
        global $db;
        $ary = array();

        $auth = self::getRulesAuth($r_id);

        foreach (self::$Auth as $key => $item) {
            $main_key = $item['key'];

            if (!self::isInAuth($auth, $main_key)) {
                continue;
            }

            if (array_key_exists('list', $item)) {
                foreach ($item['list'] as $subkey => $subitem) {
                    if (self::isInAuth($auth, $main_key, $subitem["key"])) {
                        $item['name'] = $subitem['name'];
                        $item['ck_auth'] = (self::getRowAuth($auth, $main_key, $subitem["key"]) == $subitem["auth"]) ? true : false;
                        $ary[] = self::getReturnElement($item);
                    }
                }
            }
        }
        return $ary;
    }

    private static function getRowAuth($ary_auth, $main_key, $fun_key)
    {
        foreach ($ary_auth as $key => $item) {
            if ($item['main_key'] == $main_key && $fun_key == $item['fun_key']) {
                return $item['auth'];
            }
        }
    }

    private static function getReturnElement($item)
    {
        return array('name' => $item['name'], 'ck_auth' => $item['ck_auth']);
    }

//更新
    //使用者資訊(後台更新使用者資料)
    public static function change_admin_data($username)
    {
        global $db, $admin_path_admin;
        $user = self::getUserData('username', array('username' => $username));
        if ($user) {
            self::setUser($user);
        }
    }

    //登入紀錄
    public static function change_admin_logindata($data)
    {
        global $db;
        $colname_admin = coderDBConf::$col_admin;

        $username = $data['username'];
        $mid = $data['mid'];
        $db->execute("update " . coderDBConf::$admin . " set {$colname_admin['logintime']}=:logintime, {$colname_admin['ip']}=:ip, {$colname_admin['mid']}=:mid where {$colname_admin['username']}=:username ", array(':logintime' => request_cd(), ':ip' => request_ip(), ':username' => $username, 'mid' => $mid));
    }

    //權限更新
    public static function updateAuth($r_id, $ary_fun_auth)
    {
        global $adminuser;
        $db = Database::DB();
        $table = coderDBConf::$rules_auth;
        $col = coderDBConf::$col_rules_auth;

        $db->execute('delete from ' . $table . ' where ' . $col['r_id'] . '=:r_id', array(':r_id' => $r_id));

        $auth_item = array();
        $updata = array();
        $dataupdate = array();
        foreach ($ary_fun_auth as $key => $value) {
            $item = explode('_', $value);
            $main_key = $item[0];
            $fun_key = $item[1];
            $auth = $item[2];
            if (!isset($auth_item[$main_key . '_' . $fun_key])) {
                $auth_item[$main_key . '_' . $fun_key] = 0;
            }

            $auth_item[$main_key . '_' . $fun_key] += $auth;
        }

        foreach ($auth_item as $key => $value) {
            $item = explode('_', $key);

            $updata[] = array(
                $col['main_key'] => $item[0],
                $col['fun_key'] => $item[1],
                $col['auth'] => $value,
                $col['r_id'] => $r_id,
                $col['admin'] => $adminuser['username'],
                $col['updatetime'] => 'NOW()',
                $col['createtime'] => 'NOW()',
            );
        }
        $dataupdate[$col['updatetime']] = 'NOW()';
        $dataupdate[$col['admin']] = $adminuser['username'];

        $db->query_insert_update($table, $updata, $dataupdate, true);

        return;
    }


//登出
    public static function loginOut()
    {
        global $webmanageurl_cookiepath;
        unCookie('mid', $webmanageurl_cookiepath);
        unset($_SESSION['manage_loginuser']);
    }

//function
    public static function getmid()
    {
        global $db;
        $colname_admin = coderDBConf::$col_admin;
        $mid = substr(md5(uniqid()) . time() . rand(1, 99999) . session_id(), 0, 90);
        if ($db->isExisit(coderDBConf::$admin, $colname_admin['mid'], $mid)) {
            $mid = self::getmid();
        }
        return $mid;
    }

    public static function pwHash($str)
    {
        return hash('sha512', $str);
    }

//繪製區塊
    public static function sayHello()
    {
        global $langary_coderadmin_all;
        $talktype = rand(0, 1);

        //一般問候
        if ($talktype == 0) {
            $ary_talk = array($langary_coderadmin_all['sayHello_1']['text_1'], $langary_coderadmin_all['sayHello_1']['text_2'], $langary_coderadmin_all['sayHello_1']['text_3'], $langary_coderadmin_all['sayHello_1']['text_4'], $langary_coderadmin_all['sayHello_1']['text_5'], $langary_coderadmin_all['sayHello_1']['text_6'], $langary_coderadmin_all['sayHello_1']['text_7'], $langary_coderadmin_all['sayHello_1']['text_8']);
        } else {//依時間問候
            $hour = datetime('H');
            if ($hour > 5 && $hour < 9) { //早上5點到9點登入
                $ary_talk = array($langary_coderadmin_all['sayHello_2']['text_1'], $langary_coderadmin_all['sayHello_2']['text_2'], $langary_coderadmin_all['sayHello_2']['text_3'], $langary_coderadmin_all['sayHello_2']['text_4'], $langary_coderadmin_all['sayHello_2']['text_5'], $langary_coderadmin_all['sayHello_2']['text_6'], $langary_coderadmin_all['sayHello_2']['text_7'], $langary_coderadmin_all['sayHello_2']['text_8'], $langary_coderadmin_all['sayHello_2']['text_9']);
            } else if ($hour > 9 && $hour < 11) {
                $ary_talk = array($langary_coderadmin_all['sayHello_3']['text_1'], $langary_coderadmin_all['sayHello_3']['text_2'], $langary_coderadmin_all['sayHello_3']['text_3'], $langary_coderadmin_all['sayHello_3']['text_4'], $langary_coderadmin_all['sayHello_3']['text_5']);
            } else if ($hour > 10 && $hour < 14) {
                $ary_talk = array($langary_coderadmin_all['sayHello_4']['text_1'], $langary_coderadmin_all['sayHello_4']['text_2'], $langary_coderadmin_all['sayHello_4']['text_3'], $langary_coderadmin_all['sayHello_4']['text_4']);
            } else if ($hour > 13 && $hour < 17) {
                $ary_talk = array($langary_coderadmin_all['sayHello_5']['text_1'], $langary_coderadmin_all['sayHello_5']['text_2'], $langary_coderadmin_all['sayHello_5']['text_3'], $langary_coderadmin_all['sayHello_5']['text_4'], $langary_coderadmin_all['sayHello_5']['text_5'], $langary_coderadmin_all['sayHello_5']['text_6']);
            } else if ($hour > 16 && $hour < 20) {
                $ary_talk = array($langary_coderadmin_all['sayHello_6']['text_1'], $langary_coderadmin_all['sayHello_6']['text_2'], $langary_coderadmin_all['sayHello_6']['text_3'], $langary_coderadmin_all['sayHello_6']['text_4'], $langary_coderadmin_all['sayHello_6']['text_5']);
            } else if ($hour > 19 && $hour < 23) {
                $ary_talk = array($langary_coderadmin_all['sayHello_7']['text_1'], $langary_coderadmin_all['sayHello_7']['text_2'], $langary_coderadmin_all['sayHello_7']['text_3'], $langary_coderadmin_all['sayHello_7']['text_4'], $langary_coderadmin_all['sayHello_7']['text_5'], $langary_coderadmin_all['sayHello_7']['text_6'], $langary_coderadmin_all['sayHello_7']['text_7'], $langary_coderadmin_all['sayHello_7']['text_8'], $langary_coderadmin_all['sayHello_7']['text_9']);
            } else if ($hour > 22 && $hour < 02) {
                $ary_talk = array($langary_coderadmin_all['sayHello_8']['text_1'], $langary_coderadmin_all['sayHello_8']['text_2'], $langary_coderadmin_all['sayHello_8']['text_3'], $langary_coderadmin_all['sayHello_8']['text_4'], $langary_coderadmin_all['sayHello_8']['text_5'], $langary_coderadmin_all['sayHello_8']['text_6']);
            } else {
                $ary_talk = array($langary_coderadmin_all['sayHello_9']['text_1'], $langary_coderadmin_all['sayHello_9']['text_2'], $langary_coderadmin_all['sayHello_9']['text_3'], $langary_coderadmin_all['sayHello_9']['text_4'], $langary_coderadmin_all['sayHello_9']['text_5'], $langary_coderadmin_all['sayHello_9']['text_6'], $langary_coderadmin_all['sayHello_9']['text_7']);
            }
            echo $hour;
        }
        return $langary_coderadmin_all['sayHello_10'] . $ary_talk[rand(0, count($ary_talk) - 1)];
    }


    public static function showLoginPage()
    {
        global $langary_coderadmin_all;
        self::drawBody($langary_coderadmin_all['showLoginPage_msg'], $langary_coderadmin_all['showLoginPage_msg2']);
    }

    public static function drawMenu($type_id="")
    {
        global $manage_path, $fun_auth_key,$db,$adminuser,$langary_coderadmin_all;
        $user = self::getUser();
        $auth = $user['auth'];
        // $query_str=$_SERVER['QUERY_STRING'];
        // $query_str=$query_str!='' ? '?'.$query_str : '';
        // $pagename=realpath(request_basename()).$query_str;
        $Auth_ary = self::$Auth;

        foreach ($Auth_ary as $key => $item) {
            $main_key = $item['key'];
            if (!self::isInAuth($auth, $main_key)) {
                continue;
            }


            $classname = '';
            $str = '<a href="'.(isset($item['path'])?$manage_path .$item['path']:'javascript:void(0)').'" class="dropdown-toggle">
						<i class="' . $item['icon'] . '"></i>
						<span>' . $item['name'] . $langary_coderadmin_all['drawMenu_msg2'].'</span>';
            if(!isset($item['path'])) {
                $str .= '	<b class="arrow icon-angle-right"></b>';
            }
            $str .= '</a>';
            if (array_key_exists('list', $item) && !isset($item['path'])) {
                $_str = "";

                foreach ($item['list'] as $subkey => $subitem) {
                    if (self::isInAuth($auth, $main_key, $subitem["key"])) {
                        $path = $subitem['path'];
                        $index = strpos($path, '?');
                        if ($index > 0) {
                            $_subitem = realpath(substr($path, 0, $index)) . substr($path, $index);
                        } else {
                            $_subitem = realpath($path);
                        }

                        $newid = "";
                        if($main_key.'_'.$subitem["key"] == '9_2' || $main_key.'_'.$subitem["key"] == '7_1') {
                            $newid = ($type_id !== "") ? '_' . $type_id : '';
                        }

                        if ($fun_auth_key.$newid === $subkey) {//realpath(request_basename()) == $_subitem || $pagename==$subkey
                            $classname = ' class="active" ';
                            $_str .= '<li ' . $classname . '><a href="' . $manage_path . $path . '" >' . $subitem['name'] . $langary_coderadmin_all['drawMenu_msg2'].'</a></li>';
                        } else {
                            $_str .= '<li ><a href="' . $manage_path . $path . '" >' . $subitem['name'] . $langary_coderadmin_all['drawMenu_msg2'].'</a></li>';
                        }
                    }
                }
                if ($_str != "") {
                    $str .= '<ul class="submenu">' . $_str . '</ul>';
                }
            }
            echo '<li ' . $classname . '>' . $str . '</li>';
        }
    }

    public static function drawAuthForm($r_id = '')
    {
        global $langary_coderadmin_all;
        $user_auth = array();
        if ($r_id != '') {
            $user_auth = self::getRulesAuth($r_id);
        }
        $str = '<table collspan="10" class="table">';
        $str .= "<tr><th width='55'>".$langary_coderadmin_all['drawAuthForm_msg']."</th><th width='150'>".$langary_coderadmin_all['drawAuthForm_msg2']."</th>";
        $ary_action = coderAdminLog::$action;
        // login不需要授權
        unset($ary_action['login']);
        //開始HEADER
        foreach ($ary_action as $key => $act_item) {
            $str .= "<th>{$act_item["name"]}</th>";
        }
        $str .= "</tr>";
        $ary_auth = self::$Auth;
        //每個項目
        foreach ($ary_auth as $key => $auth_item) {
            $main_tab = "";
            $sub_str = "";
            if (isset($auth_item["list"])) {
                foreach ($auth_item["list"] as $skey => $auth_sitem) {
                    $sub_str .= self::getAuthFormTrStr($auth_sitem, $user_auth, $ary_action, $auth_item['key'], $auth_sitem['key']);
                }
            }
            $str .= self::getAuthFormTrStr($auth_item, $user_auth, $ary_action, $auth_item['key'], 0);
            $str .= $sub_str;
        }
        $str .= "</table>";
        echo $str;
    }

    /*
    回傳畫TR的HTML
    $auth_item 該權限的物件
    $ary_action  該操作的物件
    $main_key 主功能key
    $fun_key  副功能key
    */
    private static function getAuthFormTrStr($auth_item, $user_auth, $ary_action, $main_key, $fun_key)
    {
        $style_class = "main_class_" . $main_key;
        $checkbox_name = '';
        $tr_style = '';
        $tr_class = '';

        $tab = "";
        $tab_end = "";
        //主功能
        if ($fun_key == 0) {
            $tab = (isset($auth_item['list'])) ? '<a class="tab tabclose icon-expand-alt" href="javascript:void(0)"></a>' : '';
            $checkbox_name = 'main_auth';
            $tr_class = 'maintr';
        } //子功能
        else {
            $tab = '<div class="col-sm-3">└─&gt;</div><div class="col-sm-9">';
            $tab_end = '</div>';
            $style_class .= " fun_class_" . $fun_key;
            $checkbox_name = 'fun_auth';
            $tr_style = "display:none;";
            $tr_class = 'funtr';
        }

        $str = "<tr class='{$tr_class}' style='{$tr_style}'><td align='center'><input type='checkbox' class='checkall'></td><td>{$tab}{$auth_item['name']}{$tab_end}</td>";
        foreach ($ary_action as $key => $act_item) {
            $checked = '';
            //有子功能的check判斷
            if ($fun_key == 0 && isset($auth_item['list'])) {
                $i = 0;
                $first_chk = true;
                foreach ($auth_item['list'] as $key => $value) {
                    //如果該項目擁有這個權限才繼續
                    if ($value['auth'] & $act_item['key']) {
                        if (self::isInAuth($user_auth, $main_key, $value['key'], $act_item["key"])) {
                            $has_chk = true;
                        } else {
                            $has_chk = false;
                        }

                        if ($i == 0) {
                            $first_chk = $has_chk;
                        } else {
                            if ($first_chk != $has_chk) {
                                break;
                            }
                        }
                        $i++;
                    }

                }
                if ($first_chk == $has_chk && $has_chk == true) {
                    $checked = 'checked';
                }
            } //沒有子功能的的check判斷
            else {
                if (self::isInAuth($user_auth, $main_key, $fun_key, $act_item["key"])) {
                    $checked = 'checked';
                }
            }
            $a_str = ($auth_item["auth"] & $act_item["key"]) ? "<input type='checkbox' class='" . $style_class . "' name='{$checkbox_name}[]' data_action='{$act_item["key"]}' data_main='{$main_key}' data_fun='{$fun_key}' value='{$main_key}_{$fun_key}_{$act_item["key"]}' {$checked}>" : "";
            $str .= "<td align='center'>{$a_str}</td>";
        }
        $str .= "</tr>";
        return $str;
    }


    private static function drawBody($title, $content)
    {
        global $inc_loginlevel,$langary_coderadmin_all;
        $lv = (getCookie("level_type")!="")?getCookie("level_type"):'';
        $link = (isset($inc_loginlevel[$lv]))?'<p class="clearfix"><a href="../'.$inc_loginlevel[$lv].'" class="pull-right"> '.$langary_coderadmin_all['drawBody_msg'].'</a></p>':'';
        die('<!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
					<meta name="description" content="">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
					<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
					<!--flaty css styles-->
					<link rel="stylesheet" href="../css/flaty.css">
					<link rel="stylesheet" href="../css/flaty-responsive.css">
				</head>
				<body class="error-page">
				<div class="error-wrapper">
						<div>
						</div>
						<h5><img src="../images/logo.gif"><span>OOPS</span></h5><p><h5>' . $title . '</h5></p><p>
						' . $content . '
						<hr>'.$link.'
						<!--<p class="clearfix">
							<a href="javascript:void(0)" onclick="window.location.href = document.referrer" class="pull-left">← 回到前一頁</a>
							<a href="../login.php" class="pull-right"> 回到登入頁</a>
						</p>-->
				 <!--basic scripts-->
					<script src="../assets/jquery/jquery-2.0.3.min.js"></script>
					<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
				</body>
			</html>');
    }
}

?>