<?php
include('_config.php');
include_once('filterconfig.php');
coderAdmin::vaild($auth,'view');

$listHelp=new coderListHelp('table1',$page_title);
$listHelp->mutileSelect=true;
$listHelp->editLink="manage.php";
$listHelp->addLink="manage.php";
$listHelp->ajaxSrc="service.php";
$listHelp->delSrc="delservice.php";

$col=array();
$col[]=array('column'=>$colname['id'],'name'=>$langary_Web_Manage_all['id'],'order'=>true,'width'=>'60');
$col[]=array('column'=>$colname['ispublic'],'name'=>$langary_Web_Manage_all['ispublic'],'order'=>true,'width'=>'60');
//$col[]=array('column'=>$colname['pic'],'name'=>$langary_Web_Manage_all['pic'],'width'=>50);
$col[]=array('column'=>$colname['name'],'name'=>"管理員名稱",'order'=>true,'width'=>'100');
$col[]=array('column'=>$colname['username'],'name'=>$langary_Web_Manage_all['username'],'order'=>true,'width'=>'150');
$col[]=array('column'=>$colname['email'],'name'=>$langary_Web_Manage_all['email'],'order'=>true);
$col[]=array('column'=>$colname_rules['name'],'name'=>$langary_Web_Manage_all['rules_name'],'order'=>true,'width'=>'180');
$col[]=array('column'=>$colname['ip'],'name'=>$langary_Web_Manage_all['ip'],'width'=>'100');
$col[]=array('column'=>$colname['admin'],'name'=>$langary_Web_Manage_all['admin'],'order'=>true,'width'=>'100');
$col[]=array('column'=>$colname['updatetime'],'name'=>$langary_Web_Manage_all['update_time'],'order'=>true,'width'=>'150');
$listHelp->Bind($col);

$listHelp->bindFilter($help);
$db = Database::DB();
coderAdminLog::insert($adminuser['username'],$main_auth_key,$fun_auth_key,'view',$langary_Web_Manage_all['insert']);
$db->close();
?>
<!DOCTYPE html>
<html>
    <head>
		<?php include('../head.php');?>
    </head>
    <body >
		<?php include('../navbar.php');?>
        <!-- BEGIN Container -->
        <div class="container" id="main-container">
			<?php include('../left.php');?>
            <!-- BEGIN Content -->
            <div id="main-content">
                <!-- BEGIN Page Title -->
                <div class="page-title">
                    <div>
                        <h1><i class="<?php echo $mainicon?>"></i> <?php echo $page_title?><?php echo $langary_index['page_title']?></h1>
                        <h4><?php echo $page_desc?></h4>
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
                        <?php echo $mtitle?>
                    </ul>
                </div>
                <!-- END Breadcrumb -->

                <!-- BEGIN Main Content -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-title">
                                <h3 style="float:left"><i class="icon-table"></i> <?php echo $page_title?></h3>
                                <div class="box-tool">
                                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                                    <a data-action="close" href="#"><i class="icon-remove"></i></a>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                            <div class="box-content">
                                <?php echo $listHelp->drawTable()?>
                            </div>
                        </div>
                    </div>
                </div>
				<?php include('../footer.php');?>
                <a id="btn-scrollup" class="btn btn-circle btn-lg" href="#"><i class="icon-chevron-up"></i></a>
            </div>
            <!-- END Content -->
        </div>
        <!-- END Container -->

		<?php include('../js.php');?>
        <script type="text/javascript" src="../js/coderlisthelp.js"></script>
		<script type="text/javascript">
			$( document ).ready(function() {
				$('#table1').coderlisthelp({debug:true,callback:function(obj,rows){
					obj.html('');
					var count=rows.length;
					for(var i=0;i<count;i++){
						var row=rows[i];
						var $tr=$('<tr></tr>');
						$tr.attr("editlink","username="+row["<?php echo $colname['username']?>"]);
						$tr.attr("delkey",row["<?php echo $colname['id']?>"]);
						$tr.attr("title",row["<?php echo $colname['username']?>"]);

						$tr.append('<td>'+row["<?php echo $colname['id']?>"]+'</td>');
                        $tr.append('<td>'+row["<?php echo $colname['ispublic']?>"]+'</td>');
                        //var pic = (row["<?php //echo $colname['pic']?>"] !="")?'<?php //echo $file_path;?>s'+row["<?php //echo $colname['pic']?>"]:'../images/nouser.jpg';

                        //$tr.append('<td><img src="'+pic+'" width="40" height="40"></img></td>');
                        $tr.append('<td>'+row["<?php echo $colname['name']?>"]+'</td>');
						$tr.append('<td>'+row["<?php echo $colname['username']?>"]+'</td>');
						$tr.append('<td>'+row["<?php echo $colname['email']?>"]+'</td>');
                        $tr.append('<td>'+row["<?php echo $colname_rules['name']?>"]+'</td>');
						$tr.append('<td>'+row["<?php echo $colname['ip']?>"]+'</td>');
						$tr.append('<td>'+row["<?php echo $colname['admin']?>"]+'</td>');
						$tr.append('<td>'+row["<?php echo $colname['updatetime']?>"]+'</td>');
						obj.append($tr);
					}
				}});
			});

		</script>

    </body>
</html>
