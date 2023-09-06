@extends('layouts.auth')

@section('title', 'Login')

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Login</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="username" class="required">Username</label>
                    <input id="username" type="text" class="form-control" name="username" tabindex="1" autofocus
                        placeholder="Masukkan username">
                    @include('components.form.error', ['name' => 'username'])
                </div>

                <div class="form-group">
                    <label for="password" class="required">Password</label>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2"
                        placeholder="Masukkan password">
                    @include('components.form.error', ['name' => 'password'])
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        <i class="fas fa-sign-in"></i>
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
