<!DOCTYPE html>
<head>
<title>Customers</title>
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
                <li><a href="../login.php"><i class="fa fa-key"></i> Log Out</a></li>
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
                    <a class="active" href="customers.php">
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
		<div class="table-agile-info">

			<div class="grid_3 grid_5 agile">
                    
                <a href="new/customersNew.php" style="padding: 0.6% 1.0%; background-color: #ff8533; color: #fff; border-radius: 4px;" class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-plus"></span> Add New Customer 
                </a>
            
			</div>
		
             
                <div class="bs-docs-example">
                    <table class="table table-striped table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Customer_ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th style="text-align: center;">Action</th>
                              
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                           include '../koneksi.php';
                           $no = 1;
                           $select = mysqli_query($connect, "SELECT * FROM customers");
                           if(mysqli_num_rows($select) > 0){
                           while ($hasil = mysqli_fetch_array($select)) {
                           ?>
                            <tr style="text-align: center;">
                                <td><?php echo $no; ?></td>
                                <td><?php echo substr($hasil['customer_name'],0,2).$hasil['customer_ID']; ?></td>
                                <td><?php echo $hasil['customer_name']; ?></td>
                                <td><?php echo $hasil['email']; ?></td>
                                <td><?php echo $hasil['address']; ?></td>
                                <td><?php echo $hasil['phone']; ?></td>
                                <td><?php echo $hasil['status']; ?></td>
                                
                                <td><?php $no++?>
                                    <a href="edit/customersEdit.php?customer_ID=<?php echo $hasil['customer_ID'] ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <span class="glyphicon-class">||</span></a>
                                    <a href="delete/customersDelete.php?customer_ID=<?php echo $hasil['customer_ID'] ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> <span class="glyphicon-class"></span></a>
                                </td>
                                
                            </tr>
                            <?php }}else{ ?>
                            <tr>
                                <td colspan="8" style="text-align: center;">No data found.</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

            

                </div>
            

        </div>

</section>

 <!-- footer -->
		  <div class="footer">
			
			  <p>© Almanna 2018 | All rights reserved.</p>
			
		  </div>
  <!-- / footer -->
</section>

<!--main content end-->
</section>

<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.dcjqaccordion.2.7.js"></script>
<script src="../js/scripts.js"></script>
<script src="../js/jquery.nicescroll.js"></script>

<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>

</body>
</html>
