<?php 
include_once "sess_check.php";

$username  = $_POST['user_adm'];
$nama  = $_POST['nama_adm'];
$telp  = $_POST['telp_adm'];
$jabatan  = $_POST['jabatan'];

$qinsert = mysqli_query($conn, "INSERT INTO admin (user_adm,nama_adm,telp_adm,jabatan,pass_adm) VALUES ('$username','$nama','$telp','$jabatan','$username') ");
if ($qinsert) {
    header("location: admin.php?act=add&msg=success");
}