@extends('layouts.main')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">MASTER COA</h3>
                <button type="submit" class="btn btn-default form-control float-right" style="width: 150px;">
                        Sync
                      </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">COA NUMBER</th>
                      <th>LEVEL</th>
                      <th>NAMA COA</th>
                      <th style="width: 40px">SALDO NORMAL</th>
                      <th>NOMINAL</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $d)
                    <tr class="{{ $d->LEVEL == 1 ? 'level-one-row' : '' }}" data-widget="expandable-table" aria-expanded="false">
                        <td>{{ $d->COA_NUMBER }}</td>
                        <td>{{ $d->LEVEL }}</td>
                        <td>{{ $d->NAMA_COA }}</td>
                        <td>{{ $d->SALDO_NORMAL }}</td>
                        <td class="editable" data-column="NOMINAL" data-id="{{ $d->ID }}">{{ $d->NOMINAL }}</td>
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
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const editableCells = document.querySelectorAll('.editable');
        editableCells.forEach((cell) => {
            cell.addEventListener('dblclick', function() {
                cell.contentEditable = true;
                cell.focus();
            });
            cell.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    const id = cell.getAttribute('data-id');
                    const column = cell.getAttribute('data-column');
                    const value = cell.textContent;
                    // Call the function to save the changes to the database using AJAX
                    saveData(id, column, value);
                    cell.contentEditable = false;
                }
            });
        });
    });
    function saveData(id, column, value) {
        fetch('/coa/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    id: id,
                    NOMINAL: value,
                }),
            })
            .then((response) => response.json())
            .then((data) => {
                // Handle the response from the server, if needed
                console.log(data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
</script>
@endsection