<?PHP
header('Content-type:application/json; charset=utf-8');
session_start();
include "_func.php";
include "_database.class.php";
include "coderfbhelp.php";
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed


$result_lo =array(
    'success' => true,
    'result' => '',
    'code' => 1,
    'message' => "Login successfully."
);

$result_pwf =array(
    'success' => false,
    'result' => '',
    'code' => 2,
    'message' => "Wrong password."
);

$result_re =array(
    'success' => false,
    'result' => '',
    'code' => 3,
    'message' => "Member does not exist, please register."
);

$result_false =array(
    'success' => false,
    'result' => '',
    'code' => 4,
    'message' => "System false."
);


//判斷是否登入
if(isset($_SESSION["memberData"]) && ($_SESSION["memberData"]!="")){
    $result_already =array(
        'success' => true,
        'result' => '',
        'code' => 5,
        'message' => "Logged in already"
    );
    $result_already['result'] = $_SESSION['memberData'];
    echo json_encode($result_already);
}
else if(isset($_POST["accesstoken"]) && ($_POST["accesstoken"]!="")){

//    $access_token = "EAAFtFl39JV4BAKH9RmFZAOJvxiJRZASCPfFyhc4nrMOZAKdEsWSjqh5S820qyfFBFv5MvcB0ZAGsp7c4N6SiBx7TsLw7tNxOUhsAURVDtE8M4RsJTzFTJYq5qwndDDugjTSzOHQh2kSqCuj830vr5gKKjVcmVlIQPhmQ9xjd1rFwHwDSpWq4HVSy3nd2pLfhwsn5IojvKgZDZD";
    $access_token = $_POST["accesstoken"];

    $Fb = new CoderFbHelp($access_token);
    $userData = $Fb->getUserArray();


    $db = Database::DB();
    $queryId = "SELECT COUNT(member_id) FROM member WHERE member_id=:member_id";
    $idCount = $db->query_prepare_first($queryId,array(':member_id' => $userData['id']));

    if($idCount['COUNT(member_id)']==0) {
        $table = "member";
        $memberData = array(
            'member_id' => $userData['id'],
            'member_name' => $userData['name'],
            'platform_id' => '4',
            'email' => $userData['email']
        );

        $db->query_insert($table,$memberData);
        $db->close();

        $result_lo["result"]=$memberData;
        echo json_encode($result_lo);
        $_SESSION['memberData'] = $memberData;
        $db->close();
    }else{
        $memberData = $db->query_prepare_first("SELECT member_id,member_name,email,platform_id, point FROM member WHERE member_id=:member_id",array(':member_id' => $userData['id']));
        $result_lo["result"]=$memberData;
        echo json_encode($result_lo);
        $_SESSION['memberData'] = $memberData;
        $db->close();
    }
}
else if(isset($_POST["account"]) && ($_POST["account"]!="") && isset($_POST["password"]) && ($_POST["password"]!="")){

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
        echo json_encode($result_re);
    }else{
        $memberData = $db->query_prepare_first("SELECT member_id,member_pw,member_name,email,platform_id, point FROM member WHERE member_id=:member_id",array(':member_id' => $userData['id']));
        if($userData["pw"]==$memberData["member_pw"]){
            $result_lo["result"]=$memberData;
            echo json_encode($result_lo);
            $_SESSION['memberData'] = $memberData;
            $db->close();
        }else{
            echo json_encode($result_pwf);
        }
    }


}
else{
    echo json_encode($result_false);
}




?>
