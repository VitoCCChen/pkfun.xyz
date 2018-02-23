<?php
include_once('_config.php');
include_once('formconfig.php');
$errorhandle = new coderErrorHandle();
$id = get('id', 1);
$chat_id = get('chat_id', 1);
$ep_id = get('ep_id', 1);
$manageinfo = "";
try {

    if ($id != "" && $chat_id != "") {
        //coderAdmin::vaild($auth, 'edit');

        $db = Database::DB();
        $row = $db->query_prepare_first("select * from $table a, $table_cl b WHERE a.`{$colname['id']}`=:id AND b.`{$colname_cl['id']}`=:chat_id", array(':id' => $id, ':chat_id'=>$chat_id));
        if (empty($row)) {
            throw new Exception($langary_manage['exception']);
        }

        $fhelp->setAttr($colname['name'], 'readonly', true);

        $fhelp->bindData($row);

        $method = 'edit';
        $active = $langary_edit_add['edit'];

        $db->close();
    } else if($id != "" && $ep_id != ""){
        //coderAdmin::vaild($auth, 'add');

        $db = Database::DB();
        $row = $db->query_prepare_first("select * from $table WHERE {$colname['id']}=:id", array( ':id' => $id) );
        if (empty($row)) {
            throw new Exception($langary_manage['exception']);
        }

        $fhelp->setAttr($colname['name'], 'readonly', true);
        //$fhelp->setAttr($colname_cl['record_id'], 'value', 5);
        $fhelp->bindData($row);

        $method = 'add';
        $active = $langary_edit_add['add'];

        $db->close();
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
                <?php echo $fhelp->drawForm($colname['id']); ?>
                <?php echo $fhelp->drawForm($colname_cl['id']); ?>
                <?php //echo $fhelp->drawForm($colname_cl['record_id']);
                if($ep_id !="") //若是add卻也要給定要在哪幾節目新增聊天
                {
                    echo str_replace(">", "value=".$ep_id.">", $fhelp->drawForm($colname_cl['record_id']) );
                }
                else
                {
                    echo $fhelp->drawForm($colname_cl['record_id']);
                }//*/
                ?>
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-title">
                            <h3><i class="<?php echo getIconClass($method) ?>"></i> <?php echo $page_title . $active ?>
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
                                            <?php echo $fhelp->drawLabel($colname['name']) ?> </label>
                                        <div class="col-sm-5 controls">
                                            <?php echo $fhelp->drawForm($colname['name']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-3 col-lg-3 control-label">
                                            <?php echo $fhelp->drawLabel($colname_cl['chatlog']) ?> </label>
                                        <div class="col-sm-5 controls">
                                            <?php echo $fhelp->drawForm($colname_cl['chatlog']) ?>
                                        </div>
                                    </div>

                                    <!-- ## coder [formScript] <- ## -->
                                    <div class="form-group">
                                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-3">
                                            <button type="submit" class="btn btn-primary"><i
                                                        class="icon-ok"></i><?php echo $langary_manage['ok']; ?><?php echo $active ?>
                                            </button>
                                            <button type="button" class="btn" onclick="$.confirm({
                                                        title: '<?php echo $langary_manage['confirm_cancel'] . $active ?>'+'?',
                                                        content: '',
                                                        type: 'red',
                                                        typeAnimated: true,
                                                        buttons: {
                                                            tryAgain: {
                                                                text: langary_jsall['confirm_ok'],
                                                                btnClass: 'btn-red',
                                                                action: function(){
                                                                    parent.closeBox();
                                                                }
                                                            },
                                                            alphabet: {
                                                            text: langary_jsall['confirm_cancel'],
                                                                action: function(){
                                                                }
                                                            }
                                                        }
                                                    });"><i
                                                        class="icon-remove"></i><?php echo $langary_manage['cancel']; ?><?php echo $active ?>
                                            </button>
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
<link rel="stylesheet" type="text/css" href="../assets/chosen-bootstrap/chosen.min.css"/>
<script type="text/javascript" src="../assets/chosen-bootstrap/chosen.jquery.min.js"></script>
<script type="text/javascript" src="../js/coderlisthelp.js"></script>


<script type="text/javascript">

<!-- ## coder [includeScript] -> ## -->
<!-- ## coder [includeScript] <- ## -->
    $(document).ready(function () {
        /* ## coder [jsScript] --> ## */
        /* ## coder [jsScript] <-- ## */

        <?php echo coderFormHelp::drawVaildScript();?>
        /* ## coder [jsVaildScript] --> ## */
        /* ## coder [jsVaildScript] <-- ## */
    })

<?php echo coderFormHelp::drawVaildScript();?>
</script>
</body>
</html>

