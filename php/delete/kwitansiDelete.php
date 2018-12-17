<?php
	include '../../koneksi.php';
	if(isset($_GET['no_kwitansi'])){
		$delete = mysqli_query($connect, "DELETE FROM kwitansi WHERE no_kwitansi = '".$_GET['no_kwitansi']."'");
		
	}
?>
<script type="text/javascript">location.href = 'http://localhost/almanna/php/kwitansi.php';</script>