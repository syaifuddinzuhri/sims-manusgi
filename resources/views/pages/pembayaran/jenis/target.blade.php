<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('jenis.student.store', $id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="">Target</label>
                    <div>
                        <label for="all">Semua Siswa</label>
                        <input type="radio" class="form-radio" value="all" name="type" id="all"
                            {{ isset($data) && $data->target_type == 'all' ? 'checked' : '' }}>
                        <label for="class">Kelas</label>
                        <input type="radio" class="form-radio" value="class" name="type" id="class"
                            {{ isset($data) && $data->target_type == 'class' ? 'checked' : '' }}>
                        <label for="custom">Siswa Pilihan</label>
                        <input type="radio" class="form-radio" value="custom" name="type" id="custom"
                            {{ isset($data) && $data->target_type == 'custom' ? 'checked' : '' }}>
                    </div>
                    @include('components.form.error', ['name' => 'type'])
                </div>

                <div class="mb-3" style="display: none;" id="class-form-box">
                    <label for="class-form">Kelas</label>
                    <select class="class-select select2" multiple id="class-form" name="class_form[]"
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

                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i>
                    Simpan</button>
            </form>

        </div>
    </div>
</div>
