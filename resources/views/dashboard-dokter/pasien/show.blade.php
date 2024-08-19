@extends('dashboard-dokter.layouts.main')

@section('container')
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-info text-white me-2">
        <i class="mdi mdi-account-multiple"></i>
      </span> Registrasi Pasien
    </h3> 
  </div>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="clearfix">
            <h4 class="card-title float-left">{{ $pasien->no_rm . ' - ' .  $pasien->nama }}</h4>
          </div>
          
          <div class="row">
            <div class="col-md-2">
                <img src="/vendors/assets/images/faces/face1.jpg" alt="profile" class="img-fluid rounded">
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                      Data Pasien {{ $pasien->nama }}
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item"><strong>Nama : </strong> {{ $pasien->nama }}</li>
                      <li class="list-group-item"><strong>No HP : </strong> {{ $pasien->no_hp }}</li>
                      <li class="list-group-item"><strong>No KTP : </strong> {{ $pasien->no_ktp }}</li>
                      <li class="list-group-item"><strong>Tanggal Lahir : </strong> {{ $pasien->ttl }}</li>
                      <li class="list-group-item"><strong>Jenis Kelamin : </strong> {{ $pasien->jenis_kelamin }}</li>
                      <li class="list-group-item"><strong>Agama : </strong> {{ $pasien->agama }}</li>
                      <li class="list-group-item"><strong>Status : </strong> {{ $pasien->status }}</li>
                      <li class="list-group-item"><strong>Alamat : </strong> {{ $pasien->alamat }}</li>
                      <li class="list-group-item"><strong>Pendidikan : </strong> {{ $pasien->pendidikan }}</li>
                      <li class="list-group-item"><strong>Pekerjaan : </strong> {{ $pasien->pekerjaan }}</li>
                      <li class="list-group-item"><strong>Penanggung Jawab : </strong> {{ $pasien->pj }}</li>
                      <li class="list-group-item"><strong>No Penanggung Jawab : </strong> {{ $pasien->no_pj }}</li>
                    </ul>
                </div>
                <a href="/dashboard-dokter/pasien" class="btn btn-sm btn-success mt-2"> Kembali <i class="mdi mdi-exit-to-app"></i>  </a>
            </div>
            <div class="col-md-5">
                <!-- You can add additional information or another card here if needed -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if ( $registrasi->keterangan === 'Pendaftaran')
  <div class="row mt-4">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Rekam Medis</h4>
          <form action="/dashboard-dokter/pasien/{{ $pasien->id }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="tanggal_periksa">Tanggal Periksa</label>
              <input type="date" class="form-control" id="tanggal_periksa" name="tanggal_periksa" value="{{ $rekamMedis->tanggal_periksa ?? '' }}">
            </div>
            <div class="form-group">
              <label for="keluhan">Keluhan</label>
              <input type="text" class="form-control" id="keluhan" name="keluhan" value="{{ $rekamMedis->keluhan ?? '' }}">
            </div>
            <div class="form-group">
              <label for="diagnosis">Diagnosis</label>
              <input type="text" class="form-control" id="diagnosis" name="diagnosis" value="{{ $rekamMedis->diagnosis ?? '' }}">
            </div>
            <div class="form-group">
              <label for="terapi">Terapi</label>
              <input type="text" class="form-control" id="terapi" name="terapi" value="{{ $rekamMedis->terapi ?? '' }}">
            </div>
            <div class="form-group">
              <label for="catatan">Catatan</label>
              <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ $rekamMedis->catatan ?? '' }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Rekam Medis</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endif
@endsection