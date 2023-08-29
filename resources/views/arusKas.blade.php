@extends('layouts.main')

@section('title', 'Laporan Arus Kas')

@section('content')
<style>
  th {
    background-color: #778899;
  }
</style>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-8 mx-auto">
        <!-- general form elements -->
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Laporan Arus Kas</h3>
          </div>
          <form action="{{ route('arusKas.index') }}" method="get">
            @csrf
            <div class="card-body">
              <div class="form-group row">
                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                <div class="col-sm-10">
                  <select class="form-control" id="tahun" name="tahun">
                    <?php
                      $currentYear = date("Y");
                      for ($year = $currentYear; $year >= $currentYear - 10; $year--) {
                        echo "<option value=\"$year\">$year</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="bulan" class="col-sm-2 col-form-label">Bulan</label>
                <div class="col-sm-10">
                  <select class="form-control" id="bulan" name="bulan">
                    <?php
                      $bulanOptions = array(
                        "01" => "Januari",
                        "02" => "Februari",
                        "03" => "Maret",
                        "04" => "April",
                        "05" => "Mei",
                        "06" => "Juni",
                        "07" => "Juli",
                        "08" => "Agustus",
                        "09" => "September",
                        "10" => "Oktober",
                        "11" => "November",
                        "12" => "Desember",
                      );

                      foreach ($bulanOptions as $value => $label) {
                        echo "<option value=\"$value\">$label</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="kas" class="col-sm-2 col-form-label">Kas:</label>
                 <div class="col-sm-10">
                 <select class="form-control" id="kas" name="kas" required>
                    @foreach ($dropdownOptionsKas as $option)
                    <option value="{{ $option->ID}}">{{ $option->NAMA_KAS}}</option>
                    @endforeach
                 </select>
                 </div>
                 </div>
              <div class="card-footer text-center">
                <button type="submit" class="btn btn-warning w-100">Cari</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <div class="row g-3">
          <div class="col-sm-7">
            <h3 class="card-title">LAPORAN ARUS KAS</h3>
          </div>
          <div class="col-sm">
            <div>
              <h5>TOTAL: @money($totalVar)</h5>
            </div>
          </div>
          <div class="col-sm">
            <a href="{{ route('laporanArus.cetak', ['tahun' => request('tahun'), 'bulan' => request('bulan'), 'kas' => request('kas')]) }}" class="btn btn-primary float-right" style="width: 120px; border-radius: 20px; color: #FFF; background-color: #4169E1">
                <i class="fa-solid fa-print"></i> Cetak
            </a>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
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
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection
