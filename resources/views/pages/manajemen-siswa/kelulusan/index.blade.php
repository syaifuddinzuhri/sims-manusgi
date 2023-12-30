@extends('layouts.app')

@section('title', 'Kelulusan')

@section('main')
    <div class="main-content">
        <section class="section">
            @include('components.section-header', ['title' => 'Kelulusan', 'index' => true])
            <form action="{{ route('kelulusan.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="">Dari Kelas:</label>
                                    <div>
                                        <label for="class">Kelas</label>
                                        <input type="radio" class="form-radio" value="class" name="type"
                                            id="class"
                                            {{ isset($data) && $data->target_type == 'class' ? 'checked' : '' }}>
                                        <label for="custom">Siswa Pilihan</label>
                                        <input type="radio" class="form-radio" value="custom" name="type"
                                            id="custom"
                                            {{ isset($data) && $data->target_type == 'custom' ? 'checked' : '' }}>
                                    </div>
                                    @include('components.form.error', ['name' => 'type'])
                                </div>

                                <div class="mb-3" style="display: none;" id="class-form-box">
                                    <label for="class-form">Kelas</label>
                                    <select class="class-select select2" id="class-form" name="class_form"
                                        placeholder="Pilih kelas">
                                        @foreach (getClass() as $item)
                                            <option value="{{ $item['id'] }}"
                                                {{ isset($data) && $data->target_type == 'class' ? (array_key_exists($item['id'], $selected) == 1 ? 'selected' : '') : '' }}>
                                                {{ $item['text'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3" style="display: none;" id="student-form-box">
                                    <label for="student-form">Nama Siswa</label>
                                    <select class="student-select select2" multiple id="student-form" name="student_form[]">
                                        @foreach (getStudent() as $item)
                                            <option value="{{ $item['id'] }}"
                                                {{ isset($data) && $data->target_type == 'custom' ? (array_key_exists($item['id'], $selected) == 1 ? 'selected' : '') : '' }}>
                                                {{ $item['text'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="passed_year">Tahun Lulus</label>
                                    <select class="class-select select2" id="passed_year" name="passed_year"
                                        placeholder="Pilih tahun lulus">
                                        @foreach (yearOptions() as $item)
                                            <option value="{{ $item['id'] }}">
                                                {{ $item['text'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Simpan</button>
            </form>

        </section>
    </div>
@endsection

@section('scripts')
    <script>
        $("input[name='type']").change(function() {
            var selectedValue = $("input[name='type']:checked").val();
            if (selectedValue == 'class') {
                $('#class-form-box').show();
                $('#student-form-box').hide();
            } else if (selectedValue == 'custom') {
                $('#student-form-box').show();
                $('#class-form-box').hide();
            } else {
                $('#student-form-box').hide();
                $('#class-form-box').hide();
            }
        });
    </script>
@endsection
