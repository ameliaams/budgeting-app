@extends('layouts.main')

@section('title', 'Edit Transaksi Keluar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Transaksi Keluar') }}</div>

                <div class="card-body">
                <form action="{{ route('updateTransaksiKeluar', ['id' => $transaction->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="kode_kwitansi">Kode Kwitansi</label>
                            <input type="text" class="form-control" id="kode_kwitansi" name="kode_kwitansi" value="{{ $transaction->KODE_KWITANSI }}" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $transaction->TANGGAL }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_coa">Nama COA</label>
                            <input type="text" class="form-control" id="nama_coa" name="nama_coa" value="{{ $transaction->NAMA_COA }}" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required>{{ $transaction->KETERANGAN }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="kredit">Nominal Kredit</label>
                            <input type="number" step="0.01" class="form-control" id="kredit" name="kredit" value="{{ $transaction->KREDIT }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
