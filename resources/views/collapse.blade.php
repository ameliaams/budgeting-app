@extends('layouts.main')

@section('title', 'Collapse Table')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered">
              <thead style="text-align: center;">
                <tr>
                  <th>BULAN</th>
                  <th>NAMA BULAN</th>
                  <th>PENGELUARAN</th>
                  <th>PEMASUKAN</th>
                </tr>
              </thead>
              <tbody>
              <tbody class="labels">
                @foreach($data as $d)
                @if($d->PEMASUKAN == "")
                <tr>
                  <td colspan="2">
                    <label for="{{ $d->NAMA_BULAN }}">{{ isset($d->NAMA_BULAN) ? $d->NAMA_BULAN : '' }}</label>
                    <input type="checkbox" name="{{ $d->NAMA_BULAN }}" id="{{ $d->NAMA_BULAN }}" data-toggle="toggle">
                  </td>
                </tr>
                @endif
</tbody>
                @if($d->PEMASUKAN != "")
                <tbody class="hide">
                <tr>
                  <td>{{ isset($d->BULAN) ? $d->BULAN : '' }}</td>
                  <td>{{ isset($d->NAMA_BULAN) ? $d->NAMA_BULAN : '' }}</td>
                  <td>{{ isset($d->PENGELUARAN) ? $d->PENGELUARAN : '' }}</td>
                  <td>{{ isset($d->PEMASUKAN) ? $d->PEMASUKAN : '' }}</td>
                </tr>
                @endif
                @endforeach
              </tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  $(document).ready(function() {
    $('[data-toggle="toggle"]').change(function() {
      $(this).parents('tr').next('tr.hide').toggle();
    });
  });
</script>
@endsection
