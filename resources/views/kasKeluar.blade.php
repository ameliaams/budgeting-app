@extends('layouts.main')

@section('title', 'Transaksi Keluar')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-10">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Transaksi Keluar</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="myForm">
                <div class="card-body">
                  <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" id="id" name="id" disabled>
                  </div>
                  <div class="form-group">
                    <label for="no_kwitansi">No Kwitansi:</label>
                    <input type="text" class="form-control" id="no_kwitansi" name="no_kwitansi" placeholder="KW/M/20230722-001" disabled>
                  </div>
                  <div class="form-group">
                  <label for="tanggal">Tanggal:</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                  </div>
                  <div class="form-group">
                  <label for="id_coa">ID COA:</label>
                  <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="id_coa" name="id_coa" disabled>
                  </div>
                  <div class="col-md-6">
                    <select id="kredit" name="kredit" required>
                      @foreach ($dropdownOptions as $result)
                        <option value="{{ $result }}">{{ $result }}</option>
                      @endforeach
                    </select>
                  </div>
                  </div>
                  </div>
                  <div class="form-group">
                  <label for="nama_coa">Nama COA:</label>
                    <input type="text" class="form-control" id="nama_coa" name="nama_coa"  disabled>
                  </div>
                  <div class="form-group">
                  <label for="kas">Kas:</label>
                    <input type="text" class="form-control" id="kas" name="kas" required>
                  </div>
                  <div class="form-group">
                  <label for="keterangan">Keterangan:</label>
                    <textarea id="keterangan" class="form-control" name="keterangan" rows="4" required></textarea>
                  </div>
                  <div class="form-group">
                  <label for="no_ref">No Ref:</label>
                    <input type="text" class="form-control" id="no_ref" name="no_ref" required>
                  </div>
                  <div class="form-group">
                  <label for="nominal">Nominal:</label>
                    <input type="number" class="form-control" id="nominal" name="nominal" placeholder="0" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <button type="button" id="deleteButton" class="btn btn-danger">Hapus</button>
                </div>
              </form>

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
