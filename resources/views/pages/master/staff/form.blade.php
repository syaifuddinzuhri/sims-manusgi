@extends('layouts.app')

@section('title', 'Staff')

@section('main')
    <div class="main-content">
        <section class="section">
            @include('components.section-header', ['title' => 'Staff'])
            <a href="{{ route('staff.index') }}" class="btn btn-sm btn-outline-dark mb-3"><i
                    class="fas fa-arrow-circle-left"></i>
                Kembali</a>
            <div class="card">
                <div class="card-body">
                    <form
                        action="{{ isset($is_editing) && $is_editing ? route('staff.update', encryptData($data->id)) : route('staff.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($is_editing) && $is_editing)
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="required">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Masukkan nama"
                                        value="{{ isset($is_editing) && $is_editing ? $data->name : '' }}">
                                    @include('components.form.error', ['name' => 'name'])
                                </div>

                                <div class="form-group">
                                    <label for="email" class="required">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Masukkan email"
                                        value="{{ isset($is_editing) && $is_editing ? $data->email : '' }}">
                                    @include('components.form.error', ['name' => 'email'])
                                </div>

                                <div class="form-group">
                                    <label for="username" class="required">Username</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Masukkan username"
                                        value="{{ isset($is_editing) && $is_editing ? $data->username : '' }}">
                                    @include('components.form.error', ['name' => 'username'])
                                </div>

                                <div class="mb-3">
                                    <label class="required">Jenis Kelamin</label>
                                    <div>
                                        <label for="laki-laki">Laki-laki</label>
                                        <input type="radio" class="form-radio" value="L" name="gender"
                                            id="laki-laki"
                                            {{ isset($is_editing) && $is_editing && $data->gender == 'L' ? 'checked' : '' }}>
                                        <label for="perempuan">Perempuan</label>
                                        <input type="radio" class="form-radio" value="P" name="gender"
                                            id="perempuan"
                                            {{ isset($is_editing) && $is_editing && $data->gender == 'P' ? 'checked' : '' }}>
                                    </div>
                                    @include('components.form.error', ['name' => 'gender'])
                                </div>

                                <div class="form-group">
                                    <label for="grup" class="required">Grup</label>
                                    <select name="grup" id="grup" class="form-control select2">
                                        <option value="" disabled selected>-- Pilih Grup --</option>
                                        @foreach (groupOptions() as $item)
                                            <option value="{{ $item['id'] }}"
                                                {{ isset($is_editing) && $is_editing && $data->role == $item['id'] ? 'selected' : '' }}>
                                                {{ $item['text'] }}</option>
                                        @endforeach
                                    </select>
                                    @include('components.form.error', ['name' => 'grup'])
                                </div>

                                @if (!isset($is_editing))
                                    <div class="form-group">
                                        <label for="password" class="required">Password</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Masukkan password"
                                            value="{{ isset($is_editing) && $is_editing ? $data->password : '' }}">
                                        @include('components.form.error', ['name' => 'password'])
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation" class="required">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control" placeholder="Masukkan konfirmasi password"
                                            value="{{ isset($is_editing) && $is_editing ? $data->password_confirmation : '' }}">
                                        @include('components.form.error', [
                                            'name' => 'password_confirmation',
                                        ])
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nip" class="">NIP</label>
                                    <input type="text" name="nip" id="nip" class="form-control"
                                        placeholder="Masukkan NIP"
                                        value="{{ isset($is_editing) && $is_editing ? $data->nip : '' }}">
                                    @include('components.form.error', ['name' => 'nip'])
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="">Nomor HP</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        placeholder="Masukkan nomor hp"
                                        value="{{ isset($is_editing) && $is_editing ? $data->phone : '' }}">
                                    @include('components.form.error', ['name' => 'phone'])
                                </div>

                                <div class="form-group">
                                    <label for="pob" class="">Tempat Lahir</label>
                                    <input type="text" name="pob" id="pob" class="form-control"
                                        placeholder="Masukkan tempat lahir"
                                        value="{{ isset($is_editing) && $is_editing ? $data->pob : '' }}">
                                    @include('components.form.error', ['name' => 'pob'])
                                </div>

                                <div class="form-group">
                                    <label for="dob" class="">Tanggal Lahir</label>
                                    <input type="text" name="dob" id="dob" class="form-control datepicker"
                                        placeholder="Masukkan tanggal lahir"
                                        value="{{ isset($is_editing) && $is_editing ? $data->dob : '' }}">
                                    @include('components.form.error', ['name' => 'dob'])
                                </div>

                                <div class="form-group">
                                    <label for="photo" class="">Foto Profil</label>
                                    <input type="file" name="photo" id="photo" class="dropify"
                                        data-max-file-size="3M" data-allowed-file-extensions="jpg png jpeg"
                                        data-default-file="{{ isset($is_editing) && $is_editing ? $data->photo : '' }}">
                                    @include('components.form.error', ['name' => 'photo'])
                                </div>

                                <button type="submit" class="btn btn-sm btn-primary float-right"><i
                                        class="fas fa-save"></i>
                                    Simpan</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection
