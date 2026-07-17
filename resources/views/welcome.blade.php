@extends('layouts.front')

@section('title', 'Home')

@section('content')
<section class="homeSection1 px-5 lg:px-2 my-10 lg:my-12 xl:my-16 2xl:my-20 relative lg:min-h-[450px] xl:min-h-[500px] 2xl:min-h-[700px] flex items-center justify-center">
    <div class="leftGraphics w-fit"><img src="{{ asset('asset/front/images/banner-image1.svg') }}" alt=""></div>
    <div class="max-w-[580px] w-full mx-auto text-center">
        <h3 class="headtopTxt text-sm xl:text-base 2xl:text-xl mb-3 text-themegreen">Financial Skills for Your Future</h3>
        <h1 class="themeHeading text-[28px] lg:text-[32px] xl:text-[48px] 2xl:text-[64px] font-semibold leading-tight mb-16 max-w-[515px] mx-auto">Financial Skills for Your Future</h1>
        <div class="paraContent max-w-[515px] mx-auto text-sm xl:text-base 2xl:text-xl leading-snug mb-14">
            <p class="mb-4">Learn money management while having fun as a virtual citizen. Live your financial life in our virtual city.</p>
            <p>With a deep understanding of the ever-evolving financial landscape, we provide strategic advice, investment options, and financial planning services that ensure long-term growth.</p>
        </div>
        <a href="{{ route('contact') }}" class="themeBtn flex items-center mx-auto w-fit gap-2">Get in Touch
            <span class="icon">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 9.5H15M15 9.5L9.72 5M15 9.5L9.72 14" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
        </a>
    </div>
    <div class="rightGraphics w-fit"><img src="{{ asset('asset/front/images/banner-image2.svg') }}" alt=""></div>
</section>


<section class="progresSection my-10 lg:my-12 xl:my-16 2xl:my-20 px-5 lg:px-0">
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


<section class="blockSection my-16 lg:my-20 xl:my-24 2xl:my-24 px-5 lg:px-0">
    <div class="container mx-auto">
        <div class="max-w-[950px] w-full mx-auto flex flex-wrap gap-10 justify-between">
            <div class="max-w-[400px]">
                <div class="headingContent">
                    <h3 class="themeHeading2 text-[24px] md:text-[28px] lg:text-[32px] font-semibold leading-tight mb-10">Your Financial Journey Begins</h3>
                    <p class="text-base mb-14">You have arrived in our virtual city as a student. The city hall will give you a monthly salary to help you learn about money management. Now you need to rent an apartment, buy groceries, and decide how to spend the rest. Will you buy that new video game every month, or save for the future?</p>
                    <div class="imgIns">
                        <img src="{{ asset('asset/front/images/financial-graphics.svg')}}" class="max-w-full h-auto" alt="">
                    </div>
                </div>
            </div>
            <div class="max-w-[400px] self-end">
                <div class="headingContent">
                    <div class="imgIns mb-10">
                        <img src="{{ asset('asset/front/images/financial-graphics.svg')}}" class="max-w-full h-auto" alt="">
                    </div>
                    <p class="text-base mb-14">Every choice teaches you about budgeting and saving. Watch your savings grow as you learn what it takes to manage money like an adult.</p>
                    <a href="{{ route('register') }}" class="secondaryBtn">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contentBlockSec my-16 lg:my-20 xl:my-24 2xl:my-24 bg-themeyellow py-20 border-b border-color-[#D9D9D9] px-5 lg:px-0">
    <div class="container mx-auto text-center">
        <div class="heading mb-10">
            <h4 class="themeHeading2 text-[24px] md:text-[28px] lg:text-[32px] font-semibold leading-tight mb-2">Why Financial education and practice matters?</h4>
            <p class="text-md xl:text-base">When you turn 18, you'll already know how to handle money, pay bills, and make smart financial decisions. You'll be ahead of the game!</p>
        </div>
        <h2 class="themeHeading text-[28px] lg:text-[32px] xl:text-[48px] 2xl:text-[64px] font-semibold leading-tight mb-4">Ready to Begin? Complete Your Setup!</h2>
        <p class="text-md xl:text-base">When you turn 18, you'll already know how to handle money, pay bills, and make smart financial decisions. You'll be ahead of the game!</p>
        <a href="{{ route('register') }}" class="themeBtn flex align-center justify-center w-fit gap-2 mx-auto mt-10">
            Register Account
            <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 10.3H15M15 10.3L9.72 5.80005M15 10.3L9.72 14.8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </a>
    </div>
</section>

<section class="faqSection my-16 lg:my-20 xl:my-24 2xl:my-24 px-5 lg:px-0">
    <div class="container mx-auto">
        <div class="heading mb-12 text-center">
            <h4 class="themeHeading2 text-[24px] md:text-[28px] lg:text-[32px] font-semibold leading-tight mb-2">Frequently Asked Questions?</h4>
        </div>
        <div class="mx-auto max-w-[720px] themeAccordian">
            <div class="accordion mb-4 rounded-lg border border-black/20 bg-themeyellow">
                <button class="accordion-toggle w-full pl-[30px] py-4 pr-10 text-left font-medium text-md xl:text-[18px] text-black">
                    Is it a paid or free financial education practice learning process?
                </button>
                <div class="accordion-content px-6 text-black text-md xl:text-base leading-relaxed">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
            </div>

            <!-- Accordion Item -->
            <div class="accordion mb-4 rounded-lg border border-black/20 bg-themeyellow">
                <button class="accordion-toggle w-full pl-[30px] py-4 pr-10 text-left font-medium text-md xl:text-[18px] text-black">
                    How much time it takes to become financially independent?
                </button>
                <div class="accordion-content px-6 text-black text-md xl:text-base leading-relaxed">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
            </div>

            <!-- Accordion Item -->
            <div class="accordion mb-4 rounded-lg border border-black/20 bg-themeyellow">
                <button class="accordion-toggle w-full pl-[30px] py-4 pr-10 text-left font-medium text-md xl:text-[18px] text-black">
                    In what age I can start learning?
                </button>
                <div class="accordion-content px-6 text-black text-md xl:text-base leading-relaxed">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
            </div>
            <div class="accordion mb-4 rounded-lg border border-black/20 bg-themeyellow">
                <button class="accordion-toggle w-full pl-[30px] py-4 pr-10 text-left font-medium text-md xl:text-[18px] text-black">
                    Do I need to pay anything to start here?
                </button>
                <div class="accordion-content px-6 text-black text-md xl:text-base leading-relaxed">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
            </div>
            <div class="accordion mb-4 rounded-lg border border-black/20 bg-themeyellow">
                <button class="accordion-toggle w-full pl-[30px] py-4 pr-10 text-left font-medium text-md xl:text-[18px] text-black">
                    Can I use this learning from any school belongs to any country?
                </button>
                <div class="accordion-content px-6 text-black text-md xl:text-base leading-relaxed">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
            </div>
            <div class="accordion mb-4 rounded-lg border border-black/20 bg-themeyellow">
                <button class="accordion-toggle w-full pl-[30px] py-4 pr-10 text-left font-medium text-md xl:text-[18px] text-black">
                    How this works, what’s the process after setting up an account here?
                </button>
                <div class="accordion-content px-6 text-black text-md xl:text-base leading-relaxed">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
            </div>
        </div>
    </div>
</section>
@endsection