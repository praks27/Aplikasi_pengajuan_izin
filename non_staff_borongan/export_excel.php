<?php
include("sess_check.php");

include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");
$no      = $_GET['no'];
$sql = "SELECT cuti.*, employee.* FROM cuti, employee WHERE cuti.username=employee.username
			AND cuti.no_cuti ='$no'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query);
// deskripsi halaman
$pagedesc = "Cetak Form Cuti";
$pagetitle = str_replace(" ", "_", $pagedesc)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="universitas pamulang">

    <title><?php echo $pagetitle ?></title>

    <link href="libs/images/tat.png" rel="icon" type="images/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/offline-font.css" rel="stylesheet">
    <link href="dist/css/custom-report.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="libs/jquery/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <section id="header-kop">
        <div class="container-fluid">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td class="text-left" width="20%">
                            <img src="libs/images/tat.png" alt="logo-dkm" width="70" />
                        </td>
                        <td class="text-center" width="60%">
                            <b>PT. Tjahaja Agung Tunggal</b> <br>
                            Jl.Margomulyo no.30 Asemrowo<br>
                            Telp: (031) 7482260<br>
                    </tr>
                </tbody>
            </table>
            <hr class="line-top" />
        </div>
    </section>
    <br />
    <br />
    <section id="body-of-report">
        <div class="container-fluid">
            <h4 class="text-center">FORM PENGAJUAN IZIN (APPROVED)</h4>
            <br />
            <br />
            <table class="table table-bordered" id="myTable">
                <h3>Form Pengajuan Izin
                    <thead>
                        <th scope="col">No.Izin</th>
                        <th scope="col">Nama Pemohon</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Divisi</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Tanggal Pengajuan</th>
                        <th scope="col">Tanggal Mulai</th>
                        <th scope="col">Tanggal Akhir</th>
                        <th scope="col">Durasi</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Status</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $result['no_cuti']; ?></td>
                            <td><?php echo $result['nama_emp'] ?></td>
                            <td><?php echo $result['telp_emp']; ?></td>
                            <td><?php echo $result['divisi']; ?></td>
                            <td><?php echo $result['jabatan']; ?></td>
                            <td><?php echo IndonesiaTgl($result['tgl_pengajuan']); ?></td>
                            <td><?php echo IndonesiaTgl($result['tgl_awal']); ?></td>
                            <td><?php echo IndonesiaTgl($result['tgl_akhir']); ?></td>
                            <td><?php echo $result['durasi']; ?> Hari</td>
                            <td><?php echo $result['keterangan']; ?></td>
                            <td><?php echo $result['stt_cuti']; ?></td>
                        </tr>
                    </tbody>
                </h3>
            </table>
            <br>
            <div>
                <label>*Form ini dicetak oleh sistem dan tidak memerlukan tanda tangan atau pengesahan lain.</label>
            </div>

        </div><!-- /.container -->
    </section>

    <script type="text/javascript">
        $(document).ready(function() {
            var table = document.getElementById("myTable");
            var rows = table.getElementsByTagName("tr");

            // Ambil judul kolom dari baris pertama
            var colNames = [];
            for (var i = 0; i < rows[0].cells.length; i++) {
                colNames.push(rows[0].cells[i].innerText);
            }

            // Buat array kosong untuk menampung data tabel
            var data = [];

            // Loop melalui setiap baris, mulai dari baris kedua
            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var rowData = {};

                // Loop melalui setiap sel dalam baris saat ini
                for (var j = 0; j < row.cells.length; j++) {
                    // Ambil nama kolom dari array judul kolom, gunakan sebagai kunci
                    var colName = colNames[j];
                    rowData[colName] = row.cells[j].innerText;
                }

                // Tambahkan data baris ke array data
                data.push(rowData);
            }

            // Buat objek workbook baru
            var wb = XLSX.utils.book_new();

            // Buat worksheet baru dan tambahkan data
            var ws = XLSX.utils.json_to_sheet(data, {
                header: colNames
            });
            XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

            // Simpan file Excel
            XLSX.writeFile(wb, "data.xlsx");
        });
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- jTebilang JavaScript -->
    <script src="libs/jTerbilang/jTerbilang.js"></script>

</body>

</html>