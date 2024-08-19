@extends('dashboard.layouts.main')

@section('container')
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-info text-white me-2">
        <i class="mdi mdi-ticket"></i>
      </span> Edit Data Pasien
    </h3> 
  </div>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="clearfix">
            <h4 class="card-title float-left">{{ $pasien[0]['no_rm'] . ' - ' .  $pasien[0]['nama'] }}</h4>
          </div>
          
          <div class="row">
            <div class="col-md-2">
                <img src="/vendors/assets/images/faces/face1.jpg" alt="profile" class="img-fluid rounded">
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                      Data Pasien {{ $pasien[0]['nama'] }}
                    </div>
                    <form action="/dashboard/pendaftaran-online/{{ $pasien[0]['id'] }}" method="post">
                      @method('put')
                      @csrf
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                          <strong>Nama : </strong>
                          <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama', $pasien[0]['nama']) }}" autofocus>
                        </li>
                        <li class="list-group-item">
                          <strong>No HP : </strong>
                          <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" id="no_hp" value="{{ old('no_hp', $pasien[0]['no_hp']) }}">
                        </li>
                        <li class="list-group-item">
                          <strong>No KTP : </strong>
                          <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" name="no_ktp" id="no_ktp" value="{{ old('no_ktp', $pasien[0]['no_ktp']) }}">
                        </li>
                        <li class="list-group-item">
                          <strong>Tanggal Lahir : </strong>
                          <input type="date" class="form-control @error('ttl') is-invalid @enderror" name="ttl" id="ttl" value="{{ old('ttl', $pasien[0]['ttl']) }}">
                        </li>
                        <li class="list-group-item">
                          <strong>Jenis Kelamin : </strong>
                          <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jk">
                            <option selected disabled>Pilih Jenis Kelamin</option>
                            @foreach (['Laki-laki', 'Perempuan'] as $j)
                              <option value="{{ $j }}" {{ $j == $pasien[0]['jenis_kelamin'] ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                          </select>
                        </li>
                        <li class="list-group-item">
                          <strong>Agama : </strong>
                          <select class="form-select @error('agama') is-invalid @enderror" name="agama" id="agama">
                            <option disabled selected>Pilih agama</option>
                            @foreach (['ISLAM', 'KRISTEN', 'HINDU', 'BUDHA', 'LAINNYA'] as $j)
                              <option value="{{ $j }}" {{ $j == $pasien[0]['agama'] ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                          </select>
                        </li>
                        <li class="list-group-item">
                          <strong>Status : </strong>
                          <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                            <option selected>Pilih Status</option>
                            @foreach (['Single', 'Berumah Tangga', 'Pelajar'] as $j)
                              <option value="{{ $j }}" {{ $j == $pasien[0]['status'] ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                          </select>
                        </li>
                        <li class="list-group-item">
                          <strong>Alamat : </strong>
                          <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" style="height: 100px">{{ old('alamat', $pasien[0]['alamat']) }}</textarea>
                        </li>
                        <li class="list-group-item">
                          <strong>Pendidikan : </strong>
                          <select class="form-select @error('pendidikan') is-invalid @enderror" name="pendidikan" id="pendidikan">
                            <option disabled selected>Pilih pendidikan</option>
                            @foreach (['SMA', 'S1', 'S2', 'S3', 'Lainnya'] as $j)
                              <option value="{{ $j }}" {{ $j == $pasien[0]['pendidikan'] ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                          </select>
                        </li>
                        <li class="list-group-item">
                          <strong>Pekerjaan : </strong>
                          <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan', $pasien[0]['pekerjaan']) }}">
                        </li>
                        <li class="list-group-item">
                          <strong>Penanggung Jawab : </strong>
                          <input type="text" class="form-control @error('pj') is-invalid @enderror" name="pj" id="pj" value="{{ old('pj', $pasien[0]['pj']) }}">
                        </li>
                        <li class="list-group-item">
                          <strong>No Penanggung Jawab : </strong>
                          <input type="text" class="form-control @error('no_pj') is-invalid @enderror" name="no_pj" id="no_pj" value="{{ old('no_pj', $pasien[0]['no_pj']) }}">
                        </li>
                      </ul>
                      <a href="/dashboard/pendaftaran-online" class="btn btn-sm btn-success mt-2"> Kembali <i class="mdi mdi-exit-to-app"></i>  </a>
                      <button type="submit" class="btn btn-sm btn-info mt-2">Simpan Data <i class="mdi mdi-content-save"></i></button>
                    </form>
                </div>
            </div>

            <div class="col-md">
                <div class="card">
                    <div class="card-header mb-3">
                      <strong>Informasi Layanan</strong> 
                    </div>
                    @if ($registrasi)
                      <div class="card-body">
                        <h5 class="card-title">Layanan yang Dipilih</h5>
                        <p class="card-text"><strong>Layanan:</strong> {{ $registrasi->layanan->nama_layanan }}</p>
                        <p class="card-text"><strong>Dokter:</strong> {{ $registrasi->dokter->nama_dokter }}</p>
                        <p class="card-text"><strong>Tipe Pasien:</strong> {{ $registrasi->tipe_pasien }}</p>
                        @if($registrasi->tipe_pasien == 'BPJS')
                          <p class="card-text"><strong>No BPJS:</strong> {{ $registrasi->no_bpjs }}</p>
                        @endif
                        <p class="card-text"><strong>Tanggal Booking:</strong> {{ $registrasi->tanggal_booking }}</p>
                      </div>
                    @else
                      <div class="alert alert-warning text-center" role="alert">
                        Informasi layanan tidak tersedia.
                      </div>
                    @endif
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection