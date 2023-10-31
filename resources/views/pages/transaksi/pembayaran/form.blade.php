@extends('layouts.app')

@section('title', 'Pembayaran')

@section('main')
    <div class="main-content">
        <section class="section">
            @include('components.section-header', ['title' => 'Pembayaran'])
            <a href="{{ route('tunggakan.index') }}" class="btn btn-sm btn-outline-dark mb-3"><i
                    class="fas fa-arrow-circle-left"></i>
                Kembali</a>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Siswa</label>
                                <input type="text" disabled readonly class="form-control"
                                    value="{{ isset($data->user) ? $data->user->name : '' }}">
                            </div>
                            <div class="form-group">
                                <label>Kelas - Jurusan</label>
                                <input type="text" disabled readonly class="form-control"
                                    value="{{ isset($data->user) ? $data->user->class->name . ' - ' . $data->user->class->department->name : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="amount" class="">Jumlah Tagihan</label>
                                <input type="text"class="form-control" placeholder="" disabled readonly
                                    value="{{ formatIDR($data->list->amount, true) }}">
                            </div>
                            <div class="form-group">
                                <label for="amount" class="">Jenis Pembayaran</label>
                                <input type="text"class="form-control" placeholder="" disabled readonly
                                    value="{{ $data->list->payment_category->type == 'month' ? 'Bulanan' : 'Bebas' }}">
                            </div>
                            @if ($data->list->payment_category->type == 'month')
                                <div class="form-group">
                                    <label for="amount" class="">Bulan</label>
                                    <input type="text"class="form-control" placeholder="" disabled readonly
                                        value="{{ ucfirst($data->list->name) }}">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pembayaran.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="payment_id" value="{{ $data->id }}">

                                <div class="form-group">
                                    <label for="name" class="required">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $data->list->payment_category->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="amount" class="required">Jumlah (RP)</label>
                                    <input type="text" name="amount" id="amount" class="form-control not-rp"
                                        placeholder="Masukkan jumlah pembayaran">
                                    @include('components.form.error', ['name' => 'amount'])
                                </div>

                                <div class="form-group">
                                    <label for="date" class="required">Tanggal</label>
                                    <input type="text" name="date" id="date" class="form-control datepicker-now"
                                        placeholder="Masukkan tanggal">
                                    @include('components.form.error', ['name' => 'date'])
                                </div>

                                <div class="form-group">
                                    <label for="notes">Keterangan</label>
                                    <textarea name="notes" id="notes" class="form-control" style="min-height: 100px"
                                        placeholder="Masukkan keterangan">{{ $data->list->payment_category->name . ' - ' . $data->user->name . ' - ' . $data->user->class->name . ' - ' . $data->user->class->department->name }}</textarea>
                                    @include('components.form.error', ['name' => 'notes'])
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
