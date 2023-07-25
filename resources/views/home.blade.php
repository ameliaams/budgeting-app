@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-8">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>01</h3>
                <p>Master COA</p>
              </div>
              <div class="icon">
              <i class="fas fa-chart-bar"></i>

              </div>
              <a href="/coa" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-8">
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
          <div class="col-lg-4 col-8">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>03</h3>
                <p>Master Tahun Anggaran</p>
              </div>
              <div class="icon">
              <i class="far fa-calendar-alt"></i>
              </div>
              <a href="/tahun" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
  
          <div class="col-lg-4 col-8">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>04</h3>
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
          <div class="col-lg-4 col-8">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>05</h3>
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
          <div class="col-lg-4 col-8">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>06</h3>
                <p>Laporan Realisai RAB</p>
              </div>
              <div class="icon">
              <i class="fas fa-file-alt"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
        
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection