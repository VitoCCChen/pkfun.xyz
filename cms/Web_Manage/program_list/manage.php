<?php
include_once('_config.php');
include_once('formconfig.php');
$errorhandle = new coderErrorHandle();
$manageinfo = "";
$pic = "";
$id = get('id', 1);
try {

    if ($id != "") {
        coderAdmin::vaild($auth, 'edit');

        $db = Database::DB();
        $row = $db->query_prepare_first("select * from $table  WHERE {$colname['id']}=:id", array(':id' => $id));
        if (empty($row)) {
            throw new Exception($langary_manage['exception']);
        }
        /* ## coder [bindData] --> ## */
        $manageinfo='  '.$langary_manage['admin'].' '.$row[$colname['manager']].' | '.$langary_manage['createtime'].' '.$row[$colname['createtime']].' | '.$langary_manage['updatetime'].' '.$row[$colname['updatetime']];
        /* ## coder [bindData] <-- ## */
        /* ## coder [beforeBind] --> ## */
        /* ## coder [beforeBind] <-- ## */

        $fhelp->bindData($row);

        $pic = $row[$colname['thumbnail']];

        $method = 'edit';
        $active = $langary_edit_add['edit'];

        $db->close();
    } else {
        coderAdmin::vaild($auth, 'add');
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
    <script language="javascript" type="text/javascript">
        <?php
        coderFormHelp::drawPicScript($method, $file_path, $pic, 'org_pic');
        ?>
    </script>
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
                                            <?php echo $fhelp->drawLabel($colname['description']) ?> </label>
                                        <div class="col-sm-5 controls">
                                            <?php echo $fhelp->drawForm($colname['description']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-3 col-lg-3 control-label">
                                            <?php echo $fhelp->drawLabel($colname['thumbnail']) ?> </label>
                                        <div class="col-sm-8 controls">
                                            <?php if($id != ""){?>
                                            <div id="picupload"></div>
                                            <?php }else{?>
                                            <div>請先完成新增節目再來上傳圖片</div>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-3 col-lg-3 control-label">
                                            <?php echo $fhelp->drawLabel($colname['url']) ?> </label>
                                        <div class="col-sm-5 controls">
                                            <?php echo $fhelp->drawForm($colname['url']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-3 col-lg-3 control-label">
                                            <?php echo $fhelp->drawLabel($colname['tag']) ?> </label>
                                        <div class="col-sm-5 controls">
                                            <?php echo $fhelp->drawForm($colname['tag']) ?>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label class="col-sm-3 col-lg-3 control-label">
                                            <?php echo $fhelp->drawLabel($colname['showtime']) ?> </label>
                                        <div class="col-sm-5 controls">
                                            <?php echo $fhelp->drawForm($colname['showtime']) ?>
                                        </div>
                                    </div>

                                    <!-- ## coder [formScript] <- ## -->
                                    <div class="form-group">
                                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-3">
                                            <button id="ok_btn" type="submit" class="btn btn-primary"><i
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
<script type="text/javascript" src="../js/coderpicupload.js"></script>
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

$('#picupload').coderpicupload({
    pics: [{
        name: '<?php echo $langary_Web_Manage_all['pic2'];?>',
        type: 5,
        tag: 's',
        width: 60,
        height: 60
    }],
    width: '100',
    height: '100',
    s_width: '60px',
    s_height: '60px',
    org_pic: org_pic,
    id: '<?php echo $colname['thumbnail'];?>',
    name:'<?php echo $id;?>'/*,required:true*/
});
<?php echo coderFormHelp::drawVaildScript();?>

/*document.getElementById("ok_btn").addEventListener("click", function(e){
    parent.pagereload();
    console.log(parent);
});*/

window.onunload = closingCode;
function closingCode(){
    parent.pagereload();
    return null;
}
</script>
</body>
</html>

