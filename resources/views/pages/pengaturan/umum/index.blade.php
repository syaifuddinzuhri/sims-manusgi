@extends('layouts.app')

@section('title', 'Pengaturan Umum')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>
                    Pengaturan Umum
                </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">
                        Pengaturan Umum
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('umum.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="app_name">Nama Aplikasi</label>
                                    <input type="text" name="app_name" id="app_name" class="form-control"
                                        placeholder="Masukkan nama aplikasi"
                                        value="{{ $setting ? $setting->app_name : '' }}">
                                    @include('components.form.error', ['name' => 'app_name'])
                                </div>
                                <div class="form-group">
                                    <label for="school_name">Nama Sekolah</label>
                                    <input type="text" name="school_name" id="school_name" class="form-control"
                                        placeholder="Masukkan nama sekolah"
                                        value="{{ $setting ? $setting->school_name : '' }}">
                                    @include('components.form.error', ['name' => 'school_name'])
                                </div>
                                <div class="form-group">
                                    <label for="app_footer">Footer Aplikasi</label>
                                    <input type="text" name="app_footer" id="app_footer" class="form-control"
                                        placeholder="Masukkan footer" value="{{ $setting ? $setting->app_footer : '' }}">
                                    @include('components.form.error', ['name' => 'app_footer'])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Masukkan email" value="{{ $setting ? $setting->email : '' }}">
                                    @include('components.form.error', ['name' => 'email'])
                                </div>
                                <div class="form-group">
                                    <label for="phone">Nomor HP</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        placeholder="Masukkan nomor HP" value="{{ $setting ? $setting->phone : '' }}">
                                    @include('components.form.error', ['name' => 'phone'])
                                </div>
                                <div class="form-group">
                                    <label for="address" class="required">Alamat</label>
                                    <textarea name="address" id="address" class="form-control" style="min-height: 100px"
                                        placeholder="Masukkan keterangan">{{ $setting ? $setting->address : '' }}</textarea>
                                    @include('components.form.error', ['name' => 'address'])
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i>
                            Simpan</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection
