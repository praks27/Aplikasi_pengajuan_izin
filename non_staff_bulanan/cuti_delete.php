<?php
include("sess_check.php");

$no  = $_GET['no'];
$username = $_GET['username'];
$cemp = mysqli_query($conn, "SELECT * FROM employee where username = '$username'");
$cempqry = mysqli_fetch_array($cemp);
$cuti = mysqli_query($conn, "SELECT * FROM cuti where no_cuti = '$no'");
$cqry = mysqli_fetch_array($cuti);
// $penambahan = $cempqry['jml_cuti'] + $cqry['durasi'];

$qdelete = "DELETE FROM cuti WHERE no_cuti = '$no'";
$qexec = mysqli_query($conn, $qdelete);
if ($qexec) {
    echo "<script type='text/javascript'>
				alert('Izin berhasil di hapus!'); 
				document.location = 'cuti_waitapp.php'; 
			</script>";
} else {
    echo "<script type='text/javascript'>
    alert('Gagal Menghapus Izin !'); 
    document.location = 'cuti_waitapp.php'; 
</script>";
}

?>
