@extends('layouts.app')

@section('title', 'Dashboard')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Selamat Datang, <span class="text-primary">{{ authUser()->name }}</span></h1>
            </div>
        </section>
    </div>
@endsection
