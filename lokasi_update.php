<?php 
include_once 'sess_check.php';
if(isset($_POST['perbarui'])){
    $id = $_POST['id_loc'];
    $nm_loc = $_POST['nm_loc'];
    $query = mysqli_query($conn,"UPDATE lokasi SET nm_loc = '$nm_loc' where id_loc = '$id' ");
    if($query){
        header("location: lokasi.php?act=update&msg=success");
    }
}
