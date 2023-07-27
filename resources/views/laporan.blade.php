@extends('layouts.main')

@section('title', 'Laporan Realisasi RAB')

@section('content')
<style>
  th {
    background-color: #FFD700;
  }
</style>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">MASTER RAB</h3>
          </div>
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
                <tr class="{{ isset($d->LEVEL) && $d->LEVEL == 1 ? 'level-one-row' : '' }}" data-widget="expandable-table" aria-expanded="false">
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
          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
              <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
            </ul>
          </div>
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection