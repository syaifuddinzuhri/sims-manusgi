@extends('layouts.app')

@section('title', 'Pengeluaran')

@section('main')
    <div class="main-content">
        <section class="section">
            @include('components.section-header', ['title' => 'Pengeluaran'])
            <a href="{{ route('pengeluaran.index') }}" class="btn btn-sm btn-outline-dark mb-3"><i
                    class="fas fa-arrow-circle-left"></i>
                Kembali</a>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form
                                action="{{ isset($is_editing) && $is_editing ? route('pengeluaran.update', encryptData($data->id)) : route('pengeluaran.store') }}"
                                method="POST">
                                @csrf
                                @if (isset($is_editing) && $is_editing)
                                    @method('PUT')
                                @endif

                                <div class="form-group">
                                    <label for="name" class="required">Nama Pengeluaran</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Masukkan nama"
                                        value="{{ isset($is_editing) && $is_editing ? $data->name : '' }}">
                                    @include('components.form.error', ['name' => 'name'])
                                </div>

                                <div class="form-group">
                                    <label for="kategori" class="required">Kategori</label>
                                    <select name="journal_category_id" id="kategori" class="form-control select2">
                                        <option value="" disabled selected>-- Pilih kategori --</option>
                                        @foreach (journalCategoryOptions('out') as $item)
                                            <option value="{{ $item['id'] }}"
                                                {{ isset($is_editing) && $is_editing && $data->journal_category_id == $item['id'] ? 'selected' : '' }}>
                                                {{ $item['text'] }}</option>
                                        @endforeach
                                    </select>
                                    @include('components.form.error', ['name' => 'journal_category_id'])
                                </div>

                                <div class="form-group">
                                    <label for="amount" class="required">Jumlah (RP)</label>
                                    <input type="text" name="amount" id="amount" class="form-control not-rp"
                                        placeholder="Masukkan jumlah"
                                        value="{{ isset($is_editing) && $is_editing ? $data->amount : '' }}">
                                    @include('components.form.error', ['name' => 'amount'])
                                </div>

                                <div class="form-group">
                                    <label for="date" class="required">Tanggal</label>
                                    <input type="text" name="date" id="date" class="form-control datepicker-now"
                                        placeholder="Masukkan tanggal"
                                        value="{{ isset($is_editing) && $is_editing ? $data->date : '' }}">
                                    @include('components.form.error', ['name' => 'date'])
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
    <script>
        var is_editing = "{{ isset($is_editing) && $is_editing }}";
        if (is_editing) {
            var amount = $('#amount').val();
            $('#amount').val(formatRupiah(amount));
        }
    </script>
@endsection
