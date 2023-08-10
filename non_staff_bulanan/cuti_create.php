<?php
include("sess_check.php");

// deskripsi halaman
$pagedesc = "Buat Pengajuan";
$menuparent = "cuti";
include("layout_top.php");
$now = date('Y-m-d');
$username = $sess_pegawaiid;
?>
<!-- <script type="text/javascript">
	function valid() {
		if (document.cuti.akhir.value < document.cuti.mulai.value) {
			alert("Tanggal akhir harus lebih besar dari tanggal mulai cuti!");
			return false;
		}

		if (document.cuti.mulai.value < document.cuti.now.value) {
			alert("Tanggal mulai cuti tidak valid!");
			return false;
		}

		return true;
	}
</script> -->
<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Pengajuan Izin</h1>
			</div><!-- /.col-lg-12 -->
		</div><!-- /.row -->

		<div class="row">
			<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<form class="form-horizontal" name="cuti" action="cuti_insert.php" method="POST" enctype="multipart/form-data" onSubmit="return valid();">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Form Pengajuan Izin</h3>
							<div class="form-group">
								<label class="control-label col-sm-3">Lokasi Kerja</label>
								<div class="col-sm-4">
									<select name="loc" id="loc" class="form-control" required>
										<option value="" selected>======== Pilih Lokasi Kerja ========</option>
										<?php
										$mySql = "SELECT * FROM lokasi ORDER BY nm_loc";
										$myQry = mysqli_query($conn, $mySql);
										$dataLeader = $result['id_loc'];
										while ($leaderData = mysqli_fetch_array($myQry)) {
											if ($leaderData['id_loc'] == $dataLeader) {
												$cek = " selected";
											} else {
												$cek = "";
											}
											echo "<option value='$leaderData[nm_loc]' $cek>" . $leaderData['nm_loc'] . "</option>";
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="panel-body" id="form-body">
							<div class="form-group" id="mulai">
								<label class="control-label col-sm-3">Tanggal Mulai</label>
								<div class="col-sm-4">
									<input type="date" name="mulai" class="form-control">
									<input type="hidden" name="now" class="form-control" value="<?php echo $now; ?>" required>
									<input type="hidden" name="username" class="form-control" value="<?php echo $username; ?>" required>
								</div>
							</div>
							<div class="form-group" id="akhir">
								<label class="control-label col-sm-3">Tanggal Akhir</label>
								<div class="col-sm-4">
									<input type="date" name="akhir" class="form-control">
								</div>
							</div>
							<div class="form-group" id="jizin">
								<label class="control-label col-sm-3">Jenis Izin</label>
								<div class="col-sm-5">
									<input class="form-check-input" type="radio" name="izin" value="datang terlambat">
									<span class="form-check-label" style="font-weight: bold ;">
										Datang Terlambat
									</span><br>
									<input class="form-check-input" type="radio" name="izin" value="pulang awal">
									<span class="form-check-label" style="font-weight: bold ;">
										Pulang Awal
									</span><br>
									<input class="form-check-input" type="radio" name="izin" value="sakit">
									<span class="form-check-label" style="font-weight: bold ;">
										Sakit
									</span><br>
									<input class="form-check-input" type="radio" name="izin" value="ijin">
									<span class="form-check-label" style="font-weight: bold ;">
										Izin
									</span><br>
									<input class="form-check-input" type="radio" name="izin" value="cuti khusus">
									<span class="form-check-label" style="font-weight: bold ;">
									Cuti Khusus ( Menikah, Istri Melahirkan/Keguguran, Cuti Haid, Duka, Khitan Anak, Baptis Anak, Pernikahan Anak )
									</span><br>
									<input class="form-check-input" type="radio" name="izin" value="libur pengganti">
									<span class="form-check-label" style="font-weight: bold ;">
										Libur Pengganti
									</span><br>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Keterangan</label>
								<div class="col-sm-4">
									<textarea name="keterangan" id="ket" class="form-control" placeholder="Keterangan" rows="3" required></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Pengelola</label>
								<div class="col-sm-4">
									<select name="spv" id="spv" class="form-control" required>
										<option value="" selected>======== Pilih Pengelola ========</option>
										<?php
										$mySql = "SELECT * FROM employee WHERE jabatan='Pengelola' OR jabatan='Pengawas' AND active='Aktif' ORDER BY nama_emp";
										$myQry = mysqli_query($conn, $mySql);
										$dataLeader = $result['username'];
										while ($leaderData = mysqli_fetch_array($myQry)) {
											if ($leaderData['username'] == $dataLeader) {
												$cek = " selected";
											} else {
												$cek = "";
											}
											echo "<option value='$leaderData[username]' $cek>" . $leaderData['nama_emp'] . "</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group" id="foto">
								<label class="control-label col-sm-3">Foto</label>
								<div class="col-sm-3">
									<input type="file" name="foto" class="form-control">
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<button type="submit" name="simpan" class="btn btn-success">Simpan</button>
						</div>
					</div><!-- /.panel -->
				</form>
			</div><!-- /.col-lg-12 -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
<!-- bottom of file -->
<script>
	$("#mulai").hide();
	$("#akhir").hide();
	$("#form-body").hide();
	$('#foto').hide();
	$(document).ready(function() {
		$('input[type=radio][name=izin]').change(function() {
			if (this.value == 'cuti khusus') {
				$('#mulai').show();
				$('#akhir').show();
				$('#foto').hide();
				$('#ket').attr('placeholder',"masukkan alasan cuti khusus");
			} else if (this.value == 'libur pengganti') {
				$('#mulai').show();
				$('#akhir').show();
				$('#foto').hide();
				$('#ket').attr('placeholder',"masukkan alasan libur pengganti");
			} else if (this.value == 'sakit') {
				$('#foto').show();
				$('#mulai').hide();
				$('#akhir').hide();
				$('#ket').attr('placeholder',"masukkan keterangan sakit");
			} else if (this.value == 'ijin') {
				$('#foto').hide();
				$('#mulai').hide();
				$('#akhir').hide();
				$('#ket').attr('placeholder',"masukkan alasan ijin");
			} else if (this.value == 'datang terlambat') {
				$('#foto').hide();
				$('#mulai').hide();
				$('#akhir').hide();
				$('#ket').attr('placeholder',"masukkan alasan datang terlambat");
			} else if (this.value == 'pulang awal') {
				$('#foto').hide();
				$('#mulai').hide();
				$('#akhir').hide();
				$('#ket').attr('placeholder',"masukkan alasan pulang awal");
			} else {
				$("#mulai").hide();
				$("#akhir").hide();
				$('#foto').hide();
			}
		});
	});
	$(document).ready(function() {
		$('#loc').change(function() {
			var selectedOption = $(this).val();
			if (selectedOption !== '') {
				$('#form-body').show();
			} else {
				$('#form-body').hide();
			}
		});
	});
</script>

<?php
include("layout_bottom.php");
?>