@extends('layouts.main')

@section('title', 'Master COA')

@section('content')
<style>
  /* CSS untuk memberi warna pada header tabel */
  th {
    background-color: #32CD32; /* Ganti dengan warna yang Anda inginkan */
    /* tambahkan gaya lainnya seperti font-color, padding, dsb. sesuai kebutuhan */
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
              <button type="button" class="btn btn-primary form-control float-right" data-toggle="modal" data-target="#myModal" style="width: 120px; border-radius: 20px; color: #FFF; background-color: #fff">
              <i class="fa-solid fa-plus"></i> Tambah
              </button>
            </form>
            <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="myForm" action="{{ route('coa.add') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add COA</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group row">
                        <label for="kas" class="col-sm-2 col-form-label">Level 1</label>
                        <div class="col-sm-5">
                            <!-- Second Dropdown (Kas) -->
                            <select class="custom-select form-control-border" id="level" name="level" required>
    @foreach ($dropdownOptionsCoa as $result)
        <option value="{{ $result->ID }}">{{ $result->NAMA_COA }}</option>
    @endforeach
</select>


                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="coa" class="col-sm-2 col-form-label">Nama Akun</label>
                        <div class="col-sm-5">
                            <!-- Second Dropdown (Kas) -->
                            <input type="text" class="form-control" id="nama_akun" name="nama_akun" required>
                        </div>
                    </div>
                </div>
                <!-- /.modal-body -->

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-dismiss="modal">Simpan</button>
                    <button type="button" id="deleteButton" class="btn btn-danger" data-dismiss="modal">Hapus</button>
                </div>
            </form>
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
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                <tr class="{{ isset($d->LEVEL) && $d->LEVEL == 1 ? 'level-one-row' : '' }}" data-widget="expandable-table" aria-expanded="false">
                  <td>{{ isset($d->COA_NUMBER) ? $d->COA_NUMBER : '' }}</td>
                  <td>{{ isset($d->NAMA_COA) ? $d->NAMA_COA : '' }}</td>
                  <td>{{ isset($d->SALDO_NORMAL) ? $d->SALDO_NORMAL : '' }}</td>
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

<!-- Add Data Modal
<div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    
  </div>
</div> -->




<!-- Add this JavaScript code at the end of your Blade view -->
<script>
  $(document).ready(function() {
    // Add a click event listener to the "Tambah" button
    $('#addData').click(function() {
      // Show the add data modal
      $('#addDataModal').modal('show');
    });

    // If you want to reset the form when the modal is closed
    $('#addDataModal').on('hidden.bs.modal', function () {
      $('#myForm').trigger('reset');
    });
  });
</script>
<!-- JavaScript file -->
@endsection
