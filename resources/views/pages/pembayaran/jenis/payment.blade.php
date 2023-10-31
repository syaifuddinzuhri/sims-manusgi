@extends('layouts.app')

@section('title', 'Atur Tarif Pembayaran')

@section('main')
    <div class="main-content">
        <section class="section">
            @include('components.section-header', ['title' => 'Atur Tarif Pembayaran', 'index' => true])
            <a href="{{ route('jenis.index') }}" class="btn btn-sm btn-outline-dark mb-3"><i
                    class="fas fa-arrow-circle-left"></i>
                Kembali</a>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="payment_type_id" class="">POS Pembayaran</label>
                                <select name="payment_type_id" id="payment_type_id" class="form-control select2" disabled>
                                    <option value="" disabled selected>-- Pilih POS Pembayaran --</option>
                                    @foreach (paymentTypeOptions() as $item)
                                        <option value="{{ $item['id'] }}"
                                            {{ $data->payment_type_id == $item['id'] ? 'selected' : '' }}>
                                            {{ $item['text'] }}</option>
                                    @endforeach
                                </select>
                                @include('components.form.error', ['name' => 'payment_type_id'])
                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="academic_year_id" class="">Tahun Ajaran</label>
                                <select name="academic_year_id" id="academic_year_id" class="form-control select2" disabled>
                                    <option value="" disabled selected>-- Pilih Tahun Ajaran --</option>
                                    @foreach (academicYearOptions() as $item)
                                        <option value="{{ $item['id'] }}"
                                            {{ $data->academic_year_id == $item['id'] ? 'selected' : '' }}>
                                            {{ $item['text'] }}</option>
                                    @endforeach
                                </select>
                                @include('components.form.error', ['name' => 'academic_year_id'])
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="">Tipe Bayar</label>
                                <div>
                                    <label for="bulanan">Bulanan</label>
                                    <input type="radio" class="form-radio" value="month" id="bulanan"
                                        {{ $data->type == 'month' ? 'checked' : '' }} disabled>
                                    <label for="bebas">Bebas</label>
                                    <input type="radio" class="form-radio" value="free" id="bebas"
                                        {{ $data->type == 'free' ? 'checked' : '' }} disabled>
                                </div>
                                @include('components.form.error', ['name' => 'type'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Tarif Pembayaran</div>
                        <div class="card-body">
                            <form action="{{ route('jenis.payment.store', $id) }}" method="POST">
                                @csrf
                                @if ($data->type == 'month')
                                    <div class="row">
                                        @foreach (getMonthPayment() as $item)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="{{ $item }}"
                                                        class="">{{ ucfirst($item) }}</label>
                                                    <input id="{{ $item }}" type="text"
                                                        class="form-control not-rp" name="{{ $item }}"
                                                        placeholder="Masukkan jumlah"
                                                        value="{{ getPaymentListByName($item) ? getPaymentListByName($item)->amount : '' }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="free" class="">Jumlah</label>
                                        <input id="free" type="text" class="form-control not-rp" name="free"
                                            placeholder="Masukkan jumlah" value="">
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i>
                                    Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                @if (isset($payment) && count($payment) > 0)
                    @include('pages.pembayaran.jenis.target')
                @endif
            </div>
        </section>
    @endsection


    @section('scripts')
        <script>
            var isPayment = "{{ isset($payment) }}";
            var isMonth = "{{ $data->type == 'month' }}";
            var targetType = "{{ $data->target_type }}";
            if (isPayment) {
                if (isMonth) {
                    getMonthsPayment().forEach(element => {
                        var jml = $('#' + element).val();
                        $('#' + element).val(formatRupiah(jml));
                    });
                } else {
                    var amount = $('#free').val();
                    $('#free').val(formatRupiah(amount));
                }

                if (targetType == 'class') {
                    $('#class-form-box').show();
                    $('#student-form-box').hide();
                } else if (targetType == 'custom') {
                    $('#student-form-box').show();
                    $('#class-form-box').hide();
                }
            }



            // TARGET BLADE SCRIPTS

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

            // function getClass() {
            //     $('.class-select').select2({
            //         minimumInputLength: 1,
            //         allowClear: true,
            //         multiple: true,
            //         ajax: {
            //             url: `{{ route('api.class.index') }}`,
            //             dataType: 'json',
            //             type: "GET",
            //             headers: {
            //                 'Authorization': 'Bearer ' + API_TOKEN
            //             },
            //             data: function(params) {
            //                 return {
            //                     keyword: params.term
            //                 };
            //             },
            //             processResults: function(data) {
            //                 return {
            //                     results: data.data
            //                 };
            //             }
            //         }
            //     });
            // }

            // function getStudent() {
            //     $('.student-select').select2({
            //         minimumInputLength: 1,
            //         allowClear: true,
            //         multiple: true,
            //         ajax: {
            //             url: `{{ route('api.student.index') }}`,
            //             dataType: 'json',
            //             type: "GET",
            //             headers: {
            //                 'Authorization': 'Bearer ' + API_TOKEN
            //             },
            //             data: function(params) {
            //                 return {
            //                     keyword: params.term
            //                 };
            //             },
            //             processResults: function(data) {
            //                 return {
            //                     results: data.data
            //                 };
            //             }
            //         }
            //     });
            // }
        </script>
    @endsection
