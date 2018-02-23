<?php
include_once('_config.php');
include_once('filterconfig.php');
$getid = (get('id')!="")?get('id'):-1;      //節目ID
$getrid = (get('r_id')!="")?get('r_id'):-1; //開播ID

/* ## coder [listHelp] --> ## */
$listHelp = new coderListHelp('table1', $page_title);
$listHelp->ajaxSrc = "service.php?id=".$getid."&r_id=".$getrid;
$listHelp->check_auth = false;

$listHelp->mutileSelect=true;
$listHelp->delSrc = "delservice.php";
$listHelp->editLink = "manage.php";
$listHelp->addLink = "manage.php?id=".$getid."&ep_id=".$getrid;

$col = array();
$col[] = array('column' => $colname_cl['id'],          'name' => $langary_Web_Manage_all['chatlog'].$langary_Web_Manage_all['id'], 'order' => true, 'width' => '60');
$col[] = array('column' => $colname['name'],           'name' => $langary_Web_Manage_all['pgram_name'], 'order' => false, 'width' => '100');
$col[] = array('column' => $colname_cl['chatlog'],     'name' => $langary_Web_Manage_all['chatlog'], 'order' => false, 'width' => '120');
$col[] = array('column' => $colname_cl['createtime'],  'name' => $langary_Web_Manage_all['create_time'], 'order' => false, 'width' => '120');
$col[] = array('column' => $colname_cl['updatetime'],  'name' => $langary_Web_Manage_all['update_time'], 'order' => false, 'width' => '120');
$col[] = array('column' => $colname_cl['manage'],      'name' => $langary_Web_Manage_all['manager'], 'order' => false, 'width' => '120');

$listHelp->Bind($col);
$listHelp->bindFilter($filterhelp);

/* ## coder [listHelp] <-- ## */

$db = Database::DB();

$db->close();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include('../head.php'); ?>
    <link rel="stylesheet" type="text/css" href="../assets/jquery-ui/jquery-ui.min.css"/>
    <style>
        .ui-sortable-helper {
            background-color: white !important;
            border: none !important;
        }
    </style>
</head>
<body>
<?php //include('../navbar.php'); ?>
<!-- BEGIN Container -->
<div class="container" id="main-container">
    <?php //include('../left.php'); ?>
    <!-- BEGIN Content -->
    <div id="main-content">
        <!-- BEGIN Page Title -->
        <div class="page-title">
            <div>
                <h1><i class="<?php echo $mainicon ;?>"></i> <?php echo $page_title ;?>管理</h1>
                <h4><?php echo $page_desc ?></h4>
            </div>
        </div>
        <!-- END Page Title -->

        <!-- BEGIN Breadcrumb -->
        <div id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="../home/index.php">Home</a>
                    <span class="divider"><i class="icon-angle-right"></i></span>
                </li>
                <?php echo $mtitle ;?>

            </ul>
        </div>
        <!-- END Breadcrumb -->

        <!-- BEGIN Main Content -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-title">
                        <h3 style="float:left"><i class="icon-table"></i> <?php echo $page_title ?></h3>
                        <div class="box-tool">
                            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                            <a data-action="close" href="#"><i class="icon-remove"></i></a>
                        </div>
                        <div style="clear:both"></div>
                    </div>
                    <div class="box-content">
                        <?php echo $listHelp->drawTable() ;?>
                    </div>
                </div>
            </div>
        </div>


        <?php include('../footer.php'); ?>

        <a id="btn-scrollup" class="btn btn-circle btn-lg" href="#"><i class="icon-chevron-up"></i></a>
    </div>
    <!-- END Content -->
</div>
<!-- END Container -->
<?php include('../js.php'); ?>

<script type="text/javascript" src="../js/coderlisthelp.js"></script>

<script type="text/javascript"> 
    $(document).ready(function () {
        /* ## coder [listRow] --> ## */
        $('#table1').coderlisthelp({
            debug: true, callback: function (obj, rows) {
                obj.html('');
                var count = rows.length;
                for (var i = 0; i < count; i++) {
                    var row = rows[i];
                    var $tr = $('<tr></tr>');
                    $tr.attr("orderlink", "order_id=" + row["<?php echo $colname_cl['id'];?>"] + "&order_key=<?php echo $colname_cl['id'];?>");
                    $tr.attr("editlink", "id=" + <?php echo $getid;?> + "&chat_id=" + row["<?php echo $colname_cl['id'];?>"]);
                    $tr.attr("delkey", row["<?php echo $colname_cl['id'];?>"]);
                    $tr.attr("title",  "聊天紀錄ID ["+row["<?php echo $colname_cl['id'];?>"]+"]");
                    $tr.append('<td>' + row["<?php echo $colname_cl['id'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['name'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname_cl['chatlog'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname_cl['createtime'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname_cl['updatetime'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname_cl['manage'];?>"] + '</td>');
                    obj.append($tr);
                }
            }, listComplete: function () {

            }
        });
        /* ## coder [listRow] <-- ## */
    });
</script>
</body>
</html>
