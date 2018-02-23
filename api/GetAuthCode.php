<?php
header('Content-type:application/json; charset=utf-8');

session_start();
include_once 'codermycardhelp.php';
include_once '_database.class.php';

$FacServiceId = "luckySG";  //廠商服務代碼
$FacTradeSeq = uniqid('MC');   //廠商交易序號(自動產生)
$TradeType = "2";   //交易模式
$ServerId = "";     //伺服器代號
$CustomerId = "";     //會員代號
$PaymentType = "";  //付費方式/付費方式群組代碼
$ItemCode = "";     //品項代碼
$ProductName = ""; //產品名稱
$Amount = "";   //金額
$Currency = "";  //幣別
$SandBoxMode = "true";  //測試環境
$FacKey = "B8sqJqY3QFQg8wE2LZ4AxcWQ69v3RUyy";   //廠商key
$Createdate = date('Y-m-d H:i:s',time());
$agent_id = "";

$result_suc = array(
    'success' => true,
    'result' => '',
    'code' => 1,
    'message' => 'Get AuthCode successfully.'
);
$fal_resultback = array(
    'success' => false,
    'result' => '',
    'code' => 2,
    'message' => 'Failed to get AuthCode .'
);
$login_resultback = array(
    'success' => false,
    'result' => '',
    'code' => 3,
    'message' => 'Please log in.'
);
$agent_resultback = array(
    'success' => false,
    'result' => '',
    'code' => 4,
    'message' => 'Failed to get agent id .'
);

if(isset($_SESSION['memberData']) && ($_SESSION['memberData']!="")) {
    if (isset($_GET["Amount"]) && !empty($_GET["Amount"]) &&
        isset($_GET["Currency"]) && !empty($_GET["Currency"]) &&
        isset($_GET["ProductName"]) && !empty($_GET["ProductName"])) {
        if (isset($_GET["agent_id"]) && !empty($_GET["agent_id"])) {
            $agent_id = $_GET["agent_id"];
            $db = Database::DB();
            $sql = "SELECT * FROM agent WHERE agent_id = '" . $agent_id . "'";
            $agent_count = $db->queryCount($sql);
            if ($agent_count == 0) {
                echo json_encode($agent_resultback);
                exit();
            }
        }

        $CustomerId = $_SESSION["memberData"]['member_id'];
        $Amount = $_GET["Amount"];
        $Currency = $_GET["Currency"];
        $ProductName = $_GET["ProductName"];
        $getauth_ary = array(
            'FacServiceId' => $FacServiceId,
            'FacTradeSeq' => $FacTradeSeq,
            'TradeType' => $TradeType,
            'ServerId' => $ServerId,
            'CustomerId' => $CustomerId,
            'PaymentType' => $PaymentType,
            'ItemCode' => $ItemCode,
            'ProductName' => $ProductName,
            'Amount' => $Amount,
            'Currency' => $Currency,
            'SandBoxMode' => $SandBoxMode,
            'FacKey' => $FacKey,
            'Created_date' => $Createdate,
            'agent_id' => $agent_id
        );
        $mycard = new coderMycardHelp();
        $result = $mycard->getAuthCode($getauth_ary);
        if($result["success"]=='true'){
            $result_suc['result'] = $result['result'];
            echo json_encode($result_suc);
        }else if($result["success"]=='false'){
            echo json_encode($fal_resultback);
        }


    }else{
        echo json_encode($fal_resultback);
    }
}else{
    echo json_encode($login_resultback);
}


?>





