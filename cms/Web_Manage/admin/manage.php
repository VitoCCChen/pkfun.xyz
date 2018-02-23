<?php
include('_config.php');
include_once('formconfig.php');
$errorhandle = new coderErrorHandle();
$username = get('username', 1);
$manageinfo = "";
$pic = "";
try {
    if ($username != "") {
        if ($username != $adminuser['username']) {
            coderAdmin::vaild($auth, 'edit');
        }
        if (!coderAdmin::isAuth($auth, coderAdminLog::getActionKey('edit'))) {
            $fhelp->setAttr($colname['ispublic'], 'readonly', true);
            $fhelp->setAttr($colname['r_id'], 'readonly', true);
        }
        $fhelp->setAttr($colname['username'], 'readonly', true);

        $db = Database::DB();

        $row = $db->query_prepare_first(" SELECT $table.*
										FROM $table 
										WHERE {$colname['username']}=:username and `{$colname['level']}` = :atype",
            array(':username' => $username, ':atype' => 1));
        if (empty($row)) {
            throw new Exception($langary_manage['exception']);
        }

        //編輯時,password預設為空白
        unset($row[$colname['password']]);
        $fhelp->bindData($row);

        $pic = $row[$colname['pic']];

        $method = 'edit';
        $active = $langary_edit_add['edit'];
        $manageinfo = '  ' . $langary_manage['admin'] . ' ' . $row[$colname['admin']] . ' | ' . $langary_manage['createtime'] . ' ' . $row[$colname['createtime']] . ' | ' . $langary_manage['updatetime'] . ' ' . $row[$colname['updatetime']] . ' | ' . $langary_manage['logintime'] . ' ' . $row[$colname['logintime']] . ' | ' . $langary_manage['ip'] . ' ' . $row[$colname['ip']];

        $row_history = coderAdminLog::getLogByUser($row[$colname['username']], 5);
        $db->close();
    } else {
        coderAdmin::vaild($auth, 'add');
        $method = 'add';
        $active = $langary_edit_add['add'];
        $fhelp->setAttr($colname['password'], 'validate', array('required' => 'yes', 'maxlength' => '30', 'minlength' => 6));
        $fhelp->setAttr('repassword', 'validate', array('required' => 'yes', 'maxlength' => '30', 'minlength' => 6, 'equalto' => '#' . $colname['password'], 'data-msg-equalto' => $langary_Web_Manage_all['repassword_p']));
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
    <script language="javascript" type="text/javascript">
        <?php
        coderFormHelp::drawPicScript($method, $file_path, $pic, 'org_pic');
        ?>
    </script>
</head>
<body>
<!-- BEGIN Container -->
<div class="container" id="main-container">
    <!-- BEGIN Content -->
    <div id="main-content">
        <!-- BEGIN Page Title -->
        <div class="page-title">
            <div>
                <h1>
                    <i class="<?php echo $mainicon ?>"></i> <?php echo $page_title ?><?php echo $langary_manage['page_title']; ?>
                </h1>
                <h4><?php echo $page_desc ?></h4>
            </div>
        </div>
        <!-- END Page Title -->
        <?php if ($manageinfo != '') { ?>
            <div class="alert alert-info">
                <button class="close" data-dismiss="alert">&times;</button>
                <strong><?php echo $langary_manage['system']; ?> </strong> <?php echo $manageinfo ?>
            </div>
        <?php } ?>
        <!-- BEGIN Main Content -->
        <div class="row">
            <div class="col-md-<?php echo isset($row_history) ? '10' : '12' ?>">
                <div class="box">
                    <div class="box-title">
                        <h3><i class="<?php echo getIconClass($method) ?>"></i> <?php echo $page_title . $active ?></h3>
                        <div class="box-tool">
                            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                            <a data-action="close" href="#"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" action="save.php" id="myform" name="myform" method="post">
                            <?php echo $fhelp->drawForm($colname['id']) ?>
                            <div class="row">
                                <!--right start-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label">
                                            <?php echo $fhelp->drawLabel($colname['ispublic']) ?>
                                        </label>
                                        <div class="col-sm-8 controls">
                                            <?php echo $fhelp->drawForm($colname['ispublic']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label">
                                            <?php echo $fhelp->drawLabel($colname['username']) ?>
                                        </label>
                                        <div class="col-sm-8  controls">
                                            <?php echo $fhelp->drawForm($colname['username']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label">
                                            <?php echo $fhelp->drawLabel($colname['password']) ?>
                                        </label>
                                        <div class="col-sm-8 controls">
                                            <?php echo $fhelp->drawForm($colname['password']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label">
                                            <?php echo $fhelp->drawLabel('repassword') ?>
                                        </label>
                                        <div class="col-sm-8 controls">
                                            <?php echo $fhelp->drawForm('repassword') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label">
                                            <?php echo $fhelp->drawLabel($colname['name']) ?>
                                        </label>
                                        <div class="col-sm-8  controls">
                                            <?php echo $fhelp->drawForm($colname['name']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label">
                                            <?php echo $fhelp->drawLabel($colname['email']) ?>
                                        </label>
                                        <div class="col-sm-8  controls">
                                            <?php echo $fhelp->drawForm($colname['email']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label">
                                            <?php echo $fhelp->drawLabel($colname['r_id']) ?>
                                        </label>
                                        <div class="col-sm-8  controls">
                                            <?php echo $fhelp->drawForm($colname['r_id']) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
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
                                <!--right start-->
                                <!--<div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-lg-2 control-label">
                                            <?php /*echo $fhelp->drawLabel($colname['pic']) */?>
                                        </label>
                                        <div class="col-sm-8  controls">
                                            <div id="picupload"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                            <button type="submit" class="btn btn-primary"><i
                                                        class="icon-ok"></i><?php /*echo $langary_manage['ok']; */?><?php /*echo $active */?>
                                            </button>
                                            <button type="button" class="btn" onclick="$.confirm({
                                                        title: '<?php /*echo $langary_manage['confirm_cancel'] . $active */?>'+'?',
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
                                                        class="icon-remove"></i><?php /*echo $langary_manage['cancel']; */?><?php /*echo $active */?>
                                            </button>
                                        </div>
                                    </div>
                                </div>-->
                                <!--right end-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php if (isset($row_history)) { ?>
                <div class="col-md-2">
                    <div class="box">
                        <div class="box-title">
                            <h3>
                                <i class="<?php echo getIconClass('info') ?>"></i> <?php echo $langary_Web_Manage_all['log']; ?>
                            </h3>
                        </div>
                        <div class="box-content">
                            <?php
                            $len = count($row_history);
                            $note = $len < 1 ? "{$row[$colname['username']]}" . $langary_Web_Manage_all['log2'] : $langary_Web_Manage_all['log3'];
                            echo ' <p> ' . $note . ' <button type="button" class="btn btn-primary pull-right" onclick="openBox(\'../adminlog/index.php?' . $colname['username'] . '=' . $row[$colname['username']] . '\')">more</button></p><hr>';
                            for ($i = 0; $i < count($row_history); $i++) {
                                $authname = coderAdmin::getAuthName($row_history[$i][$colname_log['main_key']], $row_history[$i][$colname_log['fun_key']]);
                                echo '<p>[' . $row_history[$i][$colname_log['createtime']] . ']<br>';
                                echo "{$authname['main']} {$authname['fun']} " . coderAdminLog::getActionNameByKey($row_history[$i][$colname_log['action']]) . " - {$row_history[$i][$colname_log['descript']]}</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
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
<script type="text/javascript" src="../js/coderpicupload.js"></script>
<script type="text/javascript">
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
        id: '<?php echo $colname["pic"];?>'/*,required:true*/
    });
    <?php echo coderFormHelp::drawVaildScript();?>
    <?php if($method == 'add'){?>
    $("#<?php echo $colname['username'];?>").rules("add",
        {
            messages: {
                remote: "<?php echo $langary_Web_Manage_all['username_js'];?>",
            },
            remote: {
                url: "checkdata.php",
                type: "post",
                data: {
                    type: 'username',
                    username: function () {
                        return $("#<?php echo $colname['username'];?>").val()
                    }
                }
            }
        });
    <?php }?>
    $("#<?php echo $colname['email'];?>").rules("add",
        {
            messages: {
                remote: "<?php echo $langary_Web_Manage_all['email_js'];?>",
            },
            remote: {
                url: "checkdata.php",
                type: "post",
                data: {
                    type: 'email',
                    id: function () {
                        return $("#<?php echo $colname['id'];?>").val()
                    },
                    email: function () {
                        return $("#<?php echo $colname['email'];?>").val()
                    },
                    username: function () {
                        return $("#<?php echo $colname['username'];?>").val()
                    }
                }
            }
        });

</script>
</body>
</html>
