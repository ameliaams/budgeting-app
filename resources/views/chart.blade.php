@extends('layouts.main')

@section('title', 'CHART')

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
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
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- BAR CHART -->
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
                <div class="chart">
                  <canvas id="barChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (RIGHT) -->
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
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- BAR CHART -->
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
                <div class="chart">
                  <canvas id="barChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

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
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
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

    var barChartCanvas1 = $('#barChart1').get(0).getContext('2d');
    var data2 = {!! json_encode($dataArray) !!};
    var namaCoa2 = data2.map(item => item.NAMA_COA);
    var realisasi2 = data2.map(item => item.REALISASI);

    var barChartData1 = {
        labels: namaCoa2,
        datasets: [
            {
                label: 'Pemasukkan',
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

    var barChartOptions1 = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
    };

    new Chart(barChartCanvas1, {
        type: 'bar',
        data: barChartData1,
        options: barChartOptions1
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
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
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
