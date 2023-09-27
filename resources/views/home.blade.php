@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
    <div class="col-md-6">
            <!-- PIE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Pemasukan</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <!-- PIE CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Pengeluaran</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          
          <div class="col-lg-4 col-8 mx-auto">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>01</h3>
            <p>Master Kategori Transaksi</p>
          </div>
          <div class="icon">
            <i class="fas fa-chart-bar"></i>

          </div>
          <a href="/coa" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-8 mx-auto">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>02</h3>
            <p>Master RAB</p>
          </div>
          <div class="icon">
            <i class="fas fa-money-bill"></i>
          </div>
          <a href="/rab" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-4 col-8 mx-auto">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>03</h3>
            <p>Closing Bulanan</p>
          </div>
          <div class="icon">
            <i class="far fa-calendar-alt"></i>
          </div>
          <a href="/tahun" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-8 mx-auto">
        <!-- small box -->
        <div class="small-box bg-white">
          <div class="inner">
            <h3>04</h3>
            <p>Master Kas</p>
          </div>
          <div class="icon">
            <i class="fas fa-wallet"></i>
          </div>
          <a href="/kas" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-8 mx-auto">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>05</h3>
            <p>Transaksi Masuk</p>
          </div>
          <div class="icon">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <a href="/kasMasuk" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-4 col-8 mx-auto">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>06</h3>
            <p>Transaksi Keluar</p>
          </div>
          <div class="icon">
            <i class="fas fa-shopping-bag"></i>
          </div>
          <a href="/kasKeluar" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-4 col-8 mx-auto">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>07</h3>
            <p>Laporan Realisai RAB</p>
          </div>
          <div class="icon">
            <i class="fas fa-file-alt"></i>
          </div>
          <a href="/laporanRealisasi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-8 mx-auto">
        <!-- small box -->
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3>08</h3>
            <p>Laporan Transaksi Masuk</p>
          </div>
          <div class="icon">
            <i class="fas fa-arrow-down"></i>
          </div>
          <a href="laporanTransaksiMasuk" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-4 col-8 mx-auto">
        <!-- small box -->
        <div class="small-box bg-white">
          <div class="inner">
            <h3>09</h3>
            <p>Laporan Transaksi Keluar</p>
          </div>
          <div class="icon">
            <i class="fas fa-arrow-up"></i>
          </div>
          <a href="laporanTransaksiKeluar" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-8 mx-auto">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>10</h3>
            <p>Laporan Arus Kas</p>
          </div>
          <div class="icon">
          <i class="fas fa-chart-line"></i>

          </div>
          <a href="/arusKas" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-8 mx-auto">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>11</h3>
            <p>Laporan Total Kas</p>
          </div>
          <div class="icon">
          <i class="fas fa-calculator"></i>
          </div>
          <a href="/laporanTotalKas" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      
      <!-- ./col -->
       <!-- ./col -->
       <!-- <div class="col-lg-4 col-8 mx-auto">
        <div class="small-box bg-dark">
          <div class="inner">
            <h3>12</h3>
            <p>Ubah Password</p>
          </div>
          <div class="icon">
          <i class="fas fa-key"></i>

          </div>
          <a href="/ubah" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div> -->
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      

    </div>
    <!-- /.row (main row) -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
  $(function () {
    //-------------
    //- PEMASUKAN -
    //-------------
    var pieChartCanvas1 = $('#pieChart1').get(0).getContext('2d');
    var data1 = {!! json_encode($dataArray) !!};
    var namaCoa1 = data1.map(item => item.NAMA_COA);
    var realisasi1 = data1.map(item => item.REALISASI);

    var pieData1 = {
        labels: namaCoa1,
        datasets: [
            {
                data: realisasi1,
                backgroundColor: ['#f56954', '#00a65a', '#f39c12'],
            }
        ]
    };

    var pieOptions1 = {
        maintainAspectRatio: false,
        responsive: true,
    };

    new Chart(pieChartCanvas1, {
        type: 'pie',
        data: pieData1,
        options: pieOptions1
    });

    //-------------
    //- PENGEUARAN -
    //-------------
    var pieChartCanvas2 = $('#pieChart2').get(0).getContext('2d');
    var data2 = {!! json_encode($dataArray2) !!};
    var namaCoa2 = data2.map(item => item.NAMA_COA);
    var realisasi2 = data2.map(item => item.REALISASI);

    var pieData2 = {
        labels: namaCoa2,
        datasets: [
            {
                data: realisasi2,
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#451952', '#D2DE32', '#952323'],
            }
        ]
    };

    var pieOptions2 = {
        maintainAspectRatio: false,
        responsive: true,
    };

    new Chart(pieChartCanvas2, {
        type: 'pie',
        data: pieData2,
        options: pieOptions2
    });

    var barChartCanvas2 = $('#barChart2').get(0).getContext('2d');
    var data2 = {!! json_encode($dataArray2) !!};
    var namaCoa2 = data2.map(item => item.NAMA_COA);
    var realisasi2 = data2.map(item => item.REALISASI);

    var barChartData2 = {
        labels: namaCoa2,
        datasets: [
            {
                label: 'Pengeluaran',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: realisasi2
            }
        ]
    };

    var barChartOptions2 = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
    };

    new Chart(barChartCanvas2, {
        type: 'bar',
        data: barChartData2,
        options: barChartOptions2
    });

});
</script>
@endsection