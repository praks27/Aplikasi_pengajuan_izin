<?php
include("sess_check.php");

$username	= $_POST['username'];
$ajuan = date('Y-m-d');
$mulai	= $_POST['mulai'];
$akhir	= $_POST['akhir'];
$izin	= $_POST['izin'];
$ket	= $_POST['keterangan'];
$loc 	= $_POST['loc'];
$direksi 	= $_POST['direksi'];

$start = new DateTime($mulai);
$finish = new DateTime($akhir);
$int = $start->diff($finish);
$dur = $int->days;
if(isset($izin)&&$izin == "cuti" || $izin == "cuti khusus" || $izin == "libur pengganti"){
	$durasi = $dur+1;
}else{
	$durasi = 0;
}
$stt = "Menunggu Approval Direksi";

$id = date('dmYHis');
$curtime = date('H:i:s');

$pgw = "SELECT * FROM employee WHERE username='$username'";
$qpgw = mysqli_query($conn,$pgw);
$ress = mysqli_fetch_array($qpgw);

$jml = $ress['jml_cuti'];
$ccuti = $jml - $durasi;
$sisa = $ccuti;
$foto = substr($_FILES["foto"]["name"], -5);
$newfoto = "foto" . $username . $foto;
$jml = $ress['jml_cuti'];
$folder1 = "libs/fotoizin/";
$folder2 = "../fotoapproval/";


if($durasi>$jml && $izin == 'cuti'){
	echo "<script type='text/javascript'>
			alert('Durasi cuti lebih banyak dari jumlah cuti tersedia!.'); 
			document.location = 'cuti_create.php'; 
		</script>";	
}else{
	$sql 	= "INSERT INTO cuti (no_cuti, username, tgl_pengajuan, tgl_awal, tgl_akhir,lokasi_kerja, direksi, durasi,izin, keterangan, stt_cuti,wkt_pengajuan,foto) 
				VALUES ('$id','$username','$ajuan','$mulai','$akhir','$loc', '$direksi','$durasi','$izin','$ket','$stt','$curtime','$newfoto')";
	$query 	= mysqli_query($conn,$sql);
	if ($query && $izin == 'cuti khusus') {
		$sql = "UPDATE employee SET jml_cuti = '$jml' WHERE username = '$username'";
		$query 	= mysqli_query($conn, $sql);
		header("location: cuti_waitapp.php?act=add&msg=success");
	} else if ($query && $izin == 'libur pengganti') {
		$sql = "UPDATE employee SET jml_cuti = '$jml' WHERE username = '$username'";
		$query 	= mysqli_query($conn, $sql);
		header("location: cuti_waitapp.php?act=add&msg=success");
	}
	if ($query && $izin == 'sakit') {
		if (move_uploaded_file($_FILES["foto"]["tmp_name"], $folder1 . $newfoto)) {
			copy($folder1 . $newfoto, $folder2 . $newfoto);
			echo "<script type='text/javascript'>
				alert('Pengajuan Izin Berhasil!'); 
				document.location = 'cuti_waitapp.php'; 
			</script>";
		} else {
			header("location: cuti_waitapp.php?act=add&msg=success");
		}
	}
	if ($query && $izin == 'cuti') {
		$sql = "UPDATE employee SET jml_cuti = '$sisa' WHERE username = '$username'";
		$query 	= mysqli_query($conn, $sql);
		header("location: cuti_waitapp.php?act=add&msg=success");
	}else{
		header("location: cuti_waitapp.php?act=add&msg=success");
	}
}
?>