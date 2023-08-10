<?php
include("sess_check.php");

$no  = $_GET['no'];
$username = $_GET['username'];
$cemp = mysqli_query($conn, "SELECT * FROM employee where username = '$username'");
$cempqry = mysqli_fetch_array($cemp);
$cuti = mysqli_query($conn, "SELECT * FROM cuti where no_cuti = '$no'");
$cqry = mysqli_fetch_array($cuti);
$izin = $cqry['izin'];
$penambahan = $cempqry['jml_cuti'] + $cqry['durasi'];

$qdelete = "DELETE FROM cuti WHERE no_cuti = '$no'";
$qgambar = mysqli_query($conn, "SELECT foto FROM cuti WHERE no_cuti = '$no'");
$qexec = mysqli_query($conn, $qdelete);
if ($qexec && $izin == 'cuti') {
    mysqli_query($conn, "UPDATE employee SET jml_cuti = '$penambahan' WHERE username = '$username'");
    header("location: cuti_waitapp.php?act=delete&msg=success");
} else if($qexec) {
    header("location: cuti_waitapp.php?act=delete&msg=success");
}else {
    echo "<script type='text/javascript'>
        alert('Gagal Menghapus Izin !'); 
        document.location = 'cuti_waitapp.php'; 
        </script>";
}
