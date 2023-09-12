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
                            <form action="{{ route('siswa.import.submit') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <p>Silahkan unduh format excel dibawah ini!</p>
                                <a href="{{ asset('files/template-siswa.xlsx') }}" target="_blank" class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-file-excel"></i>
                                    Format Excel
                                </a>
                                <div class="form-group mt-3">
                                    <label for="file" class="required">File</label>
                                    <input type="file" name="file" id="file" class="dropify"
                                        data-max-file-size="5M" data-allowed-file-extensions="xls xlsx csv">
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
