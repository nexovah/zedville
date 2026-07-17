@extends('layouts.front')

@section('title', 'Thank You')

@section('content')
<section class="registerSection xl:my-20 lg:my-16 md:my-12 sm:my-10 my-8">
        <div class="container mx-auto themeForm">
            <div class="max-w-[600px] mx-auto p-[20px] lg:p-[20px] xl:p-[60px] accountFormSection">
                <div class="icon flex justify-center mb-10">
                    <svg width="36" height="46" viewBox="0 0 36 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 22.8571L34.1254 33.8332C34.6725 34.2057 35 34.8247 35 35.4866V44.2143C35 44.4904 34.7761 44.7143 34.5 44.7143H1.5C1.22386 44.7143 1 44.4904 1 44.2143V35.4866C1 34.8247 1.32746 34.2057 1.87462 33.8332L18 22.8571ZM18 22.8571L34.1254 11.881C34.6725 11.5086 35 10.8896 35 10.2277V1.5C35 1.22386 34.7761 1 34.5 1H1.5C1.22386 1 1 1.22386 1 1.5V10.2277C1 10.8896 1.32746 11.5086 1.87462 11.881L18 22.8571Z" stroke="#33363F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M25.2853 42.4928V44.5643C25.2853 44.6471 25.2181 44.7143 25.1353 44.7143H10.8639C10.781 44.7143 10.7139 44.6471 10.7139 44.5643V42.4928C10.7139 42.3602 10.7665 42.233 10.8603 42.1393L17.4339 35.5657C17.7463 35.2533 18.2528 35.2533 18.5653 35.5657L25.1388 42.1393C25.2326 42.233 25.2853 42.3602 25.2853 42.4928Z" fill="#33363F"/>
                        <path d="M18.0003 21.6429L30.1431 14.3572H5.85742L18.0003 21.6429Z" fill="#33363F"/>
                        <path d="M18 37.4286V22.8571" stroke="#33363F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="contentHead text-center mb-10 mx-auto max-w-sm">
                    <h1 class="heading text-3xl font-bold mb-3">We are working on Account design for the users / students. Soon the screens will appear. </h1>
                </div>
                <div class="text-center">
                    <a href="index.php" class="themeBtn flex items-center justify-center mx-auto gap-2" style="width: fit-content;">
                        Go Back To Home Screen
                        <span class="icon">
                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.08008 10.3H15.0801M15.0801 10.3L9.80008 5.79999M15.0801 10.3L9.80008 14.8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        
    </section>
@endsection