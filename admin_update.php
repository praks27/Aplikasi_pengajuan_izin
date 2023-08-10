<?php 
include_once 'sess_check.php';
if(isset($_POST['perbarui'])){
    $id = $_POST['id_loc'];
    $user = $_POST['user_adm'];
    $telp = $_POST['telp_adm'];
    $jabatan = $_POST['jabatan'];
    $pass = $_POST['pass_adm'];
    $nama = $_POST['nama_adm'];
    $query = mysqli_query($conn,"UPDATE admin SET nama_adm = '$nama', user_adm = '$user', telp_adm = '$telp', jabatan = '$jabatan', pass_adm = '$pass' where id_adm = '$id' ");
    if($query){
        header("location: admin.php?act=update&msg=success");
    }
}