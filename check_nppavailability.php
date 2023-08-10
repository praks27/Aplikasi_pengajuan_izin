<?php 
require_once("dist/config/koneksi.php");
// code user username availablity
if(!empty($_POST["username"])) {
	$username= $_POST["username"];
	$sql = "SELECT * FROM employee WHERE username='$username'";
	$query = mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)>0){
		echo "<span style='color:red'> username sudah terdaftar.</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
	}else{
		echo "<span style='color:green'> username bisa digunakan.</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
	}
}

?>
