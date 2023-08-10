<?php
include_once 'sess_check.php';
if (isset($_GET['id_adm'])) {
    $sql = "SELECT * FROM admin WHERE id_adm='" . $_GET['id_adm'] . "'";
    $ress = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($ress);
}
$pagedesc = 'List Data Admin';
$menuparent = 'Admin';
include_once "layout_top.php";
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data Admin</h1>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-12"><?php include 'layout_alert.php'; ?></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form class="form-horizontal" action="admin_update.php" method="POST" enctype="multipart/form-data">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>Edit Data</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-sm-3">Username</label>
                                <div class="col-sm-4">
                                    <input type="hidden" name="id_loc" value="<?php echo $data['id_adm']; ?>">
                                    <input type="text" name="user_adm" class="form-control" placeholder="masukkan username baru" value="<?php echo $data['user_adm']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Nama</label>
                                <div class="col-sm-4">
                                    <input type="text" name="nama_adm" class="form-control" placeholder="masukkan nama" value="<?php echo $data['nama_adm']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Telepon</label>
                                <div class="col-sm-4">
                                    <input type="text" name="telp_adm" class="form-control" placeholder="masukkan nomor telepon" value="<?php echo $data['telp_adm']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Jabatan</label>
                                <div class="col-sm-4">
                                    <input type="text" name="jabatan" class="form-control" placeholder="masukkan jabatan" value="<?php echo $data['jabatan']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Password</label>
                                <div class="col-sm-4">
                                    <input type="text" name="pass_adm" class="form-control" placeholder="masukkan jabatan" value="<?php echo $data['pass_adm']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" name="perbarui" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'layout_bottom.php';
?>
