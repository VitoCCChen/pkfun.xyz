<?PHP
header('Content-type:application/json; charset=utf-8');
session_start();
include "_func.php";
include "_database.class.php";
include "coderfbhelp.php";
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

$result_re =array(
    'success' => true,
    'result' => '',
    'code' => 1,
    'message' => "Registered successfully , please log in."
);


$result_lo =array(
    'success' => true,
    'result' => '',
    'code' => 4,
    'message' => "Account already existed, please log in."
);


$result_false =array(
    'success' => false,
    'result' => '',
    'code' => 3,
    'message' => "System false."
);


//判斷是否登入
if(isset($_SESSION["memberData"]) && ($_SESSION["memberData"]!="")){
    $result_already =array(
        'success' => true,
        'result' => '',
        'code' => 2,
        'message' => "Logined already"
    );
    $result_already['result'] = $_SESSION['memberData'];
    echo json_encode($result_already);
}
else if(isset($_POST["account"]) && ($_POST["account"]!="") && isset($_POST["password"]) && ($_POST["password"]!="") && isset($_POST["nickname"]) && ($_POST["nickname"]!="")){

    $userData = array(
        'id' => post("account",1),
        'pw' => md5(post("password",1)),
        'name' => post("nickname",1),
        'email' => post("email",1),
        'agent_id' => post("agent_id",1)
    );
    $db = Database::DB();
    $queryId = "SELECT COUNT(member_id) FROM member WHERE member_id=:member_id";
    $idCount = $db->query_prepare_first($queryId,array(':member_id' => $userData['id']));

    if($idCount['COUNT(member_id)']==0){
        $table = "member";
        $memberData = array(
            'member_id' => $userData['id'],
            'member_pw' => $userData['pw'],
            'member_name' => $userData['name'],
            'email' => $userData['email']
        );

        $db->query_insert($table,$memberData);
        $db->close();

        $result_re["result"]=$memberData;

        echo json_encode($result_re);
    }else{
        $memberData = $db->query_prepare_first("SELECT member_id,member_name,email,platform_id FROM member WHERE member_id=:member_id",array(':member_id' => $userData['id']));
        $result_lo["result"]=$memberData;
        echo json_encode($result_lo);
        $db->close();
    }


}
else{
    echo json_encode($result_false);
}




?>
