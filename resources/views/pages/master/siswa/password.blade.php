@extends('layouts.app')

@section('title', 'Password Siswa')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>
                    Form Password Siswa
                </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">
                        Form Password Siswa
                    </div>
                </div>
            </div>

            <a href="{{ route('siswa.index') }}" class="btn btn-sm btn-outline-dark mb-3"><i
                    class="fas fa-arrow-circle-left"></i>
                Kembali</a>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Ubah Password
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="password_old" class="required">Password Sekarang</label>
                                <input type="text" name="password_old" id="password_old" class="form-control"
                                    value="{{ decryptData($data->password_encrypted) }}" disabled readonly>
                            </div>
                            <form action="{{ route('siswa.password.submit', encryptData($data->id)) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="password" class="required">Password Baru</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Masukkan password baru">
                                    @include('components.form.error', ['name' => 'password'])
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation" class="required">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" placeholder="Masukkan konfirmasi password">
                                    @include('components.form.error', [
                                        'name' => 'password_confirmation',
                                    ])
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i>
                                    Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection
