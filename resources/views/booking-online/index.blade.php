<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Online - Puskesmas Rancamalaka</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
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
    </style>
</head>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-4 p-5 form-container">
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show col-md" role="alert">
              <strong>{{ session('success') }}</strong> 
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show col-md" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="text-center">
                <div class="logo-container">
                    <img src="/img/logo.png" alt="Logo" width="100">
                </div>
                <h2 class="mb-3 text-custom-green">Booking Online</h2>
                <h3 class="mb-4 text-custom-green">Puskesmas Rancamalaka</h3>
            </div>
            <form method="post" action="{{ route('booking.checkNik') }}">
                @csrf
                <div class="mb-4">
                    <label for="nik" class="form-label fw-bold">NIK</label>
                    <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik" autofocus value="{{ old('nik') }}" placeholder="Masukkan NIK Anda">
                    @error('nik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="d-grid">
                    <button class="btn btn-custom-green text-white fw-bold py-2" type="submit">Lanjutkan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>