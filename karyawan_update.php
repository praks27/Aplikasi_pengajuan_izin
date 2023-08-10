<?php
	include("sess_check.php");
	
	// query database memperbarui data pada database
	if(isset($_POST['perbarui'])) {
		$usernamelama=$_POST['usernamelama'];
		$username=$_POST['username'];
		$nama=$_POST['nama'];
		$jml=$_POST['jml'];
		$jk=$_POST['jk'];
		$telp=$_POST['telp'];
		$divisi=$_POST['divisi'];
		$jabatan=$_POST['jabatan'];
		$alamat=$_POST['alamat'];
		$akses=$_POST['akses'];
		$cekfoto=$_FILES["foto"]["name"];
		$pass=$_POST['password'];
		$aktif=$_POST['aktif'];
		
	if($username!=""){
		$sqlcek = "SELECT * FROM employee WHERE username='$username'";
		$ress = mysqli_query($conn, $sqlcek);
		$rows = mysqli_num_rows($ress);
		if($rows<1){
			if($cekfoto!=""){
				$foto=substr($_FILES["foto"]["name"],-5);
				$newfoto = "foto".$username.$foto;				
				move_uploaded_file($_FILES["foto"]["tmp_name"],"foto/".$newfoto);
				$sql = "UPDATE employee SET
					username='". $username ."',
					nama_emp='". $nama ."',
					jk_emp='". $jk ."',
					telp_emp='". $telp ."',
					divisi='". $divisi ."',
					jabatan='". $jabatan ."',
					alamat='". $alamat ."',
					hak_akses='". $akses ."',
					jml_cuti='". $jml ."',
					password='". $pass ."',
					active='". $aktif ."',
					foto_emp='". $newfoto ."'
					WHERE username='". $usernamelama ."'";
				$ress = mysqli_query($conn, $sql);
				header("location: karyawan.php?act=update&msg=success");
			}else{
				$sql = "UPDATE employee SET
					username='". $username ."',
					nama_emp='". $nama ."',
					jk_emp='". $jk ."',
					telp_emp='". $telp ."',
					divisi='". $divisi ."',
					jabatan='". $jabatan ."',
					alamat='". $alamat ."',
					hak_akses='". $akses ."',
					jml_cuti='". $jml ."',
					password='". $pass ."',
					active='". $aktif ."'
					WHERE username='". $usernamelama ."'";
				$ress = mysqli_query($conn, $sql);
				header("location: karyawan.php?act=update&msg=success");
			}
		}else{
			header("location: karyawan_edit.php?username=$usernamelama&act=add&msg=double");			
		}
	}else{
		if($cekfoto!=""){
			$foto=substr($_FILES["foto"]["name"],-5);
			$newfoto = "foto".$usernamelama.$foto;				
			move_uploaded_file($_FILES["foto"]["tmp_name"],"foto/".$newfoto);
				$sql = "UPDATE employee SET
					nama_emp='". $nama ."',
					jk_emp='". $jk ."',
					telp_emp='". $telp ."',
					divisi='". $divisi ."',
					jabatan='". $jabatan ."',
					alamat='". $alamat ."',
					hak_akses='". $akses ."',
					jml_cuti='". $jml ."',
					password='". $pass ."',
					active='". $aktif ."',
					foto_emp='". $newfoto ."'
					WHERE username='". $usernamelama ."'";
			$ress = mysqli_query($conn, $sql);
			header("location: karyawan.php?act=update&msg=success");
		}else{
				$sql = "UPDATE employee SET
					nama_emp='". $nama ."',
					jk_emp='". $jk ."',
					telp_emp='". $telp ."',
					divisi='". $divisi ."',
					jabatan='". $jabatan ."',
					alamat='". $alamat ."',
					hak_akses='". $akses ."',
					jml_cuti='". $jml ."',
					password='". $pass ."',
					active='". $aktif ."'
					WHERE username='". $usernamelama ."'";
			$ress = mysqli_query($conn, $sql);
			header("location: karyawan.php?act=update&msg=success");
		}
	}
}
?>