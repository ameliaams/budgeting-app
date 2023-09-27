<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
  <h3 class="card-title">Laporan Kas Keluar</h3>
</div>
<div class="card-body">
<table class="table table-bordered">
          <thead style="text-align: center;">
            <tr>
              <th>NO</th>
              <th>KODE_KWITANSI</th>
              <th>TANGGAL</th>
              <th>NAMA COA</th>
              <th>KETERANGAN</th>
              <th>NOMINAL KREDIT</th>
            </tr>
          </thead>
          <tbody>
          @php $no = 1; @endphp
            @foreach ($results as $d)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ isset($d->KODE_KWITANSI) ? $d->KODE_KWITANSI : '' }}</td>
              <td>{{ isset($d->TANGGAL) ? $d->TANGGAL : '' }}</td>
              <td>{{ isset($d->NAMA_COA) ? $d->NAMA_COA : '' }}</td>
              <td>{{ isset($d->KETERANGAN) ? $d->KETERANGAN : '' }}</td>
              <td style="text-align: right;">@money(isset($d->KREDIT) && $d->KREDIT !== '' ? floatval($d->KREDIT) : 0)</td>
  </tr>
  @endforeach
  </tbody>
  </table>
</div>
</body>
</html>