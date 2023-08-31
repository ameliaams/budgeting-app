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
      <!-- left column -->
      <div class="col-md-8 mx-auto">
        <!-- general form elements -->
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Laporan Total Kas</h3>
          </div>
          <form action="{{ route('rab.index') }}" method="get">
            @csrf
            <div class="card-body">
              <div class="form-group row">
                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                <div class="col-sm-10">
                <select class="form-control" id="tahun" name="tahun">
                  @foreach ($dropdownOptionsTahun as $option)
                      <option value="{{ $option->ID }}"
                      @if ($option->ID == old('tahun', $option->ID))
                          selected="selected"
                      @endif>
                      {{ $option->NAMA_BULAN }} - {{ $option->TAHUN }}</option>
                  @endforeach
                  </select>
                </div>
              </div>
              <div class="card-footer text-center">
                <button type="submit" class="btn btn-warning w-100">Cari</button>
              </div>
            </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">MASTER RAB</h3>
            <button id="reloadButton" class="btn btn-primary float-right">
    Sync
</button>
          </div>
          </form>
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

  // reload button
  const tahunSelect = document.getElementById('tahun');
    const reloadButton = document.getElementById('reloadButton');

    tahunSelect.addEventListener('change', function () {
        const selectedTahun = tahunSelect.value;
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('tahun', selectedTahun);
        
        // Update the URL and reload the page
        window.location.href = currentUrl;
    });

    reloadButton.addEventListener('click', function () {
        // Reload the page
        window.location.reload();
    });
</script>

@endsection