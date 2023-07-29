@extends('layouts.main')

@section('title', ' Edit Transaksi Keluar')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8 mx-auto">
            <!-- general form elements -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Transaksi Keluar</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="myForm" action="{{ route('editTransaksiKeluar'}}" method="post">
                            @csrf
                @method('PUT')
                <div class="form-group row">
                  <label for="tanggal" class="col-sm-2 col-form-label">Tanggal:</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="nama_coa" class="col-sm-2 col-form-label">Nama COA:</label>       
                  <!-- Second Dropdown (COA) -->
                  <div class="col-sm-5">
                    <select class="custom-select form-control-border" id="kredit" name="kredit" required>
                      @foreach ($dropdownOptionsCoa as $result)
                        <option value="{{ $result->ID}}">{{ $result->NAMA_COA}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="kas" class="col-sm-2 col-form-label">Kas:</label>
                  <div class="col-sm-5">
                    <!-- Second Dropdown (Kas) -->
                    <select class="custom-select form-control-border" id="kas" name="kas" required>
                      @foreach ($dropdownOptionsKas as $option)
                      <!-- Ganti (Kas) -->
                        <option value="{{ $option->ID}}">{{ $option->NAMA_KAS}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="keterangan" class="col-sm-2 col-form-label">Keterangan:</label>
                  <div class="col-sm-10">
                    <textarea id="keterangan" class="form-control" name="keterangan" rows="4" required></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="no_ref" class="col-sm-2 col-form-label">No Ref:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_ref" name="no_ref" required>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="nominal" class="col-sm-2 col-form-label">Nominal:</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="nominal" name="nominal" placeholder="0" required>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">UPADATE</button>
                            </div>
                        </form>
             <!-- Tampilan SweetAlert -->
              @if (session('success'))
                  <!-- Link eksternal untuk SweetAlert -->
                  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

                  <script>
                      // Tampilkan alert pesan sukses saat halaman dimuat
                      document.addEventListener('DOMContentLoaded', function() {
                        swal({
                        title: "Data Berhasil DiUpdate!",
                        text: "",
                        icon: "success",
                        buttons: {
                          confirm: {
                            text: "OK",
                            value: true,
                            className: "btn btn-success"
                          }
                        }
                      });
                      });
                  </script>
              @endif
                    
@endsection