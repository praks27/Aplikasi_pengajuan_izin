<?php
include("sess_check.php");

$username	= $_POST['username'];
$ajuan = date('Y-m-d');
$mulai	= $_POST['mulai'];
$akhir	= $_POST['akhir'];
$izin	= $_POST['izin'];
$ket	= $_POST['keterangan'];
$spv	= $_POST['spv'];
$loc	= $_POST['loc'];

$start = new DateTime($mulai);
$finish = new DateTime($akhir);
$int = $start->diff($finish);
$dur = $int->days;
$durasi = $dur + 1;

$stt = "Menunggu Approval Supervisor";

$id = date('dmYHis');
$curtime = date('H:i:s');

$pgw = "SELECT * FROM employee WHERE username='$username'";
$qpgw = mysqli_query($conn, $pgw);
$ress = mysqli_fetch_array($qpgw);

$jml = $ress['jml_cuti'];
$ccuti = $jml - $durasi;
$sisa = $ccuti;
$foto = substr($_FILES["foto"]["name"], -5);
$newfoto = "foto" . $username . $foto;
$folder1 = "libs/foto/";
$folder2 = "../supervisor/libs/fotoapproval/";
$folder3 = "../manager/libs/fotoapproval/";
$folder4 = "../fotoapproval/";

$sql 	= "INSERT INTO cuti (no_cuti, username, tgl_pengajuan, tgl_awal, tgl_akhir, lokasi_kerja, durasi,izin, keterangan, spv, stt_cuti,wkt_pengajuan,foto) 
				VALUES ('$id','$username','$ajuan','$mulai','$akhir','$loc','$durasi','$izin','$ket','$spv','$stt','$curtime','$newfoto')";
$query 	= mysqli_query($conn, $sql);
if ($query) {
	header("location: cuti_waitapp.php?act=add&msg=success");
}

if ($query && $izin == 'sakit') {
	if (move_uploaded_file($_FILES["foto"]["tmp_name"], $folder1 . $newfoto)) {
		copy($folder1 . $newfoto, $folder2 . $newfoto);
		copy($folder1 . $newfoto, $folder3 . $newfoto);
		copy($folder1 . $newfoto, $folder4 . $newfoto);

		header("location: cuti_waitapp.php?act=add&msg=success");
	}else{
		header("location: cuti_waitapp.php?act=add&msg=success");
	}
}

if ($query) {
	header("location: cuti_waitapp.php?act=add&msg=success");
} else {
	header("location: cuti_waitapp.php?act=fail&msg=success");
}
