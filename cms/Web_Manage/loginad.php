<?php
$inc_path = "../inc/";
include($inc_path . '_config.php');

$user_lang = class_lang::getlang();
//語系陣列
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    include_once(dirname(__FILE__) . '\alllang\/' . $user_lang . ".php");
} else {
    include_once(dirname(__FILE__) . '/alllang/' . $user_lang . ".php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $webname . $langary_title ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <!--base css styles-->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">


    <!--page specific css styles-->

    <!--flaty css styles-->
    <link rel="stylesheet" href="css/flaty.css">
    <link rel="stylesheet" href="css/flaty-responsive.css">

    <link rel="shortcut icon" href="img/favicon.png">
    <style>
        .login-page:before, .error-page:before, #main-content {
            background: #e9f0f9;
        }
    </style>
    <script type="text/javascript">
        langary_jsall = <?php echo $langary_jsall?>;
    </script>
</head>
<body class="login-page">

<!-- BEGIN Main Content -->

<div id="loginform" class="login-wrapper" myac="1">


    <!-- BEGIN Login Form -->
    <form id="myform">
        <div style="text-align: center;"><img src="images/logo.gif"></div>

        <hr/>

        <div id="alertdiv" class="alert alert-info" style="display:none">
            <?php echo $langary_login['alertdiv']; ?>
        </div>

        <div id="formcontent">
            <div class="form-group">
                <div class="controls">
                    <label style="margin-left: 5px"><?php echo $langary_login['lang']; ?></label>
                    <?php foreach ($incary_lang as $_lang_k => $_lang_v) { ?>
                        <span style="margin-left: 5px">
                                <input type="radio" id="<?php echo $_lang_k ?>" name="loginlang"
                                       value="<?php echo $_lang_k ?>" <?php echo ($_lang_k != $user_lang) ? '' : 'checked' ?>>
                                <label for="<?php echo $_lang_k ?>"><?php echo $_lang_v ?></label>
                            </span>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls">
                    <input type="text" id="username" name="username"
                           placeholder="<?php echo $langary_login['username']; ?>" class="form-control"
                           autocomplete="off"/>
                </div>
            </div>
            <div class="form-group">
                <div class="controls">
                    <input type="password" id="password" name="password"
                           placeholder="<?php echo $langary_login['password']; ?>" class="form-control"
                           autocomplete="off"/>
                </div>
            </div>
            <div class="form-group">

                <!--<div style="float:left;width:180px;">
                            <input type="text" id="code" name="code" placeholder="<?php /*echo $langary_login['code'];*/ ?>" class="form-control" autocomplete="off"  />
                    </div>
                        <a href="javascript:void(0)" ><img id="codeimg" src="showrandimg.php?time=<?php /*echo time()*/ ?>" style="float:left" onClick="$(this).attr('src','showrandimg.php?time='+getTimeStamp())" class="show-popover" data-trigger="hover" data-placement="top" data-content="<?php /*echo $langary_login['codeimg2'];*/ ?>" data-original-title="<?php /*echo $langary_login['codeimg1'];*/ ?>"></a>
                        <div style="clear:both"></div>
                    </div>-->
                <div class="form-group">
                    <div class="controls">
                        <label class="checkbox"><input type="checkbox" value="1" name="remember_me"
                                                       id="remember_me"><?php echo $langary_login['remember']; ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <button type="button" id="formbtn"
                                class="btn btn-primary form-control"><?php echo $langary_login['formbtn']; ?></button>
                    </div>
                </div>
                <hr/>
            </div>
    </form>
    <!-- END Login Form -->

    <!-- BEGIN Forgot Password Form -->
    <form id="forgot" style="display:none">
        <h3>Get back your password</h3>
        <hr/>
        <div id="alertdiv_email" class="alert alert-info" style="display:none">
            <strong><?php echo $langary_login['forgot']; ?></strong><?php echo $langary_login['forgot2']; ?>
        </div>
        <div id="formforgot">
            <div class="form-group">
                <div class="controls">
                    <input type="text" id="forgotme_email" name="forgotme_email"
                           placeholder="<?php echo $langary_login['forgot3']; ?>" class="form-control"
                           autocomplete="off"/>
                </div>
            </div>
            <div class="form-group">
                <div class="controls">
                    <button type="button" class="btn btn-primary form-control"
                            id="sendauthemail"><?php echo $langary_login['forgot4']; ?></button>
                </div>
            </div>
            <hr/>
            <p class="clearfix">
                <a href="#" class="goto-login pull-left"><?php echo $langary_login['forgot5']; ?></a>
            </p>
        </div>
    </form>
    <!-- END Forgot Password Form -->


</div>
<!-- END Main Content -->

<!--basic scripts-->
<script type="text/javascript" src="assets/jquery/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/nicescroll/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="assets/jquery-cookie/jquery.cookie.js"></script>
<script type="text/javascript" src="assets/jquery-validation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="js/animatehelp.js"></script>
<!--page specific plugin scripts-->
<!--flaty scripts-->
<script src="js/flaty.js"></script>
<script src="js/public.js"></script>
<script language="javascript" type="text/javascript" src="js/login.js"></script>

<script type="text/javascript" src="js/cookie.js"></script>
<script type="text/javascript" src="js/lang.js"></script
</body>
</html>
