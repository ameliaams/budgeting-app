@extends('layouts.main')

@section('title', 'Laporan Kas Masuk')

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
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Laporan Kas Masuk</h3>
          </div>
          <form action="{{ route('laporanTransaksiMasuk.index', ['tanggalAwal' => request('tanggalAwal')]) }}" method="get">
            @csrf
            <div class="card-body">
              <div class="form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Awal</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="tanggalA" name="tanggalA" value="{{ $tgl_awal->format('Y-m-d') }}" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="tanggalAK" name="tanggalAK" value="{{ $tgl_akhir->format('Y-m-d') }}" required>
                </div>
              </div>
              <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary w-100">Cari</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">LAPORAN KAS MASUK</h3>
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
              <th>NOMINAL DEBET</th>
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
              <td style="text-align: right;">@money(isset($d->DEBET) && $d->DEBET !== '' ? floatval($d->DEBET) : 0)</td>
              <td style="text-align: center;">
                <!-- Edit Button -->
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal{{ $d->ID }}">
                  Edit
                </button>
                <!-- Add SweetAlert library to the head section of your HTML layout -->

                <head>
                  <!-- ... Other meta tags and CSS links ... -->
                  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                </head>

                <!-- Delete Button -->
                <form action="{{ route('laporanTransaksiMasuk.delete', $d->ID) }}" method="post" style="display: inline-block;">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete()">Delete</button>
                </form>

                <!-- JavaScript -->
                <script>
                  // Function to handle the delete confirmation using SweetAlert
                  function confirmDelete() {
                    swal({
                      title: "Apakah Anda yakin?",
                      text: "Sekali dihapus, Anda tidak akan dapat memulihkan transaksi ini!",
                      icon: "warning",
                      buttons: {
                        cancel: {
                          text: "Batal",
                          value: null,
                          visible: true,
                          className: "btn btn-secondary",
                        },
                        confirm: {
                          text: "Hapus",
                          value: true,
                          className: "btn btn-danger",
                        },
                      },
                    }).then(function(willDelete) {
                      // If user confirms deletion, submit the form
                      if (willDelete) {
                        // Find the form element and submit it
                        var formElement = document.querySelector("form[action='{{ route('laporanTransaksiMasuk.delete', $d->ID) }}']");
                        formElement.submit();
                      }
                    });
                  }

                  // Function to display SweetAlert success message after successful deletion
                  @if(session('success'))
                  swal({
                    title: "Berhasil!",
                    text: "Data berhasil dihapus.",
                    icon: "success",
                    buttons: {
                      confirm: {
                        text: "OK",
                        value: true,
                        className: "btn btn-success"
                      }
                    }
                  });
                  @endif
                </script>


                <!-- FORM ADD COA -->
                <div class="modal fade" id="myModal{{ $d->ID }}">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <form method="post" action="{{ route('laporanTransaksiMasuk.update', $d->ID) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                          <h4 class="modal-title">Update Data Laporan</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group row">
                            <label for="tanggal" class="col-sm-3 col-form-label">Tanggal:</label>
                            <div class="col-sm-8">
                              <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ \Carbon\Carbon::parse($d->TANGGAL)->format('Y-m-d') }}" required>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="nama_coa" class="col-sm-3 col-form-label">Nama COA:</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="debit" name="debit" value="{{ old('debit', $d->NAMA_COA) }}" disabled required>
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
                            <input type="number" class="form-control" id="nominal" name="nominal" placeholder="0" value="{{ old('nominal') ?? ($d->DEBET ?? '') }}" required>
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
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



@endsection