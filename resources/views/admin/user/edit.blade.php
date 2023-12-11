@extends('layouts.master')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            {{-- header konten --}}
            <div class="page-header">
                <!-- ... (konten yang sudah ada) ... -->
            </div>
            {{-- header konten --}}

            {{-- formulir --}}
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Pengguna</h4><br>
                            <form method="POST" action="{{ route('updateUser', $tbl_users->id) }}">
                                @csrf
                                <!-- @method('') -->

                                <!-- Nama Lengkap -->
                                <div class="form-group">
                                    <label for="name">Nama Lengkap:</label>
                                    <input type="text" name="name" class="form-control" value="{{ $tbl_users->name }}" required>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" class="form-control" value="{{ $tbl_users->email }}" required>
                                </div>

                                <!-- Peran -->
                                <div class="form-group">
                                    <label for="role">Peran:</label>
                                    <select name="role" class="form-control" required>
                                        <option value="admin" {{ $tbl_users->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="manager" {{ $tbl_users->role == 'manager' ? 'selected' : '' }}>Manajer</option>
                                        <option value="employee" {{ $tbl_users->role == 'employee' ? 'selected' : '' }}>Karyawan</option>
                                    </select>
                                </div>

                                <!-- Sandi (opsional) -->
                                <div class="form-group">
                                    <label for="password">Sandi:</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <!-- Konfirmasi Sandi (opsional) -->
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Sandi:</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>

                                <button href="{{ route('updateUser', $tbl_users->id) }}" type="submit" class="btn btn-gradient-primary me-2">Perbarui</button>
                                <a href="{{ route('cancelEdit') }}" class="btn btn-light">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- formulir --}}
        </div>
    </div>
@endsection
