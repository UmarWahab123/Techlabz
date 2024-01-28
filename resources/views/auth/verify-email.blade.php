@extends('front.layouts.master')

@section('content')

<div class="container-fluid page-body-wrapper full-page-wrapper" style="background-color: #f5f7ff;">
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0 mt-50 mb-50">
            <div class="col-lg-5 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5 bg-white">
                    <div class="text-center">
                        <div class="brand-logo">
                            <!-- <img src="https://www.techlabz.uk/public/storage/uploads/slider/1659439080_techlabz-resize.png" alt="logo"> -->
                            <h3>Tech Labz Ltd</h3>
                        </div>
                    </div>
                   
                    <div class="mb-4 text-sm text-gray-600 text-center">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-green-600 text-center text-success">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif

                    <div class="mt-4 flex items-center justify-between text-center">
                        <form method="POST" action="{{ route('verification.send') }}" class="d-inline-block">
                            @csrf

                            <div>
                                <button class="btn btn-theme-colored1 btn-sm" type="submit">{{ __('Resend Verification Email') }}</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('logout') }}"  class="d-inline-block">
                            @csrf

                            <button type="submit" class="btn btn-theme-colored1 btn-sm">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
@endsection 