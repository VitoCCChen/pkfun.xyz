<?php
include "_database.class.php";
session_start();
header('Content-type:application/json; charset=utf-8');
$result_suc =array(
    'success' => true,
    'count' => '',
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

        $member_id = $_SESSION["memberData"]["member_id"];
        $db = Database::DB();
        $row = $db->preparefetch_all_array("SELECT c.* , a.name AS anc_name FROM contribution c LEFT JOIN anchor a ON c.anchor_id = a.id WHERE member_id=:id ORDER BY created_date DESC", array(":id" => $member_id ));
        $count = count($row);
        $db->close();
        $result_suc["result"]=$row;
        $result_suc["count"]=$count;
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