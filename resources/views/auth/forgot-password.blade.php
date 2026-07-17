@extends('layouts.front')

@section('title', 'Forgot Password')

@section('content')
<section class="registerSection xl:my-20 lg:my-16 md:my-12 sm:my-10 my-8">
    <div class="container mx-auto">
        <div class="max-w-[600px] mx-auto p-[20px] lg:p-[20px] xl:p-[60px] accountFormSection" style="max-width: 600px;">
            <div class="contentHead text-center mb-10">
                <h1 class="heading text-3xl font-bold mb-3">Reset Password</h1>
                <p class="text-base leading-26">Lets get inside and start your money management, practice hard every month to become financially independent.</p>
            </div>
            <div class="themeForm iconForm">
                @if ($errors->has('email'))
                    <div class="text-red-500 text-sm my-2 text-center">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                @if (session('status'))
                    <div class="mb-4 p-4 rounded bg-green-100 text-green-800 border border-green-300">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    
                    <div class="relative form-group mb-5">
                        <label for="" class="form-label mb-2">Email <span class="text-gray-800">*</span></label>
                        <div class="relative haveIcon">
                            <span class="absolute inset-y-3 left-3 flex items-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 15.7143V8.28571C3 7.02335 4.07452 6 5.4 6H18.6C19.9255 6 21 7.02335 21 8.28571V15.7143C21 16.9767 19.9255 18 18.6 18H5.4C4.07452 18 3 16.9767 3 15.7143Z" stroke="currentColor"/>
                                    <path d="M7 9L12 12L17 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <input type="email" name="email" :value="old('email')" required autofocus class="form-control" placeholder="Enter your email address">
                        </div>
                    </div>
                    <div class="mt-10 text-center">
                        <button type="submit" class="themeBtn flex items-center justify-center mx-auto gap-2">
                            Reset Your Password
                            <span class="icon">
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.08008 10.3H15.0801M15.0801 10.3L9.80008 5.79999M15.0801 10.3L9.80008 14.8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </button>
                    </div>
                    <div class="mt-10 text-center flex justify-center items-center">
                        <div class="text-base leading-6 text-black">Return to <a href="{{ route('login') }}" class="theme-text-color font-semibold hover:theme-text-colordark">Login</a></div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    
</section>
@endsection