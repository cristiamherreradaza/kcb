@extends('layouts.login')

@section('content')

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group row">

        <div class="col-md-8">
            <input id="email" placeholder="Email" type="email" class="form-control h-auto border-0 px-0 placeholder-dark-75 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">

        <div class="col-md-8">
            <input id="password" type="password" class="form-control h-auto border-0 px-0 placeholder-dark-75 @error('password') is-invalid @enderror" name="password" required placeholder="Password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-3">
        <div class="checkbox-inline">
            <label class="checkbox checkbox-outline m-0 text-muted">
                <input type="form-check-input" name="remember" id="remeber" {{ old('remember') ? 'checked' : '' }} />
                <span></span>Recuerdame </label>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Ingresar') }}
            </button>

            {{-- @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif --}}
        </div>
    </div>
</form>

@endsection
