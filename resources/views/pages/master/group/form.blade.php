@extends('layouts.app')

@section('title', 'Grup')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>
                    @if (isset($is_editing) && $is_editing)
                        Form Edit
                    @else
                        Form Tambah
                    @endif
                </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">
                        @if (isset($is_editing) && $is_editing)
                            Form Edit
                        @else
                            Form Tambah
                        @endif
                        Grup
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('grup.index') }}" class="btn btn-sm btn-outline-dark mb-3"><i
                            class="fas fa-arrow-circle-left"></i>
                        Kembali</a>
                    <div class="card">
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
