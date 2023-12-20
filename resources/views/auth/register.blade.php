

<head>
    <!-- Meta tag yang diperlukan -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
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
                            <p class="login-box-msg col-2">{{ __('Register') }}</p>
                            <form action="{{route('register')}}" method="post">
                                @csrf
                                
                                <div class="input-group mb-3">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Full name" name="name" value="{{ old('name') }}" required autocomplete="name"
                                    autofocus>
                                    <div class="input-group-append input-group-text">
                                        <span class="fa fa-user"></span>
                                    </div>
                                </div>
                                
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                                <div class="input-group mb-3">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{old('email')}}" placeholder="Email" required autocomplete="email">
                                    <div class="input-group-append input-group-text">
                                        <span class="fa fa-envelope"></span>
                                    </div>
                                </div>
                                
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                                <div class="input-group mb-3">
                                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                                        <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                                    </select>
                                    
                                    <div class="input-group-append input-group-text">
                                        <span class="fa fa-user"></span>
                                    </div>
                                
                                </div>
                                
                                @error('role')
                                
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                
                                @enderror
                                
                                <div class="input-group mb-3">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password" name="password" required autocomplete="new-password">
                                    <div class="input-group-append input-group-text">
                                        <span class="fa fa-lock"></span>
                                    </div>
                                </div>
                                
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                                <div class="input-group mb-3">
                                    <input id="password-confirm" type="password" class="form-control" placeholder="Retype password"
                                    name="password_confirmation" required autocomplete="new-password">
                                    <div class="input-group-append input-group-text">
                                        <span class="fa fa-lock"></span>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Register') }}</button>
                                    </div>
                <!-- /.col -->
                                </div>
                            </form>

                            @if (Route::has('login'))
                            <hr>
                            <p class="mb-0 text-center">
                                <a href="{{ route('login') }}" class="text-center">{{ __('Sudah punya akun? Login sekarang') }}</a>
                            </p>
                            @endif
                        </div>
    <!-- /.login-card-body -->
</div>
