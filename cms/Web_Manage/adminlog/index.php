<?php 
include('_config.php');
coderAdmin::vaild($auth,'view');

$listHelp=new coderListHelp('table1',$page_title);
$listHelp->ajaxSrc="service.php";

$col=array();
$col[]=array('column'=>$colname['id'],'name'=>$langary_Web_Manage_all['id'],'order'=>true,'width'=>'60','def_desc'=>'desc');
$col[]=array('column'=>$colname['username'],'name'=>$langary_Web_Manage_all['username'],'order'=>true,'width'=>'100');
$col[]=array('column'=>$colname['main_key'],'name'=>$langary_Web_Manage_all['main_key'],'order'=>true,'width'=>'100');
$col[]=array('column'=>$colname['fun_key'],'name'=>$langary_Web_Manage_all['fun_key'],'order'=>true,'width'=>'100');
$col[]=array('column'=>$colname['action'],'name'=>$langary_Web_Manage_all['action'],'order'=>true,'width'=>'100');
$col[]=array('column'=>$colname['descript'],'name'=>$langary_Web_Manage_all['descript'],'order'=>true);
$col[]=array('column'=>$colname['ip'],'name'=>$langary_Web_Manage_all['ip'],'width'=>'100');
$col[]=array('column'=>$colname['createtime'],'name'=>$langary_Web_Manage_all['createtime'],'order'=>true,'width'=>'150');
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
		<?php if(get($colname['username'], 1)==''){include('../navbar.php') ;} ?>
        <!-- BEGIN Container -->
        <div class="container" id="main-container">
			<?php if(get($colname['username'], 1)==''){include('../left.php');}?>
            <!-- BEGIN Content -->
            <div id="main-content">
                <!-- BEGIN Page Title -->
                <div class="page-title">
                    <div>
                        <h1><i class="<?php echo $mainicon?>"></i> <?php echo $page_title?>管理</h1>
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
                                    <a d ata-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
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
						$tr.append('<td>'+row["<?php echo $colname['id']?>"]+'</td>');
						$tr.append('<td>'+row["<?php echo $colname['username']?>"]+'</td>');
                        $tr.append('<td>'+row["<?php echo $colname['main_key']?>"]+'</td>'); 
                        $tr.append('<td>'+row["<?php echo $colname['fun_key']?>"]+'</td>'); 
						$tr.append('<td>'+row["<?php echo $colname['action']?>"]+'</td>');							
						$tr.append('<td>'+row["<?php echo $colname['descript']?>"]+'</td>');										
						$tr.append('<td>'+row["<?php echo $colname['ip']?>"]+'</td>');								
						$tr.append('<td>'+row["<?php echo $colname['createtime']?>"]+'</td>');
						obj.append($tr);
					}
				}});			
			});
			
		</script>

    </body>
</html>
