<?php require('../koneksi.php');?>
<!DOCTYPE html>
<head>
	<title>Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

	<!-- bootstrap-css -->
	<link rel="stylesheet" href="../css/bootstrap.min.css" >
	<!-- //bootstrap-css -->

	<!-- Custom CSS -->
	<link href="../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../css/style-responsive.css" rel="stylesheet"/>

	<!-- font CSS -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

	<!-- font-awesome icons -->
	<link rel="stylesheet" href="../css/font.css" type="text/css"/>
	<link href="../css/font-awesome.css" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

	<!-- //font-awesome icons -->

	<script src="../js/jquery2.0.3.min.js"></script> 
	<!--invoice dropdown-->

</head>

<body>
	<section id="container">

		<!--header start-->
		<header class="header fixed-top clearfix">

			<!--logo start-->
			<div class="brand">
				<a href="#" class="logo">
					ALMANNA
				</a>

				<div class="sidebar-toggle-box">
					<div class="fa fa-bars"></div>
				</div>
			</div>
			<!--logo end-->

			<div class="top-nav clearfix">
			    <!--search & user info start-->
			    <ul class="nav pull-right top-menu">
			      
			        <!-- user login dropdown start-->
			        <li class="dropdown">
			            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
			                <img alt="" src="../images/admin.png">
			                <span class="username">Admin</span>
			                <b class="caret"></b>
			            </a>
			            <ul class="dropdown-menu extended logout">
			                <li><a href="../logout.php"><i class="fa fa-key"></i> Logout</a></li>
			            </ul>
			        </li>
			        <!-- user login dropdown end -->
			       
			    </ul>
			    <!--search & user info end-->
			</div>
		</header>
		<!--header end-->

		<!--sidebar start-->
		<aside>
		    <div id="sidebar" class="nav-collapse">
		        <!-- sidebar menu start-->
		        <div class="leftside-navigation">
		            <ul class="sidebar-menu" id="nav-accordion">
		                <li>
		                    <a class="active" href="dashboard.php">
		                        <i class="fa fa-th"></i>
		                        <span>Dashboard</span>
		                    </a>
		                </li>
		                <li class="sub-menu">
		                    <a href="customers.php">
		                        <i class="fa fa-users"></i>
		                        <span>Customers</span>
		                    </a>
		                </li>
		                <li>
		                    <a href="quotation.php">
		                        <i class="fa fa-book"></i>
		                        <span>Quotation</span>
		                    </a>
		                    
		                </li>
		                <li>
                    		<a href="kwitansi.php">
                        		<i class="fa fa-money"></i>
                        		<span>Receipt</span>
                    		</a>
                    
               			</li>
		                <li>
		                    <a href="#">
		                        <i class="fa fa-copy"></i>
		                        <span>Invoice</span>
		                    </a>
		                    <ul class="sub">
								<li><a href="proforma.php">Proforma</a></li>
								<li><a href="actual.php">Actual</a></li>
		                    </ul>
		                </li>
		                
		                <li class="sub-menu">
		                    <a href="report.php">
		                        <i class="fa fa-envelope"></i>
		                        <span>Report</span>
		                    </a> 
		                </li>
		                
		            </ul>            
		        </div>
		        <!-- sidebar menu end-->
		    </div>
		</aside>
		<!--sidebar end-->

		<!--main content start-->
		<section id="main-content">
			<section class="wrapper">
				<!-- //market-->

				<div class="market-updates">
					<div class="col-md-3 market-update-gd">
						<div class="market-update-block clr-block-2">
							<div class="col-md-4 market-update-right">
								<i class="fa fa-shopping-cart" aria-hidden="true"></i>
							</div>

							<div class="col-md-8 market-update-left">
								<h4>Orders</h4>
								<?php						
								$count = mysqli_num_rows(mysqli_query($connect, "Select customer_ID FROM `customers`"));
								?>
								<h3>
									<?php echo $count;?>
								</h3>

							</div>
							<div class="clearfix"> </div>
						</div>
					</div>

					<div class="col-md-3 market-update-gd">
						<div class="market-update-block clr-block-1">
							<div class="col-md-4 market-update-right">
								<i class="fa fa-copy" ></i>
							</div>
							<div class="col-md-8 market-update-left">
								<h4>Invoice</h4>
								<?php						
								$count = mysqli_num_rows(mysqli_query($connect, "Select no_actual FROM `actual`"));
								?>
								<h3>
									<?php echo $count;?>
								</h3>
							</div>
						  <div class="clearfix"> </div>
						</div>
					</div>

					<div class="col-md-3 market-update-gd">
						<div class="market-update-block clr-block-3">
							<div class="col-md-4 market-update-right">
								<i class="fa fa-users" ></i>
							</div>
							<div class="col-md-8 market-update-left">
								<h4>Customers</h4>
								<?php						
								$count = mysqli_num_rows(mysqli_query($connect, "Select customer_ID FROM `customers`"));
								?>
								<h3>
									<?php echo $count;?>
								</h3>
							</div>
						  <div class="clearfix"> </div>
						</div>
					</div>

					<div class="col-md-3 market-update-gd">
						<div class="market-update-block clr-block-4">
							<div class="col-md-4 market-update-right">
								<i class="fa fa-usd"></i>
							</div>
							<div class="col-md-8 market-update-left">
								<h4>Cash</h4>
								<?php						
								$count = mysqli_query($connect, "Select SUM(masuk) AS masuk FROM `report`");
								$row = mysqli_fetch_array($count);
								$count = mysqli_query($connect, "Select SUM(keluar) AS keluar FROM `report`");
								$row2 = mysqli_fetch_array($count);
								$hasil = $row['masuk']-$row2['keluar'];
								?>
								<h3><?php echo $hasil;?></h3>
							</div>
						  <div class="clearfix"> </div>
						</div>
					</div>


					<div class="col-md-4 market-update-gd">
						<div class="market-update-block clr-block-5">
							
							<h4>Treatment</h4><hr>
							<p>"Lorem ipsum dolor sit amet, consectetuer adiping elit, sed diam nomummy nibh euismod tinunt ut laoreet dolore magna aliquam"</p>
							<div class="clearfix"> </div>
							
						</div>
					</div>

					<div class="col-md-4 market-update-gd">
						<div class="market-update-block clr-block-5">
							
							<h4>Customer</h4><hr>
							<p>"Lorem ipsum dolor sit amet, consectetuer adiping elit, sed diam nomummy nibh euismod tinunt ut laoreet dolore magna aliquam"</p>
							
						    <div class="clearfix"> </div>
						</div>
					</div>

					<div class="col-md-4 market-update-gd">
						<div class="market-update-block clr-block-5">
							
							<h4>Order</h4><hr>
							<p>"Lorem ipsum dolor sit amet, consectetuer adiping elit, sed diam nomummy nibh euismod tinunt ut laoreet dolore magna aliquam"</p>
						</div>
						<div class="clearfix"> </div>
					</div>
					
		            <div class="clearfix"> </div>

				</div>
		
				<div class="col-md-12 stats-info stats-last widget-shadow">
					<div class="stats-last-agile">

						<table class="table table-striped table-bordered" id="myTable">
							<thead>
								<tr>
									<th><span>No.</span></th>
									<th><span>Name</span></th>
									<th><span>Email</span></th>
									<th><span>Phone</span></th>
									<th><span>Order Date</span></th>
									<th><span>Order Name</span></th>
								</tr>
							</thead>
						
							<tbody>
								<?php
                           include '../koneksi.php';
                           $no = 1;

                           $select = mysqli_query($connect, "SELECT * FROM customers");
                           // $select = mysqli_query($connect, "SELECT customers.*, quotation.* FROM customers INNER JOIN quotation ON customers.customer_ID = quotation.customer_ID");
                           if(mysqli_num_rows($select) > 0){
                           while ($hasil = mysqli_fetch_array($select)) {
                           ?>

                            <tr style="">
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $hasil['customer_name']; ?></td>
                                <td><?php echo $hasil['email']; ?></td>
                                <td><?php echo $hasil['phone']; ?></td>
                                <td><?php echo $hasil['orderDate']; ?></td>
                                <td><?php echo $hasil['order_name']; ?></td>
                            </tr>

                            
                            <?php }}else{ ?>
                            <tr>
                                <td colspan="6" style="text-align: center;">No data found.</td>
                            </tr>
                            <?php } ?>
							</tbody>
						</table>
							
					</div>
				</div>
				


		  		<div class="clearfix"> </div>
		
</section>

				 <!-- footer -->
				<div class="footer">
					<div class="wthree-copyright">
						<p>© Almanna 2018 | All rights reserved.</p>
					</div>
				</div>
				<!-- / footer -->
			
		<!--main content end-->
		</section>
	</section>

	<script src="../js/bootstrap.js"></script>
	<script src="../js/jquery.dcjqaccordion.2.7.js"></script> <!--invoice dropdown-->
	<script src="../js/scripts.js"></script>
	<script src="../js/jquery.nicescroll.js"></script> <!--open&close sidebar-->
	
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>

</body>
</html>