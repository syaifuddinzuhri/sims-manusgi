<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('jenis.student.store', encryptData($payment->id)) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="">Target</label>
                    <div>
                        <label for="all">Semua</label>
                        <input type="radio" class="form-radio" value="all" name="type" id="all"
                            {{ isset($payment) && $payment->type == 'all' ? 'checked' : '' }}>
                        <label for="class">Kelas</label>
                        <input type="radio" class="form-radio" value="class" name="type" id="class"
                            {{ isset($payment) && $payment->type == 'class' ? 'checked' : '' }}>
                        <label for="custom">Kustom</label>
                        <input type="radio" class="form-radio" value="custom" name="type" id="custom"
                            {{ isset($payment) && $payment->type == 'custom' ? 'checked' : '' }}>
                    </div>
                    @include('components.form.error', ['name' => 'type'])
                </div>

                <div class="mb-3" style="display: none;" id="class-form">
                    <label for="class-form">Kelas</label>
                    <select class="class-select" name="class_form[]" data-placeholder="Pilih kelas">
                        @if (isset($payment_detail) && count($payment_detail) > 0)
                            @foreach ($payment_detail as $item)
                                <option value="{{ $item['id'] }}" selected>{{ $item['text'] }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="mb-3" style="display: none;" id="custom-form">
                    <label for="search-form">Nama Siswa</label>
                    <select class="student-select" name="student_form[]" data-placeholder="Pilih siswa">
                    </select>
                </div>

                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i>
                    Simpan</button>
            </form>

        </div>
    </div>
</div>

@section('scripts')
    <script>
        var paymentTypeAll = "{{ isset($payment) && $payment->type == 'all' }}"
        var paymentTypeClass = "{{ isset($payment) && $payment->type == 'class' }}"
        var paymentTypeCustom = "{{ isset($payment) && $payment->type == 'custom' }}"

        // if (paymentTypeClass) {
        //     $('#class-form').show();
        //     $('#custom-form').hide();
        //     getClass();
        // }

        $("input[name='type']").change(function() {
            var selectedValue = $("input[name='type']:checked").val();
            if (selectedValue == 'class') {
                $('#class-form').show();
                $('#custom-form').hide();
                getClass();
            } else if (selectedValue == 'custom') {
                $('#custom-form').show();
                $('#class-form').hide();
                getStudent();
            } else {
                $('#custom-form').hide();
                $('#class-form').hide();
            }
        });

        function getClass() {
            $('.class-select').select2({
                minimumInputLength: 1,
                allowClear: true,
                multiple: true,
                ajax: {
                    url: `{{ route('api.class.index') }}`,
                    dataType: 'json',
                    type: "GET",
                    headers: {
                        'Authorization': 'Bearer ' + API_TOKEN
                    },
                    data: function(params) {
                        return {
                            keyword: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data
                        };
                    }
                }
            });
        }

        function getStudent() {
            $('.student-select').select2({
                minimumInputLength: 1,
                allowClear: true,
                multiple: true,
                ajax: {
                    url: `{{ route('api.student.index') }}`,
                    dataType: 'json',
                    type: "GET",
                    headers: {
                        'Authorization': 'Bearer ' + API_TOKEN
                    },
                    data: function(params) {
                        return {
                            keyword: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data
                        };
                    }
                }
            });
        }
    </script>
@endsection
