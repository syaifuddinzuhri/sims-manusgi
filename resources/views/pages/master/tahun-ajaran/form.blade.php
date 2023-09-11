@extends('layouts.app')

@section('title', 'Tahun Ajaran')

@section('main')
    <div class="main-content">
        <section class="section">
            @include('components.section-header', ['title' => 'Tahun Ajaran'])
            <a href="{{ route('tahun-ajaran.index') }}" class="btn btn-sm btn-outline-dark mb-3"><i
                    class="fas fa-arrow-circle-left"></i>
                Kembali</a>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form
                                action="{{ isset($is_editing) && $is_editing ? route('tahun-ajaran.update', encryptData($data->id)) : route('tahun-ajaran.store') }}"
                                method="POST">
                                @csrf
                                @if (isset($is_editing) && $is_editing)
                                    @method('PUT')
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="semester" class="required">Semester</label>
                                            <select name="semester" id="semester" class="form-control select2">
                                                <option value="" disabled selected>-- Pilih Semester --</option>
                                                <option value="1">Ganjil</option>
                                                <option value="2">Genap</option>
                                            </select>
                                            @include('components.form.error', ['name' => 'semester'])
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="required">Semester</label>
                                    <div>
                                        <label for="ganjil">Ganjil</label>
                                        <input type="radio" class="form-radio" name="semester" id="ganjil">
                                        <label for="genap">Genap</label>
                                        <input type="radio" class="form-radio" name="semester" id="genap">
                                    </div>
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
