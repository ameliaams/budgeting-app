@extends('layouts.main')

@section('title', 'Laporan Total Kas')

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
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Laporan Total Kas</h3>
          </div>
          <form action="{{ route('laporanTotalKas.index') }}" method="get">
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
              <div class="card-footer text-center">
                <button type="submit" class="btn btn-danger w-100">Cari</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">LAPORAN TOTAL KAS</h3>
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
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection