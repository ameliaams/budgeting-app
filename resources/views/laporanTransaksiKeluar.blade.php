@extends('layouts.main')

@section('title', 'Laporan Kas Keluar')

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
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Laporan Kas Keluar</h3>
              </div>
              <form action="{{ route('laporanTransaksiKeluar.index', ['tanggalAwal' => request('tanggalAwal')]) }}" method="get">
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
                   <button type="submit" class="btn btn-danger w-100">Cari</button>
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
                  <th>NOMINAL DEBIT</th>
                  <th>AKSI</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($results as $d)
    <tr>
        <td>{{ isset($d->ID) ? $d->ID : '' }}</td>
        <td>{{ isset($d->KODE_KWITANSI) ? $d->KODE_KWITANSI : '' }}</td>
        <td>{{ isset($d->TANGGAL) ? $d->TANGGAL : '' }}</td>
        <td>{{ isset($d->NAMA_COA) ? $d->NAMA_COA : '' }}</td>
        <td>{{ isset($d->KETERANGAN) ? $d->KETERANGAN : '' }}</td>
        <td style="text-align: right;">@money(isset($d->KREDIT) && $d->KREDIT !== '' ? floatval($d->KREDIT) : 0)</td>
        <td style="text-align: center;">
            <!-- Edit Button -->
            <a href="#" class="btn btn-sm btn-primary">
                Edit
            </a>
            <!-- Delete Button -->
            <form action="{{ route('laporanTransaksiKeluar.delete', ['id' => $d->ID, 'idTahunAjaran' => $d->ID_TAHUN_AJARAN, 'idUser' => $d->ID_USER]) }}" method="post" style="display: inline-block;">
    @csrf
    @method('DELETE')
                
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this transaction?')">Delete</button> 
               
            </form>

                    </td>
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