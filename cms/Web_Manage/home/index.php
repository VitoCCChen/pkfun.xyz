<?php
include('_config.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('../head.php');?>
	</head>
	<body>
		<?php include('../navbar.php');?>
		<!-- BEGIN Container -->
		<div class="container" id="main-container">
			<?php include('../left.php');?>

			<!-- BEGIN Content -->
			<div id="main-content">
				<!-- BEGIN Page Title -->
				<div class="page-title">
					<div>
						<h1><i class="icon-home"></i> 首頁資訊</h1>
						<h4><?php echo $page_desc?></h4>
					</div>
				</div>
				<!-- END Page Title -->

				<!-- BEGIN Breadcrumb -->
				<div id="breadcrumbs">
					<ul class="breadcrumb">
						<li class="active"><i class="icon-home"></i> Home</li>
					</ul>
				</div>
				<!-- END Breadcrumb -->

				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="tile">
											<p class="title"><?php echo $adminuser['name']?> - 歡迎使用本系統</p>
											<p style="margin-top:10px">
												<img src="<?php echo $adminuser['pic']?>" style="float:left" width="60">
												<div style="float:left;margin:5px">
													您本次登入時間為:
													<?php echo $adminuser['time'].'<br>登入IP:'.request_ip().'<br><li class="icon-smile"> '.coderAdmin::sayHello().'</li>';?>
												</div>
												<div class="clearfix"></div>
											</p>
											<div class="img img-bottom">
												<i class="icon-desktop"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

                        <?php if($adminuser['type']>1){?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="tile tile-blue">
                                    <div class="img" style="line-height: 82px;">
                                        <img src="../img/demo/wp-logo.png" alt="wp" style="max-height: 50px;">
                                    </div>
                                    <div class="content">
                                        <p class="big"><?php echo ($adminuser['type'] == '4'?$adminuser['serviceid']:$adminuser['id']).".".class_agents_link::getList_home()?></p>
                                        <p class="title"><?php echo $langary_hometitle['title']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
					</div>
				</div>
				<!--<div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-title">
                                <h3><i class="icon-sitemap"></i> 總攬</h3>
                                <div class="box-tool">
                                    <div class="btn-group">
                                        <select class="form-control" style="margin-top: -5px;">
                                            <option value="">全部</option>
                                            <option value="1">代理人</option>
                                            <option value="2">玩家</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="box-content" id="mydata">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover fill-head">
                                        <thead>
                                        <tr>
                                            <th>日期</th>
                                            <th>新增用戶</th>
                                            <th>上分總人數</th>
                                            <th>上分總額</th>
                                            <th>下注總次數</th>
                                            <th>下注總額</th>
                                            <th>下分總人數</th>
                                            <th>下分總額</th>
                                            <th>總營收</th>
                                            <th>佔成總營收</th>
                                            <th>退水總營收</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>2017-07-28</td>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>6</td>
                                            <td>7</td>
                                            <td>8</td>
                                            <td>9</td>
                                            <td>10</td>
                                        </tr>
                                        <tr>
                                            <td>2017-07-27</td>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>6</td>
                                            <td>7</td>
                                            <td>8</td>
                                            <td>9</td>
                                            <td>10</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover fill-head">
                                        <thead>
                                        <tr>
                                            <th>統計</th>
                                            <th>新增用戶</th>
                                            <th>上分總人數</th>
                                            <th>上分總額</th>
                                            <th>下注總次數</th>
                                            <th>下注總額</th>
                                            <th>下分總人數</th>
                                            <th>下分總額</th>
                                            <th>總營收</th>
                                            <th>佔成總營收</th>
                                            <th>退水總營收</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>近7日內</td>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>6</td>
                                            <td>7</td>
                                            <td>8</td>
                                            <td>9</td>
                                            <td>10</td>
                                        </tr>
                                        <tr>
                                          <td>本月</td>
                                          <td>1</td>
                                          <td>2</td>
                                          <td>3</td>
                                          <td>4</td>
                                          <td>5</td>
                                          <td>6</td>
                                          <td>7</td>
                                          <td>8</td>
                                          <td>9</td>
                                          <td>10</td>
                                          </tr>
                                        <tr>
                                          <td>上月</td>
                                          <td>1</td>
                                          <td>2</td>
                                          <td>3</td>
                                          <td>4</td>
                                          <td>5</td>
                                          <td>6</td>
                                          <td>7</td>
                                          <td>8</td>
                                          <td>9</td>
                                          <td>10</td>
                                          </tr>
                                        <tr>
                                          <td>總數</td>
                                          <td>1</td>
                                          <td>2</td>
                                          <td>3</td>
                                          <td>4</td>
                                          <td>5</td>
                                          <td>6</td>
                                          <td>7</td>
                                          <td>8</td>
                                          <td>9</td>
                                          <td>10</td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
				</div>-->


				<!-- END Tiles -->


				<!-- BEGIN Main Content -->

				<!-- END Main Content -->

				<?php include('../footer.php');?>

				<a id="btn-scrollup" class="btn btn-circle btn-lg" href="#"><i class="icon-chevron-up"></i></a>
			</div>
			<!-- END Content -->

		</div>
		<!-- END Container -->


		<?php include('../js.php');?>


		<!-- <script src="../assets/flot/jquery.flot.js"></script>
		<script src="../assets/flot/jquery.flot.resize.js"></script>
		<script src="../assets/flot/jquery.flot.pie.js"></script>
		<script src="../assets/flot/jquery.flot.stack.js"></script>
		<script src="../assets/flot/jquery.flot.crosshair.js"></script>
		<script src="../assets/flot/jquery.flot.tooltip.min.js"></script>
		<script src="../assets/sparkline/jquery.sparkline.min.js"></script> -->

		<script>
  //       function showplot(){

  //           //define placeholder class
  //           var placeholder = $("#visitors-chart");

  //           if ($(placeholder).size() == 0) {
  //           return;
  //           }
  //           //some data
  //           var d1 = [
  //               [1, 35],
  //               [2, 48],
  //               [3, 34],
  //               [4, 54],
  //               [5, 46],
  //               [6, 37],
  //               [7, 40],
  //               [8, 55],
  //               [9, 43],
  //               [10, 61],
  //               [11, 52],
  //               [12, 57],
  //               [13, 64],
  //               [14, 56],
  //               [15, 48],
  //               [16, 53],
  //               [17, 50],
  //               [18, 59],
  //               [19, 66],
  //               [20, 73],
  //               [21, 81],
  //               [22, 75],
  //               [23, 86],
  //               [24, 77],
  //               [25, 86],
  //               [26, 85],
  //               [27, 79],
  //               [28, 83],
  //               [29, 95],
  //               [30, 92]
  //           ];
  //           var d2 = [
  //               [1, 9],
  //               [2, 15],
  //               [3, 16],
  //               [4, 21],
  //               [5, 19],
  //               [6, 15],
  //               [7, 22],
  //               [8, 29],
  //               [9, 20],
  //               [10, 27],
  //               [11, 32],
  //               [12, 37],
  //               [13, 34],
  //               [14, 30],
  //               [15, 28],
  //               [16, 23],
  //               [17, 28],
  //               [18, 35],
  //               [19, 31],
  //               [20, 28],
  //               [21, 33],
  //               [22, 25],
  //               [23, 27],
  //               [24, 24],
  //               [25, 36],
  //               [26, 25],
  //               [27, 39],
  //               [28, 28],
  //               [29, 35],
  //               [30, 42]
  //           ];
  //           var chartColours = ['#88bbc8', '#ed7a53', '#9FC569', '#bbdce3', '#9a3b1b', '#5a8022', '#2c7282'];
  //           //graph options
  //           var options = {
  //                   grid: {
  //                       show: true,
  //                       aboveData: true,
  //                       color: "#3f3f3f" ,
  //                       labelMargin: 5,
  //                       axisMargin: 0,
  //                       borderWidth: 0,
  //                       borderColor:null,
  //                       minBorderMargin: 5 ,
  //                       clickable: true,
  //                       hoverable: true,
  //                       autoHighlight: true,
  //                       mouseActiveRadius: 20
  //                   },
  //                   series: {
  //                       grow: {
  //                           active: false,
  //                           stepMode: "linear",
  //                           steps: 50,
  //                           stepDelay: true
  //                       },
  //                       lines: {
  //                           show: true,
  //                           fill: true,
  //                           lineWidth: 3,
  //                           steps: false
  //                           },
  //                       points: {
  //                           show:true,
  //                           radius: 4,
  //                           symbol: "circle",
  //                           fill: true,
  //                           borderColor: "#fff"
  //                       }
  //                   },
  //                   legend: {
  //                       position: "ne",
  //                       margin: [0,-25],
  //                       noColumns: 0,
  //                       labelBoxBorderColor: null,
  //                       labelFormatter: function(label, series) {
  //                           // just add some space to labes
  //                           return label+'&nbsp;&nbsp;';
  //                        }
  //                   },
  //                   yaxis: { min: 0 },
  //                   xaxis: {ticks:11, tickDecimals: 0},
  //                   colors: chartColours,
  //                   shadowSize:1,
  //                   tooltip: true, //activate tooltip
  //                   tooltipOpts: {
  //                       content: "%s : %y.0",
  //                       defaultTheme: false,
  //                       shifts: {
  //                           x: -30,
  //                           y: -50
  //                       }
  //                   }
  //               };
  //               $.plot(placeholder, [
  //               {
  //                   label: "Visits",
  //                   data: d1,
  //                   lines: {fillColor: "#f2f7f9"},
  //                   points: {fillColor: "#88bbc8"}
  //               },
  //               {
  //                   label: "Unique Visits",
  //                   data: d2,
  //                   lines: {fillColor: "#fff8f2"},
  //                   points: {fillColor: "#ed7a53"}
  //               }

  //           ], options);

  //       }
  //   if (jQuery.plot) {

		// showplot();
  //   }
  //   if (jQuery().sparkline) {
  //       $('.inline-sparkline').sparkline(
  //           'html',
  //           {
  //               width: '70px',
  //               height: '26px',
  //               lineWidth: 2,
  //               spotRadius: 3,
  //               lineColor: '#88bbc8',
  //               fillColor: '#f2f7f9',
  //               spotColor: '#14ae48',
  //               maxSpotColor: '#e72828',
  //               minSpotColor: '#f7941d'
  //           }
  //       );
  //   }
		</script>
	</body>
</html>
