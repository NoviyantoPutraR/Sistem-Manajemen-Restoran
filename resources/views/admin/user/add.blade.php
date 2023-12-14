@extends('layouts.master')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            {{-- content header --}}
            <div class="page-header">
                <!-- ... (existing content) ... -->
            </div>
            {{-- content header --}}

            {{-- tabel --}}
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah User</h4><br>
                            <form action="{{ route('storeUser') }}" method="post">
                                @csrf

                                <!-- Full Name -->
                                <div class="form-group">
                                    <label for="name">Full Name:</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('full_name') }}" required>
                                    <!-- Tampilan pesan kesalahan -->
                                    @error('full_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror                                
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                </div>

                                <!-- Role -->
                                <div class="form-group">
                                    <label for="role">Role:</label>
                                    <select name="role" class="form-control" required>
                                        <option value="admin">Admin</option>
                                        <option value="manager">Manager</option>
                                        <option value="employee">Employee</option>
                                    </select>
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password:</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>

                                <button href="{{ route('storeUser') }}" type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                                <button type="button" class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- table --}}
            </div>
        </div>
    </div>
@endsection
