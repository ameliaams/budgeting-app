@extends('layouts.main')

@section('title', 'Collapse Table')

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
              @foreach($data as $d)
              @if($d->PEMASUKAN == "")
              <tbody class="labels level-one-row">
                <tr >
                  <td colspan="4">
                    <label for="{{ $d->NAMA_BULAN }}">{{ $d->NAMA_BULAN }}</label>
                    <input type="checkbox" name="{{ $d->NAMA_BULAN }}" id="{{ $d->NAMA_BULAN }}" data-toggle="toggle">
                  </td>
                </tr>
              </tbody>
              @endif
              @if($d->KETERANGAN == "AWAL")
              <tbody class="hide">
                @endif
              @if($d->PEMASUKAN != "")
                <tr>
                  <td>{{ isset($d->BULAN) ? $d->BULAN : '' }}</td>
                  <td>{{ isset($d->NAMA_BULAN) ? $d->NAMA_BULAN : '' }}</td>
                  <td>{{ isset($d->PENGELUARAN) ? $d->PENGELUARAN : '' }}</td>
                  <td>{{ isset($d->PEMASUKAN) ? $d->PEMASUKAN : '' }}</td>
                </tr>
              @endif
              @if($d->KETERANGAN == "AKHIR")
              </tbody>
              @endif
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <script>
  $(document).ready(function() {
  $('[data-toggle="toggle"]').each(function() {
    $(this).prop('checked', true);
    $(this).parents().next('.hide').toggle();
  });
  $('[data-toggle="toggle"]').change(function() {
    $(this).parents().next('.hide').toggle();
  });
});
</script>
@endsection
