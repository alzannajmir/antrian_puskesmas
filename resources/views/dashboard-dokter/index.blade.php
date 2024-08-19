@extends('dashboard-dokter.layouts.main')

@section('container')
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-info text-white me-2">
          <i class="mdi mdi-home"></i>
        </span> Dashboard Dokter
      </h3> 
    </div>
    <div class="row">
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
          <div class="card-body">
            <img src="/vendors/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Jumlah Dokter <i class="mdi mdi-account-multiple mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">{{ count($dokter) }} Orang</h2>
            <h6 class="card-text">Total Dokter Aktif</h6>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
            <img src="/vendors/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Jumlah Pasien Hari ini <i class="mdi mdi-account mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">{{ count($pasien) }} Orang</h2>
            <h6 class="card-text">Pasien Terdaftar Hari Ini</h6>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
          <div class="card-body">
            <img src="/vendors/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
            <h4 class="font-weight-normal mb-3"> Jumlah Antrian Hari ini <i class="mdi mdi-desktop-mac mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">{{ count($antrian) }} Antrian </h2>
            <h6 class="card-text">BPJS & Umum</h6>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Daftar Pasien Hari Ini</h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>No. </th>
                    <th>Nama Pasien</th>
                    <th>Jenis Layanan</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($pasien->take(5) as $p)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $p->pendaftaran->nama }}</td>
                      <td>{{ $p->layanan->nama_layanan }}</td>
                      <td><label class="badge badge-{{ $p->status ? 'success' : 'warning' }}">{{ $p->status ? 'Selesai' : 'Menunggu' }}</label></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Informasi Antrian</h4>
            <canvas id="antrianChart"></canvas>
            <div class="text-center mt-4">
              <h5>Total Antrian: {{ count($antrian) }}</h5>
              <p>BPJS: {{ $antrian->where('loket_id', '1')->count() }} | Umum: {{ $antrian->where('loket_id', '2')->count() }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      var ctx = document.getElementById('antrianChart').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['BPJS', 'Umum'],
          datasets: [{
            data: [{{ $antrian->where('loket_id', '1')->count() }}, {{ $antrian->where('loket_id', '2')->count() }}],
            backgroundColor: [
              'rgba(255, 99, 132, 0.8)',
              'rgba(54, 162, 235, 0.8)'
            ]
          }]
        }
      });
    </script>
@endsection