<?php
header('Content-type:application/json; charset=utf-8');
session_start();
include_once 'coderpointhelp.php';
if ( !isset( $_SESSION["origURL"] ) )
    $_SESSION["origURL"] = $_SERVER["HTTP_REFERER"];

$loginless_resultback = array(
    'success' => false,
    'result' => '',
    'code' => 3,
    'message' => 'Please login.'
);

$fal_resultback = array(
    'success' => false,
    'result' => '',
    'code' => 4,
    'message' => 'Contribution failed.'
);

if(1 | $_SESSION["origURL"] == 'http://www.pkfun.xyz/pkfun/live_ins.html'){
//if($_SESSION["origURL"] == 'http://localhost/manage/test/contributiontest.html'){

    if(isset($_SESSION['memberData']) && ($_SESSION['memberData']!="")){
        if(!empty($_POST["anchor_id"])&&!empty($_POST["point"])){
            $member_id = $_SESSION['memberData']['member_id'];
            $anchor_id = $_POST["anchor_id"];
            $point = $_POST["point"];
            $content = $_POST["content"];
            $contribute_ary = array(
                'mem_id' => $member_id,
                'anc_id' => $anchor_id,
                'anc_name' => "",
                'point' => $point,
                'content' => $content
            );
            $contribute = new coderPointHelp();
            $result = $contribute->Contribution($contribute_ary);

            echo json_encode($result);


        }else{
            echo json_encode($fal_resultback);
        }
    }else{
        echo json_encode($loginless_resultback);
    }
}else{
    echo json_encode($fal_resultback);
}

?>





