<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Arus Kas</title>
    <style>
        /* Add your styles here */
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
        }
        .card {
            border: 1px solid #ccc;
            margin: 20px;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 7px;
        }
        th {
            text-align: center;
            background-color: #778899;
            color: white;
        }
        .total-row td {
            border-top: 2px solid #ccc;
            font-weight: bold;
        }
        /* Add additional styles for better PDF layout */
        @media print {
            body {
                margin: 0;
                font-size: 11px;
            }
            .card {
                border: none;
                margin: 0;
                padding: 0;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 10px; /* Adjust font size for better fit */
            }
            th, td {
                border: 1px solid #ccc;
                padding: 4px; /* Adjust padding for better fit */
            }
        }
    </style>
</head>
<body>
                    <div class="card-header">
                        <h3 class="card-title">Laporan Arus Kas</h3>
                    </div>
                    <div class="card-body">
                    <table class="table table-bordered">
                        <thead style="text-align: center;">
                            <tr>
                                <th>KODE KWITANSI</th>
                                <th>TANGGAL</th>
                                <th>JENIS TRANSAKSI</th>
                                <th>DEBET</th>
                                <th>KREDIT</th>
                                <th>NAMA_COA</th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $d)
                            <tr>
                                <td>{{ isset($d->KODE_KWITANSI) ? $d->KODE_KWITANSI : '' }}</td>
                                <td>{{ isset($d->TANGGAL) ? $d->TANGGAL : '' }}</td>
                                <td>{{ isset($d->KET_TRANSAKSI) ? $d->KET_TRANSAKSI : '' }}</td>
                                <td style="text-align: right;">@money(isset($d->DEBET) && $d->DEBET !== '' ? floatval($d->DEBET) : 0)</td>
                                <td style="text-align: right;">@money(isset($d->KREDIT) && $d->KREDIT !== '' ? floatval($d->KREDIT) : 0)</td>
                                <td>{{ isset($d->NAMA_COA) ? $d->NAMA_COA : '' }}</td>
                                <td>{{ isset($d->KETERANGAN) ? $d->KETERANGAN : '' }}</td>
                            </tr>
                            @endforeach
                            <tr class="total-row" style="background-color: yellow">
                                <td colspan="6" style="text-align: right;">Total :</td>
                                <td colspan="1" style="text-align: right;">@money(($totalVar))</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
</body>
</html>
