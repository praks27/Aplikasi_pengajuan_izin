<?php
include("sess_check.php");
$id = $_GET['id_loc'];
$qdelete = mysqli_query($conn, "DELETE FROM lokasi WHERE id_loc='$id'");
if ($qdelete) {
    header("location: lokasi.php?act=delete&msg=success");
}
