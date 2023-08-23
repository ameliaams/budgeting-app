<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Total Kas</title>
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
            <h3 class="card-title">Laporan Total Kas</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead style="text-align: center;">
                    <tr>
                    <th>KODE</th>
                    <th>NAMA_KAS</th>
                    <th>TOTAL</th>
                    </tr>
                </thead>
            <tbody>
            @foreach ($results as $d)
            <tr>
            <td>{{ isset($d->KODE) ? $d->KODE : '' }}</td>
            <td>{{ isset($d->NAMA_KAS) ? $d->NAMA_KAS : '' }}</td>
            <td>{{ isset($d->TOTAL) ? $d->TOTAL : '' }}</td>
            </tr>
            @endforeach
            <tr class="total-row" style="background-color: yellow">
                                <td colspan="2" style="text-align: right;">Total :</td>
                                <td colspan="1" style="text-align: right;">@money(($totalVar))</td>
                            </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
