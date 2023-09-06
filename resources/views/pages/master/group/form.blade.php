@extends('layouts.app')

@section('title', 'Grup')

@section('main')
    <div class="main-content">
        <section class="section">
            @include('components.section-header', ['title' => 'Grup'])
            <a href="{{ route('grup.index') }}" class="btn btn-sm btn-outline-dark mb-3"><i
                    class="fas fa-arrow-circle-left"></i>
                Kembali</a>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form
                                action="{{ isset($is_editing) && $is_editing ? route('grup.update', encryptData($data->id)) : route('grup.store') }}"
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
