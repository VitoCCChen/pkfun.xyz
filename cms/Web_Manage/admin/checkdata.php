<?php
include('_config.php');
$db = Database::DB();

$type=post('type',1);
switch ($type) {
    case 'username':
        $username=post('username',1);
        echo isDateNotExisit('username',$username) ? 'true' : 'false';
        break;
    case 'email':
        $id=post('id');
        $email=post('email',1);
        echo isDateNotExisit('email',$email,$id) ? 'true' : 'false';
        break;
    default:
        die('false');
        break;
}

$db->close();
?>