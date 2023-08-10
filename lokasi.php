<?php
	include("sess_check.php");
	
	// deskripsi halaman
	$pagedesc = "Data Lokasi";
	include("layout_top.php");
	include("dist/function/format_tanggal.php");
	include("dist/function/format_rupiah.php");
?>
<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Data Lokasi</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
				
				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<a href="lokasi_tambah.php" class="btn btn-success">Tambah</a>
							</div>
							<div class="panel-body">
								<table class="table table-striped table-bordered table-hover" id="tabel-data">
									<thead>
										<tr>
											<th width="5%">No</th>
											<th>Nama Lokasi</th>
											<th>Opsi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											$sql = "SELECT * FROM lokasi ORDER BY nm_loc ASC";
											$ress = mysqli_query($conn, $sql);
											while($data = mysqli_fetch_array($ress)) {
												echo '<tr>';
												echo '<td class="text-center">'. $i .'</td>';
												echo '<td class="text-center">'. $data['nm_loc'] .'</td>';
												echo '<td class="text-center">
													  <a href="lokasi_edit.php?id_loc='. $data['id_loc'] .'" class="btn btn-warning btn-xs">Edit</a>';?>
													  <a href="lokasi_delete.php?id_loc=<?php echo $data['id_loc'];?>" onclick="return confirm('Apakah anda yakin akan menghapus <?php echo $data['nm_loc'];?>?');" class="btn btn-danger btn-xs">Hapus</a></td>
												<?php
													  echo '</td>';
												echo '</tr>';												
												$i++;
											}
										?>
									</tbody>
								</table>
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
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->
<!-- bottom of file -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#tabel-data').DataTable({
			"responsive": true,
			"processing": true,
			"columnDefs": [
				{ "orderable": false, "targets": [2] }
			]
		});
		
		$('#tabel-data').parent().addClass("table-responsive");
	});
</script>
<?php
	include("layout_bottom.php");
?>