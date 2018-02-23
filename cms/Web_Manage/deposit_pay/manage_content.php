<?php
include_once('_config.php');
include_once('formconfig.php');
$errorhandle = new coderErrorHandle();
$id = get('id', 1);
$manageinfo = "";
/* ## coder [initData] --> ## */

/* ## coder [initData] <-- ## */
try {

    if ($id != "") {
        //coderAdmin::vaild($auth, 'edit');

        $db = Database::DB();
        $row = $db->query_prepare_first("select * from $table  WHERE {$colname['id']}=:id", array(':id' => $id));
        if (empty($row)) {
            throw new Exception($langary_manage['exception']);
        }
        /* ## coder [bindData] --> ## */
        $manageinfo='  '.$langary_manage['admin'].' '.$row[$colname['manager']].' | '.$langary_manage['createtime'].' '.$row[$colname['create_time']].' | '.$langary_manage['updatetime'].' '.$row[$colname['update_time']];
        /* ## coder [bindData] <-- ## */
        /* ## coder [beforeBind] --> ## */
        /* ## coder [beforeBind] <-- ## */
        //$row[$colname['date']] = date("Y-m-d",strtotime($row[$colname['date']]));
        $fhelp->bindData($row);

        $method = 'edit';
        $active = $langary_edit_add['edit'];

        $db->close();
    } else {
        die('<script>parent.closeBox();parent.showNotice("alert","'.$page_title.'","'.$langary_Web_Manage_all['die_error'].'")</script>');
        //coderAdmin::vaild($auth, 'add');
        $method = 'add';
        $active = $langary_edit_add['add'];
    }
} catch (Exception $e) {
    $db->close();
    $errorhandle->setException($e);
}
if ($errorhandle->isException()) {
    $errorhandle->showError();
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include('../head.php'); ?>
    <link rel="stylesheet" type="text/css" href="../assets/dropzone/downloads/css/dropzone.css"/>
    <link rel="stylesheet" type="text/css" href="../assets/jcrop/jquery.Jcrop.min.css"/>
    <!-- ## coder [phpScript] -> ## -->
    <!-- ## coder [phpScript] <- ## -->

</head>
<body>
<!-- BEGIN Container -->
<div class="container" id="main-container">
    <!-- BEGIN Content -->
    <div id="main-content">
        <!-- BEGIN Page Title -->
        <div class="page-title">
            <div>
                <h1><i class="<?php echo $mainicon ?>"></i> <?php echo $page_title ?><?php echo $langary_manage['page_title'];?></h1>
                <h4><?php echo $page_desc ?></h4>
            </div>
        </div>
        <!-- END Page Title -->
        <?php if ($manageinfo != '') { ?>
            <div class="alert alert-info">
                <button class="close" data-dismiss="alert">&times;</button>
                <strong><?php echo $langary_manage['system'];?> </strong> <?php echo $manageinfo ?>
            </div>
        <?php } ?>
        <!-- BEGIN Main Content -->
        <div class="row">
            <form class="form-horizontal" action="save.php" id="myform" name="myform" method="post">
                <?php echo $fhelp->drawForm($colname['id']) ?>
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-title">
                            <h3><i class="<?php echo getIconClass($method) ?>"></i> <?php echo $page_title . $langary_Web_Manage_all['details'] ?>
                            </h3>
                            <div class="box-tool">
                                <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                                <a data-action="close" href="#"><i class="icon-remove"></i></a>
                            </div>
                        </div>
                        <div class="box-content">
                            <div class="row">
                                <!--left start-->
                                <div class="col-md-10">
                                    <!-- ## coder [formScript] -> ## -->
                                    <div class="form-group ">
                                        <label class="col-sm-3 col-lg-3 control-label">
                                            <?php echo $fhelp->drawLabel($colname['is_pay']) ?> </label>
                                        <div class="col-sm-5 control-label" style="text-align: left;">
                                            <?php echo $langary_yn[$row[$colname['is_pay']]] ?>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-3 col-lg-3 control-label">
                                            <?php echo $fhelp->drawLabel($colname['name']) ?> </label>
                                        <div class="col-sm-5 control-label" style="text-align: left;">
                                            <?php echo $row[$colname['name']]  ?>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                    <label class="col-sm-3 col-lg-3 control-label">
                                        <?php echo $fhelp->drawLabel($colname['bank']) ?> </label>
                                    <div class="col-sm-3 controls">
                                        <?php echo $row[$colname['bank']] ?>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="col-sm-3 col-lg-3 control-label">
                                        <?php echo $fhelp->drawLabel($colname['num']) ?> </label>
                                    <div class="col-sm-3 controls">
                                        <?php echo $row[$colname['num']] ?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-3 col-lg-3 control-label">
                                        <?php echo $fhelp->drawLabel($colname['money']) ?> </label>
                                    <div class="col-sm-3 controls">
                                        <?php echo $row[$colname['money']]?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-3 col-lg-3 control-label">
                                        <?php echo $fhelp->drawLabel($colname['contents']) ?> </label>
                                    <div class="col-sm-3 controls">
                                        <?php echo $row[$colname['contents']] ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-3">
                                        <button type="button" class="btn btn-primary" onClick="parent.closeBox();">
                                            <i class="icon-remove"></i><?php echo $langary_manage['close'];?><?php echo $active ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                                </div>
                                <!--left end-->

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- END Main Content -->
        <?php include('../footer.php'); ?>
        <a id="btn-scrollup" class="btn btn-circle btn-lg" href="#"><i class="icon-chevron-up"></i></a>
    </div>
    <!-- END Content -->
</div>
<!-- END Container -->


<?php include('../js.php'); ?>
<script type="text/javascript" src="../assets/jquery-validation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="../assets/jquery-validation/dist/additional-methods.js"></script>
<script type="text/javascript" src="../assets/ckeditor/ckeditor.js"></script>
<!-- 多圖上傳 -->
<script type="text/javascript" src="../assets/dropzone/downloads/dropzone.min.js"></script>
<!-- 裁圖&傳圖 -->
<script type="text/javascript" src="../assets/jcrop/jquery.Jcrop.min.js"></script>
<!-- ## coder [includeScript] -> ## -->
<!-- ## coder [includeScript] <- ## -->
<script type="text/javascript">
    $(".red").hide();
    $(document).ready(function () {
        /* ## coder [jsScript] --> ## */
        /* ## coder [jsScript] <-- ## */

        <?php echo coderFormHelp::drawVaildScript();?>
        /* ## coder [jsVaildScript] --> ## */

        /* ## coder [jsVaildScript] <-- ## */
    })


</script>
</body>
</html>
