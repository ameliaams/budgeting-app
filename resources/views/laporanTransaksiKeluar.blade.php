@extends('layouts.main')

@section('title', 'Laporan Kas Keluar')

@section('content')
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8 mx-auto">
            <!-- general form elements -->
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">Laporan Kas Keluar</h3>
              </div>
              <form action="{{ route('laporanTransaksiKeluar.index') }}" method="get">
                @csrf
                <div class="card-body">
                <div class="form-group row">
                  <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Awal</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggalA" name="tanggalA" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggalAK" name="tanggalAK" required>
                  </div>
                </div>

                <div class="card-footer text-center">
                   <button type="submit" class="btn btn-dark w-100">Cari</button>
                </div>

                </div>
                </div>
            </form>
          </div>
              </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">LAPORAN KAS KELUAR</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead style="text-align: center;">
                <tr>
                  <th>ID</th>
                  <th>KODE_KWITANSI</th>
                  <th>TANGGAL</th>
                  <th>NAMA COA</th>
                  <th>KETERANGAN</th>
                  <th>NOMINAL KREDIT</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($results as $result)
                <tr>
                  <td>{{ isset($result->ID) ? $result->ID : '' }}</td>
                  <td>{{ isset($result->KODE_KWITANSI) ? $result->KODE_KWITANSI : '' }}</td>
                  <td>{{ isset($result->TANGGAL) ? $result->TANGGAL : '' }}</td>
                  <td>{{ isset($result->NAMA_COA) ? $result->NAMA_COA : '' }}</td>
                  <td>{{ isset($result->KETERANGAN) ? $result->KETERANGAN : '' }}</td>
                  <td style="text-align: right;">@money(isset($result->KREDIT) && $result->KREDIT !== '' ? floatval($result->DEBET) : 0)</td>
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