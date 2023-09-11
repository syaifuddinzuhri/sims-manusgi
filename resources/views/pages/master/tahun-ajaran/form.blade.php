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
                                            <label for="first_year" class="required">Tahun Awal</label>
                                            <select name="first_year" id="first_year" class="form-control select2">
                                                <option value="" disabled selected>-- Pilih Tahun Awal --</option>
                                                @foreach (yearOptions() as $item)
                                                    <option value="{{ $item['id'] }}"
                                                        {{ isset($is_editing) && $is_editing && $data->first_year == $item['id'] ? 'selected' : '' }}>
                                                        {{ $item['text'] }}</option>
                                                @endforeach
                                            </select>
                                            @include('components.form.error', ['name' => 'first_year'])
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_year" class="required">Tahun Akhir</label>
                                            <input type="text" name="last_year" id="last_year" class="form-control"
                                                readonly
                                                value="{{ isset($is_editing) && $is_editing ? $data->last_year : '' }}">
                                        </div>

                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="required">Semester</label>
                                    <div>
                                        <label for="ganjil">Ganjil</label>
                                        <input type="radio" class="form-radio" value="1" name="semester"
                                            id="ganjil"
                                            {{ isset($is_editing) && $is_editing && $data->semester == 1 ? 'checked' : '' }}>
                                        <label for="genap">Genap</label>
                                        <input type="radio" class="form-radio" value="2" name="semester"
                                            id="genap"
                                            {{ isset($is_editing) && $is_editing && $data->semester == 2 ? 'checked' : '' }}>
                                    </div>
                                    @include('components.form.error', ['name' => 'semester'])
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
    <script>
        $('#first_year').on('change', function() {
            var year = parseInt($(this).val());
            $('#last_year').val(year + 1);
        })
    </script>
@endsection
