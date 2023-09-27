<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Masuk</title>
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
        h1{
            text-align: center;
        }
    </style>
</head>
<body>
                    <div class="card-header">
                        <h1 class="card-title">Bukti Kas Masuk</h1>
                    </div>
                    <p><b>Tanggal : {{ isset($results[0]->TANGGAL) ? $results[0]->TANGGAL : '' }}</b></p>
                    <P><b>Kode Kwitansi : {{ isset($results[0]->KODE_KWITANSI) ? $results[0]->KODE_KWITANSI : '' }}</b></P>
                    <div class="card-body">
                    <table class="table">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Rincian</th>
                                  <th>Keterangan</th>
                                  <th>Jumlah</th>
                              </tr>
                          </thead>
                    <tbody data-group="programming_languages">
    @php $no = 1; @endphp
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ isset($results[0]->NAMA_COA) ? $results[0]->NAMA_COA : '' }}</td>
        <td>{{ isset($results[0]->KETERANGAN) ? $results[0]->KETERANGAN : '' }}</td>
        <td>{{ isset($results[0]->NOMINAL) ? $results[0]->NOMINAL : '' }}</td>
    </tr>
    @foreach(array_slice($results, 1) as $d)
    <tr class="item">
        <td>{{ $no++ }}</td>
        <td>{{ isset($d->NAMA_COA) ? $d->NAMA_COA : '' }}</td>
        <td>{{ isset($d->KETERANGAN) ? $d->KETERANGAN : '' }}</td>
        <td>{{ isset($d->NOMINAL) ? $d->NOMINAL : '' }}</td>
    </tr>
    @endforeach
    <tr class="total-row" style="background-color: yellow">
        <td colspan="3" style="text-align: right;">Total :</td>
        <td colspan="1" style="text-align: right;">@money(($totalVar))</td>
    </tr>
</tbody>
                          
                      </table>
                    </div>
</body>
</html>
