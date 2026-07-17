@extends('layouts.profile')

@section('title', 'Bank Account')

@section('content')
<div class="flex flex-col items-start justify-between pb-6 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-xl font-bold whitespace-nowrap ">Bank Account</h1>
</div>
<div class="grid grid-cols-1 gap-5 mt-6"  x-data="{ confirmationModal: false }">
    <div class="themeTabspills">
        <div class="w-full">
            <!-- Tabs Header -->
            @include('bank.partials.bankmenu')

            <div class="tailCard py-6 lg:py-10 px-6 lg:px-8 max-w-[1000px] w-full mt-4 border border-[#D2DDDB] rounded-lg">
                <div class="tabcontent active">
                    @include('bank.partials.dashboard')
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->

    <div
        x-show="confirmationModal"
        x-transition.opacity
        class="fixed w-full h-full z-100 overflow-y-auto top-0 left-0 overflow-x-hidden themeModal"
        @keydown.escape.window="confirmationModal = false" style="display: none;">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50" @click="confirmationModal = false"></div>

        <!-- Modal Box -->
        <div class="modalDilog max-w-[450px]">
            <div class="modalContent bg-white py-12 px-14 rounded-lg z-100 border border-color-[#D2DDDB]">
                <div class="flex justify-between items-center mb-4">
                    <button @click="confirmationModal = false" class="absolute top-4 right-4 text-gray-500 hover:opacity-80 focus:outline-none transition">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="9" fill="#E7FBF3" />
                            <path d="M16 8L8 16" stroke="#016950" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8 8L16 16" stroke="#016950" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <div class="bodyContent">
                    <div class="text-center">
                        <h4 class="text-xl font-semibold text-black mb-4">Your Card Has Been Successfully Frozen</h4>
                        <p>You’ve successfully frozen your card. If this wasn’t you, please contact our support team immediately.</p>
                        <div class="text-center mt-8">
                            <button class="themeBtn">Confirm</button>
                            <button @click="confirmationModal = false" class="whiteBtn ml-2">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection