<?php
/* 简中 title ↓ */
$langary_title = "后台管理系统";
/* title ↑ */

/* login.php ↓ */
$langary_login = array(
    'lang' => '语系',
    'alertdiv' => '<strong>登入中...</strong>请稍候',
    'actype' => '请选择身份',
    'username' => '请在此输入您的账号',
    'password' => '请在此输入您的密码',
    'code' => '右图数字',
    'codeimg1' => '看不清楚吗?',
    'codeimg2' => '点我就可以重新取得一组新的验证图片!',
    'remember' => '记住我',
    'formbtn' => '登入',
    'forgot' => '验证中...',
    'forgot2' => '请稍候',
    'forgot3' => '请在此输入您的Email',
    'forgot4' => '寄出验证信',
    'forgot5' => '← 回登入页',
);

//账号身份
$langary_actype = array(1=>'管理员',2=>"总代理人",3=>"代理人",4=>"客服");

$langary_actype_text = "身分";

/* login.php ↑ */

/* coderadminlog.php ↓ */
$langary_action = array(
    'login' => '登入',
    'view' => '浏览',
    'add' => '新增',
    'edit' => '编辑',
    'del' => '删除'
);

$langary_coderAdminLog_all = array(
    'insert_msg' => '错误的main type',
    'insert_msg2' => '错误的fun type',
    'getTypeIndex_msg' => '错误的type key值',
    'getActionIndex_msg' => '错误的action key值',
    'getActionKey_msg' => '错误的act type'
);
/* coderadminlog.php ↑ */

/* coderadmin.php ↓ */
$langary_auth = array(
    'news' => array(
        'name'=>'公告',
        'list'=>array(
            'news_system'=>'系统公告',
            'news_games'=>'游戏公告'
        )
    ),
    'company' => array(
        'name'=>'公司报表',
        'list'=>array(
            'company_data'=>'公司报表'
        )
    ),
    'agents' => array(
        'name'=>'代理',
        'list'=>array(
            'admin_agent'=>'总代理人列表',
            'agents_acc'=>'代理帐务',
            'agents_data'=>'代理人列表',
            'agents_service'=>'人员管理列表',
            'individuation'=>'个性化设定',
            'agents_link'=>'代理链接',
            'agents_offer'=>'代理优惠'
        )
    ),
    'player' => array(
        'name'=>'玩家',
        'list'=>array(
            'player_data'=>'玩家列表',
            'users_group'=>'玩家群组列表',
            'player_log'=>'玩家下注纪录',
            'player_orderlog'=>'追单纪录'
        )
    ),
    'finance' => array(
        'name'=>'财务报表',
        'list'=>array(
            'finance_day'=>'日报表',
            'finance_numerical'=>'统计报表'
        )
    ),
    'control' => array(
        'name'=>'实时控盘',
        'list'=>array(
            'control_double'=>'双面盘',
            'control_oneten'=>'1-10位',
            'control_color'=>'猜车选色区',
            'control_bp'=>'庄闲制'
        )
    ),
    'lottery' => array(
        'name'=>'开奖纪录',
        'list'=>array(
            'lottery_data'=>'北京赛车',
            'lottery_data1'=>'幸运赛艇'
        )
    ),
    'games' => array(
        'name'=>'游戏设定',
        'list'=>array(
            'games_system'=>'游戏设定',
            'games_player'=>'玩法设定'
        )
    ),
    'acc' => array(
        'name'=>'帐务',
        'list'=>array(
            'acc_table'=>'总揽列表',
            'acc_on'=>'上分申请',
            'acc_under'=>'下分申请',
            'acc_on_check'=>'上分申请审核',
            'acc_under_check'=>'下分申请审核'
        )
    ),
    'exchange' => array(
        'name'=>'币种',
        'list'=>array(
            'exchange_rate'=>'币种列表'
        )
    ),

    'admin' => array(
        'name'=>'登入账号',
        'list'=>array(
            'admin'=>'账号列表',
            'adminlog'=>'操作历程记录'
        )
    ),
    'auth' => array(
        'name'=>'账号角色权限',
        'list'=>array(
            'auth_rules'=>'角色列表'
        )
    ),
    'index' => array(
        'name'=>'首页'
    )
);

$langary_coderadmin_all = array(
    'error' => '权限错误~',
    'msg' => '您未拥有操作此项功能的权限,请联络系统管理员。',
    'msg2' => '授权失败!',
    'exception' => '数据遗失',
    'exception2' => 'Error!数据遗失',
    'login_insert' => '登入失败-帐密不正确',
    'login_exception' => '账号或密码不正确!',
    'login_insert2' => '登入失败-己被停权',
    'login_exception2' => '此账号己被停权!',
    'login_insert3' => '登入成功',
    'setUser_exception' => 'USER格式不正确,储存错误!',
    'sayHello_1' => array(
        'text_1' => '欢迎登入。','text_2' => '感谢您使用本系统',
        'text_3' => 'Hello :)','text_4' => ' 阿啰哈',
        'text_5' => '记得要微笑 :)','text_6' => '每隔30分钟记得喝水,出去活动一下。',
        'text_7' => '来杯咖啡吗?','text_8' => ' hihi!!',
    ),
    'sayHello_2' => array(
        'text_1' => '早安!','text_2' => '早起的鸟儿有虫吃!',
        'text_3' => '您知道吗?清晨的空气特别新鲜','text_4' => '您今天真早',
        'text_5' => '您早','text_6' => '来杯咖啡吗?',
        'text_7' => '记得吃早餐!','text_8' => '今天真是个美好的一天,不是吗?',
        'text_9' => '一日之计在于晨',
    ),
    'sayHello_3' => array(
        'text_1' => '您今天加油了吗?','text_2' => ' 每天告诉自己一次,我真的很不错',
        'text_3' => '抱最大的希望，为最大的努力，做最坏的打算','text_4' => '喝口水吧',
        'text_5' => '每天都是一年中最美好的日子'
    ),
    'sayHello_4' => array(
        'text_1' => '吃过饭了吗?','text_2' => ' 记得多吃点蔬菜水果喔~ ',
        'text_3' => '来根香蕉吧!','text_4' => '多吃香蕉有益健康'
    ),
    'sayHello_5' => array(
        'text_1' => '来杯下午茶吧。','text_2' => '每一件事都要用多方面的角度来看它',
        'text_3' => '美好的生命应该充满期待、惊喜和感激。','text_4' => '天才是百分之一的灵感加上百分之九十九的努力',
        'text_5' => '您累了吗? 喝杯水吧休息一下吧。','text_6' => '肚子饿的话,吃些点心吧。'
    ),
    'sayHello_6' => array(
        'text_1' => '今天没什么事就早点下班吧','text_2' => '记得吃晚餐',
        'text_3' => '晚餐不要吃太多,身体才健康','text_4' => '想象力比知识更重要',
        'text_5' => '晚餐请不要吃太多'
    ),
    'sayHello_7' => array(
        'text_1' => '您辛苦了','text_2' => '别忙到太晚',
        'text_3' => '加油加油!','text_4' => '如果你曾歌颂黎明，那么也请你拥抱黑夜',
        'text_5' => '吃晚餐了吗?','text_6' => '没什么事就早点休息吧',
        'text_7' => '研究指出,加班会降低工作效率','text_8' => '千万别吃宵夜',
        'text_9' => '睡前别喝太多水,会水腄'
    ),
    'sayHello_8' => array(
        'text_1' => '请去休息吧!','text_2' => '研究指出,加班会降低工作效率',
        'text_3' => '您睡不着吗?','text_4' => '感谢每盏亮着的灯,没留下你一个人',
        'text_5' => '经验是由痛苦中粹取出来的','text_6' => '天才是百分之一的灵感加上百分之九十九的努力'
    ),
    'sayHello_9' => array(
        'text_1' => '................','text_2' => '唔....',
        'text_3' => '嗯.....','text_4' => '现在是下班时间吧?',
        'text_5' => '天才是百分之一的灵感加上百分之九十九的努力','text_6' => 'XD',
        'text_7' => '囧'
    ),
    'sayHello_10' => '您好 ',
    'showLoginPage_msg' => '登入逾时',
    'showLoginPage_msg2' => '您尚未登入或超过登入期限<br>为了确保安全性<br>请按下方连结重新登入。',
    'drawMenu_msg' => '控盘',
    'drawMenu_msg2' => '管理',
    'drawAuthForm_msg' => '全选',
    'drawAuthForm_msg2' => '项目',
    'drawBody_msg' => '回到登入页'
);

/* coderadmin.php ↑ */

/* navbar.php ↓ */
$langary_navbar = array(
    'time' => '登入时间',
    'data' => '修改个人资料',
    'loginout' => '注销'
);
/* navbar.php ↑ */

/* Web_Manage/↓ */
//代理人类型
$langary_agent_type = array(
    1 => '占成',
    2 => '退佣'
);

//代理人上分类型
$langary_pay_type = array(
    1 => '现金制',
    2 => '信用制'
);

//审核
$langary_transfers = array(
    0 => '等待审核',
    1 => '已审核',
    2 => '拒绝'
);

//开奖
$langary_bettings = array(
    0 => '未开奖',
    1 => '已开奖',
    2 => '撤单'
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

//性别
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

//总揽
$langary_acc_table = array(
    1=>'近7日内',
    2=>'本月',
    3=>'上月',
    4=>'总数'
);

//代理人连结 - 状态
$langary_agents_link = array(
    0=>'未启用',
    1=>'启用',
    2=>'停用'
);

//性别
$langary_hometitle = array(
    'title'=>'代理人连结'
);

//帐务
$langary_agents_acc = array(
    0=>'未结算',
    1=>'已结算'
);

/* 实时控盘 ↓ */
$langary_control_ranking = array(
    1=>'冠军',2=>'亚军',3=>'季军',4=>'第四',5=>'第五',
    6=>'第六',7=>'第七',8=>'第八',9=>'第九',10=>'第十'
);

/* 实时控盘 ↑ */

/* 公用 Web_Manage/..../ ↓ */
$langary_config = array(
    'page_desc'=>'后台管理者账号管理区。您可以在这里检视所有账号，或对账号进行新增、修改、删除等操作。',
    'page_desc2'=>'后台用户操作记录列表,此区仅供浏览操作纪录。',
    'page_desc3'=>'您可将内容修改为希望呈现的内容。',
    'page_desc4'=>'您可以在这里检视所有资料,或进行新增、修改、删除等操作。',
    'mtitle'=>'管理'
);

$langary_delservice = array(
    'msg' => '未知错误,请联络系统管理员',
    'msg2' => '未选取删除数据',
    'exception' => '查无删除数据',
    'insert' => '笔资料'
);

$langary_orderservice = array(
    'msg' => '未知错误,请联络系统管理员',
    'msg2' => '未设定排序数据',
    'insert' => '排序'
);

$langary_edit_add = array(
    'edit' => '编辑',
    'add' => '新增'
);

$langary_manage = array(
    'exception' => '查无相关资料!',
    'admin' => '管理者 : ',
    'createtime' => '建立时间 :',
    'updatetime' => '上次修改时间 :',
    'logintime' => '最后登入时间 :',
    'ip' => '最后登入IP :',
    'page_title' => '管理',
    'system' => '系统信息 : ',
    'ok' => '完成',
    'confirm_cancel' => '确定要取消',
    'cancel' => '取消',
);

$langary_index = array(
    'page_title' => '管理'
);

$langary_Web_Manage_all = array(
    'keyword' => '关键词',
    'title' => '标题',
    'title_p' => '请输入标题',
    'date' => '日期',
    'date_p' => '请输入日期',
    'manager' => '最后管理者',
    'is_public' => '公开',
    'create_time' => '建立日期',
    'update_time' => '最后修改时间',
    'contents' => '内容',
    'id' => 'ID',
    'insert' => '列表',
    'username' => '登入账号',
    'ip' => 'ip',
    'main_key' => '主功能',
    'createdata' => '操作日期',
    'mtitle_log' => '操作记录浏览',
    'fun_key' => '次功能',
    'action' => '操作',
    'descript' => '信息',
    'createtime' => '操作时间',
    'name' => '名字',
    'name_p' => '请输入名字',
    'email' => 'E-mail',
    'admin' => '管理员',
    'ispublic' => '启用',
    'r_id' => '所属权限角色',
    'username_p' => '请输入管理员账号',
    'username_h' => '此帐密为登入系统之账号,不能重复。',
    'password' => '密码',
    'password_p' => '请输入管理员密码',
    'password_h' => '登入系统之密码',
    'repassword' => '密码确认',
    'repassword_p' => '请重新输入管理员密码',
    'repassword_h' => '为了确认密码是否确,麻烦您再输入一次',
    'email_p' => '请输入Email',
    'pic' => '图片',
    'rules_name' => '权限角色',
    'exception' => '账号',
    'exception2' => '重复,请重新输入一组账号',
    'log' => '操作记录',
    'log2' => '目前没有操作记录。',
    'log3' => '以下为最近5笔操作记录',
    'pic2' => '缩图',
    'username_js' => '此账号己被使用,请重新输入!',
    'email_js' => '此E-mail己被使用,请重新输入!',
    'superadmin' => '超级管理员',
    'superadmin_h' => '超级管理员具有最高权限,可以使用所有功能',
    'del' => '总代&代理人角色不可删除!',
    'del2' => '已有账号指定为欲删除的角色，请先将其修改为其他角色',
    'r_name' => '角色名称',
    'r_name_p' => '请输入角色名称',
    'r_agents' => '代理人账号使用',
    'r_agents_h' => '新增代理人账号使用',
    'r_service' => '客服账号使用',
    'r_service_h' => '新增客服账号使用',
    'depiction' => '叙述',
    'depiction_p' => '请输入叙述',
    'rules_m' => '权限设定',
    'r_num' => '管理人成员数量',
    'r_auth' => '操作权限',
    'del3' => '已有玩法设定，勿删除游戏!',
    'name2' => '名称',
    'name2_p' => '请输入名称',
    'status' => '状态',
    'link_name' => '网址名称',
    'link_name_p' => '请输入网址名称',
    'remark' => '备注',
    'remark_p' => '请输入备注',
    'start_time' => '启用时间',
    'stop_time' => '停用时间',
);






/* 公用 Web_Manage/..../ ↑ */

//给所有 js档案使用
$langary_jsall = array(
    'confirm' => '您确定要删除这些项目吗?',
    'confirm_ok' => '确定',
    'confirm_cancel' => '取消',
    'confirm2' => '您确定要删除',
    'msg' => '请先选择要被删除的项目',
    'oops_error' => '读取数据时发生错误,请梢候再试',
    'oops_error2' => '作业失败',
    'orderList_ok' => '排序作业完成',
    'orderList_ok2' => '排序作业完成',
    'orderList_error' => '排序作业失败',
    'deleteList_ok' => '删除作业完成',
    'deleteList_ok2' => '您己成功删除',
    'deleteList_ok3' => '笔资料',
    'deleteList_error' => '删除作业失败',
    'showList' => '回传数据错误',
    'showModifyContent_ordertitle' => '必须要用排序字段排序才可使用',
    'showModifyContent_up' => '上移',
    'showModifyContent_down' => '下移',
    'showModifyContent_edit' => '修改',
    'showModifyContent_del' => '删除',
    'getSearchPara_alert' => '您的搜寻条件无法顺利执行',
    'getSearchPara_alert2' => '有些字段格式不正确导致搜寻无法完全显示,请检查输入条件是否正确!<br>',
    'checkFormat_alert' => '必须为yyyy-mm-dd格式<br>',
    'checkFormat_alert2' => '必须为数字格式<br>',
    'username_required' => '请输入登入账号',
    'password_required' => '请输入登入密码',
    'code_required' => '请输入右图数字',
    'forgotme_email' => '请输入您的E-mail',
    'formbtn_alert' => '验证登入信息中...',
    'formbtn_alert2' => '请稍候',
    'sendauthemail' => '准备发送验证信...',
    'sendauthemail2' => '请稍候',
    'sendauthemail_vaildResult' => '确认信已寄出，请至信箱查收',
    'vaildResult' => '验证完成!',
    'vaildResult2' => '准备进入系统..',
    'vaildResult3' => '验证失败!',
    'fileupload' => '请先上传档案',
    'fileupload2' => '点我上传档案',
    'fileupload3' => '点我移除档案',
    'fileupload4' => '文件类型不正确',
    'fileupload5' => '上传作业完成',
    'fileupload6' => '您己成功上传档案。',
    'fileupload7' => '上传失败:',
    'fileupload8' => '点我浏览档案',
    'fileupload9' => '数据传送发生错误!!请在试一次!',

);
$langary_jsall = json_encode($langary_jsall);









/* Web_Manage/ ↑ */


/** PHP END **/

