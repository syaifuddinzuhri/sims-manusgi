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
                                    <th scope="col">Sudah Dibayar</th>
                                    <th scope="col">Tagihan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                    $dibayar = 0;
                                @endphp
                                @foreach ($data['data'] as $item)
                                    @php
                                        $pay = 0;
                                        $total += $item->list->amount;
                                        foreach ($item->journals as $key => $value) {
                                            $dibayar += $value->amount;
                                            $pay += $value->amount;
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ ucfirst($item->list->name) }}</td>
                                        <td>{{ formatIdr($item->list->amount, true) }}</td>
                                        <td>{{ formatIdr($pay, true) }}</td>
                                        <td>{{ formatIdr($item->list->amount - $pay, true) }}</td>
                                        <td>
                                            @if ($item->status != 'Lunas')
                                                <a href="{{ route('pembayaran.create', ['payment' => encryptData($item->id)]) }}"
                                                    class="btn btn-sm btn-primary"><i
                                                        class="fas fa-money-bill-transfer"></i>
                                                    Bayar</a>
                                            @else
                                                <button class="btn btn-sm btn-success"><i class="fas fa-check"></i>
                                                    Lunas</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="font-weight-bold bg-light">
                                    <td colspan="4" class="text-right">Total</td>
                                    <td>{{ formatIdr($total, true) }}</td>
                                </tr>
                                <tr class="font-weight-bold bg-light">
                                    <td colspan="4" class="text-right">Sudah Dibayar</td>
                                    <td class="text-success">{{ formatIdr($dibayar, true) }}</td>
                                </tr>
                                <tr class="font-weight-bold bg-light">
                                    <td colspan="4" class="text-right">Belum Dibayar</td>
                                    <td class="text-danger">-{{ formatIdr($total - $dibayar, true) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <div class="row">
                            @foreach ($data['data'] as $item)
                                @php
                                    $dibayar = 0;
                                    foreach ($item->journals as $key => $value) {
                                        $dibayar += $value->amount;
                                    }
                                @endphp
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="text" disabled readonly class="form-control"
                                            placeholder="Masukkan nama" value="{{ formatIdr($item->list->amount, true) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sudah Dibayar</label>
                                        <input type="text" disabled readonly class="form-control text-success"
                                            placeholder="Masukkan nama" value="{{ formatIdr($dibayar, true) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Belum Dibayar</label>
                                        <input type="text" disabled readonly class="form-control text-danger"
                                            placeholder="Masukkan nama" value="-{{ formatIdr($item->list->amount - $dibayar, true) }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    @if ($item->status != 'Lunas')
                                        <a href="{{ route('pembayaran.create', ['payment' => encryptData($item->id)]) }}"
                                            class="btn btn-sm btn-primary"><i class="fas fa-money-bill-transfer"></i>
                                            Bayar</a>
                                    @else
                                        <button class="btn btn-sm btn-success"><i class="fas fa-check"></i> Lunas</button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endsection
