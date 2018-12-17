<?php
	include '../../koneksi.php';
	if(isset($_GET['report_ID'])){
		$delete = mysqli_query($connect, "DELETE FROM report WHERE report_ID = '".$_GET['report_ID']."'");
		
	}
?>
<script type="text/javascript">location.href = 'http://localhost/almanna/php/report.php';</script>