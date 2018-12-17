<?php
	include '../koneksi.php';
	if(isset($_GET['no_invoice'])){
		$delete = mysqli_query($connect, "DELETE FROM invoice WHERE no_invoice = '".$_GET['no_invoice']."'");
		
	}
?>
<script type="text/javascript">location.href = 'http://localhost/almanna/php/proforma.php';</script>