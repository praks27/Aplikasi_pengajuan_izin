<?php
	// memulai session
	session_start();
	// membaca nilai variabel session 
	$chk_sess = $_SESSION['supervisor'];
	// memanggil file koneksi
	include("dist/config/koneksi.php");
	include("dist/config/library.php");
	// mengambil data pengguna dari tabel pengguna
	$sql_sess = "SELECT * FROM employee WHERE username='". $chk_sess ."'";
	$ress_sess = mysqli_query($conn, $sql_sess);
	$row_sess = mysqli_fetch_array($ress_sess);
	// menyimpan id_pengguna yang sedang login
	$sess_spvid = $row_sess['username'];
	$sess_spvname = $row_sess['nama_emp'];
	// mengarahkan ke halaman login.php apabila session belum terdaftar
	if(!isset($chk_sess)) {
		header("location: ../login.php?login=false");
	}
?>