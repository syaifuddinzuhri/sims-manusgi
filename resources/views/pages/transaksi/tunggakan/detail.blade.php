@extends('layouts.app')

@section('title', 'Detail Tunggakan Pembayaran')

@section('main')
    <div class="main-content">
        <section class="section">
            @include('components.section-header', [
                'title' => 'Detail Tunggakan Pembayaran',
                'index' => true,
            ])
            <a href="{{ route('tunggakan.index') }}" class="btn btn-sm btn-outline-dark mb-3"><i
                    class="fas fa-arrow-circle-left"></i>
                Kembali</a>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Pembayaran</label>
                                <input type="text" disabled readonly class="form-control" placeholder="Masukkan nama"
                                    value="{{ isset($data['category']) ? $data['category']->name : '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipe Jenis Pembayaran</label>
                                <input type="text" disabled readonly class="form-control" placeholder="Masukkan nama"
                                    value="{{ isset($data['category']) ? ($data['category']->type == 'month' ? 'Bulanan' : 'Bebas') : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
