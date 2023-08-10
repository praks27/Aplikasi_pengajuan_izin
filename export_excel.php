<?php
include("sess_check.php");
include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");

$yearnow = date('Y');
$jizin = $_GET['jizin'];
$tglPeng = $_GET['tglpeng'];
$selesai = $_GET['tglakhir'];
// deskripsi halaman
$pagedesc = "Laporan Data " . $jizin . " - Periode " . $yearnow;
$pagetitle = str_replace(" ", "_", $pagedesc);
// deskripsi halaman
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

    <!-- datatable style -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <!-- bootstrap 4 css  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- css tambahan  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

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
            <?php
            function jizin($jenisizin, $tglPeng, $selesai, $conn)
            {
                $sql = "SELECT cuti.*, employee.* FROM cuti, employee WHERE cuti.username=employee.username";
                // Add conditions based on user input
                if (!empty($jenisizin)) {
                    $sql .= " AND cuti.izin='$jenisizin'";
                }
                if (!empty($tglPeng) && !empty($selesai)) {
                    $sql .= " AND cuti.tgl_pengajuan BETWEEN '$tglPeng' AND '$selesai'";
                }
                $sql .= " ORDER BY cuti.tgl_pengajuan DESC";
                $query = mysqli_query($conn, $sql);
            ?>
                <thead>
                    <th scope="col">No</th>
                    <th scope="col">No.Izin</th>
                    <th scope="col">Nama Pemohon</th>
                    <th scope="col">Divisi</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Jenis Izin</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <?php if ($jenisizin == 'cuti' || $jenisizin == 'cuti khusus' || $jenisizin == 'libur pengganti') {
                    ?>
                        <th scope="col">Tanggal Mulai</th>
                        <th scope="col">Tanggal Akhir</th>
                        <th scope="col">Durasi</th>
                    <?php
                    } ?>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Status</th>
                    </th>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($data = mysqli_fetch_array($query)) {
                        echo '<tr>';
                        echo '<td class="text-center">' . $i . '</td>';
                        echo '<td>' . $data['no_cuti'] . '</td>';
                        echo '<td>' . $data['nama_emp'] . '</td>';
                        echo '<td>' . $data['divisi'] . '</td>';
                        echo '<td>' . $data['jabatan'] . '</td>';
                        echo '<td>' . $data['izin'] . '</td>';
                        echo '<td class="text-center text-nowrap">' . format_tanggal($data['tgl_pengajuan']) . '</td>';
                        if ($jenisizin == 'cuti' || $jenisizin == 'cuti khusus' || $jenisizin == 'libur pengganti') {
                            echo '<td class="text-center text-nowrap">' . format_tanggal($data['tgl_awal']) . '</td>';
                            echo '<td class="text-center text-nowrap">' . format_tanggal($data['tgl_akhir']) . '</td>';
                            echo '<td>' . $data['durasi'] . '</td>';
                        }
                        echo '<td>' . $data['keterangan'] . '</td>';
                        echo '<td>' . $data['stt_cuti'] . '</td>';
                        echo '</tr>';

                        $i++;
                    }
                    ?>
                </tbody>
            <?php
            }
            ?>
            <table class="table table-bordered" id="myTable">
                <?php jizin($jizin, $tglPeng, $selesai, $conn) ?>
            </table>
            <br>
            <div>
                <label>*Form ini dicetak oleh sistem dan tidak memerlukan tanda tangan atau pengesahan lain.</label>
            </div>
        </div><!-- /.container -->
    </section>

    <!-- jquery -->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <!-- jquery datatable -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <!-- script tambahan  -->
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js">
    </script>

    <!-- fungsi datatable -->
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                // script untuk membuat export data 
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ]
            })
        });
        $(document).ready(function() {
            $('#tableIjin').DataTable({
                // script untuk membuat export data 
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ]
            })
        });
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- jTebilang JavaScript -->
    <script src="libs/jTerbilang/jTerbilang.js"></script>

</body>

</html>