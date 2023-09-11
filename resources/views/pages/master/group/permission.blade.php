@extends('layouts.app')

@section('title', 'Manajemen Akses Grup')

@section('main')
    <div class="main-content">
        <section class="section">
            @include('components.section-header', ['title' => 'Manajemen Akses Grup'])
            <a href="{{ route('grup.index') }}" class="btn btn-sm btn-outline-dark mb-3"><i
                    class="fas fa-arrow-circle-left"></i>
                Kembali</a>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="required">Nama Grup</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Masukkan nama" value="{{ $data->name }}" disabled readonly>
                                @include('components.form.error', ['name' => 'name'])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header font-weight-bold">
                            Manajemen Akses
                        </div>
                        <div class="card-body">
                            <form action="{{ route('permission.submit', $id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <ul class="nav nav-tabs" id="permissionTab" role="tablist">
                                    @foreach ($permissions as $item)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{ $item->name == 'read-master' ? 'active' : '' }}"
                                                id="btn-{{ $item->name }}" data-toggle="tab"
                                                data-target="#{{ $item->name }}" type="button"
                                                role="tab">{{ $item->label }}</button>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content" id="permissionTabContent">
                                    @foreach ($permissions as $item)
                                        <div class="tab-pane fade {{ $item->name == 'read-master' ? 'show active' : '' }}"
                                            id="{{ $item->name }}" role="tabpanel">
                                            <div class="row">
                                                @foreach ($item['children'] as $child)
                                                    <div class="col-md-3 my-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="{{ $child->name }}"
                                                                name="permission[][{{ $child->name }}]"
                                                                {{ $child->is_checked == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="{{ $child->name }}">
                                                                {{ $child->label }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="btn btn-sm btn-primary" type="submit">
                                    <i class="fas fa-save"></i>
                                    Simpan
                                </button>
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
        $('#permissionTab button').on('click', function(event) {
            event.preventDefault()
            $(this).tab('show')
        })
    </script>
@endsection
