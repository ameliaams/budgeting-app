@extends('layouts.main')

@section('title', 'Master Tahun Anggaran')

@section('content')
<style>
  /* CSS untuk memberi warna pada header tabel */
  th {
    background-color: #778899;
    /* Ganti dengan warna yang Anda inginkan */
    /* tambahkan gaya lainnya seperti font-color, padding, dsb. sesuai kebutuhan */
  }
</style>


<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">MASTER TAHUN ANGGARAN</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead style="text-align: center;">
                <tr>
                  <th style="width: 10px">ID</th>
                  <th>TAHUN</th>
                  <th>BULAN</th>
                  <th style="width: 40px">ID USER</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tahun as $t)
                <tr>
                  <td>{{ $t->ID }}</td>
                  <td>{{ $t->TAHUN }}</td>
                  <td>{{ $t->BULAN }}</td>
                  <td>{{ $t->ID_USER }}</td>
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