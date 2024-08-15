<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Presensi</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 15px;
            font-size: 1.25rem;
            font-weight: 500;
            border-bottom: 1px solid #dee2e6;
        }

        .card-body {
            padding: 15px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            background-color: #007bff;
            border: 1px solid #007bff;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .btn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .table-container {
            margin-top: 20px;
        }



        table.dataTable {
            width: 100%;
            table-layout: fixed;
            /* Ensure column widths are fixed */
        }

        table.dataTable thead th {
            background-color: #007bff;
            color: white;
            text-align: center;
        }

        table.dataTable tbody td {
            vertical-align: middle;
            text-align: center;
            overflow: hidden;
        }

        table.dataTable th,
        table.dataTable td {
            width: 100px;
            /* Set a fixed width for columns */
            word-wrap: break-word;
        }

        table.dataTable tfoot th {
            background-color: #f8f9fa;
        }

        .holiday {
            background-color: #cccccc;
        }

        .status-hadir {
            background-color: #d4edda;
            /* Hijau muda */
            color: #155724;
            /* Warna teks hijau gelap */
        }

        .status-ijin {
            background-color: #fff3cd;

            /* Kuning muda */
            color: #856404;

            /* Warna teks kuning gelap */
        }

        .status-sakit {
            background-color: #d1ecf1;

            /* Biru muda */
            color: #0c5460;

            /* Warna teks biru gelap */
        }


        .absen-empty {
            background-color: #f8d7da;

            /* Merah muda */
            color: #721c24;

            /* Warna teks merah gelap */
        }
    </style>
    <style>
        .navbar {
            z-index: 1;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            background-color: #007bff;
            /* Primary color from Bootstrap */
        }

        .navbar-brand {
            color: #ffffff !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 1.5rem;
            font-weight: bold;
            text-transform: uppercase;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            max-height: 40px;
            margin-right: 10px;
        }

        .navbar-brand:hover {
            color: #d0d0d0 !important;
        }

        .navbar-nav .nav-link {
            color: #ffffff !important;
            font-size: 1.2rem;
            /* Larger font size for nav links */
            font-weight: 500;
            /* Medium weight for better readability */
        }

        .navbar-nav .nav-link:hover {
            color: #d0d0d0 !important;
        }

        .navbar-nav .nav-item.active .nav-link {
            font-weight: bold;
            /* Emphasize the active link */
            color: #f8f9fa !important;
            /* Lighter color for active link */
        }

        .container {
            margin-top: 80px;
            /* Adjust the margin-top to provide space for the fixed navbar */

        }

        .navbar-nav .nav-item.logout {
            margin-left: auto;
            /* Push the logout button to the right */
        }

        @media (max-width: 768px) {
            .navbar {
                background-color: #007bff;
            }

            .navbar-nav .nav-link {
                color: #ffffff !important;
                font-size: 1.1rem;
                /* Slightly smaller font size for mobile */
            }

            .navbar-nav .nav-link:hover {
                color: #d0d0d0 !important;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">

                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo site_url('home'); ?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('user/list'); ?>">User List <span class="visually-hidden"></a>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('holidays/index'); ?>">Holidays </span></a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item logout">
                    <a class="btn btn-danger" href="<?php echo site_url('auth/logout'); ?>">Logout <span class="visually-hidden"></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container content">
        <div class="row justify-content-md-end">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Rekap Presensi</div>


                    <form method="GET" action="<?= site_url('home') ?>" class="mb-3">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="month">Bulan:</label>
                                <select name="month" id="month" class="form-control">
                                    <?php for ($i = 1; $i <= 12; $i++): ?>
                                        <option value="<?= $i ?>" <?= $i == $selectedMonth ? 'selected' : '' ?>>
                                            <?= date('F', mktime(0, 0, 0, $i, 10)) ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="year">Tahun:</label>
                                <select name="year" id="year" class="form-control">
                                    <?php for ($i = 2020; $i <= date('Y'); $i++): ?>
                                        <option value="<?= $i ?>" <?= $i == $selectedYear ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>

                    <div class="table-container">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Nama</th>
                                        <?php for ($i = 1; $i <= $endOfMonth; $i++): ?>
                                            <th><?= $i ?></th>
                                        <?php endfor; ?>
                                        <th rowspan="2">Rekap</th>
                                    </tr>
                                    <tr>
                                        <?php for ($i = 1; $i <= $endOfMonth; $i++): ?>
                                            <th><?= date('D', strtotime("$selectedYear-$selectedMonth-$i")) ?></th>
                                        <?php endfor; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($absensiData as $userId => $data): ?>
                                        <tr>
                                            <td><?= $data['name'] ?></td>
                                            <?php for ($i = 1; $i <= $endOfMonth; $i++): ?>
                                                <?php
                                                $holidayClass = '';
                                                $statusClass = '';
                                                $emptyClass = '';
                                                $currentDate = sprintf('%04d-%02d-%02d', $selectedYear, $selectedMonth, $i);
                                                $isHoliday = in_array($currentDate, array_column($holidays, 'tanggal'));
                                                $isTodayOrFuture = ($selectedMonth == date('n') && $selectedYear == date('Y') && $i > date('j'));

                                                if ($isHoliday) {
                                                    $holidayClass = 'holiday';
                                                }

                                                if (!$isHoliday && !isset($data['dates'][$i])) {
                                                    if (!$isTodayOrFuture) {
                                                        $emptyClass = 'absen-empty';
                                                    }
                                                } else {
                                                    $status = isset($data['dates'][$i]) ? $data['dates'][$i]['status'] : '';
                                                    if ($status) {
                                                        switch (strtolower($status)) {
                                                            case 'hadir':
                                                                $statusClass = 'status-hadir';
                                                                break;
                                                            case 'ijin':
                                                                $statusClass = 'status-ijin';
                                                                break;
                                                            case 'sakit':
                                                                $statusClass = 'status-sakit';
                                                                break;
                                                            case 'absen':
                                                                $statusClass = 'status-absen';
                                                                break;
                                                        }
                                                    }
                                                }
                                                ?>
                                                <td class="<?= $holidayClass ?> <?= $statusClass ?> <?= $emptyClass ?> clickable"
                                                    data-name="<?= $data['name'] ?>"
                                                    data-date="<?= $currentDate ?>"
                                                    data-status="<?= $status ?>"
                                                    data-masuk="<?= isset($data['dates'][$i]) ? $data['dates'][$i]['masuk'] : '-' ?>"
                                                    data-pulang="<?= isset($data['dates'][$i]) ? $data['dates'][$i]['pulang'] : '-' ?>"
                                                    data-keterangan="<?= isset($data['dates'][$i]) ? $data['dates'][$i]['keterangan'] : '-' ?>"
                                                    data-foto="<?= isset($data['dates'][$i]) ? $data['dates'][$i]['foto'] : '-' ?>"
                                                    data-latitude="<?= isset($data['dates'][$i]) ? $data['dates'][$i]['latitude'] : '-' ?>"
                                                    data-longitude="<?= isset($data['dates'][$i]) ? $data['dates'][$i]['longitude'] : '-' ?>">
                                                    <?php if ($isHoliday): ?>
                                                        Libur
                                                    <?php elseif (isset($data['dates'][$i])): ?>
                                                        <?= $data['dates'][$i]['masuk'] ?><br>
                                                        <?= $data['dates'][$i]['pulang'] ?><br>
                                                        <?= $data['dates'][$i]['status'] ?>
                                                    <?php else: ?>
                                                        <?php if ($emptyClass): ?>
                                                            Absen
                                                        <?php else: ?>
                                                            -
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endfor; ?>
                                            <td>
                                                <?php
                                                $hadir = 0;
                                                $ijin = 0;
                                                $sakit = 0;
                                                $absen = 0;

                                                foreach ($data['dates'] as $day => $details) {
                                                    if ($details['status'] == 'Hadir') {
                                                        $hadir++;
                                                    } elseif ($details['status'] == 'Ijin') {
                                                        $ijin++;
                                                    } elseif ($details['status'] == 'Sakit') {
                                                        $sakit++;
                                                    }
                                                }

                                                if ($selectedMonth == date('n') && $selectedYear == date('Y')) {
                                                    $absen = 0;
                                                    for ($i = 1; $i <= date('j'); $i++) {
                                                        $currentDate = sprintf('%04d-%02d-%02d', $selectedYear, $selectedMonth, $i);
                                                        if (!isset($data['dates'][$i]) && !in_array($currentDate, array_column($holidays, 'tanggal')) && date('w', strtotime($currentDate)) != 0) {
                                                            $absen++;
                                                        }
                                                    }
                                                } else {
                                                    $lastDayOfMonth = date('t', mktime(0, 0, 0, $selectedMonth, 1, $selectedYear));
                                                    $absen = 0;
                                                    for ($i = 1; $i <= $lastDayOfMonth; $i++) {
                                                        $currentDate = sprintf('%04d-%02d-%02d', $selectedYear, $selectedMonth, $i);
                                                        if (!isset($data['dates'][$i]) && !in_array($currentDate, array_column($holidays, 'tanggal')) && date('w', strtotime($currentDate)) != 0) {
                                                            $absen++;
                                                        }
                                                    }
                                                }
                                                ?>
                                                Hadir: <?= $hadir ?><br>
                                                Ijin: <?= $ijin ?><br>
                                                Sakit: <?= $sakit ?><br>
                                                Absen: <?= $absen ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal HTML -->
    <!-- Modal HTML -->
    <div class="modal fade" id="absenModal" tabindex="-1" role="dialog" aria-labelledby="absenModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="absenModalLabel">Detail Absensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama:</strong> <span id="modalName"></span></p>
                    <p><strong>Tanggal:</strong> <span id="modalDate"></span></p>
                    <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                    <p><strong>Masuk:</strong> <span id="modalMasuk"></span></p>
                    <p><strong>Pulang:</strong> <span id="modalPulang"></span></p>
                    <p><strong>Keterangan:</strong> <span id="modalKeterangan"></span></p>
                    <p><strong>Foto:</strong> <img id="modalFoto" src="http://103.240.110.4/alfurqon/application/uploads/CAP6453268386582053654.jpg" alt="Foto" style="max-width: 100%; height: auto;"></p>

                    <div id="map" style="height: 400px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let map; // Deklarasikan map di sini sehingga bisa diakses di seluruh fungsi

            document.querySelectorAll('.clickable').forEach(function(element) {
                element.addEventListener('click', function() {
                    const name = element.getAttribute('data-name');
                    const date = element.getAttribute('data-date');
                    const status = element.getAttribute('data-status');
                    const masuk = element.getAttribute('data-masuk');
                    const pulang = element.getAttribute('data-pulang');
                    const keterangan = element.getAttribute('data-keterangan');
                    const foto = element.getAttribute('data-foto');
                    const latitude = parseFloat(element.getAttribute('data-latitude'));
                    const longitude = parseFloat(element.getAttribute('data-longitude'));

                    // Reset content modal
                    document.getElementById('modalName').innerText = name;
                    document.getElementById('modalDate').innerText = date;
                    document.getElementById('modalStatus').innerText = status;
                    document.getElementById('modalMasuk').innerText = masuk;
                    document.getElementById('modalPulang').innerText = pulang;
                    document.getElementById('modalKeterangan').innerText = keterangan;
                    document.getElementById('modalFoto').src = (foto && foto !== '-') ? 'http://103.240.110.4/alfurqon/application/uploads/' + encodeURIComponent(foto) : 'path/to/default.jpg';


                    // Hapus peta yang ada sebelumnya jika sudah ada
                    if (map) {
                        map.remove();
                    }

                    // Inisialisasi peta jika koordinat valid
                    if (!isNaN(latitude) && !isNaN(longitude)) {
                        map = L.map('map').setView([latitude, longitude], 13);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '© OpenStreetMap contributors'
                        }).addTo(map);
                        L.marker([latitude, longitude]).addTo(map)
                            .bindPopup('<b>Lokasi:</b><br>' + name)
                            .openPopup();
                    } else {
                        // Menampilkan pesan kesalahan jika koordinat tidak valid
                        document.getElementById('map').innerHTML = '<p>Koordinat tidak valid</p>';
                    }

                    // Tampilkan modal
                    $('#absenModal').modal('show');
                });
            });

            // Pastikan modal di-reset ketika ditutup
            $('#absenModal').on('hidden.bs.modal', function() {
                // Hapus peta yang ada sebelumnya jika sudah ada
                if (map) {
                    map.remove();
                    map = null; // Reset peta ke null setelah dihapus
                }
            });
        });
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .holiday {
            background-color: #cccccc;
            text-align: center;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                ordering: false,
                paging: false,
                bFilter: false,
                info: false,
                buttons: ['copy', 'csv', 'excel']
            });
        });
    </script>
</body>

</html>