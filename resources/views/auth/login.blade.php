@extends('layouts.front')

@section('title', 'Login')

@section('content')
<section class="registerSection xl:my-20 lg:my-16 md:my-12 sm:my-10 my-8">
    <div class="container mx-auto">
        <div class="max-w-[600px] mx-auto p-[20px] lg:p-[20px] xl:p-[60px] accountFormSection" style="max-width: 600px;">
            
            <div class="contentHead text-center mb-10">
                <h1 class="heading text-3xl font-bold mb-3">Log In</h1>
                <p class="text-base leading-26">Lets get inside and start your money management, practice hard every month to become financially independent.</p>
            </div>
            <div class="themeForm iconForm">
                @if ($errors->has('email'))
                    <div class="mb-4 text-red-600 bg-red-100 border border-red-300 rounded p-3">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
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
                            <input type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="form-control" placeholder="Enter your email address">
                        </div>
                    </div>
                    
                    <div class="relative form-group mb-5">
                        <label for="" class="form-label mb-2">Password <span class="text-gray-800">*</span></label>
                        <div class="relative haveIcon pswtoggle">
                            <span class="absolute inset-y-0 left-3 flex items-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.8 16.4L15 17.75C13.2222 19.0833 10.7778 19.0833 9 17.75L7.2 16.4C5.18555 14.8892 4 12.5181 4 10V6C4 4.89543 4.89543 4 6 4H18C19.1046 4 20 4.89543 20 6V10C20 12.5181 18.8144 14.8892 16.8 16.4Z" stroke="currentColor" stroke-linecap="round"/>
                                    <circle cx="12" cy="10" r="1" fill="currentColor"/>
                                    <circle cx="9" cy="10" r="1" fill="currentColor"/>
                                    <circle cx="15" cy="10" r="1" fill="currentColor"/>
                                </svg>
                            </span>
                            <input type="password" class="form-control pswfield" placeholder="Enter password" name="password"
                            required autocomplete="current-password">
                            <span class="absolute togglePsw inset-y-0 right-3 flex items-center">
                                <svg class="showPsw" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="3.5" stroke="currentColor"/>
                                    <path d="M20.188 10.9343C20.5762 11.4056 20.7703 11.6412 20.7703 12C20.7703 12.3588 20.5762 12.5944 20.188 13.0657C18.7679 14.7899 15.6357 18 12 18C8.36427 18 5.23206 14.7899 3.81197 13.0657C3.42381 12.5944 3.22973 12.3588 3.22973 12C3.22973 11.6412 3.42381 11.4056 3.81197 10.9343C5.23206 9.21014 8.36427 6 12 6C15.6357 6 18.7679 9.21014 20.188 10.9343Z" stroke="currentColor"/>
                                </svg>
                                <svg class="hidePsw" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.39453 10.5156C9.1445 10.9535 9 11.4596 9 12C9 13.6569 10.3431 15 12 15C12.5402 15 13.0455 14.8544 13.4834 14.6045L14.2109 15.332C13.5774 15.7532 12.8178 16 12 16C9.79086 16 8 14.2091 8 12C8 11.1821 8.24569 10.4217 8.66699 9.78809L9.39453 10.5156ZM12 8C14.2091 8 16 9.79086 16 12C16 12.2736 15.9722 12.5407 15.9199 12.7988L14.9961 11.875C14.9322 10.3173 13.6819 9.06629 12.124 9.00293L11.2002 8.0791C11.4586 8.02668 11.7262 8 12 8Z" fill="currentColor"/>
                                    <path d="M7.21777 8.33887C5.92029 9.30039 4.86765 10.4393 4.19824 11.252C3.77388 11.7672 3.72949 11.8565 3.72949 12C3.72949 12.1435 3.77388 12.2328 4.19824 12.748C4.8934 13.592 6.00033 14.79 7.36719 15.7734C8.73818 16.7598 10.3282 17.5 12 17.5C13.1985 17.5 14.3541 17.1179 15.418 16.5391L16.1523 17.2734C14.9184 17.987 13.5099 18.4999 12 18.5C10.0362 18.5 8.24221 17.6346 6.7832 16.585C5.32033 15.5325 4.15073 14.2639 3.42578 13.3838C3.07382 12.9565 2.72949 12.5741 2.72949 12C2.72949 11.4259 3.07382 11.0435 3.42578 10.6162C4.10362 9.79325 5.16942 8.63002 6.50098 7.62207L7.21777 8.33887ZM12 5.5C13.9638 5.50007 15.7578 6.36537 17.2168 7.41504C18.6797 8.46756 19.8493 9.73608 20.5742 10.6162C20.9262 11.0435 21.2705 11.4259 21.2705 12C21.2705 12.5741 20.9262 12.9565 20.5742 13.3838C20.0937 13.9672 19.416 14.7192 18.5889 15.4678L17.8809 14.7598C18.6764 14.0438 19.3335 13.3165 19.8018 12.748C20.226 12.2329 20.2705 12.1435 20.2705 12C20.2705 11.8565 20.226 11.7671 19.8018 11.252C19.1066 10.408 17.9997 9.20998 16.6328 8.22656C15.2619 7.24022 13.6717 6.50007 12 6.5C11.3058 6.5 10.6259 6.62876 9.96973 6.84863L9.18945 6.06836C10.0693 5.71793 11.0134 5.5 12 5.5Z" fill="currentColor"/>
                                    <path d="M5 2L21 18" stroke="currentColor"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="mt-10 text-center">
                        <button type="submit" class="themeBtn flex items-center justify-center mx-auto gap-2">
                            Log In to Get Inside
                            <span class="icon">
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.08008 10.3H15.0801M15.0801 10.3L9.80008 5.79999M15.0801 10.3L9.80008 14.8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </button>
                    </div>
                    <div class="mt-10 text-center flex justify-between items-center">
                        <div class="text-base leading-6 text-black"><a href="{{ route('password.request') }}" class="theme-text-color font-semibold">Need a password reset?</a></div>
                        <div class="text-base leading-6 text-black">Need an account? <a href="{{ route('register') }}" class="theme-text-color font-semibold">Register</a></div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    
</section>
@endsection