@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Rancangan Anggaran Belanja') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>COA Number</th>
                                <th>Level</th>
                                <th>Nama COA</th>
                                <th>Saldo Normal</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->COA_NUMBER }}</td>
                                <td>{{ $d->LEVEL }}</td>
                                <td>{{ $d->NAMA_COA }}</td>
                                <td>{{ $d->SALDO_NORMAL }}</td>
                                <td class="editable" data-column="NOMINAL" data-id="{{ $d->ID }}">{{ $d->NOMINAL }}</td>
                                <!-- Display more columns as needed -->
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

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
        fetch('/home/update', {
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