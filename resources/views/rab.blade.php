@extends('layouts.main')

@section('title', 'Master RAB')

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
                        @if ($option->ID == session('selected_tahun'))
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
            <button id="reloadButton" class="btn btn-primary float-right"><i class="fas fa-sync-alt"></i> Sync</button>
          </div>
          </form>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead style="text-align: center;">
                <tr>
                  <th style="width: 10px">COA NUMBER</th>
                  <th>NAMA COA</th>
                  <th>NOMINAL</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                <tr class="{{ isset($d->LEVEL) && $d->LEVEL == 1 ? 'level-one-row' : ($d->LEVEL == '' ? 'level-null' : '') }}" data-widget="expandable-table" aria-expanded="false">
                  <td>{{ isset($d->COA_NUMBER) ? $d->COA_NUMBER : '' }}</td>
                  <td>{{ isset($d->NAMA_COA) ? $d->NAMA_COA : '' }}</td>
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
      let originalValue; // To store the original value of the cell
      
      cell.addEventListener('dblclick', function() {
        // Check if the parent row has the 'level-one-row' class (LEVEL = 1)
        const isLevelOneRow = cell.closest('tr').classList.contains('level-one-row');
        const isLevelNull = cell.closest('tr').classList.contains('level-null');

        if (!isLevelOneRow && !isLevelNull) {
          cell.contentEditable = true;
          cell.focus();
          originalValue = cell.textContent; // Store the original value
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

      cell.addEventListener('blur', function() {
        if (originalValue !== cell.textContent) {
          const id = cell.getAttribute('data-id');
          const column = cell.getAttribute('data-column');
          const value = cell.textContent;

          // Call the function to save the changes to the database using AJAX
          saveData(id, column, value);
        }

        cell.contentEditable = false;
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
</script>

@endsection

@section('scripts')
<script>
  //reload button
       const reloadButton = document.getElementById('reloadButton');

reloadButton.addEventListener('click', function () {
    // Set the target tahun value based on your logic or condition
    const targetTahun = "9"; // Example: You can change this based on your logic

    // Get the value of the "tahun" parameter from the URL
    const tahunParam = new URLSearchParams(window.location.search).get('tahun');

    // Check if the "tahun" parameter matches the target tahun
    if (tahunParam === targetTahun) {
        // Refresh the page
        location.reload();
    } else {
        alert("This button can only be used for the specific tahun value.");
    }
        });

</script>
@endsection
