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
                  <th>NOMINAL KREDIT</th>
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
        <td>
          <!-- Edit Button -->
          <form action="{{ route('laporanTransaksiKeluar.edit', $d->ID) }}" id="addDataModal">
            @csrf
              <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">
                Edit
              </button>
              <!-- FORM ADD COA -->
            <div class="modal fade" id="myModal">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="container-fluid">
                  <form method="post" action="{{ route('laporanTransaksiKeluar.edit', $d->ID) }}">
                    @csrf
                    <div class="modal-header">
                      <h4 class="modal-title">Update Data</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                  <div class="form-group row">
                    <label for="tanggal" class="col-sm-3 col-form-label">Tanggal:</label>
                    <div class="col-sm-8">
    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $d->TANGGAL ?? '') }}" required>
</div>

                  </div>
                <div class="form-group row">
                  <label for="nama_coa" class="col-sm-3 col-form-label">Nama COA:</label>       
                  <div class="col-sm-8">
                  <input type="text" class="form-control" id="kredit" name="kredit" value="{{ old('kredit', $d->NAMA_COA) }}" disabled required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="kas" class="col-sm-3 col-form-label">Kas:</label>
                  <div class="col-sm-8">
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
                  <label for="keterangan" class="col-sm-3 col-form-label">Keterangan:</label>
                  <div class="col-sm-8">
                      <textarea id="keterangan" class="form-control" name="keterangan" rows="4" required>{{ old('keterangan', $d->KETERANGAN ?? '') }}</textarea>
                  </div>
              </div>


                <div class="form-group row">
                  <label for="no_ref" class="col-sm-3 col-form-label">No Ref:</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="no_ref" name="no_ref" value="{{ old('no_ref') ?? ($d->NO_REF ?? '') }}" required>
                </div>

                </div>
                
                <div class="form-group row">
                    <label for="nominal" class="col-sm-3 col-form-label">Nominal:</label>
                    <div class="col-sm-8">
                    <input type="number" class="form-control" id="nominal" name="nominal" placeholder="0" value="{{ old('nominal') ?? ($d->NOMINAL ?? '') }}" required>
                    </div>
                </div>

                
                      <div class="modal-footer">
                        <button type="submit" id="SaveButton" class="btn form-control float-right" style="width: 120px; border-radius: 20px; color: #FFF; background-color: #4169E1">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                        </button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
            </div>
          </form>
          <!-- Delete Button -->
          <form action="{{ route('laporanTransaksiKeluar.delete', $d->ID) }}" method="post" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this transaction?')">Delete</button> 
          </form>
          </td>
                </tr>
                @endforeach
              </tbody>
            </table>

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