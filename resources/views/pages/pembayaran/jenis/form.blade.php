@extends('layouts.app')

@section('title', 'Jenis Pembayaran')

@section('main')
    <div class="main-content">
        <section class="section">
            @include('components.section-header', ['title' => 'Jenis Pembayaran'])
            <a href="{{ route('jenis.index') }}" class="btn btn-sm btn-outline-dark mb-3"><i
                    class="fas fa-arrow-circle-left"></i>
                Kembali</a>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form
                                action="{{ isset($is_editing) && $is_editing ? route('jenis.update', encryptData($data->id)) : route('jenis.store') }}"
                                method="POST">
                                @csrf
                                @if (isset($is_editing) && $is_editing)
                                    @method('PUT')
                                @endif

                                <div class="form-group">
                                    <label for="payment_type_id" class="required">POS Pembayaran</label>
                                    <select name="payment_type_id" id="payment_type_id" class="form-control select2">
                                        <option value="" disabled selected>-- Pilih POS Pembayaran --</option>
                                        @foreach (paymentTypeOptions() as $item)
                                            <option value="{{ $item['id'] }}"
                                                {{ isset($is_editing) && $is_editing && $data->payment_type_id == $item['id'] ? 'selected' : '' }}>
                                                {{ $item['text'] }}</option>
                                        @endforeach
                                    </select>
                                    @include('components.form.error', ['name' => 'payment_type_id'])
                                </div>

                                <div class="form-group">
                                    <label for="academic_year_id" class="required">Tahun Ajaran</label>
                                    <select name="academic_year_id" id="academic_year_id" class="form-control select2">
                                        <option value="" disabled selected>-- Pilih Tahun Ajaran --</option>
                                        @foreach (academicYearOptions() as $item)
                                            <option value="{{ $item['id'] }}"
                                                {{ isset($is_editing) && $is_editing && $data->academic_year_id == $item['id'] ? 'selected' : '' }}>
                                                {{ $item['text'] }}</option>
                                        @endforeach
                                    </select>
                                    @include('components.form.error', ['name' => 'academic_year_id'])
                                </div>

                                <div class="mb-3">
                                    <label class="required">Tipe Bayar</label>
                                    <div>
                                        <label for="bulanan">Bulanan</label>
                                        <input type="radio" class="form-radio" value="month" name="type"
                                            id="bulanan"
                                            {{ isset($is_editing) && $is_editing && $data->type == 'month' ? 'checked' : '' }}>
                                        <label for="bebas">Bebas</label>
                                        <input type="radio" class="form-radio" value="free" name="type"
                                            id="bebas"
                                            {{ isset($is_editing) && $is_editing && $data->type == 'free' ? 'checked' : '' }}>
                                    </div>
                                    @include('components.form.error', ['name' => 'type'])
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
