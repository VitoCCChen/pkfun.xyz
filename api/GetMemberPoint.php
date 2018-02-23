<?php
include_once "coderpointhelp.php";
session_start();
header('Content-type:application/json; charset=utf-8');
$result_suc =array(
    'success' => true,
    'result' => '',
    'message' => "request successful"
);
$result_fal =array(
    'success' => false,
    'result' => '',
    'message' => "request filed"
);
try{
    if(isset($_SESSION['memberData']) && ($_SESSION['memberData']!="")) {

        $db = Database::DB();
        $member_id = $_SESSION["memberData"]["member_id"];
        $row = coderPointHelp::getPoint($member_id);
        $db->close();

        $result_suc["result"]=$row;
        echo json_encode($result_suc);
    }else{
        echo json_encode($result_fal);
    }

}
catch(Exception $e) {
    $db->close();
    $result_fal['success'] = false;
    $result_fal['message'] = $e->getMessage();
    echo json_encode($result_fal);
}