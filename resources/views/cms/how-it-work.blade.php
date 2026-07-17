@extends('layouts.front')

@section('title', 'How It Works')

@section('content')
<section class="progresSection mt-10 lg:mt-12 xl:mt-16 2xl:mt-20 mb-14 lg:mb-16 xl:mb-20 2xl:mb-24 px-5 lg:px-0">
    <div class="container mx-auto">
        <div class="heading mb-24 pb-20 text-center">
            <h2 class="themeHeading2 text-[24px] md:text-[28px] lg:text-[32px] font-semibold leading-tight">How It Works – 4 Easy Steps</h2>
        </div>
        <div class="timeLines relative max-w-[1240px] mx-auto">
            <div class="items">
                <div class="timelineCard max-w-[460px]">
                    <div class="flex items-center gap-2 mb-8">
                        <span class="nocount">01.</span>
                        <h4 class="heading">Sign Up & Create Your Profile</h4>
                    </div>
                    <div class="textPara">Register quickly using our simple form to become a citizen of Virtual City. Setup your profile in just a few steps and start organizing finances—just like adults do in the real world.</div>
                </div>
                <div class="centerSection">
                    <button class="themeBtn flex align-center justify-center w-fit gap-2">
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 10.3H3M3 10.3L8.28 5.80005M3 10.3L8.28 14.8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Register to Start
                    </button>
                </div>
            </div>
            <div class="items">
                <div class="timelineCard max-w-[460px]">
                    <div class="flex items-center gap-2 mb-8">
                        <span class="nocount">02.</span>
                        <h4 class="heading">Earn Your Monthly Zeds</h4>
                    </div>
                    <div class="textPara">Get a monthly salary in Zeds, our fun virtual currency, just like real-world earnings. Earn salary, shop, and vote on city issues.</div>
                </div>
                <div class="centerSection">
                    <button class="themeBtn flex align-center justify-center w-fit gap-2">
                        Salary In Zed
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 10.3H15M15 10.3L9.72 5.80005M15 10.3L9.72 14.8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="items">
                <div class="timelineCard max-w-[460px]">
                    <div class="flex items-center gap-2 mb-8">
                        <span class="nocount">03.</span>
                        <h4 class="heading">Spend & Decide Wisely</h4>
                    </div>
                    <div class="textPara">Make choices—rent an apartment, shop, invest, or save. Every action affects your financial health. Open bank accounts and make investments.</div>
                </div>
                <div class="centerSection">
                    <button class="themeBtn flex align-center justify-center w-fit gap-2">
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 10.3H3M3 10.3L8.28 5.80005M3 10.3L8.28 14.8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Spend & Save from Bank
                    </button>
                </div>
            </div>
            <div class="items">
                <div class="timelineCard max-w-[460px]">
                    <div class="flex items-center gap-2 mb-8">
                        <span class="nocount">04.</span>
                        <h4 class="heading">Learn & Grow Financially</h4>
                    </div>
                    <div class="textPara">Each decision builds real-life money skills and teaches you how to live independently. Build real financial skills through play. Donate to projects and support your community</div>
                </div>
                <div class="centerSection">
                    <button class="themeBtn flex align-center justify-center w-fit gap-2">
                        Play & Grow Money Skills
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 10.3H15M15 10.3L9.72 5.80005M15 10.3L9.72 14.8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection