<?php
include("sess_check.php");
$id = $_GET['id_adm'];
$qdelete = mysqli_query($conn, "DELETE FROM admin WHERE id_adm='$id'");
if ($qdelete) {
    header("location: admin.php?act=delete&msg=success");
}
