<?php
include("sess_check.php");

$id = $sess_admid;
$username=$_POST['username'];
$nama=$_POST['nama'];
$jk=$_POST['jk'];
$telp=$_POST['telp'];
$divisi=$_POST['divisi'];
$jabatan=$_POST['jabatan'];
$akses=$_POST['akses'];
$jml=$_POST['jml'];
$alamat=$_POST['alamat'];
$foto=substr($_FILES["foto"]["name"],-5);
$newfoto = "foto".$username.$foto;
$tgl = date('Y-m-d');
$aktif = "Aktif";
if ($akses == 'Non_staff_bulanan'){
	$jcuti = 0;
}else if ($akses == 'Non_staff_bulanan'){
	$jcuti = 0;
}else {
	$jcuti = $jml;
}

$sqlcek = "SELECT * FROM employee WHERE username='$username'";
$resscek = mysqli_query($conn, $sqlcek);
$rowscek = mysqli_num_rows($resscek);
if($rowscek<1){
	$sql="INSERT INTO employee(username,nama_emp,jk_emp,telp_emp,divisi,jabatan,alamat,hak_akses,jml_cuti,password,active,id_adm)
		  VALUES('$username','$nama','$jk','$telp','$divisi','$jabatan','$alamat','$akses','$jcuti','$username','$aktif','$id')";
	$ress = mysqli_query($conn, $sql);
	if($ress){
		move_uploaded_file($_FILES["foto"]["tmp_name"],"foto/".$newfoto);
		header("location: karyawan.php?act=add&msg=success");
	}else{
		echo("Error description: " . mysqli_error($conn));
		header("location: karyawan.php?act=add&msg=fail");
		echo "<script type='text/jav
		
		ascript'> document.location = 'karyawan_tambah.php'; </script>";
	}
}else{
	header("location: karyawan_tambah.php?act=add&msg=double");	
}
?>