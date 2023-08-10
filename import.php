<?php
include("sess_check.php");
$pagedesc = "Import Data Karyawan";
include("layout_top.php");
?>
<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Import Data Karyawan</h1>

            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <label>Import Data Karyawan</label>
                                    <input type="file" class="form-control" name="import" required>
                                </div>
                                <div class="col-sm-4">
                                    <label>&nbsp;</label><br />
                                    <input name="submit" type="submit" value="Import" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require_once "vendor/autoload.php";

        // Baca file Excel yang diunggah oleh pengguna
        if (isset($_POST['submit'])) {
            // cek ekstensi file 
            $allowed_extensions = array('xlsx', 'xls', 'csv'); // daftar ekstensi yang diizinkan
            $file_name = $_FILES['import']['name'];
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

            // memeriksa apakah ekstensi file diizinkan
            if (!in_array($file_extension, $allowed_extensions)) {
                echo "File yang diunggah harus memiliki ekstensi: " . implode(',', $allowed_extensions);
            } else {
                $excel_file = $_FILES['import']['tmp_name'];
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($excel_file);
                $spreadsheet = $reader->load($excel_file);
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray(null, true, true, true);


                // Looping baris data pada file Excel
                foreach ($rows as $row) {
                    $username = $row['A'];
                    $nama = $row['B'];
                    $jk = $row['C'];
                    $telp = $row['D'];
                    $divisi = $row['E'];
                    $jabatan = $row['F'];
                    $alamat = $row['G'];
                    $akses = $row['H'];
                    $cuti = $row['I'];
                    $pw = $row['J'];
                    $aktif = $row['K'];
                    $id_adm = $row['L'];

                    //untuk cek jumlah data
                    $sheet = $spreadsheet->getActiveSheet();
                    $jumlah_data = $sheet->getHighestRow();

                    $check_emp = mysqli_query($conn, "SELECT * FROM employee WHERE username = '$username'");
                    //untuk cek data karyawan
                    if (mysqli_num_rows($check_emp)) {
                        $up_emp = mysqli_query($conn, "UPDATE employee SET username = '$username', 
                                                               nama_emp = '$nama', 
                                                               jk_emp = '$jk',
                                                               telp_emp = '$telp',
                                                               divisi = '$divisi',
                                                               jabatan = '$jabatan',
                                                               alamat = '$alamat',
                                                               hak_akses = '$akses',
                                                               jml_cuti = '$cuti',
                                                               password = '$pw',
                                                               active = '$aktif',
                                                               id_adm = '$id_adm' where username = '$username'");
                        $msg = 2;
                    } else {
                        // Query untuk memasukkan data ke tabel MySQL
                        $sql = mysqli_query($conn, "INSERT INTO employee(username,nama_emp,jk_emp,telp_emp,divisi,jabatan,alamat,hak_akses,jml_cuti,password,active,id_adm) VALUES 
                    ('$username', '$nama', '$jk', '$telp', '$divisi', '$jabatan', '$alamat', '$akses', '$cuti', '$pw', '$aktif', '$id_adm')");
                        $msg = 1;
                    }
                }

                // Eksekusi query
                if ($msg == 1) {
                    echo "<script>alert('Data Karyawan $jumlah_data Berhasil Import');</script>";
                    echo "<script type='text/javascript'> document.location = 'karyawan.php'; </script>";
                } else if ($msg == 2) {
                    echo "<script>alert('Data Karyawan Berhasil Diupdate');</script>";
                    echo "<script type='text/javascript'> document.location = 'karyawan.php'; </script>";
                } else {
                    echo "<script>alert('Error Data Gagal Diimport!');</script>";
                    echo "<script type='text/javascript'> document.location = 'import.php'; </script>";
                }
            }
        }
        include("layout_bottom.php");
        ?>