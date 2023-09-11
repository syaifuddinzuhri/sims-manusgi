@extends('layouts.app')

@section('title', 'Kelas')

@section('main')
    <div class="main-content">
        <section class="section">
            @include('components.section-header', ['title' => 'Kelas'])
            <a href="{{ route('kelas.index') }}" class="btn btn-sm btn-outline-dark mb-3"><i
                    class="fas fa-arrow-circle-left"></i>
                Kembali</a>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form
                                action="{{ isset($is_editing) && $is_editing ? route('kelas.update', encryptData($data->id)) : route('kelas.store') }}"
                                method="POST">
                                @csrf
                                @if (isset($is_editing) && $is_editing)
                                    @method('PUT')
                                @endif

                                <div class="form-group">
                                    <label for="name" class="required">Kelas</label>
                                    <select name="name" id="name" class="form-control select2">
                                        <option value="" disabled selected>-- Pilih Tingkat Kelas --</option>
                                        <option value="X"  {{ isset($is_editing) && $is_editing && $data->name == "X" ? 'selected' : '' }}>X</option>
                                        <option value="XI"  {{ isset($is_editing) && $is_editing && $data->name == "XI" ? 'selected' : '' }}>XI</option>
                                        <option value="XII"  {{ isset($is_editing) && $is_editing && $data->name =="XII" ? 'selected' : '' }}>XII</option>
                                    </select>
                                    @include('components.form.error', ['name' => 'department_id'])
                                </div>
                                <div class="form-group">
                                    <label for="department_id" class="required">Jurusan</label>
                                    <select name="department_id" id="department_id" class="form-control select2">
                                        <option value="" disabled selected>-- Pilih Jurusan --</option>
                                        @foreach (departmentOptions() as $item)
                                            <option value="{{ $item['id'] }}"
                                                {{ isset($is_editing) && $is_editing && $data->department_id == $item['id'] ? 'selected' : '' }}>
                                                {{ $item['text'] }}</option>
                                        @endforeach
                                    </select>
                                    @include('components.form.error', ['name' => 'department_id'])
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
