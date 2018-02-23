<?php
/* 繁中 title ↓ */
$langary_title = "後台管理系統";
/* title ↑ */

/* login.php ↓ */
$langary_login = array(
    'lang' => '語系',
    'alertdiv' => '<strong>登入中...</strong>請稍候',
    'actype' => '請選擇身份',
    'username' => '請在此輸入您的帳號',
    'password' => '請在此輸入您的密碼',
    'code' => '右圖數字',
    'codeimg1' => '看不清楚嗎?',
    'codeimg2' => '點我就可以重新取得一組新的驗證圖片!',
    'remember' => '記住我',
    'formbtn' => '登入',
    'forgot' => '驗證中...',
    'forgot2' => '請稍候',
    'forgot3' => '請在此輸入您的Email',
    'forgot4' => '寄出驗證信',
    'forgot5' => '← 回登入頁',
);

//帳號身份
$langary_actype = array(1=>'管理員',2=>"總代理人",3=>"代理人",4=>"客服");

$langary_actype_text = "身分";

/* login.php ↑ */

/* coderadminlog.php ↓ */
$langary_action = array(
    'login' => '登入',
    'view' => '瀏覽',
    'add' => '新增',
    'edit' => '編輯',
    'del' => '刪除'
);

$langary_coderAdminLog_all = array(
    'insert_msg' => '錯誤的main type',
    'insert_msg2' => '錯誤的fun type',
    'getTypeIndex_msg' => '錯誤的type key值',
    'getActionIndex_msg' => '錯誤的action key值',
    'getActionKey_msg' => '錯誤的act type'
);
/* coderadminlog.php ↑ */

/* coderadmin.php ↓ */
$langary_auth = array(
    'news' => array(
        'name'=>'公告',
        'list'=>array(
            'news_system'=>'系統公告',
            'news_games'=>'遊戲公告'
        )
    ),
    'member' => array(
        'name'=>'會員',
        'list'=>array(
            'platform'=>'平台列表',
            'agent' =>'代理',
            'player'=>'會員列表',
            'anchor'=>'主播列表'
        )
    ),
    'games' => array(
        'name'=>'遊戲設定',
        'list'=>array(
            'games_system'=>'遊戲設定',
            'games_player'=>'玩法設定'
        )
    ),
    'admin' => array(
        'name'=>'登入帳號',
        'list'=>array(
            'admin'=>'帳號列表',
            'adminlog'=>'操作歷程記錄'
        )
    ),
    'auth' => array(
        'name'=>'帳號角色權限',
        'list'=>array(
            'auth_rules'=>'角色列表'
        )
    ),
    'index' => array(
        'name'=>'首頁'
    ),
    'dispensing' => array(
        'name'=>'出款',
        'list'=>array(
            'bank'=>'銀行',
            'bank_card'=>'銀行卡',
            'application'=>'出款申請',
            'check'=>'出款審核',
            'log'=>'出款歷程'
        )
        ),
    'deposit' => array(
        'name'=>'入款',
        'list'=>array(
            'pay'=>'第三方支付',
            'platform'=>'平台名稱',
            'player'=>'玩家',
            'application'=>'入款申請',
            'log'=>'入款歷程',
            'check'=>'入款審核'
        )
    ),
    'product' => array(
        'name'=>'儲值商品',
        'list'=>array(
            'product_data'=>'商品列表',
            'product_log'=>'商品歷程'
        )
        ),
    'pay' => array(
        'name'=>'第三方入款',
        'list'=>array(
            'mycard'=>'mycard入款'
        )
    ),
    'program' => array(
        'name'=>'節目資料',
        'list'=>array(
            'program_list'=>'節目列表',
            'program_tag'=>'標籤列表'
        )
    )


);

$langary_coderadmin_all = array(
    'error' => '權限錯誤~',
    'msg' => '您未擁有操作此項功能的權限,請聯絡系統管理員。',
    'msg2' => '授權失敗!',
    'exception' => '數據遺失',
    'exception2' => 'Error!數據遺失',
    'login_insert' => '登入失敗-帳密不正確',
    'login_exception' => '帳號或密碼不正確!',
    'login_insert2' => '登入失敗-己被停權',
    'login_exception2' => '此帳號己被停權!',
    'login_insert3' => '登入成功',
    'setUser_exception' => 'USER格式不正確,儲存錯誤!',
    'sayHello_1' => array(
        'text_1' => '歡迎登入。','text_2' => '感謝您使用本系統',
        'text_3' => 'Hello :)','text_4' => ' 阿囉哈',
        'text_5' => '記得要微笑 :)','text_6' => '每隔30分鐘記得喝水,出去活動一下。',
        'text_7' => '來杯咖啡嗎?','text_8' => ' hihi!!',
    ),
    'sayHello_2' => array(
        'text_1' => '早安!','text_2' => '早起的鳥兒有蟲吃!',
        'text_3' => '您知道嗎?清晨的空氣特別新鮮','text_4' => '您今天真早',
        'text_5' => '您早','text_6' => '來杯咖啡嗎?',
        'text_7' => '記得吃早餐!','text_8' => '今天真是個美好的一天,不是嗎?',
        'text_9' => '一日之計在於晨',
    ),
    'sayHello_3' => array(
        'text_1' => '您今天加油了嗎?','text_2' => ' 每天告訴自己一次,我真的很不錯',
        'text_3' => '抱最大的希望，為最大的努力，做最壞的打算','text_4' => '喝口水吧',
        'text_5' => '每天都是一年中最美好的日子'
    ),
    'sayHello_4' => array(
        'text_1' => '吃過飯了嗎?','text_2' => ' 記得多吃點蔬菜水果喔~ ',
        'text_3' => '來根香蕉吧!','text_4' => '多吃香蕉有益健康'
    ),
    'sayHello_5' => array(
        'text_1' => '來杯下午茶吧。','text_2' => '每一件事都要用多方面的角度來看它',
        'text_3' => '美好的生命應該充滿期待、驚喜和感激。','text_4' => '天才是百分之一的靈感加上百分之九十九的努力',
        'text_5' => '您累了嗎? 喝杯水吧休息一下吧。','text_6' => '肚子餓的話,吃些點心吧。'
    ),
    'sayHello_6' => array(
        'text_1' => '今天沒什麼事就早點下班吧','text_2' => '記得吃晚餐',
        'text_3' => '晚餐不要吃太多,身體才健康','text_4' => '想像力比知識更重要',
        'text_5' => '晚餐請不要吃太多'
    ),
    'sayHello_7' => array(
        'text_1' => '您辛苦了','text_2' => '別忙到太晚',
        'text_3' => '加油加油!','text_4' => '如果你曾歌頌黎明，那麼也請你擁抱黑夜',
        'text_5' => '吃晚餐了嗎?','text_6' => '沒什麼事就早點休息吧',
        'text_7' => '研究指出,加班會降低工作效率','text_8' => '千萬別吃宵夜',
        'text_9' => '睡前別喝太多水,會水腄'
    ),
    'sayHello_8' => array(
        'text_1' => '請去休息吧!','text_2' => '研究指出,加班會降低工作效率',
        'text_3' => '您睡不著嗎?','text_4' => '感謝每盞亮著的燈,沒留下你一個人',
        'text_5' => '經驗是由痛苦中粹取出來的','text_6' => '天才是百分之一的靈感加上百分之九十九的努力'
    ),
    'sayHello_9' => array(
        'text_1' => '................','text_2' => '唔....',
        'text_3' => '嗯.....','text_4' => '現在是下班時間吧?',
        'text_5' => '天才是百分之一的靈感加上百分之九十九的努力','text_6' => 'XD',
        'text_7' => '囧'
    ),
    'sayHello_10' => '您好 ',
    'showLoginPage_msg' => '登入逾時',
    'showLoginPage_msg2' => '您尚未登入或超過登入期限<br>為了確保安全性<br>請按下方連結重新登入。',
    'drawMenu_msg' => '控盤',
    'drawMenu_msg2' => '管理',
    'drawAuthForm_msg' => '全選',
    'drawAuthForm_msg2' => '項目',
    'drawBody_msg' => '回到登入頁'
);

/* coderadmin.php ↑ */

/* navbar.php ↓ */
$langary_navbar = array(
    'time' => '登入時間',
    'data' => '修改個人資料',
    'loginout' => '登出'
);
/* navbar.php ↑ */

/* Web_Manage/↓ */
//代理人類型
$langary_agent_type = array(
    1 => '佔成',
    2 => '退佣'
);

//代理人上分類型
$langary_pay_type = array(
    1 => '現金制',
    2 => '信用制'
);

//審核
$langary_transfers = array(
    0 => '等待審核',
    1 => '已審核',
    2 => '拒絕',
    3 => '捨棄'
);
$langary_transfers_manage = array(
    0 => '等待審核',
    1 => '已審核',
    2 => '拒絕',
);
$langary_mycard = array(
    0 => '未交易',
    1 => '已交易',
    'Created_date' => '交易時間',
    'Pay_time' => '付款時間',
    'Check_time' => '請款時間'
);
$langary_mycard_pay = array(
    0 => '未請款',
    1 => '已請款'
);
//開獎
$langary_bettings = array(
    0 => '未開獎',
    1 => '已開獎',
    2 => '撤單'
);
$langary_transfers_product = array(
    0 => '未上架',
    1 => '上架中',
    2 => '下架中'
);

//月份
$langary_month = array(
    1=>'一月',
    2=>'二月',
    3=>'三月',
    4=>'四月',
    5=>'五月',
    6=>'六月',
    7=>'七月',
    8=>'八月',
    9=>'九月',
    10=>'十月',
    11=>'十一月',
    12=>'十二月'
);

//星期
$langary_week = array(
    0=>'日',
    1=>'一',
    2=>'二',
    3=>'三',
    4=>'四',
    5=>'五',
    6=>'六'
);

//性別
$langary_sex = array(
    0=>'未知',
    1=>'男',
    2=>'女'
);

//是否
$langary_yn = array(
    0=>'否',
    1=>'是'
);
$langary_check = array(
    0=>'等待支付',
    1=>'已支付'
);
//總攬
$langary_acc_table = array(
    1=>'近7日內',
    2=>'本月',
    3=>'上月',
    4=>'總數'
);

//代理人連結 - 狀態
$langary_agents_link = array(
    0=>'未啟用',
    1=>'啟用',
    2=>'停用'
);

//性別
$langary_hometitle = array(
    'title'=>'代理人連結'
);

//帳務
$langary_agents_acc = array(
    0=>'未結算',
    1=>'已結算'
);

/* 即時控盤 ↓ */
$langary_control_ranking = array(
    1=>'冠軍',2=>'亞軍',3=>'季軍',4=>'第四',5=>'第五',
    6=>'第六',7=>'第七',8=>'第八',9=>'第九',10=>'第十'
);

/* 即時控盤 ↑ */

/* 公用 Web_Manage/..../ ↓ */
$langary_config = array(
    'page_desc'=>'後台管理者帳號管理區。您可以在這裡檢視所有帳號，或對帳號進行新增、修改、刪除等操作。',
    'page_desc2'=>'後台使用者操作記錄列表,此區僅供瀏覽操作紀錄。',
    'page_desc3'=>'您可將內容修改為希望呈現的內容。',
    'page_desc4'=>'您可以在這裡檢視所有資料,或進行新增、修改、刪除等操作。',
    'mtitle'=>'管理'
);

$langary_delservice = array(
    'msg' => '未知錯誤,請聯絡系統管理員',
    'msg2' => '未選取刪除資料',
    'exception' => '查無刪除資料',
    'insert' => '筆資料'
);

$langary_orderservice = array(
    'msg' => '未知錯誤,請聯絡系統管理員',
    'msg2' => '未設定排序資料',
    'insert' => '排序'
);

$langary_edit_add = array(
    'edit' => '編輯',
    'add' => '新增',
    'view' => '瀏覽'
);

$langary_manage = array(
    'exception' => '查無相關資料!',
    'admin' => '管理者 : ',
    'createtime' => '建立時間 :',
    'updatetime' => '上次修改時間 :',
    'logintime' => '最後登入時間 :',
    'ip' => '最後登入IP :',
    'page_title' => '管理',
    'system' => '系統資訊 : ',
    'ok' => '完成',
    'confirm_cancel' => '確定要取消',
    'confirm_finish' => '確定完成',
    'confirm_delete' => '確定要捨棄',
    'cancel' => '取消',
    'close' => '關閉',
);

$langary_index = array(
    'page_title' => '管理'
);

$langary_Web_Manage_all = array(
    'keyword' => '關鍵字',
    'title' => '標題',
    'title_p' => '請輸入標題',
    'date' => '日期',
    'date_p' => '請輸入日期',
    'manager' => '最後管理者',
    'is_public' => '公開',
    'create_time' => '建立日期',
    'update_time' => '最後修改時間',
    'login_time' => '申請日期',
    'contents' => '內容',
    'id' => 'ID',
    'insert' => '列表',
    'username' => '登入帳號',
    'ip' => 'ip',
    'main_key' => '主功能',
    'createdata' => '操作日期',
    'mtitle_log' => '操作記錄瀏覽',
    'fun_key' => '次功能',
    'action' => '操作',
    'descript' => '資訊',
    'createtime' => '操作時間',
    'name' => '玩家名稱',
    'name_p' => '請輸入玩家名稱',
    'email' => 'E-mail',
    'admin' => '管理員',
    'ispublic' => '啟用',
    'group' => '遊戲名稱',
    'r_id' => '所屬權限角色',
    'username_p' => '請輸入管理員帳號',
    'username_h' => '此帳密為登入系統之帳號,不能重覆。',
    'password' => '密碼',
    'password_p' => '請輸入管理員密碼',
    'password_h' => '登入系統之密碼',
    'repassword' => '密碼確認',
    'repassword_p' => '請重新輸入管理員密碼',
    'repassword_h' => '為了確認密碼是否確,麻煩您再輸入一次',
    'email_p' => '請輸入Email',
    'pic' => '圖片',
    'rules_name' => '權限角色',
    'exception' => '帳號',
    'exception2' => '重覆,請重新輸入一組帳號',
    'log' => '操作記錄',
    'log2' => '目前沒有操作記錄。',
    'log3' => '以下為最近5筆操作記錄',
    'pic2' => '縮圖',
    'username_js' => '此帳號己被使用,請重新輸入!',
    'email_js' => '此E-mail己被使用,請重新輸入!',
    'superadmin' => '超級管理員',
    'superadmin_h' => '超級管理員具有最高權限,可以使用所有功能',
    'del' => '總代&代理人角色不可刪除!',
    'del2' => '已有帳號指定為欲刪除的角色，請先將其修改為其他角色',
    'r_name' => '角色名稱',
    'r_name_p' => '請輸入角色名稱',
    'r_agents' => '代理人帳號使用',
    'r_agents_h' => '新增代理人帳號使用',
    'r_service' => '客服帳號使用',
    'r_service_h' => '新增客服帳號使用',
    'depiction' => '敘述',
    'depiction_p' => '請輸入敘述',
    'rules_m' => '權限設定',
    'r_num' => '管理人成員數量',
    'r_auth' => '操作權限',
    'del3' => '已有玩法設定，勿刪除遊戲!',
    'name2' => '名稱',
    'name2_p' => '請輸入名稱',
    'status' => '狀態',
    'link_name' => '網址名稱',
    'link_name_p' => '請輸入網址名稱',
    'remark' => '備註',
    'remark_p' => '請輸入備註',
    'start_time' => '啟用時間',
    'stop_time' => '停用時間',
    'die_error' => '操作錯誤',
    'details' => '詳細資訊',
    'player' => '玩家',
    'bank' => '銀行',
    'platform' => '平台名稱',
    'parnername' => '成員名稱',
    'parnerage' => '年齡',
    'parnerweight' => '身材',
    'pgram_name' => '節目名稱',
    'url' => '節目網址',
    'tag' => '節目標籤',
    'tag_name' => '標籤名稱',
    'showtime' => '節目時間',
    'chatlog' => '聊天紀錄',
    'product_repeat' => '上架商品重複'
);






/* 公用 Web_Manage/..../ ↑ */

//給所有 js檔案使用
$langary_jsall = array(
    'confirm' => '您確定要刪除這些項目嗎?',
    'confirm_ok' => '確定',
    'confirm_cancel' => '取消',
    'confirm2' => '您確定要刪除',
    'msg' => '請先選擇要被刪除的項目',
    'oops_error' => '讀取資料時發生錯誤,請梢候再試',
    'oops_error2' => '作業失敗',
    'orderList_ok' => '排序作業完成',
    'orderList_ok2' => '排序作業完成',
    'orderList_error' => '排序作業失敗',
    'deleteList_ok' => '刪除作業完成',
    'deleteList_ok2' => '您己成功刪除',
    'deleteList_ok3' => '筆資料',
    'deleteList_error' => '刪除作業失敗',
    'showList' => '回傳資料錯誤',
    'showModifyContent_ordertitle' => '必須要用排序欄位排序才可使用',
    'showModifyContent_up' => '上移',
    'showModifyContent_down' => '下移',
    'showModifyContent_edit' => '修改',
    'showModifyContent_del' => '刪除',
    'getSearchPara_alert' => '您的搜尋條件無法順利執行',
    'getSearchPara_alert2' => '有些欄位格式不正確導致搜尋無法完全顯示,請檢查輸入條件是否正確!<br>',
    'checkFormat_alert' => '必須為yyyy-mm-dd格式<br>',
    'checkFormat_alert2' => '必須為數字格式<br>',
    'username_required' => '請輸入登入帳號',
    'password_required' => '請輸入登入密碼',
    'code_required' => '請輸入右圖數字',
    'forgotme_email' => '請輸入您的E-mail',
    'formbtn_alert' => '驗證登入資訊中...',
    'formbtn_alert2' => '請稍候',
    'sendauthemail' => '準備發送驗證信...',
    'sendauthemail2' => '請稍候',
    'sendauthemail_vaildResult' => '確認信已寄出，請至信箱查收',
    'vaildResult' => '驗證完成!',
    'vaildResult2' => '準備進入系統..',
    'vaildResult3' => '驗證失敗!',
    'fileupload' => '請先上傳檔案',
    'fileupload2' => '點我上傳檔案',
    'fileupload3' => '點我移除檔案',
    'fileupload4' => '檔案類型不正確',
    'fileupload5' => '上傳作業完成',
    'fileupload6' => '您己成功上傳檔案。',
    'fileupload7' => '上傳失敗:',
    'fileupload8' => '點我瀏覽檔案',
    'fileupload9' => '資料傳送發生錯誤!!請在試一次!',

);
$langary_jsall = json_encode($langary_jsall);









/* Web_Manage/ ↑ */


/** PHP END **/