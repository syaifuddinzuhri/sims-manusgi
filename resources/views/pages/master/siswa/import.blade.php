@extends('layouts.app')

@section('title', 'Import Siswa')

@section('main')
    <div class="main-content">
        <section class="section">
            @include('components.section-header', ['title' => 'Import Siswa'])
            <a href="{{ route('siswa.index') }}" class="btn btn-sm btn-outline-dark mb-3"><i
                    class="fas fa-arrow-circle-left"></i>
                Kembali</a>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>Petunjuk Singkat</h6>
                            <hr>
                            <p class="mb-0">Data siswa bisa diimport melalui Excel memakai format XLS, atau XLSX.</p>
                            <p>Silahkan klik tombol dibawah ini untuk memperoleh format file.</p>
                            <a href="{{ asset('files/template-siswa.xlsx') }}" target="_blank"
                                class="btn btn-sm btn-outline-success">
                                <i class="fas fa-file-excel"></i>
                                Format Excel
                            </a>
                            <h6 class="mt-3">Catatan</h6>
                            <ul>
                                <li>Semua data wajib diisi</li>
                                <li>Pengisian data jenis <b>TANGGAL</b> wajib diisi dengan format <b>YYYY-MM-DD</b>,
                                    contohnya 2020-12-31</li>
                                <li>Jenis kelamin diisi dengan <b>L</b> atau <b>P</b> penulisan wajib sama persis</li>
                                <li>Data <b>Username</b> harus unik <b>(Tidak boleh ada data yang sama antar siswa)</b></li>
                                <li>Kolom <b>kelas</b> diisi sesuai dengan nama kelas masing-masing yang ada di menu <b>Data
                                        Master->Kelas</b></li>
                                <li>Kolom <b>jurusan</b> diisi sesuai dengan nama kelas masing-masing yang ada di menu
                                    <b>Data Master->Jurusan</b></li>
                            </ul>
                            <hr>
                            <form action="{{ route('siswa.import.submit') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mt-3">
                                    <label for="file" class="required">Upload File</label>
                                    <input type="file" name="file" id="file" class="dropify"
                                        data-max-file-size="5M" data-allowed-file-extensions="xls xlsx">
                                    @include('components.form.error', ['name' => 'file'])
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
