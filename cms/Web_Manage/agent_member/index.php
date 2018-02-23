<?php
include_once('_config.php');
include_once('filterconfig.php');
$getid = (get('id')!="")?get('id'):0;

/* ## coder [listHelp] --> ## */
$listHelp = new coderListHelp('table1', $page_title);

$listHelp->ajaxSrc = "service.php?id=".$getid;
$listHelp->check_auth = false;

$listHelp->orderColumn = $orderColumn;
$listHelp->orderDesc = $orderDesc;

$col = array();
$col[] = array('column' => $colname_a['agent_id'], 'name' => '代理ID ', 'order' => false, 'width' => '200');
$col[] = array('column' => $colname_a['name'], 'name' => '代理名稱 ', 'order' => false, 'width' => '200');
$col[] = array('column' => $colname['member_id'], 'name' => '會員ID ', 'order' => false, 'width' => '200');
$col[] = array('column' => $colname['name'], 'name' => '會員名稱 ', 'order' => false, 'width' => '200');
$col[] = array('column' => $colname['email'], 'name' => 'E-mail ', 'order' => false);
$col[] = array('column' => $colname['point'], 'name' => '點數 ', 'order' => false, 'width' => '100');
$col[] = array('column' => $colname_c['point'], 'name' => '總打賞點數 ', 'order' => false, 'width' => '100');
$col[] = array('column' => $colname['create_time'], 'name' => $langary_Web_Manage_all['login_time'], 'order' => true, 'width' => '200');
//$col[] = array('column' => $colname['update_time'], 'name' => '最後修改時間', 'order' => true, 'width' => '120');
$col[]=array('column'=>$colname['id'],'name'=>'打賞紀錄','order'=>false,'width'=>'80','classname'=>'text-center');

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
<!-- BEGIN Container -->
<div class="container" id="main-container">
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
                <?php echo $mtitle; ?>

            </ul>
        </div>
        <!-- END Breadcrumb -->

        <!-- BEGIN Main Content -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-title">
                        <h3 style="float:left"><i class="icon-table"></i> <?php echo $page_title; ?></h3>
                        <div class="box-tool">
                            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                            <a data-action="close" href="#"><i class="icon-remove"></i></a>
                        </div>
                        <div style="clear:both"></div>
                    </div>
                    <div class="box-content">
                        <?php echo $listHelp->drawTable(); ?>
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
                    $tr.attr("title", row["<?php echo $colname['name'];?>"]);
                    $tr.append('<td>' + row["<?php echo $colname_a['agent_id'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname_a['name'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['member_id'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['name'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['email'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['point'];?>"] + '</td>');
                    $tr.append('<td>' + row["totalcon"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['create_time'];?>"] + '</td>');
                    $tr.append('<td class="text-center"><button class="btn btn-sm btn-warning" onclick="openBox(\'../award_log/index.php?id=' + row["<?php echo $colname['id']?>"] + '\',\'95%\',\'95%\',\'fade\',function(){$(\'#table1\').find(\'#refreshBtn\').click()})"><span class="glyphicon  glyphicon-list-alt"></span></button></td>');
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
