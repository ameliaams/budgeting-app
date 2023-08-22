<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Realisasi RAB</title>
    <style>
        /* Add your styles here */
        body {
            font-family: 'Times New Roman', Times, serif;
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
            padding: 8px;
        }
        th{
          text-align: center;
        }
    </style>
</head>
<body>
                        <div class="card-header">
                            <h3 class="card-title">Laporan Realisasi RAB</h3>
                        </div>
                        <div class="card-body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>COA NUMBER</th>
                                        <th>NAMA COA</th>
                                        <th>SALDO NORMAL</th>
                                        <th>NOMINAL</th>
                                        <th>REALISASI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporan as $lapor)
                                    <tr>
                                        <td style="text-align: center;">{{ isset($lapor->COA_NUMBER) ? $lapor->COA_NUMBER : '' }}</td>
                                        <td>{{ isset($lapor->NAMA_COA) ? $lapor->NAMA_COA : '' }}</td>
                                        <td style="text-align: center;">{{ isset($lapor->SALDO_NORMAL) ? $lapor->SALDO_NORMAL : '' }}</td>
                                        <td style="text-align: right;">@money(isset($lapor->NOMINAL) ? $lapor->NOMINAL : '')</td>
                                        <td style="text-align: right;">@money(isset($lapor->REALISASI) ? $lapor->REALISASI : '')</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
</body>
</html>
