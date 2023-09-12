@extends('layouts.app')

@section('title', 'Kategori')

@section('main')
    <div class="main-content">
        <section class="section">
            @include('components.section-header', ['title' => 'Kategori'])
            <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-outline-dark mb-3"><i
                    class="fas fa-arrow-circle-left"></i>
                Kembali</a>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form
                                action="{{ isset($is_editing) && $is_editing ? route('kategori.update', encryptData($data->id)) : route('kategori.store') }}"
                                method="POST">
                                @csrf
                                @if (isset($is_editing) && $is_editing)
                                    @method('PUT')
                                @endif

                                <div class="form-group">
                                    <label for="name" class="required">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Masukkan nama"
                                        value="{{ isset($is_editing) && $is_editing ? $data->name : '' }}">
                                    @include('components.form.error', ['name' => 'name'])
                                </div>

                                <div class="mb-3">
                                    <label class="required">Tipe</label>
                                    <div>
                                        <label for="in">Pemasukan</label>
                                        <input type="radio" class="form-radio" value="in" name="type"
                                            id="in"
                                            {{ isset($is_editing) && $is_editing && $data->type == 'in' ? 'checked' : '' }}>
                                        <label for="pengeluaran">Pengeluaran</label>
                                        <input type="radio" class="form-radio" value="out" name="type"
                                            id="pengeluaran"
                                            {{ isset($is_editing) && $is_editing && $data->type == 'out' ? 'checked' : '' }}>
                                    </div>
                                    @include('components.form.error', ['name' => 'type'])
                                </div>

                                <div class="form-group">
                                    <label for="notes">Keterangan</label>
                                    <textarea name="notes" id="notes" class="form-control" style="min-height: 100px"
                                        placeholder="Masukkan keterangan">{{ isset($is_editing) && $is_editing ? $data->notes : '' }}</textarea>
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

@section('scripts')
    <script></script>
@endsection
