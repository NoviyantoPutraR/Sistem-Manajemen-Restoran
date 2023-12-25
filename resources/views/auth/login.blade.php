@push('scripts')
    <script>
        const passwordInput = document.getElementById('password');
        const showPasswordButton = document.getElementById('show-password');

        showPasswordButton.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>
@endpush

<head>
    <!-- Meta tag yang diperlukan -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <style>
        .text-purple {
            color: #bf77f6
        }
    </style>
    <!-- plugin:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css untuk halaman ini -->
    <!-- End plugin css untuk halaman ini -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Gaya layout -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End gaya layout -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo text-center">
                                <h2 class="text-purple font-weight-bold">SISTEM MANAJEMEN</h2>
                                <h2 class="text-purple font-weight-bold">RESTORAN</h2>
                            </div>
                            <h4 class="text-center">LOGIN</h4>
                            {{-- <h6 class="font-weight-light">Masuk untuk melanjutkan.</h6> --}}
                            <form class="pt-3" action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="email"
                                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}"
                                            placeholder="Email" required autocomplete="email" autofocus>
                                        <div class="input-group-append input-group-text">
                                            <span class="fa fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="password"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Kata Sandi" required
                                            autocomplete="current-password">
                                        <div class="input-group-append input-group-text">
                                            <span class="fa fa-lock"></span>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="submit"
                                            class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Masuk</button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="text-center">
                                {{-- @if (Route::has('password.request'))
                                    <p class="mb-2">
                                        <a href="{{ route('password.request') }}">Lupa Kata Sandi?</a>
                                    </p>
                                @endif --}}
                                @if (Route::has('register'))
                                    <p class="mb-0">
                                        Belum punya akun? <a href="{{ route('register') }}" class="text-primary">Daftar
                                            sekarang</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js untuk halaman ini -->
    <!-- End plugin js untuk halaman ini -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <!-- Script tambahan Anda di sini -->
    <!-- endinject -->
</body>
