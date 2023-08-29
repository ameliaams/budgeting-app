@extends('layouts.main')

@section('title', 'Laporan Realisasi RAB')

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
            <h3 class="card-title">Laporan Total Kas</h3>
          </div>
          <form action="{{ route('laporan.index') }}" method="get">
            @csrf
            <div class="card-body">
              <div class="form-group row">
                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                <div class="col-sm-10">
                <select class="form-control" id="tahun" name="tahun">
                @foreach ($dropdownOptionsTahun as $option)
                    <option value="{{ $option->ID }}">{{ $option->NAMA_BULAN }} - {{ $option->TAHUN }}</option>
                @endforeach
                </select>
                </div>
              </div>
              <div class="card-footer text-center">
                <button type="submit" class="btn btn-warning w-100">Cari</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Laporan Realisasi RAB</h3>
              <div class="card-footer clearfix">
              <a href="{{ route('laporan.cetak', ['tahun' => $idTahunAjaran]) }}" class="btn btn-primary float-right" style="width: 120px; border-radius: 20px; color: #FFF; background-color: #4169E1">
                <i class="fa-solid fa-print"></i> Cetak</a>
              </div>
        </form>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead style="text-align: center;">
                <tr>
                  <th style="width: 10px">COA NUMBER</th>
                  <th>NAMA COA</th>
                  <th style="width: 40px">SALDO NORMAL</th>
                  <th>NOMINAL</th>
                  <th>REALISASI</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($laporan as $lapor)
              <tr class="{{ isset($lapor->LEVEL) && $lapor->LEVEL == 1 ? 'level-one-row' : ($lapor->LEVEL == '' ? 'level-null' : '') }}" data-widget="expandable-table" aria-expanded="false">
                  <td>{{ isset($lapor->COA_NUMBER) ? $lapor->COA_NUMBER : '' }}</td>
                  <td>{{ isset($lapor->NAMA_COA) ? $lapor->NAMA_COA : '' }}</td>
                  <td>{{ isset($lapor->SALDO_NORMAL) ? $lapor->SALDO_NORMAL : '' }}</td>
                  <td style="text-align: right;">@money(isset($lapor->NOMINAL) ? $lapor->NOMINAL : '')</td>
                  <td style="text-align: right;">@money(isset($lapor->REALISASI) ? $lapor->REALISASI : '')</td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection