@extends('layouts.main')

@section('title', 'Ubah Password')

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
  <!-- Horizontal Form -->
  <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Ubah Password</h3>
              </div>
              <form action="{{ route('ubah.index') }}" method="get">
            @csrf
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="passwordLama" class="col-sm-3 col-form-label">Password Lama</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="passwordLama" placeholder="Password Lama">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="passwordBaru" class="col-sm-3 col-form-label">Password Baru</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="passwordBaru" placeholder="Password Baru">
                      
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Konfirmasi Password </label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="inputPassword" placeholder="Konfirmasi Password">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <div class="text-center">
                    <button type="submit" name="btnup" class="btn btn-info" style="width:30%">Update</button>
                </div>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            </div>
            </div>
            </div>
            <!-- /.card -->
</section>
@endsection