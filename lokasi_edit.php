<?php
include_once 'sess_check.php';
if (isset($_GET['id_loc'])) {
    $sql = "SELECT * FROM lokasi WHERE id_loc='" . $_GET['id_loc'] . "'";
    $ress = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($ress);
}
$pagedesc = 'Data Lokasi';
$menuparent = 'laporan';
include_once "layout_top.php";
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data Lokasi</h1>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-12"><?php include 'layout_alert.php'; ?></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form class="form-horizontal" action="lokasi_update.php" method="POST" enctype="multipart/form-data">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>Edit Data</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-sm-3">Nama Lokasi</label>
                                <div class="col-sm-4">
                                    <input type="hidden" name="id_loc" value="<?php echo $data['id_loc']; ?>">
                                    <input type="text" name="nm_loc" class="form-control"
                                        placeholder="masukkan nama lokasi" value="<?php echo $data['nm_loc']; ?>">
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
