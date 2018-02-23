<?php
include('_config.php');
$db = Database::DB();

$type=post('type',1);
switch ($type) {
    case 'username':
        $username=post('username',1);
        $id = post('id',1);
        echo isDateNotExisit('username',$username,$id) ? 'true' : 'false';
        break;
    default:
        die('false');
        break;
}

$db->close();
?>