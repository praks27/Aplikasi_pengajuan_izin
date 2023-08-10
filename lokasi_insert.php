<?php
include("sess_check.php");
$nm_loc = $_POST['nm_loc'];

$qinsert = mysqli_query($conn, "INSERT INTO lokasi (nm_loc) VALUES ('$nm_loc')");
if ($qinsert){
    header("location: lokasi.php?act=add&msg=success");
}
?>