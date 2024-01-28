@extends('front.layouts.master')

@section('content')

<div class="container-fluid page-body-wrapper full-page-wrapper" style="background-color: #f5f7ff;">
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0 mt-50 mb-50">
            <div class="col-lg-5 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5 bg-white">
                    <div class="text-center">
                        <div class="brand-logo">
                            <!-- <img src="../../images/logo.svg" alt="logo"> -->
                            <h3>Tech Labz Ltd</h3>
                        </div>
                        </div>
                        <h6 class="font-weight-light">Create New Account.</h6>
                   
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

                    <form method="POST" action="{{ route('register') }}" class="pt-3">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" name="name"  placeholder="Name" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="email" name="email"  placeholder="Email" value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirmation" id="password" placeholder="Confirm Password">
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-theme-colored1 btn-sm">Register</button>
                        </div>
                        <div class="my-2 d-flex justify-content-between align-items-center">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>
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