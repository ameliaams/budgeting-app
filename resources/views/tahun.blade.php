@extends('layouts.main')

@section('title', 'Master Tahun Anggaran')

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
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">MASTER TAHUN ANGGARAN</h3>
            <form method="post" action="{{ route('tahun.tutup') }}">
                @csrf
                <input type="hidden" name="userId" value="{{ $user->ID }}">
                <button type="submit" class="btn btn-danger form-control float-right" data-toggle="modal" data-target="#myModal" style="width: 120px; border-radius: 20px; color: #FFF;">
                  Tutup</button>
            </form>
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
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection