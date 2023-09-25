@extends('layouts.main')

@section('title', 'Transaksi Masuk')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8 mx-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Transaksi Masuk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="repeater_form" action="{{ route('masuk.simpanData') }}" method="post">
                @csrf
              <div class="card-body">
                <div class="form-group row">
                  <label for="id" class="col-sm-2 col-form-label">ID:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="id" name="id" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="no_kwitansi" class="col-sm-2 col-form-label">No Kwitansi:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_kwitansi" name="no_kwitansi" placeholder="KW/M/../../.." readonly required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="tanggal" class="col-sm-2 col-form-label">Tanggal:</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="kas" class="col-sm-2 col-form-label">Kas:</label>
                  <div class="col-sm-5">
                    <!-- Second Dropdown (Kas) -->
                    <select class="custom-select form-control-border" id="kas" name="kas" required>
                      @foreach ($dropdownOptionsKas as $option)
                        <option value="{{ $option->ID }}">{{ $option->NAMA_KAS }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                    <label for="no_ref" class="col-sm-2 col-form-label">No Ref:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_ref" name="no_ref">
                    </div>
                </div>
               
                <!-- Bagian HTML -->
                <div id="repeater">
    <div class="repeater-heading" style="text-align: right;">
        <button type="button" class="btn btn-success repeater-add-btn">Tambah Coa <i class="fa-solid fa-circle-plus"></i></button>
    </div>
    <div class="clearfix"></div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Nama COA</th>
                    <th>Keterangan</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody data-group="programming_languages">
                <tr class="item">
                    <td>
                        <button class="btn btn-danger remove-btn" onclick="$(this).parents('tr').remove()">Hapus</button>
                    </td>
                    <td>
                        <select class="custom-select form-control-border" name="debet[]" required>
                            @foreach ($dropdownOptionsCoa as $result)
                                <option value="{{ $result->ID }}">{{ $result->NAMA_COA }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="keterangan[]" required>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="nominal[]" required>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

              <!-- /.card-body -->
              <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" id="deleteButton" class="btn btn-danger">Batal</button>
                            </div>
                        </form>
                        <script>
                            document.getElementById("myForm").addEventListener("submit", function(event) {
                                // Check if the No Ref field is empty
                                var noRefField = document.getElementById("no_ref");
                                if (noRefField.value.trim() === "") {
                                    // If it's empty, set a default value (or you can choose to leave it empty)
                                    noRefField.value = "";
                                }
                            });
                        </script>

             <!-- Tampilan SweetAlert -->
              @if (session('success'))
                  <!-- Link eksternal untuk SweetAlert -->
                  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

                  <script>
                      // Tampilkan alert pesan sukses saat halaman dimuat
                      document.addEventListener('DOMContentLoaded', function() {
                        swal({
                        title: "Data Berhasil Disimpan!",
                        text: "",
                        icon: "success",
                        buttons: {
                          confirm: {
                            text: "OK",
                            value: true,
                            className: "btn btn-success"
                          }
                        }
                      });
                      });
                  </script>
              @endif
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


    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Add COA row
    $('.repeater-add-btn').click(function () {
        var newRow = $('.item:first').clone();
        newRow.find("input[type='text']").val(""); // Clear input values in the cloned row
        newRow.find("select").val(""); // Clear select value in the cloned row
        $(newRow).appendTo('tbody[data-group="programming_languages"]');
    });

    // Remove COA row
    $('tbody[data-group="programming_languages"]').on('click', '.remove-btn', function () {
        $(this).closest('tr').remove();
    });
});
</script>

@endsection