<?php
$inc_path="../inc/";
include($inc_path.'_config.php');
//$adminuser=coderAdmin::getUser();

coderAdmin::loginOut();
//header('location:'.$inc_loginlevel[$adminuser['type']]);
header('location:'.$inc_loginlevel[getCookie("level_type")]);
?>