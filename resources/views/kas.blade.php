@extends('layouts.main')

@section('title', 'Master KAS')

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
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">MASTER KAS</h3>
            <form action="{{ route('kas.add') }}" id="addDataModal">
              @csrf
              <button type="button" class="btn btn-primary form-control float-right" data-toggle="modal" data-target="#myModal" style="width: 120px; border-radius: 20px; color: #FFF; background-color: #4169E1">
                <i class="fa-solid fa-plus"></i> Tambah
              </button>
            </form>

            <!-- FORM ADD COA -->
            <div class="modal fade" id="myModal">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <form method="post" action="{{ route('kas.add') }}">
                    @csrf
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah Data KAS</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group row">
                        <label for="kas" class="col-sm-3 col-form-label">Kode</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="kode" name="kode" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="kas" class="col-sm-3 col-form-label">Nama Kas</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="nama_kas" name="nama_kas" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="kas" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-8">
                          <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
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
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead style="text-align: center;">
              <tr>
                <th style="width: 10px">KODE</th>
                <th style="width: 200px">NAMA KAS</th>
                <th>KETERANGAN</th>
                <th style="width: 130px">AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $d)
              <tr data-widget="expandable-table" aria-expanded="false">
                <td>{{ isset($d->KODE) ? $d->KODE : '' }}</td>
                <td>{{ isset($d->NAMA_KAS) ? $d->NAMA_KAS : '' }}</td>
                <td>{{ isset($d->KETERANGAN) ? $d->KETERANGAN : '' }}</td>
                <td>
                  <!-- Edit Button -->
                  <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal{{ $d->ID }}">
                    Edit
                  </button>
                  <!-- Delete Button -->
                  <form action="{{ route('kas.delete', $d->ID) }}" method="post" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(event)">Delete</button>
                  </form>

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
                        }
                      });
                    }
                  </script>
                  
                  <!-- FORM UPDATE COA -->
                  <div class="modal fade" id="myModal{{ $d->ID }}">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <form method="post" action="{{ route('kas.update', $d->ID) }}">
                          @csrf
                          @method('PUT')
                          <div class="modal-header">
                            <h4 class="modal-title">Update Master KAS</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group row">
                              <label for="nama_coa" class="col-sm-3 col-form-label">KODE:</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="kode" name="kode" value="{{ old('kode', $d->KODE) }}" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="nama_coa" class="col-sm-3 col-form-label">Nama Kas:</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_kas" name="nama_kas" value="{{ old('nama_kas', $d->NAMA_KAS) }}" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="nama_coa" class="col-sm-3 col-form-label">Keterangan:</label>
                              <div class="col-sm-8">
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="4" required>{{ old('keterangan', $d->KETERANGAN) }}</textarea>
                              </div>
                            </div>
                            <div class="modal-footer">
                        <button type="submit" id="saveButtonUniqueID" class="btn form-control float-right SaveButton" style="width: 120px; border-radius: 20px; color: #FFF; background-color: #4169E1">
                          <i class="fa-solid fa-floppy-disk"></i> Simpan
                        </button>
                      </div>
                      </form>

                      <!-- Check for delete success and display the success message , masih tidak muncul-->
                @if(session('success'))
                <script>
                  Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    buttons: {
                      confirm: {
                        text: "OK",
                        value: true,
                        className: "btn btn-success"
                      }
                    }
                  });
                </script>
                @endif
                      </div>
                    </div>
                  </div>
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
      <!-- /.card -->
    </div>
  </div>
  </div>
</section>
<!-- /.content -->
@endsection