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
                                                    <label for="{{ $item->name }}"
                                                        class="">{{ $item->label }}</label>
                                                    <input id="{{ $item->name }}" type="text"
                                                        class="form-control not-rp" name="{{ $item->name }}"
                                                        placeholder="Masukkan jumlah"
                                                        value="{{ isset($payment) ? $payment[$item->name] : '' }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="free_amount" class="">Jumlah</label>
                                        <input id="free_amount" type="text" class="form-control not-rp"
                                            name="free_amount" placeholder="Masukkan jumlah"
                                            value="{{ isset($payment) ? $payment->free_amount : '' }}">
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i>
                                    Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                @if (isset($payment))
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <label class="">Tipe Bayar</label>
                                <div>
                                    <label for="all">Semua</label>
                                    <input type="radio" class="form-radio" value="all" name="type" id="all">
                                    <label for="class">Kelas</label>
                                    <input type="radio" class="form-radio" value="class" name="type" id="class">
                                    <label for="custom">Kustom</label>
                                    <input type="radio" class="form-radio" value="custom" name="type" id="custom">
                                </div>
                                @include('components.form.error', ['name' => 'type'])
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection


@section('scripts')
    <script>
        var isPayment = "{{ isset($payment) }}";
        var isMonth = "{{ $data->type == 'month' }}";

        if (isPayment) {
            if (isMonth) {
                getMonthsPayment().forEach(element => {
                    var jml = $('#' + element).val();
                    $('#' + element).val(formatRupiah(jml));
                });
            } else {
                var amount = $('#free_amount').val();
                $('#free_amount').val(formatRupiah(amount));
            }
        }
    </script>
@endsection
