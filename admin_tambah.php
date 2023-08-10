<?php
include("sess_check.php");
$pagedesc = "List Data Admin";
$menuparent = "Admin";
include("layout_top.php");
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">List Data Admin</h1>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <form class="form-horizontal" action="admin_insert.php" method="POST" enctype="multipart/form-data">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>Tambah Data</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-sm-3">Username</label>
                                <div class="col-sm-4">
                                    <input type="text" name="user_adm" id="txt_user" class="form-control" placeholder="tuliskan username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Nama</label>
                                <div class="col-sm-4">
                                    <input type="text" name="nama_adm" class="form-control" placeholder="masukkan lokasi kerja" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Telepon</label>
                                <div class="col-sm-4">
                                    <input type="text" name="telp_adm" class="form-control" placeholder="08**********" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Jabatan</label>
                                <div class="col-sm-4">
                                    <input type="text" name="jabatan" class="form-control" placeholder="tuliskan jabatan" required>
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
include("layout_bottom.php");
?>