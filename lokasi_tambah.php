<?php
include ("sess_check.php");
$pagedesc = "Data Lokasi Kerja";
$menuparent = "laporan";
include ("layout_top.php");
?>
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
                <form class="form-horizontal" action="lokasi_insert.php" method="POST" enctype="multipart/form-data">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>Tambah Data</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-sm-3">Nama Lokasi Kerja</label>
                                <div class="col-sm-4">
                                    <input type="text" name="nm_loc" class="form-control" placeholder="masukkan lokasi kerja" required>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include ("layout_bottom.php");
?>