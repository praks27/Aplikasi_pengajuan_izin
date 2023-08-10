<?php
include("sess_check.php");

// deskripsi halaman
$pagedesc = "Menunggu Approval";
include("layout_top.php");
include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");
$id = $sess_pegawaiid;
?>
<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Data Menunggu Approval</h1>
			</div><!-- /.col-lg-12 -->
		</div><!-- /.row -->

		<div class="row">
			<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<?php
						$Sql = "SELECT cuti.*, employee.* FROM cuti, employee WHERE cuti.username=employee.username AND cuti.stt_cuti !='Rejected'
									    AND cuti.username='$id' ORDER BY cuti.tgl_pengajuan DESC";
						$Qry = mysqli_query($conn, $Sql);


						?>
						<table class="table table-striped table-bordered table-hover" id="tabel-data">
							<thead>
								<tr>
									<th width="1%">No</th>
									<th width="1%">Nama Pemohon</th>
									<th width="5%">Tgl Pengajuan</th>
									<th width="5%">jabatan</th>
									<th width="5%">jenis izin</th>
									<th width="5%">Status</th>
									<th width="5%">Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								while ($data = mysqli_fetch_array($Qry)) {
									echo '<tr>';
									echo '<td class="text-center">' . $i . '</td>';
									echo '<td class="text-center">' . $data['username'] . '</td>';
									echo '<td class="text-center">' . IndonesiaTgl($data['tgl_pengajuan']) . '</td>';
									echo '<td class="text-center">' . $data['jabatan'] . '</td>';
									echo '<td class="text-center">' . $data['izin'] . '</td>';
									echo '<td class="text-center stt_cuti">' . $data['stt_cuti'] . '</td>';
									echo '<td class="text-center">
													  <a href="#myModal" data-toggle="modal" data-load-code="' . $data['no_cuti'] . '" data-remote-target="#myModal .modal-body" class="btn btn-primary btn-xs">Detail</a>'; ?>
									<a href="cuti_delete.php?no=<?php echo $data['no_cuti']; ?>&username=<?= $data['username']; ?>" onclick="return confirm('Apakah anda yakin akan membatalkan pengajuan izin ?');" class="btn btn-danger btn-xs btn_hps">Hapus</a></td>
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
									<p>Sedang memproses…</p>
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
			"columnDefs": [{
				"orderable": false,
				"targets": []
			}]
		});

		$('#tabel-data').parent().addClass("table-responsive");
	});
</script>
<script>
	var app = {
		code: '0'
	};

	$('[data-load-code]').on('click', function(e) {
		e.preventDefault();
		var $this = $(this);
		var code = $this.data('load-code');
		if (code) {
			$($this.data('remote-target')).load('cuti_detail.php?code=' + code);
			app.code = code;

		}
	});
</script>
<script>
	$(document).ready(function() {
		$('.stt_cuti').each(function() {
			var stt_cuti = $(this).text().trim();
			if (stt_cuti === 'Approved' || stt_cuti === 'Rejected') {
				$(this).closest('tr').find('.btn_hps').hide();
			}
		});
	});
</script>
<?php
include("layout_bottom.php");
?>