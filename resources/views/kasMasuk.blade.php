@extends('layouts.main')

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
                <h3 class="card-title">Transaksi Masuk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" id="id" name="id" required>
                  </div>
                  <div class="form-group">
                    <label for="no_kwitansi">No Kwitansi:</label>
                    <input type="text" class="form-control" id="no_kwitansi" name="no_kwitansi" required>
                  </div>
                  <div class="form-group">
                  <label for="tanggal">Tanggal:</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                  </div>
                  <div class="form-group">
                  <label for="id_coa">ID COA:</label>
                    <input type="text" class="form-control" id="id_coa" name="id_coa" required>
                    <select id="country" name="country" required>
                        <option value="">transaksi</option>
                    </select>
                  </div>
                  <div class="form-group">
                  <label for="nama_coa">Nama COA:</label>
                    <input type="text" class="form-control" id="nama_coa" name="nama_coa" required>
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
                    <input type="number" class="form-control" id="nominal" name="nominal" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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
