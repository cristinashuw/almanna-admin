<!DOCTYPE html>
<head>
<title>Quotation</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="../../css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="../../css/style.css" rel='stylesheet' type='text/css' />
<link href="../../css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="../../css/font.css" type="text/css"/>
<link href="../../css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="../../js/jquery2.0.3.min.js"></script>
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
                <img alt="" src="../../images/admin.png">
                <span class="username">Admin</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="../../login.php"><i class="fa fa-key"></i>Log Out</a></li>
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
                    <a href="../dashboard.php">
                        <i class="fa fa-th"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="../customers.php">
                        <i class="fa fa-users"></i>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="../quotation.php">
                        <i class="fa fa-book"></i>
                        <span>Quotation</span>
                    </a>
                    
                </li>
                <li>
                    <a href="../kwitansi.php">
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
                        <li><a href="../proforma.php">Proforma</a></li>
                        <li><a href="../actual.php">Actual</a></li>
                    </ul>
                </li>
                
                <li class="sub-menu">
                    <a href="../report.php">
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
		<div class="table-agile-info">

            <div class="well">
                
                <h3>Add New Quotation</h3><hr>
                <section class="panel">
                        <header class="panel-heading">
                            Order's Information
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="" method="POST">
                                
                                <div class="form-group">
                                    <label>Order name</label>
                                    <select name="order_name" class="form-control m-bot15">
                                        <option value="Rejuvenation">Rejuvenation</option>
                                        <option value="Diabetic Related">Diabetic Related</option>
                                        <option value="Brain Disorder">Brain Disorder</option>
                                        <option value="Osteoarthritis">Osteoarthritis</option>                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Destination</label>
                                    <select name="destination" class="form-control m-bot15">
                                        <option value="Bali">Bali</option>
                                        <option value="Yogyakarta">Yogyakarta</option>
                                        <option value="Lombok">Lombok</option>
                                        <option value="Danau Toba">Danau Toba</option>                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Medical fee</label>
                                    <input type="text" name="medicalFee" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Travel fee</label>
                                    <input type="text" name="travelFee" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Date Order</label>
                                    <input name="orderDate" class="form-control" type="Date" step=1 required>
                                </div>

                                <div class="form-group">
                                    <label>Order Status</label>
                                    <select name="orderStatus" class="form-control m-bot15">
                                        <option value="Completed">Completed</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Canceled">Canceled</option>
                                    </select>

                                </div>
                                <button type="submit" name="save" class="btn btn-info">Submit</button>
                            </form>
                            </div>

                        </div>
                    </section>

               
<?php
include '../../koneksi.php';
if(isset($_POST['save'])){
    $order_name = $_POST['order_name'];
    $destination = $_POST['destination'];
    $medicalFee = $_POST['medicalFee'];
    $travelFee = $_POST['travelFee'];
    $orderDate  = $_POST['orderDate'];
    $orderStatus = $_POST['orderStatus'];
                        
        $query = "INSERT INTO customers(order_name, destination, medicalFee, travelFee, orderDate, orderStatus) VALUES('$order_name', '$destination', '$medicalFee', '$travelFee', '$orderDate', '$orderStatus')";
                        
        $insert = mysqli_query($connect,$query );

            if($insert){
                echo 'berhasil disimpan';

                ?>
<script type="text/javascript">location.href = 'http://localhost/almanna/php/quotation.php';</script>

                <?php
                    }else{
                        echo 'gagal disimpan'.mysqli_error($connect);
                    }
                }
                ?>

            </div>

            <div class="clearfix"> </div>
        	

        </div>

</section>

 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© Almanna 2018 | All rights reserved.</p>
			</div>
		  </div>
  <!-- / footer -->
</section>

<!--main content end-->
</section>
<script src="../../js/bootstrap.js"></script>
<script src="../../js/jquery.dcjqaccordion.2.7.js"></script>
<script src="../../js/scripts.js"></script>
<script src="../../js/jquery.slimscroll.js"></script>
<script src="../../js/jquery.nicescroll.js"></script>
</body>
</html>