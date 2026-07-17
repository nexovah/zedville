@extends('layouts.front')

@section('title', 'Contact Us')

@section('content')
<section class="registerSection xl:my-20 lg:my-16 md:my-12 sm:my-10 my-8">
        <div class="container mx-auto">
            <div class="pageHeading text-center max-w-[520px] mx-auto mb-[70px]">
                <h1 class="themeHeading text-[28px] lg:text-[32px] xl:text-[48px] 2xl:text-[64px] font-semibold leading-tight mb-8">Get in Touch with Us</h1>
                <p class="text-sm xl:text-base 2xl:text-xl leading-snug mb-10">Have questions about Virtual City or need help navigating your financial learning journey?</p>
                <a href="mailto:info@example.com" class="flex justify-center gap-x-2 items-center content text-sm text-black font-normal">
                    <span class="icon">
                        <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.48047 7.77539L10.3192 10.356L15.1579 7.77539" stroke="currentColor" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M1.93164 16.0711V5.90332C1.93164 4.79875 2.82707 3.90332 3.93164 3.90332H16.5994C17.7039 3.90332 18.5994 4.79875 18.5994 5.90332V16.0711C18.5994 17.1756 17.7039 18.0711 16.5994 18.0711H3.93164C2.82707 18.0711 1.93164 17.1756 1.93164 16.0711Z" stroke="currentColor" stroke-width="0.8"></path>
                        </svg>
                    </span>
                    <span class="txt">info@example.com</span>
                </a>
            </div>
            <div class="max-w-[600px] mx-auto p-[20px] lg:p-[20px] xl:p-[60px] accountFormSection">
                <div class="contentHead mb-10">
                    <p class="text-base leading-26">Reach out to us for personalized expert <br/> guidance on your financial lerarning journey.</p>
                </div>
                <div class="themeForm iconForm">
                    <form action="#" method="post">
                        <div class="relative form-group mb-5">
                            <label for="" class="form-label mb-2">Name <span class="text-gray-800">*</span></label>
                            <div class="relative haveIcon">
                                <span class="absolute inset-y-3 left-3 flex items-center">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.99934 2.16675C5.39698 2.16675 1.66602 5.89771 1.66602 10.5001C1.66602 15.1025 5.39698 18.8334 9.99934 18.8334C14.6017 18.8334 18.3327 15.1025 18.3327 10.5001C18.3327 5.89771 14.6017 2.16675 9.99934 2.16675Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M3.55859 15.7881C3.55859 15.7881 5.41612 13.4167 9.99945 13.4167C14.5828 13.4167 16.4403 15.7881 16.4403 15.7881" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M10 10.5003C11.3807 10.5003 12.5 9.38095 12.5 8.00024C12.5 6.61953 11.3807 5.50024 10 5.50024C8.61929 5.50024 7.5 6.61953 7.5 8.00024C7.5 9.38095 8.61929 10.5003 10 10.5003Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                                <input type="text" required="" class="form-control" placeholder="Enter your full name">
                            </div>
                        </div>
                        
                        <div class="relative form-group mb-5">
                            <label for="" class="form-label mb-2">Email <span class="text-gray-800">*</span></label>
                            <div class="relative haveIcon">
                                <span class="absolute inset-y-3 left-3 flex items-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 15.7143V8.28571C3 7.02335 4.07452 6 5.4 6H18.6C19.9255 6 21 7.02335 21 8.28571V15.7143C21 16.9767 19.9255 18 18.6 18H5.4C4.07452 18 3 16.9767 3 15.7143Z" stroke="currentColor"></path>
                                        <path d="M7 9L12 12L17 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                                <input type="email" required="" class="form-control" placeholder="Enter your email address">
                            </div>
                        </div>
                        <div class="relative form-group mb-5">
                            <label for="" class="form-label mb-2">Message <span class="text-gray-800">*</span></label>
                            <div class="relative haveIcon">
                                <span class="absolute inset-y-3 left-3 flex items-start">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 21C16.9705 21 21 16.9705 21 12C21 7.02943 16.9705 3 12 3C7.02943 3 3 7.02943 3 12C3 13.6393 3.43828 15.1762 4.20404 16.5L3.45 20.55L7.5 19.7959C8.82378 20.5618 10.3607 21 12 21Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M17 12.4737C17.2761 12.4737 17.5 12.2617 17.5 12.0001C17.5 11.7384 17.2761 11.5264 17 11.5264C16.7239 11.5264 16.5 11.7384 16.5 12.0001C16.5 12.2617 16.7239 12.4737 17 12.4737Z" fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 12.4737C12.2761 12.4737 12.5 12.2617 12.5 12.0001C12.5 11.7384 12.2761 11.5264 12 11.5264C11.7239 11.5264 11.5 11.7384 11.5 12.0001C11.5 12.2617 11.7239 12.4737 12 12.4737Z" fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7 12.4737C7.27615 12.4737 7.5 12.2617 7.5 12.0001C7.5 11.7384 7.27615 11.5264 7 11.5264C6.72385 11.5264 6.5 11.7384 6.5 12.0001C6.5 12.2617 6.72385 12.4737 7 12.4737Z" fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <textarea name="" class="form-control min-h-[120px]" id="" placeholder="Type your message"></textarea>
                            </div>
                        </div>
                        <div class="text-center text-base leading-26 text-center mb-10">Must complete all fields before submitting the form</div>
                        <div class="mt-10 text-center">
                            <button type="submit" class="themeBtn flex items-center justify-center mx-auto gap-2">
                                Get in Touch
                                <span class="icon">
                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.08008 10.3H15.0801M15.0801 10.3L9.80008 5.79999M15.0801 10.3L9.80008 14.8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </section>
@endsection