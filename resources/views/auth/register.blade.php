<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name') }} - Register</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../node_modules/selectric/public/selectric.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container-fluid">
                <div class="row" style="background: linear-gradient(to right, #f4f4f4 50%, #fff 50%);">
                    <div class="col-md-6 d-flex flex-column justify-content-center my-5">
                        <div class="col-md-11 mx-auto">
                            <div>
                                <h1 class="font-weight-bold" style="color: black">Selamat Datang!</h1>
                                <p style="width: 80%;">Yuk, daftarkan diri Anda segera untuk mendapatkan banyak
                                    rekomendasi sesuai dengan minat bakat Anda</p>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="first_name" class="font-weight-bold">Nama Lengkap</label>
                                        <input id="first_name" type="text" name="name" value="{{ old('name') }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Masukkan nama lengkap" autofocus style="border-radius: 15px;">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="font-weight-bold">Email</label>
                                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Masukkan alamat email anda" style="border-radius: 15px;">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="d-block font-weight-bold">Kata Sandi</label>
                                        <div class="input-group">
                                            <input id="password" type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Masukkan kata sandi" data-indicator="pwindicator"
                                                style="border-right: none; border-radius: 15px 0px 0px 15px;">
                                            <div class="input-group-append">
                                                <div class="input-group-text toggle-password" id="password-toggle"
                                                    style="border-left: none; border-radius: 0px 15px 15px 0px;">
                                                    <i class="fa fa-eye-slash"></i>
                                                </div>
                                            </div>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation" class="d-block font-weight-bold">Konfirmasi
                                            Kata Sandi</label>
                                        <div class="input-group">
                                            <input id="password_confirmation" name="password_confirmation"
                                                type="password" class="form-control"
                                                placeholder="Masukkan konfirmasi kata sandi"
                                                style="border-right: none; border-radius: 15px 0px 0px 15px;">
                                            <div class="input-group-append">
                                                <div class="input-group-text toggle-password" id="password-toggle"
                                                    style="border-left: none; border-radius: 0px 15px 15px 0px;">
                                                    <i class="fa fa-eye-slash"></i>
                                                </div>
                                            </div>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="user_type" class="font-weight-bold">Daftar sebagai:</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="user_type"
                                                id="pencari_kerja" value="pencari_kerja"
                                                @if (old('user_type') === 'pencari_kerja') checked @endif>
                                            <label class="form-check-label" for="pencari_kerja">Pencari Kerja</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="user_type"
                                                id="perusahaan" value="perusahaan"
                                                @if (old('user_type') === 'perusahaan') checked @endif>
                                            <label class="form-check-label" for="perusahaan">Perusahaan</label>
                                        </div>
                                        @error('user_type')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block"
                                            style="border-radius: 15px;">
                                            Daftar
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="mt-2 text-muted text-center">
                                Sudah punya Akun? <a href="/login">Login kuy</a>
                                <p class="mt-2">Copyright &copy; 2023 Design By <a href="">Mustika Putri</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex flex-column align-items-center justify-content-start my-5">
                        <a href="/" class="img-fluid text-center" style="width: 50%; height: auto;">
                            <img class="img-fluid" src="{{ asset('assets/img/landing-page/logo.svg') }}"
                                alt="" style="width: 75%; height: auto;">
                        </a>
                        <img class="img-fluid mt-5" src="{{ asset('assets/img/landing-page/regis.svg') }}"
                            alt="">
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="../node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="../node_modules/selectric/public/jquery.selectric.min.js"></script>

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const togglePasswords = document.querySelectorAll(".toggle-password");
            const passwordInputs = document.querySelectorAll("input[type='password']");
            const passwordToggleWrappers = document.querySelectorAll("#password-toggle");

            togglePasswords.forEach((togglePassword, index) => {
                togglePassword.addEventListener("click", function() {
                    const passwordInput = passwordInputs[index];
                    if (passwordInput.type === "password") {
                        passwordInput.type = "text";
                        togglePassword.innerHTML = '<i class="fa fa-eye"></i>';
                    } else {
                        passwordInput.type = "password";
                        togglePassword.innerHTML = '<i class="fa fa-eye-slash"></i>';
                    }
                });

                passwordInputs[index].addEventListener("focus", function() {
                    passwordToggleWrappers[index].style.borderColor = "#808eec";
                });

                passwordInputs[index].addEventListener("blur", function() {
                    passwordToggleWrappers[index].style.borderColor = "#ecedf8";
                });
            });
        });
    </script>


    <!-- Page Specific JS File -->
    <script src="../assets/js/page/auth-register.js"></script>
</body>

</html>
