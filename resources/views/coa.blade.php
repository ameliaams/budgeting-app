@extends('layouts.main')

@section('title', 'Master Kategori Transaksi')

@section('content')
<style>
  th {
    background-color: #778899;
  }
  @media screen and (max-width: 767px) {
    /* Aturan CSS untuk mobile di sini */
    table {
      font-size: 12px; /* Contoh perubahan ukuran font untuk mobile */
    }
  }
</style>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <!-- <h3 class="card-title">MASTER KATEGORI TRANSAKSI</h3> -->
            <form action="{{ route('coa.add') }}" id="addDataModal">
              @csrf
              <button type="button" class="btn btn-primary form-control float-right" data-toggle="modal" data-target="#myModal" style="width: 120px; border-radius: 20px; color: #FFF; background-color: #4169E1">
                <i class="fa-solid fa-plus"></i> Tambah
              </button>
            </form>

            <!-- FORM ADD COA -->
            <div class="modal fade" id="myModal">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <form id="myForm" method="post" action="{{ route('coa.add') }}">
                    @csrf
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah Data COA</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group row">
                        <label for="level" class="col-sm-2 col-form-label">Level 1</label>
                        <div class="col-sm-5">
                        <select class="custom-select form-control-border" id="level" name="level" required>
                            @foreach ($dropdownOptionsCoa as $result)
                            <option value="{{ $result->ID }}">{{ $result->NAMA_COA }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="kas" class="col-sm-2 col-form-label">Nama Akun</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" id="nama_akun" name="nama_akun" required>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" id="SaveButton" class="btn form-control float-right" style="width: 120px; border-radius: 20px; color: #FFF; background-color: #4169E1">
                          <i class="fa-solid fa-floppy-disk"></i> Simpan
                        </button>
                      </div>
                    </form>

                  <!-- ... bagian JavaScript SweetAlert ... -->
                  <script>
                  document.getElementById('SaveButton').addEventListener('click', function(event) {
                    event.preventDefault();

                    // Display SweetAlert for success
                    Swal.fire({
                      title: 'Berhasil!',
                      text: 'Data berhasil disimpan.',
                      icon: 'success'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        // If confirmed, submit the form
                        document.getElementById('myForm').submit();
                      }
                    });
                  });
                  </script>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead style="text-align: center;">
              <tr>
                <th style="width: 10px">COA NUMBER</th>
                <th>NAMA COA</th>
                <th style="width: 40px">SALDO NORMAL</th>
                <th style="width: 130px">AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $d)
              <tr class="{{ isset($d->LEVEL) && $d->LEVEL == 1 ? 'level-one-row' : ($d->LEVEL == '' ? 'level-null' : '') }}" data-widget="expandable-table" aria-expanded="false">
                <td>{{ isset($d->COA_NUMBER) ? $d->COA_NUMBER : '' }}</td>
                <td>{{ isset($d->NAMA_COA) ? $d->NAMA_COA : '' }}</td>
                <td>{{ isset($d->SALDO_NORMAL) ? $d->SALDO_NORMAL : '' }}</td>
                <td>
                  <!-- Delete Button -->
                  @if ($d->LEVEL != 1 && $d->LEVEL != '')
                  <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal{{ $d->ID }}">
                    Edit
                  </button>

                  <form action="{{ route('coa.delete', $d->ID) }}" method="post" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(event)">Delete</button>
                  </form>
                  @endif

                  <!-- ... bagian JavaScript SweetAlert ... -->
                  <script>
                    function confirmDelete(event) {
                      // Mencegah aksi default dari tombol "Delete"
                      event.preventDefault();

                      // Tampilkan SweetAlert dengan pesan konfirmasi delete
                      Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: 'Anda tidak dapat mengembalikan data ini setelah dihapus.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          // Jika konfirmasi "Ya" di-klik, submit form untuk menghapus data
                          event.target.closest('form').submit();
                          // Display a simple success message after successful submission
                        Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data berhasil dihapus.',
                                icon: 'success'
                              });
                        }
                      });
                    }
                  </script>
                  
                  <!-- FORM UPDATE COA -->
                  <div class="modal fade" id="myModal{{ $d->ID }}">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                      <form id="myForm{{ $d->ID }}" method="post" action="{{ route('coa.update', $d->ID) }}">
                          @csrf
                          @method('PUT')
                          <div class="modal-header">
                            <h4 class="modal-title">Update Master COA</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                              <div class="form-group row">
                                <label for="nama_coa" class="col-sm-3 col-form-label">Level 1</label>
                                <div class="col-sm-8">
                                      <input type="text" class="form-control" id="level" name="level" value="{{ old('level', $d->COA_HEADER ) }}" disabled>
                                </div>
                              </div>
                            <div class="form-group row">
                              <label for="nama_coa" class="col-sm-3 col-form-label">Nama COA:</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_akun" name="nama_akun" value="{{ old('nama_akun', $d->NAMA_COA) }}" required>
                              </div>
                            </div>
                            <div class="modal-footer">
                          <button type="submit" id="saveButtonUniqueID{{ $d->ID }}" class="btn form-control float-right SaveButton" style="width: 120px; border-radius: 20px; color: #FFF; background-color: #4169E1">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan
                          </button>
                        </div>
                      </form>

                     <!-- JavaScript SweetAlert -->
                     <script>
                        document.getElementById('saveButtonUniqueID{{ $d->ID }}').addEventListener('click', function(event) {
                          event.preventDefault();

                          // Display SweetAlert for confirmation
                          Swal.fire({
                            title: 'Konfirmasi',
                            text: 'Anda yakin ingin menyimpan data?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#4169E1',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, simpan',
                            cancelButtonText: 'Batal'
                          }).then((result) => {
                            if (result.isConfirmed) {
                              // If confirmed, submit the form
                              document.getElementById('myForm{{ $d->ID }}').submit();

                              // Display a simple success message after successful submission
                              Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data berhasil disimpan.',
                                icon: 'success'
                              });
                            }
                          });
                        });
                      </script>
                      </div>
                    </div>
                  </div>

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      <!-- /.card -->
    </div>
  </div>
  </div>
</section>
<!-- /.content -->
@endsection