<?php
// setting tanggal
$haries = array("Sunday" => "Minggu", "Monday" => "Senin", "Tuesday" => "Selasa", "Wednesday" => "Rabu", "Thursday" => "Kamis", "Friday" => "Jum'at", "Saturday" => "Sabtu");
$bulans = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$bulans_count = count($bulans);
// tanggal bulan dan tahun hari ini
$hari_ini = $haries[date("l")];
$bulan_ini = $bulans[date("n")];
$tanggal = date("d");
$bulan = date("m");
$tahun = date("Y");

$id = $sess_pegawaiid;
$sql_g = "SELECT * FROM employee WHERE username='$id'";
$ress_g = mysqli_query($conn, $sql_g);
$res = mysqli_fetch_array($ress_g);
$jcuti = mysqli_query($conn, "SELECT jml_cuti FROM employee WHERE username='$id'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Pengajuan Izin PT. Tjahaja Agung Tunggal - <?php echo $pagedesc ?></title>

	<link href="../libs/images/tat.png" rel="icon" type="images/x-icon">

	<!-- Bootstrap Core CSS -->
	<link href="libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="libs/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

	<!-- DataTables CSS -->
	<link href="libs/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

	<!-- DataTables Responsive CSS -->
	<link href="libs/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="dist/css/offline-font.css" rel="stylesheet">
	<link href="dist/css/custom.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- jQuery -->
	<script src="libs/jquery/dist/jquery.min.js"></script>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

	<div id="wrapper">
		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span>
					</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand hidden-xs" href="index.php">
					<img src="../libs/images/tat.png" alt="brand" width="32" class="float-left image-brand">
					<div class="float-right">&nbsp;<strong>PT. Tjahaja Agung Tunggal</strong></div>
					<div class="clear-both"></div>
				</a>
				<a class="navbar-brand visible-xs" href="index.php">
					<img src="../libs/images/tat.png" alt="brand" width="32" class="float-left image-brand">
					<div class="float-right">&nbsp;<strong>PT. Tjahaja Agung Tunggal</strong></div>
					<div class="clear-both"></div>
				</a>
			</div><!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right">
				<li>
					<?php
					while ($jml = mysqli_fetch_array($jcuti)) {
						echo "<h4 style='padding: 1rem;'><b>sisa cuti : " . $jml['jml_cuti'] . "</b></h4>";
					}
					?>
				</li>
				<li class="dropdown dropdown-right">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-user fa-fw"></i>&nbsp;<?php echo ucfirst($sess_pegawainame); ?>&nbsp;<i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li><a href="pengaturan.php"><i class="fa fa-gear fa-fw"></i>&nbsp;Pengaturan Akun</a></li>
						<li class="divider"></li>
						<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Keluar</a></li>
					</ul><!-- /.dropdown-user -->
				</li><!-- /.dropdown -->
			</ul><!-- /.navbar-top-links -->

			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
						<li class="sidebar-search">
							<h4> Permohonan Izin<br> <b>PT. Tjahaja Agung Tunggal</b></h4>
							<h5 class="text-muted"><i class="fa fa-calendar fa-fw"></i>&nbsp;<?php echo $hari_ini . ", " . $tanggal . " " . $bulan_ini . " " . $tahun ?></h5>
						</li>
						<?php
						if ($pagedesc == "Beranda") {
							echo '<li><a href="index.php" class="active"><i class="fa fa-home fa-fw"></i>&nbsp;Beranda</a></li>';
						} else {
							echo '<li><a href="index.php"><i class="fa fa-home fa-fw"></i>&nbsp;Beranda</a></li>';
						}
						if (isset($menuparent) && $menuparent == "cuti") {
							echo '<li class="active">';
						} else {
							echo '<li>';
						}
						?>
						<!-- open <li> tag generated with php, see line 155-160 -->
						<a href="#"><i class="fa fa-recycle fa-fw"></i>&nbsp;Pengajuan Izin<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<?php
							if ($pagedesc == "Buat Permohonan") {
								echo '<li><a href="cuti_create.php" class="active">Buat Permohonan</a></li>';
							} else {
								echo '<li><a href="cuti_create.php">Buat Permohonan</a></li>';
							}
							if ($pagedesc == "Menunggu Approval") {
								echo '<li><a href="cuti_waitapp.php" class="active">Menunggu Approval</a></li>';
							} else {
								echo '<li><a href="cuti_waitapp.php">Menunggu Approval</a></li>';
							}
							if ($pagedesc == "Rejected") {
								echo '<li><a href="cuti_reject.php" class="active">Rejected</a></li>';
							} else {
								echo '<li><a href="cuti_reject.php">Rejected</a></li>';
							}
							if ($pagedesc == "Approved") {
								echo '<li><a href="cuti_app.php" class="active">Approved</a></li>';
							} else {
								echo '<li><a href="cuti_app.php">Approved</a></li>';
							}
							?>
						</ul><!-- /.nav-second-level -->
						</li>
					</ul>
				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</nav>
		<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>