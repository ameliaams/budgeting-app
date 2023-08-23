@extends('layouts.main')

@section('title', 'Master RAB')

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
            <h3 class="card-title">MASTER RAB</h3>
            <form method="post" action="{{ route('rab.sync') }}">
              @csrf
              <button type="submit" id="syncButton" class="btn form-control float-right" style="width: 120px; border-radius: 20px; color: #FFF; background-color: #4169E1">
                <i class="fas fa-arrows-rotate"></i> Sync
              </button>
            </form>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead style="text-align: center;">
                <tr>
                  <th style="width: 10px">COA NUMBER</th>
                  <th>NAMA COA</th>
                  <th style="width: 40px">SALDO NORMAL</th>
                  <th>NOMINAL</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                <tr class="{{ isset($d->LEVEL) && $d->LEVEL == 1 ? 'level-one-row' : ($d->LEVEL == '' ? 'level-null' : '') }}" data-widget="expandable-table" aria-expanded="false">
                  <td>{{ isset($d->COA_NUMBER) ? $d->COA_NUMBER : '' }}</td>
                  <td>{{ isset($d->NAMA_COA) ? $d->NAMA_COA : '' }}</td>
                  <td>{{ isset($d->SALDO_NORMAL) ? $d->SALDO_NORMAL : '' }}</td>
                  <td class="editable" data-column="NOMINAL" data-id="{{ isset($d->ID) ? $d->ID : '' }}" style="text-align: right;">
                      @money(isset($d->NOMINAL) ? $d->NOMINAL : '')
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
      </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const editableCells = document.querySelectorAll('.editable');

    editableCells.forEach((cell) => {
      cell.addEventListener('dblclick', function() {
        // Check if the parent row has the 'level-one-row' class (LEVEL = 1)
        const isLevelOneRow = cell.closest('tr').classList.contains('level-one-row');
        const isLevelNull = cell.closest('tr').classList.contains('level-null');

        if (!isLevelOneRow && !isLevelNull) {
          cell.contentEditable = true;
          cell.focus();
        }
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
    fetch('/rab/update', {
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
        // Handle the response from the server
        console.log(data);
      })
      .catch((error) => {
        console.error('Error:', error);
      });
  }

  // Sync Function
  document.getElementById('syncButton').addEventListener('click', function() {
    // Call the function to sync the data
    syncData();
  });

  function syncData() {
    // Perform the AJAX request to update the data
    fetch('/rab/update', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
      })
      .then((response) => response.json())
      .then((data) => {
        // Handle the response from the server
        if (data.success) {
          // Update successful
          // Refresh the table content
          const tableBody = document.querySelector('.table tbody');
          tableBody.innerHTML = '';

          data.data.forEach((d) => {
            const row = `
                            <tr class="${d.LEVEL == 1 ? 'level-one-row' : ''}">
                                <td>${d.COA_NUMBER}</td>
                                <td>${d.NAMA_COA}</td>
                                <td>${d.SALDO_NORMAL}</td>
                                <td class="editable" data-column="NOMINAL" data-id="${d.ID}">${d.NOMINAL}</td>
                            </tr>
                        `;
            tableBody.insertAdjacentHTML('beforeend', row);
          });
        } else {
          // Update failed
          console.error(data.message);
        }
      })
      .catch((error) => {
        console.error('Error:', error);
      });
  }
</script>
@endsection