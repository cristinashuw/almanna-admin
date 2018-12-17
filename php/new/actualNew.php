<!DOCTYPE html>
<head>
<title>Actual</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
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
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="images/admin.png">
                <span class="username">Admin</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="login.php"><i class="fa fa-key"></i> Log Out</a></li>
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
                    <a href="dashboard.php">
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
                        <span>Kwitansi</span>
                    </a>
                    
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-copy"></i>
                        <span>Invoice</span>
                    </a>
                    <ul class="sub">
                        <li><a class="active" href="proforma.php">Proforma</a></li>
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
		<div class="table-agile-info">

            <div class="well">
                
                <h3>Add New Proforma</h3><hr>
                <section class="panel">
                        <header class="panel-heading">
                            Proforma Invoice
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="" method="POST">
                                <div class="form-group">
                                    <label>Invoice No.</label>
                                    <input type="text" name="no_invoice" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Invoice Date</label>
                                    <input type="text" name="invoiceDate" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="customer_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Treatment ID</label>
                                    <input type="text" name="treatment_ID" class="form-control" required>
                                </div>
                                
                                <button type="submit" name="save" class="btn btn-info">Submit</button>
                            </form>
                            </div>

                        </div>
                    </section>

                <?php
                include '../../koneksi.php';
                if(isset($_POST['save'])){

                    $insert = "INSERT INTO invoice (no_invoice, invoiceDate) VALUES ('$no_invoice', '$invoiceDate');";
                    $insert .= "INSERT INTO customers(customer_name, email) VALUES ('$customer_name', '$email')";

                    $result = mysqli_multi_query($connect, $insert);

                    if($query){
                        echo 'berhasil disimpan';
                ?>
<script type="text/javascript">location.href = 'http://localhost/medicaltravel/proforma.php';</script>
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
			  <p>© Almanna 2018| All rights reserved.</p>
			</div>
		  </div>
  <!-- / footer -->
</section>

<!--main content end-->
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
</body>