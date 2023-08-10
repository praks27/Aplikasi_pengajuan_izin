<?php
  //error_reporting(0);

  $dbhost = "localhost";
  $dbuser = "tjahajaagungtung";
  $dbpass = "Hujan-lagi123";
  $dbname = "tjahajaa_db_cuti";

  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Tidak dapat terhubung ke database: ".mysqli_error());
?>