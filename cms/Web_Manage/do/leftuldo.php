<?php
include ("_config.php");
$manage_path = get('path',1);
$fun_auth_key = get('ck',1);
$type_id = get('allgames_id',1);

?>
<!-- BEGIN Navlist -->
<ul class="nav nav-list">
    <li>
        <a href="../home/index.php">
            <i class="icon-home"></i>
            <span><?php echo $langary_auth['index']['name']?></span>
        </a>
    </li>
    <?php

    /*$db = new Database($HS, $ID, $PW, $DB);
    $db->connect();*/
    $db = Database::DB();
    coderAdmin::drawMenu($type_id);
    $db->close();
    ?>
</ul>
<!-- END Navlist -->

<!-- BEGIN Sidebar Collapse Button -->
<div id="sidebar-collapse" class="visible-lg">
    <i class="icon-double-angle-left"></i>
</div>
<!-- END Sidebar Collapse Button -->