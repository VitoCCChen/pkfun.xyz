<?php
include_once('_config.php');
include_once('filterconfig.php');
coderAdmin::vaild($auth, 'view');
/* ## coder [listHelp] --> ## */
$listHelp = new coderListHelp('table1', $page_title);
$listHelp->editLink = "manage.php";
//$listHelp->addLink = "manage.php";
$listHelp->ajaxSrc = "service.php";
//$listHelp->delSrc = "delservice.php";
//$listHelp->orderSrc = "orderservice.php";
//$listHelp->ordersortable = "orderservice.php";
$listHelp->orderColumn = $orderColumn;
$listHelp->orderDesc = $orderDesc;
$col = array();
$col[] = array('column' => $colname['id'], 'name' => 'ID', 'order' => true, 'width' => '50');
$col[] = array('column' => $colname['member_id'], 'name' => '會員ID', 'order' => true, 'width' => '80');
$col[] = array('column' => $colname_p['product_id'], 'name' => '產品', 'order' => false, 'width' => '100');
$col[] = array('column' => $colname['FacTradeSeq'], 'name' => '第三方交易序號', 'order' => true, 'width' => '150');
$col[] = array('column' => $colname['agent_id'], 'name' => '代理ID', 'order' => true, 'width' => '90');
$col[] = array('column' => $colname['ReturnCode'], 'name' => '交易狀態', 'order' => true, 'width' => '90');
$col[] = array('column' => $colname['PayResult'], 'name' => '請款狀態', 'order' => true, 'width' => '90');
$col[] = array('column' => $colname['Redeposit'], 'name' => '補儲', 'order' => true, 'width' => '50');
$col[] = array('column' => $colname['Amount'], 'name' => '金額', 'order' => true, 'width' => '100');
$col[] = array('column' => $colname['Currency'], 'name' => '幣別', 'order' => true, 'width' => '100');
$col[] = array('column' => $colname['Created_date'], 'name' => '交易時間', 'order' => true, 'width' => '120');
$col[] = array('column' => $colname['Pay_time'], 'name' => '交易完成時間', 'order' => true, 'width' => '120');
$col[] = array('column' => $colname['Check_time'], 'name' => '請款時間', 'order' => true, 'width' => '120');
$listHelp->Bind($col);
$listHelp->bindFilter($filterhelp);
/* ## coder [listHelp] <-- ## */
$db = Database::DB();
coderAdminLog::insert($adminuser['username'], $main_auth_key, $fun_auth_key, 'view', '列表');
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
<?php include('../navbar.php'); ?>
<!-- BEGIN Container -->
<div class="container" id="main-container">
    <?php include('../left.php'); ?>
    <!-- BEGIN Content -->
    <div id="main-content">
        <!-- BEGIN Page Title -->
        <div class="page-title">
            <div>
                <h1><i class="<?php echo $mainicon ?>"></i> <?php echo $page_title ?>管理</h1>
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
                <?php echo $mtitle ?>

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
                        <?php echo $listHelp->drawTable() ?>
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
                    $tr.attr("orderlink", "order_id=" + row["<?php echo $colname['id'];?>"] + "&order_key=<?php echo $colname['id'];?>");
                    $tr.attr("editlink", "id=" + row["<?php echo $colname['id'];?>"]);
                    $tr.attr("delkey", row["<?php echo $colname['id'];?>"]);
                    $tr.attr("title", row["<?php echo $colname['id'];?>"]);
                    $tr.append('<td>' + row["<?php echo $colname['id'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['member_id'];?>"] + '</td>');
                    $tr.append('<td>' + row["product_name"]+'('+row["product"]+')' + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['FacTradeSeq'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['agent_id'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['ReturnCode'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['PayResult'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['Redeposit'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['Amount'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['Currency'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['Created_date'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['Pay_time'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['Check_time'];?>"] + '</td>');
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