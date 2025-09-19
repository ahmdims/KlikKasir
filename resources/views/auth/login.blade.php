@extends('layouts.auth')

@section('content')
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="text-center mb-11">
            <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
            <div class="text-gray-500 fw-semibold fs-6">Sistem Kasir Terintegrasi</div>
        </div>
        <div class="fv-row mb-8">
            <input type="text" placeholder="Email" name="email" autocomplete="off"
                class="form-control bg-transparent @error('email') is-invalid @enderror" value="{{ old('email') }}" required
                autofocus />
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="fv-row mb-3">
            <input type="password" placeholder="Password" name="password" autocomplete="off"
                class="form-control bg-transparent @error('password') is-invalid @enderror" required />
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
            <div></div>
            <a href="#" class="link-primary">Forgot Password ?</a>
        </div>
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                <span class="indicator-label">Sign In</span>
            </button>
        </div>
        <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
            <a href="#" class="link-primary">Sign up</a>
        </div>
    </form>
@endsection