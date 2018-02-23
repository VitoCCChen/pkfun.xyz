<?php
include "_database.class.php";
header('Content-type:application/json; charset=utf-8');

$result =array(
    'success' => true,
    'result' => '',
    'message' => "request successful"
);
try{
    $db = Database::DB();

    isset($_GET["id"])?
        $row = $db->preparefetch_all_array("SELECT * FROM program WHERE pgram_id=:id", array(":id"=>$_GET["id"]) ):
        $row = $db->fetch_all_array("SELECT * FROM program");

    $db->close();
    $result["result"]=$row;
    echo json_encode($result);
}
catch(Exception $e) {
    $db->close();
    $result['success'] = false;
    $result['message'] = $e->getMessage();
    echo json_encode($result);
}

