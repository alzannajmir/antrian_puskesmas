<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Puskesmas Rancamalaka</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="/img/logo.png" />
    <style>
        body {
            background-image: url('/img/background-login.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
            height: 100vh;
        }

        /* Layer Gelap */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .text-custom-green {
            color: #188a1a;
        }

        .border-custom-green {
            border-color: #188a1a !important;
        }

        .btn-custom-green {
            background-color: #188a1a;
            border-color: #188a1a;
        }

        .btn-custom-green:hover {
            background-color: #146c14;
            border-color: #146c14;
        }

        .vh-100 {
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-4 p-5 shadow-sm border rounded-5 border-custom-green bg-white">
            <h2 class="text-center mb-4 text-custom-green">Silahkan Login</h2>
            <div class="text-center mb-4">
                <img src="/img/logo.png" alt="Logo" width="100">
            </div>
            @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <form method="post" action="/login">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control bg-light bg-opacity-10 border border-custom-green @error('email') is-invalid @enderror" name="email" id="email" autofocus value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control bg-light bg-opacity-10 border border-custom-green @error('password') is-invalid @enderror" name="password" id="password">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <p class="small"><a class="text-custom-green" href="forget-password.html">Forgot password?</a></p>
                <div class="d-grid">
                    <button class="btn btn-custom-green text-white" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
