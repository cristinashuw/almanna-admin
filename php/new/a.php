<?php
	include '../../koneksi.php';
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
                    <a href="../kwitansi.php">
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
                            <label>Choose Packet :</label>

                            <form role="form" action="" method="POST" required style="text-align: center;">
                            	<button name="Medical">Medical Only</button>
                            	<button name="Travel">Travel Only</button>
                            	<button name="MedicalTravel">Medical & Travel</button>
                            	<br><br>
                            </form>

                            <?php
								if(isset($_POST['Medical']))
							{ ?>
								
							<form action="" method="post">
								<label>Select your Treatment</label><br>
								<div class="radio">
									<label><input type="radio" name="optradio">Rejuvenation</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Diabetic Related</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Brain Disorder</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Osteoarthritis</label>
								</div>
								<br>

								<input type="submit" name="submit" value="OK" />
							</form>
								
							<?php
								} elseif(isset($_POST['Travel'])) {  ?>

							<form action="" method="post">
								<label>Select your Destination</label><br>
								<div class="radio">
									<label><input type="radio" name="optradio">Bali</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Lombok</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Jogjakarta</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Danau Toba</label>
								</div>
								<br>
								<input type="submit" name="submit" value="OK" />
							</form>

							<?php
								} elseif(isset($_POST['MedicalTravel'])) {  ?>

							<form action="" method="post">
								<br>
							<label>Select your Treatment</label><br>
								<div class="radio">
									<label><input type="radio" name="optradio">Rejuvenation</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Diabetic Related</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Brain Disorder</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Osteoarthritis</label>
								</div>
								<br>
							<label>Select your Destination(s)</label>

                                <div class="radio"><input type="checkbox" name="check_list[]" value="Bali"><label>Bali</label></div>
                                <div class="radio"><input type="checkbox" name="check_list[]" value="Lombok"><label>Lombok</label></div>
                                <div class="radio"><input type="checkbox" name="check_list[]" value="Jogjakarta"><label>Jogjakarta</label></div>
                                <div class="radio"><input type="checkbox" name="check_list[]" value="Danau Toba"><label>Danau Toba</label></div>
                                <input type="submit" name="submit" value="OK"/>
                            </form>
                                
                            <?php
                                } else echo "<span>Please Select One.</span><br/>";
                                
                            ?>
                        </div>
                    </div>

                        <?php
                            if(isset($_POST['submit'])){//to run PHP script on submit
                                if(!empty($_POST['check_list'])){

                                    foreach($_POST['check_list'] as $selected){
                                        echo $selected."</br>";
                                    }
                                }
                            }
                        ?>

							
                </section>
            </div>
        </div>
    </section>
</section>
     





</body>
</html>

