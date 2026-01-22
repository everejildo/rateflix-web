@extends('layouts.app')

@section('content')
    <div class="login-container">
        <div class="header">
            <h1 class="app-name">RateFlix</h1>
            <div class="logo">
                <i class="fas fa-video"></i>
                <img src="multimedia/Rate.png">
            </div>
        </div>

        <div class="login-form-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<style>
    .login-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #f0f0f0;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .app-name {
        font-size: 2em;
        margin-bottom: 10px;
    }

    .logo {
        size: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .logo img {
        width: 100px;
        height: auto;
        /* height: 100px;  Set a specific height */
        /* width: auto;   Maintain aspect ratio */
        /* width: 100%;  Make it responsive within its container */
        /* height: auto; */
    }

    .login-form-container {
        background-color: #000;
        padding: 30px;
        border-radius: 10px;
        width: 300px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    label {
        color: #fff;
        display: block;
        margin-bottom: 5px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        background-color: #333;
        color: #fff;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>