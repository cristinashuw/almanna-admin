<?php
    include '../koneksi.php';
    $data_edit = mysqli_query($connect, "SELECT * FROM invoice WHERE no_invoice = '".$_GET['no_invoice']."'");
    $result = mysqli_fetch_array($data_edit);
?>

<!DOCTYPE html>
<head>
<title>Proforma</title>
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
                
                <li>
                    <a href="../quotation.php">
                        <i class="fa fa-book"></i>
                        <span>Quotation</span>
                    </a>
                    
                </li>
                <li>
                    <a  href="../kwitansi.php">
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
                        <li><a class="active" href="../proforma.php">Proforma</a></li>
                        <li><a href="../actual.php">Actual</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="../customers.php">
                        <i class="fa fa-users"></i>
                        <span>Customers</span>
                    </a>
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
                
                <h3>Edit Proforma</h3><hr>
                <section class="panel">
                        <header class="panel-heading">
                            Proforma Invoice
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="" method="POST">
                                <div class="form-group">
                                    <label>Invoice No.</label>
                                    <input type="text" name="no_invoice" class="form-control" value="<?php echo $result['no_invoice'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Invoice Date</label>
                                    <input type="text" name="invoiceDate" class="form-control" value="<?php echo $result['invoiceDate'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Receipt No.</label>
                                    <input type="text" name="no_kwitansi" class="form-control" value="<?php echo $result['no_kwitansi'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Customer ID</label>
                                    <input type="text" name="customer_ID" class="form-control" value="<?php echo $result['customer_ID'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Quotation ID</label>
                                    <input type="text" name="quotation_ID" class="form-control" value="<?php echo $result['quotation_ID'] ?>" required>
                                </div>

                                <button type="submit" name="Edit" class="btn btn-info">Update</button>
                            </form>
                            </div>

                        </div>
                    </section>

                <?php
                if(isset($_POST['Edit'])){
                    $update = mysqli_query($connect, "UPDATE invoice SET no_invoice = '".$_POST['no_invoice']."', invoiceDate = '".$_POST['invoiceDate']."', no_kwitansi = '".$_POST['no_kwitansi']."', customer_ID = '".$_POST['customer_ID']."', quotation_ID = '".$_POST['quotation_ID']."' WHERE no_invoice = '".$_GET['no_invoice']."'");
                    if($update){
                        echo 'berhasil edit';
                ?>
<script type="text/javascript">location.href = 'http://localhost/medicaltravel/php/proforma.php';</script>
                
                <?php
                    }else{
                        echo 'gagal edit'.mysqli_error($connect);
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
			  <p>© Magangtugas2018.com | All rights reserved.</p>
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