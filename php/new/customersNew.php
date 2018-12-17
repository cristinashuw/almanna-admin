<?php
include '../../koneksi.php';
    // $VcID = '';
    $Vnama = '';
    $Vemail = '';
    $Vaddress = '';
    $Vphone = '';
    $Vstatus = '';
                
    if(isset($_POST['save'])){
        // $VcID = $_POST['customer_ID'];
        $Vnama = $_POST['customer_name'];
        $Vemail = $_POST['email'];
        $Vaddress = $_POST['address'];
        $Vphone = $_POST['phone'];
        $Vstatus = $_POST['status'];
                    
        $select = mysqli_query($connect, "SELECT * From Customers Where customer_name = '".$_POST['customer_name']."' OR email = '".$_POST['email']."'");
                    
        $row = mysqli_fetch_assoc($select);

            if($row['customer_name'] == $_POST['customer_name']){
                            $nama = "sama";
                    
                }elseif($row['email'] == $_POST['email']){
                            $email = "sama";
                        
                    } else {
                        // $insert = mysqli_query($connect,"INSERT INTO customers(customer_ID, customer_name, email, address, phone, status) VALUES ('".$_POST['customer_ID']."', '".$_POST['customer_name']."', '".$_POST['email']."', '".$_POST['address']."', '".$_POST['phone']."', '".$_POST['status']."')" );

                        $insert = mysqli_query($connect,"INSERT INTO customers(customer_name, email, address, phone, status) VALUES ('".$_POST['customer_name']."', '".$_POST['email']."', '".$_POST['address']."', '".$_POST['phone']."', '".$_POST['status']."')" );
                        
                        if(isset($insert)){
                        echo '';
?>

<script type="text/javascript">location.href = 'http://localhost/almanna/php/customers.php';</script>
                
                    <?php
                        }else{
                          echo 'gagal disimpan'.mysqli_error($connect);
                            }
                        }
                    
    }
                    
                    ?>

<!DOCTYPE html>
<head>
<title>Customers</title>
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
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
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
                    <a class="active" href="../customers.php">
                        <i class="fa fa-users"></i>
                        <span>Customer</span>
                    </a>
                </li>
                <li>
                    <a href="../quotation.php">
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
                
                <h3>Add New Customer</h3><hr>
                <section class="panel">
                        <header class="panel-heading">
                            Customer's Information
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="" method="POST">
                                
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="customer_name" value="<?php echo $Vnama?>" class="form-control" required>
                                <?php  
                                if(isset($_POST['save'])){
                                    if (isset($nama)) {
                                        echo "*Name already exists.";
                                    }
                                }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="<?php echo $Vemail?>" class="form-control" required>
                                    <?php  
                                if(isset($_POST['save'])){
                                    if (isset($email)) {
                                        echo "*Email already exists.";
                                    }
                                }
                                
                                    ?>

                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" value="<?php echo $Vaddress?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="number" name="phone" value="<?php echo $Vphone?>" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control m-bot15">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" name="save" class="btn btn-info">Submit</button>
                            </form>
                            </div>

                        </div>
                    </section>


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