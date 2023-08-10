<?php
	include("sess_check.php");
	
	if(isset($_GET['username'])) {
		$sql = "SELECT * FROM employee WHERE username='". $_GET['username'] ."'";
		$ress = mysqli_query($conn, $sql);
		$data = mysqli_fetch_array($ress);
	}
	// deskripsi halaman
	$pagedesc = "Data Karyawan";
	$menuparent = "master";
	include("layout_top.php");
?>
<script type="text/javascript">
	function checkusernameAvailability() {
	$("#loaderIcon").show();
	jQuery.ajax({
		url: "check_nppavailability.php",
		data:'username='+$("#username").val(),
		type: "POST",
		success:function(data){
			$("#user-availability-status").html(data);
			$("#loaderIcon").hide();
		},
		error:function (){}
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
						<form class="form-horizontal" action="karyawan_update.php" method="POST" enctype="multipart/form-data">
							<div class="panel panel-default">
								<div class="panel-heading"><h3>Edit Data</h3></div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-sm-3">username</label>
										<div class="col-sm-4">
											<input type="text" name="usernamelama" class="form-control" placeholder="username" value="<?php echo $data['username'] ?>" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">username Baru (Abaikan jika tidak diubah)</label>
										<div class="col-sm-4">
											<input type="text" name="username" onBlur="checkusernameAvailability()" class="form-control" placeholder="username Baru (Abaikan Jika Tidak Ada Perubahan!)">
											<span id="user-availability-status" style="font-size:12px;"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Nama</label>
										<div class="col-sm-4">
											<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $data['nama_emp'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jenis Kelamin</label>
										<div class="col-sm-3">
											<select name="jk" id="jk" class="form-control" required>
												<option value="<?php echo $data['jk_emp'] ?>" selected><?php echo $data['jk_emp'] ?></option>
												<option value="Laki-Laki">Laki-Laki</option>
												<option value="Perempuan">Perempuan</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Telepon</label>
										<div class="col-sm-4">
											<input type="number" name="telp" min="0" class="form-control" placeholder="Telepon" value="<?php echo $data['telp_emp'] ?>"required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Divisi</label>
										<div class="col-sm-4">
											<input type="text" name="divisi" class="form-control" placeholder="Divisi" value="<?php echo $data['divisi'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jabatan</label>
										<div class="col-sm-3">
											<input type="text" name="jabatan" class="form-control" placeholder="Jabatan" value="<?php echo $data['jabatan'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Alamat</label>
										<div class="col-sm-4">
											<textarea name="alamat" class="form-control" placeholder="Alamat" rows="3" required><?php echo $data['alamat'] ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Hak Akses</label>
										<div class="col-sm-3">
											<select name="akses" id="akses" class="form-control" required>
												<option value="<?php echo $data['hak_akses'] ?>" selected><?php echo $data['hak_akses'] ?></option>
												<option value="Hod">Hod</option>
												<option value="Supervisor">Supervisor</option>
												<option value="Staff">Staff</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jumlah Cuti</label>
										<div class="col-sm-3">
											<input type="number" name="jml" min="0" class="form-control" placeholder="Telepon" value="<?php echo $data['jml_cuti'] ?>"required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Aktif</label>
										<div class="col-sm-3">
											<select name="aktif" id="aktif" class="form-control" required>
												<option value="aktif" <?php if ($data['active'] == 'aktif') { echo 'selected' ;} ?>>Aktif</option>
												<option value="tidak aktif" <?php if ($data['active'] == 'tidak aktif') { echo 'selected' ;} ?>>Tidak Aktif</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Password</label>
										<div class="col-sm-4">
											<input type="text" name="password" class="form-control" placeholder="Password" value="<?php echo $data['password'] ?>" required>
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<button type="submit" name="perbarui" class="btn btn-success">Update</button>
								</div>
							</div><!-- /.panel -->
						</form>
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->
<!-- bottom of file -->
<?php
	include("layout_bottom.php");
?>