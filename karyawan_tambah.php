<?php
include("sess_check.php");

// deskripsi halaman
$pagedesc = "Data Karyawan";
$menuparent = "master";
include("layout_top.php");
?>
<script type="text/javascript">
	function checkusernameAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "check_usernameavailability.php",
			data: 'username=' + $("#username").val(),
			type: "POST",
			success: function(data) {
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Data Karyawan</h1>
			</div><!-- /.col-lg-12 -->
		</div><!-- /.row -->

		<div class="row">
			<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<form class="form-horizontal" action="karyawan_insert.php" method="POST" enctype="multipart/form-data">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Tambah Data</h3>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label class="control-label col-sm-3">username</label>
								<div class="col-sm-4">
									<input type="text" name="username" onBlur="checkusernameAvailability()" class="form-control" placeholder="username" required>
									<span id="user-availability-status" style="font-size:12px;"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Nama</label>
								<div class="col-sm-4">
									<input type="text" name="nama" class="form-control" placeholder="Nama" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Jenis Kelamin</label>
								<div class="col-sm-3">
									<select name="jk" id="jk" class="form-control" required>
										<option value="" selected>--- Pilih Jenis Kelamin ---</option>
										<option value="Laki-Laki">Laki-Laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Telepon</label>
								<div class="col-sm-4">
									<input type="number" name="telp" min="0" class="form-control" placeholder="Telepon" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Divisi</label>
								<div class="col-sm-4">
									<input type="text" name="divisi" class="form-control" placeholder="Divisi" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Jabatan</label>
								<div class="col-sm-4">
									<input type="text" name="jabatan" class="form-control" placeholder="Jabatan" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Alamat</label>
								<div class="col-sm-4">
									<textarea name="alamat" class="form-control" placeholder="Alamat" rows="3" required></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Hak Akses</label>
								<div class="col-sm-3">
									<select name="akses" id="akses" class="form-control" required>
										<option value="" selected>--- Pilih Hak Akses ---</option>
										<option value="HOD">HOD</option>
										<option value="Supervisor">Supervisor/Pengelola/Pengawas</option>
										<option value="Staff">Staff</option>
										<option value="Non_staff_bulanan">Non Staff Bulanan</option>
										<option value="Non_staff_borongan">Non Staff Borongan</option>
									</select>
								</div>
							</div>
							<div class="form-group" id="jcuti">
								<label class="control-label col-sm-3">Jumlah Cuti</label>
								<div class="col-sm-3">
									<input type="number" name="jml" min="0" class="form-control" placeholder="Jumlah Cuti">
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
<script>
	$(document).ready(function() {
		$('#akses').change(function() {
			if (this.value == 'Non_staff_bulanan') {
				$('#jcuti').hide();
			} else if (this.value == 'Non_staff_borongan') {
				$('#jcuti').hide();
			} else {
				$("#jcuti").show();
			}

		});
	});
</script>
<!-- bottom of file -->
<?php
include("layout_bottom.php");
?>