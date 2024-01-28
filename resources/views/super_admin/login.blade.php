@extends('layouts.login')

@section('content')

<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    <div class="text-center">
                        <div class="brand-logo">
                            <!-- <img src="../../images/logo.svg" alt="logo"> -->
                            <h2>Tech Labz Ltd</h2>
                        </div>
                        </div>
                        <h4>Hello! let's get started</h4>
                        <h6 class="font-weight-light">Sign in to continue.</h6>
                   
                    @if ($errors->any())
                        <div>
                            <div class="font-medium text-red-600 text-danger">
                                {{ __('Whoops! Something went wrong.') }}
                            </div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600  text-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="pt-3">
                        @csrf
                        <div class="form-group">
                            <input class="form-control form-control-lg" type="email" name="email"  placeholder="Email" value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Log In</button>
                        </div>
                        <div class="my-2 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <label class="form-check-label text-muted">
                                <input type="checkbox" class="form-check-input"  name="remember">
                                Keep me signed in
                                </label>
                            </div>
                            <a href="{{ route('password.request') }}" class="auth-link text-black d-none">Forgot password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
@endsection 