@extends('layouts.main')

@section('title', 'Master COA')

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
            <h3 class="card-title">MASTER COA</h3>
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
                  <form method="post" action="{{ route('coa.add') }}">
                    @csrf
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah Data COA</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group row">
                        <label for="kas" class="col-sm-2 col-form-label">Level 1</label>
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
                <th style="width: 50px">AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $d)
              <tr class="{{ isset($d->LEVEL) && $d->LEVEL == 1 ? 'level-one-row' : '' }}" data-widget="expandable-table" aria-expanded="false">
                <td>{{ isset($d->COA_NUMBER) ? $d->COA_NUMBER : '' }}</td>
                <td>{{ isset($d->NAMA_COA) ? $d->NAMA_COA : '' }}</td>
                <td>{{ isset($d->SALDO_NORMAL) ? $d->SALDO_NORMAL : '' }}</td>
                <td>
                  <!-- Delete Button -->
                  @if ($d->LEVEL != 1)
                  <form action="{{ route('coa.delete', $d->ID) }}" method="post" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete()">Hapus</button>
                  </form>
                  @endif

                  <!-- JavaScript -->
                  <script>
                    // Function to handle the delete confirmation using SweetAlert
                    function confirmDelete() {
                      swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this transaction!",
                        icon: "warning",
                        buttons: {
                          cancel: {
                            text: "Cancel",
                            value: null,
                            visible: true,
                            className: "btn btn-secondary",
                          },
                          confirm: {
                            text: "Delete",
                            value: true,
                            className: "btn btn-danger",
                          },
                        },
                      }).then(function(willDelete) {
                        // If user confirms deletion, submit the form
                        if (willDelete) {
                          // Find the form element and submit it
                          var formElement = document.querySelector("form[action='{{ route('coa.delete', $d->ID) }}']");
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