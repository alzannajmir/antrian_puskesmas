<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Online - Puskesmas Rancamalaka</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/img/logo.png" />
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-image: url('/img/backgroung-booking.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
            height: 100vh;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 0;
        }

        .text-custom-green {
            color: #2ecc71;
        }

        .border-custom-green {
            border-color: #2ecc71 !important;
        }

        .btn-custom-green {
            background-color: #2ecc71;
            border-color: #2ecc71;
            transition: all 0.3s ease;
        }

        .btn-custom-green:hover {
            background-color: #27ae60;
            border-color: #27ae60;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(46, 204, 113, 0.3);
        }

        .vh-100 {
            position: relative;
            z-index: 1;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            transition: all 0.3s ease;
        }

        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
        }

        .form-control, .form-select {
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #2ecc71;
            box-shadow: 0 0 0 0.2rem rgba(46, 204, 113, 0.25);
        }

        .form-control:focus {
            border-color: #2ecc71;
            box-shadow: 0 0 0 0.2rem rgba(46, 204, 113, 0.25);
        }

        .logo-container {
            background-color: #fff;
            border-radius: 50%;
            padding: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            margin-bottom: 20px;
        }

        h2, h3 {
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        @media (max-width: 767px) {
            body {
                height: 100%;
                min-height: 100vh;
                background-size: cover;
                background-position: center;
            }

            body::before {
                height: 100%;
                min-height: 100vh;
            }

            .vh-100 {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-5 p-5 form-container">
            <div class="text-center">
                <div class="logo-container">
                    <img src="/img/logo.png" alt="Logo" width="100">
                </div>
                <h2 class="mb-3 text-custom-green">Booking Online</h2>
                <h3 class="mb-4 text-custom-green">Puskesmas Rancamalaka</h3>
            </div>
            <form method="post" action="{{ route('booking.submit') }}">
                @csrf
                <input type="hidden" name="nik" value="{{ $pasien->no_ktp }}">
                <div class="mb-3">
                    <label for="layanan_id" class="form-label fw-bold">Poli</label>
                    <select class="form-select border-custom-green" name="layanan_id" id="layanan_id" required>
                        <option value="">Pilih Poli</option>
                        @foreach($layanans as $layanan)
                            <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal_booking" class="form-label fw-bold">Tanggal Booking</label>
                    <input type="date" class="form-control border-custom-green" name="tanggal_booking" id="tanggal_booking" required>
                </div>
                <div class="mb-3">
                    <label for="tipe_pasien" class="form-label fw-bold">Tipe Pasien</label>
                    <select class="form-select border-custom-green" name="tipe_pasien" id="tipe_pasien" required>
                        <option value="UMUM">UMUM</option>
                        <option value="BPJS">BPJS</option>
                    </select>
                </div>
                <div class="mb-3" id="bpjs_number_field" style="display:none;">
                    <label for="no_bpjs" class="form-label fw-bold">Nomor BPJS</label>
                    <input type="text" class="form-control border-custom-green" name="no_bpjs" id="no_bpjs">
                </div>
                <div class="d-grid">
                    <button class="btn btn-custom-green text-white fw-bold py-2" type="submit">Submit Booking</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            var tomorrowFormatted = tomorrow.toISOString().split('T')[0];
            $('#tanggal_booking').attr('min', tomorrowFormatted);

            $('#layanan_id').change(function() {
                var layananId = $(this).val();
                if (layananId) {
                    $.ajax({
                        url: '{{ route("booking.getDokters") }}',
                        type: 'GET',
                        data: { layanan_id: layananId },
                        success: function(data) {
                            $('#dokter_id').empty();
                            $('#dokter_id').append('<option value="">Pilih Dokter</option>');
                            $.each(data, function(key, value) {
                                $('#dokter_id').append('<option value="' + value.id + '">' + value.nama_dokter + '</option>');
                            });
                        }
                    });
                } else {
                    $('#dokter_id').empty();
                    $('#dokter_id').append('<option value="">Pilih Dokter</option>');
                }
            });
            $('#tipe_pasien').change(function() {
                if ($(this).val() == 'BPJS') {
                    $('#bpjs_number_field').show();
                    $('#no_bpjs').prop('required', true);
                } else {
                    $('#bpjs_number_field').hide();
                    $('#no_bpjs').prop('required', false);
                }
            });
        });
    </script>
</body>
</html>