<?php
include("sess_check.php");

$no=$_POST['no'];
$aksi=$_POST['aksi'];
$reject=$_POST['reject'];
$username=$_POST['username'];
$stt = "";
$null = 0;
$cemp = mysqli_query($conn, "SELECT * FROM employee where username = '$username'");
$cempqry = mysqli_fetch_array($cemp);
$cuti = mysqli_query($conn, "SELECT * FROM cuti where no_cuti = '$no'");
$cqry = mysqli_fetch_array($cuti);
$penambahan = $cempqry['jml_cuti'] + $cqry['durasi'];

if($aksi=="2"){
	$stt="Rejected";
	$sql = "UPDATE cuti SET
			stt_cuti='". $stt ."',
			lead_app='". $null ."',
			spv_app='". $null ."',
			ket_reject='". $reject ."'
			WHERE no_cuti='". $no ."'";
		$ress = mysqli_query($conn, $sql);
		mysqli_query($conn, "UPDATE employee SET jml_cuti = '$penambahan' WHERE username = '$username'");
		header("location: approval_cuti.php?act=update&msg=success");
	
}else{
	$stt="Menunggu Approval HRD";
	$num=1;
	$sql = "UPDATE cuti SET
			stt_cuti='". $stt ."',
			mng_app='". $num ."'
			WHERE no_cuti='". $no ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: approval_cuti.php?act=update&msg=success");
	
}
?>