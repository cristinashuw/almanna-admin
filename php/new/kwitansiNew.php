<!DOCTYPE html>
<head>
<title>Kwitansi</title>

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
                    <a href="../quotation.php">
                        <i class="fa fa-book"></i>
                        <span>Quotation</span>
                    </a>
                    
                </li>
                <li>
                    <a class="active" href="../kwitansi.php">
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
                
                <h3>Add New Receipt</h3><hr>
                <section class="panel">
                        <header class="panel-heading">
                            
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="" method="POST">
                                <div class="form-group">
                                    <label>Receipt No.</label>
                                    <input type="text" name="no_kwitansi" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Customer ID</label>
                                    <select name="customer_ID" class="form-control m-bot15" required>
                                    <?php
                                       include '../../koneksi.php';
                                       $select = mysqli_query($connect, "SELECT * FROM customers");
                                       if(mysqli_num_rows($select) > 0){
                                       while ($hasil = mysqli_fetch_array($select)) {
                                       ?>  
                                       <option>                         
                                        <?php echo substr($hasil['customer_name'],0,2).$hasil['customer_ID']; ?>
                                        </option>
                                    <?php }} ?>                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Quotation ID</label>
                                    <select name="quotation_ID" class="form-control m-bot15" required>
                                    <?php
                                       include '../../koneksi.php';
                                       $select = mysqli_query($connect, "SELECT * FROM customers");
                                       if(mysqli_num_rows($select) > 0){
                                       while ($hasil = mysqli_fetch_array($select)) {
                                       ?>  
                                       <option>                         
                                        <?php echo substr($hasil['order_name'],0,2).$hasil['customer_ID']; ?>
                                        </option>
                                    <?php }} ?>                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Down Payment</label>
                                    <input type="text" name="downPayment" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Information</label>
                                    <input type="text" name="keterangan" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Date</label>
                                    <input name="paymentDate" class="form-control" type="Date" step=1 required>
                                </div>
                                    
                                <button type="submit" name="save" class="btn btn-info">Submit</button>
                            </form>
                            </div>

                        </div>
                    </section>

<?php
if(isset($_POST['save'])){
    $no_kwitansi = $_POST['no_kwitansi'];
    $customer_ID = $_POST['customer_ID'];
    $quotation_ID = $_POST['quotation_ID'];
    $downPayment = $_POST['downPayment'];
    $keterangan = $_POST['keterangan'];
    $paymentDate  = $_POST['paymentDate'];
                        
        $query = "INSERT INTO kwitansi(no_kwitansi, customer_ID, quotation_ID, downPayment, keterangan, paymentDate) VALUES('$no_kwitansi','$customer_ID', '$quotation_ID', '$downPayment', '$keterangan', '$paymentDate')";
                        
        $insert = mysqli_query($connect,$query );

            if($insert){
                echo 'berhasil disimpan';

                ?>
<script type="text/javascript">location.href = 'http://localhost/almanna/php/kwitansi.php';</script>

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