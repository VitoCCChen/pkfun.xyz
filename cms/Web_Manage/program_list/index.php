<?php
include_once('_config.php');
include_once('filterconfig.php');
coderAdmin::vaild($auth, 'view');

/* ## coder [listHelp] --> ## */
$listHelp = new coderListHelp('table1', $page_title);
$listHelp->mutileSelect=true;
$listHelp->editLink = "manage.php";
$listHelp->addLink = "manage.php";
$listHelp->ajaxSrc = "service.php";
$listHelp->delSrc = "delservice.php";

$col = array();
$col[] = array('column' => $colname['id'],          'name' => $langary_Web_Manage_all['id'],         'order' => true, 'width' => '60');
$col[] = array('column' => $colname['name'],        'name' => $langary_Web_Manage_all['pgram_name'], 'order' => true, 'width' => '100');
$col[] = array('column' => $colname['description'], 'name' => $langary_Web_Manage_all['depiction'],  'order' =>false, 'width' => '300');
$col[] = array('column' => $colname['thumbnail'],   'name' => $langary_Web_Manage_all['pic2'],       'order' =>false, 'width' => '100','classname'=>'text-center');
$col[] = array('column' => $colname['url'],         'name' => $langary_Web_Manage_all['url'],        'order' =>false);
$col[] = array('column' => $colname['tag'],         'name' => $langary_Web_Manage_all['tag'],        'order' =>false, 'width' => '400');
$col[] = array('column' => $colname['createtime'],  'name' => $langary_Web_Manage_all['create_time'],'order' => true, 'width' => '180');
$col[] = array('column' => $colname['updatetime'],  'name' => $langary_Web_Manage_all['update_time'],'order' => true, 'width' => '180');
$col[] = array('column' => $colname['showtime'],    'name' => $langary_Web_Manage_all['showtime'],   'order' => true, 'width' => '120');
$col[] = array('column' => $colname['manager'],     'name' => $langary_Web_Manage_all['manager'],    'order' => true, 'width' => '120');
$col[] = array('column' => $colname['id'],          'name' => '開播紀錄',   'order' =>false, 'width' => '80','classname'=>'text-center');

$listHelp->Bind($col);
$listHelp->bindFilter($filterhelp);

/* ## coder [listHelp] <-- ## */

$db = Database::DB();
coderAdminLog::insert($adminuser['username'], $main_auth_key, $fun_auth_key, 'view', $langary_Web_Manage_all['insert']);
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
                <h1><i class="<?php echo $mainicon ?>"></i> <?php echo $page_title ?><?php echo $langary_index['page_title']?></h1>
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
                            <!-- 何必要有摺疊&關閉表格?? -->
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
    function pagereload(){ location.reload();}

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
                    $tr.append('<td>' + row["<?php echo $colname['id'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['name'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['description'];?>"] + '</td>');

                    var pic = (row["<?php echo $colname['thumbnail']?>"] !="")?'<?php echo $file_path;?>s'+row["<?php echo $colname['thumbnail']?>"]:'../images/nouser.jpg';
                    $tr.append('<td class="text-center"><img src="'+pic+'" width="40" height="40"></img></td>');

                    //$tr.append('<td>' + row["<?php //echo $colname['thumbnail'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['url'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['tag'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['createtime'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['updatetime'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['showtime'];?>"] + '</td>');
                    $tr.append('<td>' + row["<?php echo $colname['manager'];?>"] + '</td>');
                    $tr.append('<td class="text-center"><button class="btn btn-sm btn-warning" onclick="openBox(\'../program_EPlist/index.php?id=' + row["<?php echo $colname['id']?>"] + '\',\'95%\',\'95%\',\'fade\',function(){$(\'#table1\').find(\'#refreshBtn\').click()})"><span class="glyphicon  glyphicon-list-alt"></span></button></td>');
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
