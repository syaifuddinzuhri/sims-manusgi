@extends('layouts.app')

@section('title', 'Dashboard')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Selamat Datang, <span class="text-primary">{{ authUser()->name }}</span></h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('dashboard.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file">
                        <button type="submit">submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
