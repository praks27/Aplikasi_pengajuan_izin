<?php
include("sess_check.php");

// deskripsi halaman
$pagedesc = "Laporan Data Izin";
include("layout_top.php");
include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");
$sql = mysqli_query($conn, "SELECT cuti.*, employee.* FROM cuti, employee WHERE cuti.username=employee.username ORDER BY cuti.wkt_pengajuan DESC");
$img = mysqli_fetch_array($sql);
?>
<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Laporan Data Izin</h1>
			</div><!-- /.col-lg-12 -->
		</div><!-- /.row -->
		<div class="row">
			<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<form method="POST" name="laporan" onSubmit="return valid();">
							<div class="form-group">
								<div class="col-sm-4">
									<label>Tanggal Awal</label>
									<input type="date" name="tgl_awal" class="form-control">
								</div>
								<div class="col-sm-4">
									<label>Tanggal Akhir</label>
									<input type="date" name="tgl_akhir" class="form-control">
								</div>
								<div class="col-sm-4">
									<label>Jenis Izin</label>
									<select name="jizin" class="form-control" id="">
										<option value="" selected>--pilih jenis izin--</option>
										<option value="datang terlambat">Datang Terlambat</option>
										<option value="sakit">sakit</option>
										<option value="cuti khusus">cuti khusus</option>
										<option value="cuti">cuti</option>
										<option value="dinas luar">dinas luar</option>
										<option value="pulang awal">pulang awal</option>
										<option value="ijin">ijin</option>
										<option value="libur pengganti">Libur Pengganti</option>
									</select>
								</div>
								<div class="col-sm-8" style="padding-top: 25px;">
									<div class="row">
										<div class="col-sm-3">
											<input type="submit" name="submit" value="Lihat Laporan" class="btn btn-primary">
										</div>
										<div class="col-sm-3">
											<a href="download_img.php" target="_blank" class="btn btn-success">Download semua Foto Izin Sakit</a>
										</div>
									</div>
								</div>
							</div>
					</div>
					</form>
				</div>
			</div>
			<?php
			if (isset($_POST['submit'])) {
				$no = 0;
				$tglPeng = isset($_POST['tgl_awal']) ? $_POST['tgl_awal'] : '';
				$selesai = isset($_POST['tgl_akhir']) ? $_POST['tgl_akhir'] : '';
				$jizin = isset($_POST['jizin']) ? $_POST['jizin'] : '';

				// Start building the SQL query
				$sql = "SELECT cuti.*, employee.* FROM cuti, employee WHERE cuti.username=employee.username";

				// Add conditions based on user input
				if (!empty($jizin)) {
					$sql .= " AND cuti.izin='$jizin'";
				}

				if (!empty($tglPeng) && !empty($selesai)) {
					$sql .= " AND cuti.tgl_pengajuan BETWEEN '$tglPeng' AND '$selesai'";
				}

				$query = mysqli_query($conn, $sql);
			?>

				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<table class="table table-striped table-bordered table-hover" id="tabel-data">
									<thead>
										<tr>
											<th width="1%">No</th>
											<th width="10%">Nama Pemohon</th>
											<th width="5%">Tgl Pengajuan</th>
											<th width="5%">Divisi</th>
											<th width="5%">Jabatan</th>
											<th width="5%">Jenis Izin</th>
											<th width="5%">Keterangan</th>
											<th width="5%">Status</th>
											<?php if ($jizin == 'sakit') { ?>
												<th width="5%">Foto</th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										while ($data = mysqli_fetch_array($query)) {
											echo '<tr>';
											echo '<td class="text-center">' . $i . '</td>';
											echo '<td>' . $data['nama_emp'] . '</td>';
											echo '<td class="text-center text-nowrap">' . format_tanggal($data['tgl_pengajuan']) . '</td>';
											echo '<td class="text-center text-nowrap">' . $data['divisi'] . '</td>';
											echo '<td class="text-center text-nowrap">' . $data['jabatan'] . '</td>';
											echo '<td class="text-center text-nowrap">' . $data['izin'] . '</td>';
											echo '<td class="text-center text-nowrap">' . $data['keterangan'] . '</td>';
											echo '<td>' . $data['stt_cuti'] . '</td>';
											if ($jizin == 'sakit') {
												echo '<td class="text-center text-nowrap"><img src="fotoapproval/' . $data['foto'] . '"width="120px"></td>';
											}
											echo '</tr>';
											$i++;
										}
										?>
									</tbody>
								</table>
								<div class="form-group">
									<a href="laporan_cetak.php?jizin=<?php echo $jizin; ?>" target="_blank" class="btn btn-warning">Cetak</a>
									<a href="export_excel.php?jizin=<?php echo $jizin; ?>&tglpeng=<?= $tglPeng; ?>&tglakhir=<?= $selesai; ?>" target="_blank" class="btn btn-success">Export excel</a>
								</div>
							</div>
							<!-- Large modal -->
							<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-body">
											<p>One fine body…</p>
										</div>
									</div>
								</div>
							</div>
						</div><!-- /.panel -->
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->
			<?php } ?>
		</div><!-- /.container-fluid -->
	</div><!-- /#page-wrapper -->
	<!-- bottom of file -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabel-data').DataTable({
				"responsive": true,
				"processing": true,
				"columnDefs": [{
					"orderable": false,
					"targets": [4]
				}]
			});

			$('#tabel-data').parent().addClass("table-responsive");
		});
	</script>
	<script>
		var app = {
			code: '0'
		};
	</script>
	<?php
	include("layout_bottom.php");
	?>