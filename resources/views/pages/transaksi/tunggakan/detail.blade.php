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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nama Siswa</label>
                                <input type="text" disabled readonly class="form-control" placeholder="Masukkan nama"
                                    value="{{ isset($data['user']) ? $data['user']->name : '' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Kelas - Jurusan</label>
                                <input type="text" disabled readonly class="form-control" placeholder="Masukkan nama"
                                    value="{{ isset($data['user']) ? $data['user']->class->name . ' - ' . $data['user']->class->department->name : '' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nama Pembayaran</label>
                                <input type="text" disabled readonly class="form-control" placeholder="Masukkan nama"
                                    value="{{ isset($data['category']) ? $data['category']->name : '' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tipe Jenis Pembayaran</label>
                                <input type="text" disabled readonly class="form-control" placeholder="Masukkan nama"
                                    value="{{ isset($data['category']) ? ($data['category']->type == 'month' ? 'Bulanan' : 'Bebas') : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    @if (isset($data['category']) && $data['category']->type == 'month')
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Uraian</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['data'] as $item)
                                    <tr>
                                        <td>{{ ucfirst($item->list->name) }}</td>
                                        <td>{{ formatIdr($item->list->amount, true) }}</td>
                                        <td>
                                            <a href="{{ route('pembayaran.create', ['payment_list_id' => encryptData($item->id)]) }}"
                                                class="btn btn-sm btn-primary"><i class="fas fa-money-bill-transfer"></i>
                                                Bayar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="row">
                            @foreach ($data['data'] as $item)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="text" disabled readonly class="form-control"
                                            placeholder="Masukkan nama" value="{{ formatIdr($item->list->amount, true) }}">
                                    </div>
                                    <a href="{{ route('pembayaran.create', ['payment_list_id' => encryptData($item->id)]) }}"
                                        class="btn btn-sm btn-primary"><i class="fas fa-money-bill-transfer"></i>
                                        Bayar</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endsection
