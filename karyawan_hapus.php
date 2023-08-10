<?php
	include("sess_check.php");
		$id = $_GET['username'];	
		$sql = "DELETE FROM employee WHERE username='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: karyawan.php?act=delete&msg=success");
?>