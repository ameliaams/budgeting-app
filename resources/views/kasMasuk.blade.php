@extends('layouts.main')

@section('title', 'TRANSAKSI MASUK')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8 mx-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">TRANSAKSI MASUK</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="myForm" action="{{ route('kasMasuk.simpanData') }}" method="post">
                @csrf
              <div class="card-body">
                <div class="form-group row">
                  <label for="id" class="col-sm-2 col-form-label">ID:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="id" name="id" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="no_kwitansi" class="col-sm-2 col-form-label">No Kwitansi:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_kwitansi" name="no_kwitansi" placeholder="KW/M/../../.." disabled required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="tanggal" class="col-sm-2 col-form-label">Tanggal:</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="id_coa" class="col-sm-2 col-form-label">ID COA:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="id_coa" name="id_coa" disabled>
                  </div>
                  <!-- Second Dropdown (COA) -->
                  <div class="col-sm-4">
                    <select class="custom-select form-control-border" id="kredit" name="kredit" required>
                      @foreach ($dropdownOptionsCoa as $result)
                        <option value="{{ $result}}">{{ $result}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="nama_coa" class="col-sm-2 col-form-label">Nama COA:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_coa" name="nama_coa" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="kas" class="col-sm-2 col-form-label">Kas:</label>
                  <div class="col-sm-10">
                    <!-- Second Dropdown (Kas) -->
                    <select class="custom-select form-control-border" id="kas" name="kas" required>
                      @foreach ($dropdownOptionsKas as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
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
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" id="deleteButton" class="btn btn-danger">Hapus</button>
              </div>
            </form>

              @if (session('success'))
                  <div>{{ session('success') }}</div>
              @endif
              <script>
                // Add an event listener to the "Delete" button
                document.getElementById('deleteButton').addEventListener('click', function() {
                // Reset the form fields to their initial state or empty values
                document.getElementById('myForm').reset();
                });
            </script>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@endsection
