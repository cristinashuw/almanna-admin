<?php
	include '../../koneksi.php';
	if(isset($_GET['customer_ID'])){
		$delete = mysqli_query($connect, "DELETE FROM `customers` WHERE customer_ID = '".$_GET['customer_ID']."'");
		
	}
?>
<script type="text/javascript">location.href = 'http://localhost/almanna/php/quotation.php';</script>