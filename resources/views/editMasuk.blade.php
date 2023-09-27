@extends('layouts.main')

@section('title', 'Update Transaksi Masuk')

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
                <h3 class="card-title">Update Transaksi Masuk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(!empty($results[0]))
              <form id="myForm" method="POST" action="{{ route('masuk.editData') }}">
                  @csrf
              <div class="card-body">
                <div class="form-group row">
                  <label for="id" class="col-sm-2 col-form-label">ID:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="id2" name="id2" readonly value="{{ old('id2', $results[0]->ID) }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="no_kwitansi" class="col-sm-2 col-form-label">No Kwitansi:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_kwitansi" name="no_kwitansi" placeholder="KW/M/../../.." readonly required value="{{ old('no_kwitansi', $results[0]->KODE_KWITANSI) }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="tanggal" class="col-sm-2 col-form-label">Tanggal:</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ \Carbon\Carbon::parse($results[0]->TANGGAL)->format('Y-m-d') }}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="kas" class="col-sm-2 col-form-label">Kas:</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="nama_kas" name="nama_kas" value="{{ old('nama_kas') ?? ($results[0]->NAMA_KAS ?? '') }}" required readonly>
                  </div>
                  <div class="col-sm-5">
                    <input type="hidden" class="form-control" id="kas" name="kas" value="{{ old('kas') ?? ($results[0]->ID_KAS ?? '') }}" required readonly>
                  </div>
                </div>


                <div class="form-group row">
                    <label for="no_ref" class="col-sm-2 col-form-label">No Ref:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_ref" name="no_ref" value="{{ old('no_ref') ?? ($results[0]->ID_COA ?? '') }}" required>
                    </div>
                </div>
               
                <!-- Bagian HTML -->
                <div id="repeater">
                  <div class="clearfix"></div>
                  <div class="table-responsive">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Nama COA</th>
                                  <th>Keterangan</th>
                                  <th>Nominal</th>
                              </tr>
                          </thead>
                        
                          <tbody data-group="programming_languages">
                            @foreach($results as $d)
                              <tr class="item">
                                  <td>
                                  <input type="text" class="form-control" name="id[]" value="{{ old('id[]', $d->ID) }}" required readonly>
                                  </td>
                                  <td>
                                    <input type="text" class="form-control" name="debet[]" value="{{ old('debet[]', $d->NAMA_COA) }}" required readonly>
                                  </td>
                                  <td>
                                      <input type="text" class="form-control" name="keterangan[]" value="{{ old('keterangan[]', $d->KETERANGAN) }}" required>
                                  </td>
                                  <td>
                                      <input type="text" class="form-control" name="nominal[]" value="{{ old('nominal[]', $d->NOMINAL) }}" required>
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>                          
                      </table>
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" id="SaveButton" class="btn btn-primary">Simpan</button>
                 <button type="button" id="deleteButton" class="btn btn-danger">Batal</button>
                 <a href="{{ route('masuk.print', $d->ID) }}" class="btn btn-primary float-right" style="width: 120px; border-radius: 20px; color: #FFF; background-color: #4169E1">
                    <i class="fa-solid fa-print"></i> Cetak
                </a>
              </div>
               </form>
                  @endif
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

  <script>
    document.getElementById("myForm").addEventListener("submit", function(event) {
      var noRefField = document.getElementById("no_ref");
      if (noRefField.value.trim() === "") {
          noRefField.value = ""; // Set a default value if needed
      }
    });
  </script>

@endsection