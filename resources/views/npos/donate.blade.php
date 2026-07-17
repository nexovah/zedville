@extends('layouts.profile')

@section('title', 'NPOs Donate Now')

@section('content')
@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
        .success-checkmark {
            animation: scaleIn 0.5s ease-out;
        }
        @keyframes scaleIn {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); opacity: 1; }
        }
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            opacity: 0;
        }
        @keyframes confettiFall {
            0% { transform: translateY(-100px) rotate(0deg); opacity: 1; }
            100% { transform: translateY(400px) rotate(720deg); opacity: 0; }
        }
        .float-gentle {
            animation: floatGentle 3s ease-in-out infinite;
        }
        @keyframes floatGentle {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endpush
<!-- <div class="flex flex-col items-start justify-between pb-6 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-xl font-bold whitespace-nowrap ">Donate Now</h1>
</div> -->
<div class="flex items-center justify-between">
    
    <!-- Left Side - Page Title -->
    <h1 class="text-xl font-bold whitespace-nowrap">
        Donate Now
    </h1>

    <!-- Right Side - Back Button -->
    <button onclick="history.back()"
        class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 transition">

        Back

        <svg xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 5l7 7-7 7" />
        </svg>
    </button>

</div>
<div class="grid grid-cols-1 gap-5" x-data="{viewPin: false  }">
<div class="row">
    <div class="col-12">
        <div class="w-full p-4 sm:p-6 lg:p-8">
                <div class="w-full">

                    <!-- Checkout Card -->
                    <div id="checkoutForm" class="bg-white rounded-3xl shadow-xl shadow-warm-200/40 overflow-hidden border border-warm-100">
                        
                        <!-- Organization Header -->
                        <div class="bg-gradient-to-r from-sage-100 via-cream-100 to-warm-100 p-6">
                            <div class="flex items-center gap-4">
                                <div id="orgIcon" class="float-gentle w-16 h-16 bg-white rounded-2xl shadow-md flex items-center justify-center text-3xl">
                                    🐾
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-sage-500 font-semibold uppercase tracking-wider mb-1">You're donating to</p>
                                    <h2 id="orgName" class="text-xl font-bold text-gray-800">{{ $name }}</h2>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Account: <span id="orgAccount" class="font-mono text-gray-600">{{ $accNO }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Content -->
                        <div class="p-6 space-y-5">
                            
                            <!-- Donation Amount -->
                            <div class="bg-gradient-to-r from-warm-50 to-blush-50 rounded-2xl p-4 border border-warm-100">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="text-2xl">💝</span>
                                        <span class="text-gray-600 font-medium">Your Donation</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <input type="number" id="donationAmount" placeholder="0.00" min="1" step="0.01" class="w-28 text-right text-2xl font-bold text-warm-600 bg-transparent border-b-2 border-warm-300 focus:border-warm-500 outline-none placeholder-warm-300">
                                        <span class="text-lg font-semibold text-warm-500">Zed</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Information Section -->
                            <div class="space-y-4">
                                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wide flex items-center gap-2">
                                    <svg class="w-4 h-4 text-sage-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Card Information
                                </h3>

                                <!-- Cardholder Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-2">Cardholder Name</label>
                                    <input type="text" placeholder="Name on card" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-warm-400 focus:ring-4 focus:ring-warm-100 outline-none transition-all text-gray-700 placeholder-gray-400" value="{{ $bankAccount ? $bankAccount->student_name : '' }}">
                                </div>

                                <!-- Card Number -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-2">Card Number</label>
                                    <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-warm-400 focus:ring-4 focus:ring-warm-100 outline-none transition-all text-gray-700 placeholder-gray-400 font-mono tracking-wide" value="{{ $bankAccount ? trim(chunk_split($bankAccount->card_number, 4, ' ')) : '' }}">
                                </div>

                                <!-- Expiry & CVV Row -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">Expiry Date</label>
                                        <input type="text" id="expiryDate" placeholder="MM/YY" maxlength="5" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-warm-400 focus:ring-4 focus:ring-warm-100 outline-none transition-all text-gray-700 placeholder-gray-400 font-mono" value="{{ $bankAccount ? \Carbon\Carbon::parse($bankAccount->card_valid)->format('m/y') : '' }}">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">CVV</label>
                                        <input type="password" placeholder="•••" maxlength="4" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-warm-400 focus:ring-4 focus:ring-warm-100 outline-none transition-all text-gray-700 placeholder-gray-400 font-mono tracking-widest" value="{{ $bankAccount ? $bankAccount->card_cvv : '' }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Divider -->
                            <div class="border-t border-dashed border-gray-200"></div>

                            <!-- PIN Entry Section -->
                            <div class="space-y-3">
                                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide flex items-center gap-2">
                                    <svg class="w-4 h-4 text-sage-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Enter your 4-digit PIN
                                </label>
                                <div class="flex justify-center gap-3">
                                    <input type="password" maxlength="1" class="pin-input w-14 h-14 text-center text-2xl font-bold border-2 border-gray-200 rounded-xl focus:border-warm-400 focus:ring-4 focus:ring-warm-100 outline-none transition-all bg-cream-50" data-index="0">
                                    <input type="password" maxlength="1" class="pin-input w-14 h-14 text-center text-2xl font-bold border-2 border-gray-200 rounded-xl focus:border-warm-400 focus:ring-4 focus:ring-warm-100 outline-none transition-all bg-cream-50" data-index="1">
                                    <input type="password" maxlength="1" class="pin-input w-14 h-14 text-center text-2xl font-bold border-2 border-gray-200 rounded-xl focus:border-warm-400 focus:ring-4 focus:ring-warm-100 outline-none transition-all bg-cream-50" data-index="2">
                                    <input type="password" maxlength="1" class="pin-input w-14 h-14 text-center text-2xl font-bold border-2 border-gray-200 rounded-xl focus:border-warm-400 focus:ring-4 focus:ring-warm-100 outline-none transition-all bg-cream-50" data-index="3">
                                </div>
                                <p id="pinError" class="text-center text-sm text-red-500 hidden">Please enter a valid 4-digit PIN</p>
                                
                                <!-- Forgot PIN Link -->
                                <div class="text-center pt-1">
                                    <p class="text-sm text-gray-500">
                                        Forgot your PIN? <!--href="#my-accounts" id="forgotPinLink" -->
                                        <a href="javascript:void(0)"  @click="viewPin = true" class="text-warm-500 hover:text-warm-600 font-semibold inline-flex items-center gap-1 hover:underline transition-colors">
                                            Click here to view your PIN
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <!-- Confirm Button -->
                            <button id="confirmBtn" class="w-full bg-gradient-to-r from-warm-400 to-warm-500 hover:from-warm-500 hover:to-warm-600 text-white font-bold py-4 px-6 rounded-2xl shadow-lg shadow-warm-300/40 transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-3 text-lg">
                                <span class="text-xl">💝</span>
                                Confirm Donation
                            </button>

                            <!-- Security Note -->
                            <p class="text-center text-xs text-gray-400 flex items-center justify-center gap-1.5">
                                <svg class="w-4 h-4 text-sage-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                Your transaction is secured with 256-bit encryption
                            </p>
                        </div>
                    </div>

                    <!-- Thank You Screen (Hidden by default) -->
                    <div id="thankYouScreen" class="bg-white rounded-3xl shadow-xl shadow-warm-200/40 overflow-hidden border border-warm-100 hidden relative">
                        <div id="confettiContainer" class="absolute inset-0 overflow-hidden pointer-events-none"></div>
                        
                        <div class="p-8 text-center relative z-10">
                            <!-- Success Checkmark -->
                            <div class="success-checkmark w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-sage-300 to-sage-500 rounded-full flex items-center justify-center shadow-lg shadow-sage-300/40">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            
                            <h2 class="text-3xl font-bold text-gray-800 mb-2">Thank You! 🎉</h2>
                            <p class="text-lg text-warm-500 font-bold mb-4"><span id="donatedAmount">0.00</span> Zed Donated Successfully</p>
                            
                            <p id="thankYouMessage" class="text-gray-600 mb-6 leading-relaxed">
                                Your generous donation will help provide food, shelter, and medical care for rescued animals. Every contribution makes a difference!
                            </p>
                            
                            <div class="bg-cream-100 rounded-xl p-4 mb-6">
                                <p class="text-sm text-gray-500 mb-1">Transaction Reference</p>
                                <!-- <p id="transactionRef" class="font-mono text-gray-700 font-bold">TXN-2024-XXXXX</p> -->
                                <p id="transactionRef" class="font-mono text-gray-700 font-bold"></p>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row gap-3">
                                <button id="newDonationBtn" class="flex-1 bg-gradient-to-r from-warm-400 to-warm-500 hover:from-warm-500 hover:to-warm-600 text-white font-semibold py-3 px-4 rounded-xl transition-all shadow-md">
                                    Make Another Donation
                                </button>
                                <button class="flex-1 bg-sage-100 hover:bg-sage-200 text-sage-700 font-semibold py-3 px-4 rounded-xl transition-colors">
                                    Download Receipt
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Organization Selector (Demo) -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-500 mb-3">Select an organization</p>
                        <div class="flex flex-wrap justify-center gap-2">
                            <button onclick="selectOrganization('animal')" class="org-btn px-3 py-2 text-xs font-medium bg-white rounded-full border border-gray-200 hover:border-warm-300 hover:bg-warm-50 transition-colors shadow-sm">🐾 Animal Shelter</button>
                            <button onclick="selectOrganization('senior')" class="org-btn px-3 py-2 text-xs font-medium bg-white rounded-full border border-gray-200 hover:border-warm-300 hover:bg-warm-50 transition-colors shadow-sm">👴 Senior Care</button>
                            <button onclick="selectOrganization('children')" class="org-btn px-3 py-2 text-xs font-medium bg-white rounded-full border border-gray-200 hover:border-warm-300 hover:bg-warm-50 transition-colors shadow-sm">🧒 Children's Orphanage</button>
                            <button onclick="selectOrganization('food')" class="org-btn px-3 py-2 text-xs font-medium bg-white rounded-full border border-gray-200 hover:border-warm-300 hover:bg-warm-50 transition-colors shadow-sm">🍎 Food Bank</button>
                            <button onclick="selectOrganization('library')" class="org-btn px-3 py-2 text-xs font-medium bg-white rounded-full border border-gray-200 hover:border-warm-300 hover:bg-warm-50 transition-colors shadow-sm">📚 Local Library</button>
                            <button onclick="selectOrganization('community')" class="org-btn px-3 py-2 text-xs font-medium bg-white rounded-full border border-gray-200 hover:border-warm-300 hover:bg-warm-50 transition-colors shadow-sm">🏠 Community Center</button>
                            <button onclick="selectOrganization('eco')" class="org-btn px-3 py-2 text-xs font-medium bg-white rounded-full border border-gray-200 hover:border-warm-300 hover:bg-warm-50 transition-colors shadow-sm">🌱 EcoFun</button>
                        </div>
                    </div>
                </div>
            </div> 
    </div>
</div>
<!-- For Model -->
  <!-- View Pin Modal -->
    <div
        x-show="viewPin"
        x-transition.opacity
        class="fixed w-full h-full z-100 overflow-y-auto top-0 left-0 overflow-x-hidden themeModal"
        @keydown.escape.window="viewPin = false" style="display: none;">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50" @click="viewPin = false"></div>
        <!-- Modal Box -->
        <div class="modalDilog max-w-[450px]">
            <div class="modalContent bg-white py-12 px-6 rounded-lg z-100 border border-color-[#D2DDDB]">
                <div class="flex justify-between items-center mb-4">
                    <button @click="viewPin = false" class="absolute top-4 right-4 text-gray-500 hover:opacity-80 focus:outline-none transition">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="9" fill="#E7FBF3" />
                            <path d="M16 8L8 16" stroke="#016950" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8 8L16 16" stroke="#016950" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <div class="bodyContent">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye text-green-600">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Your PIN</h3>
                            <p class="text-sm text-gray-600">Debit Card PIN</p>
                        </div>
                    </div>
                    <div class="bg-green-50 p-3 rounded border border-green-200">
                        <div class="text-xl text-center text-green-800 font-bold mb-3">{{$bankAccount->card_pin}}</div>
                        <div class="text-md text-center text-green-800 font-semibold mb-2">📌 Important PIN Security Information:</div>
                        <ul class="text-left space-y-1">
                            <li>• Never share your PIN with anyone</li>
                            <li>• Use your PIN for ATM withdrawals and card purchases</li>
                            <li>• Cover the keypad when entering your PIN</li>
                            <li>• Change your PIN regularly for security</li>
                            <li>• Contact us immediately if compromised</li>
                        </ul>
                    </div>
                    <div class="text-center mt-8">
                        <button @click="viewPin = false" class="themeBtn w-full">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@push('scripts')
    <script src="https://cdn.tailwindcss.com"></script>

<script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Nunito', 'sans-serif'],
                    },
                    colors: {
                        warm: {
                            50: '#f0fdf6',
                            100: '#dcfce9',
                            200: '#bbf7d4',
                            300: '#86efb8',
                            400: '#1a9e5a',
                            500: '#157a46',
                            600: '#0f6e3d',
                            700: '#0a4f2c',
                        },
                        sage: {
                            50: '#f0fdf6',
                            100: '#e6f7ef',
                            200: '#c3e9d5',
                            300: '#86cfaa',
                            400: '#1a9e5a',
                            500: '#157a46',
                        },
                        blush: {
                            50: '#f0fdf6',
                            100: '#e6f7ef',
                            200: '#c3e9d5',
                            300: '#86cfaa',
                            400: '#4ade80',
                        },
                        cream: {
                            50: '#f7faf9',
                            100: '#e6f7ef',
                            200: '#c3e9d5',
                        }
                    }
                }
            }
        }
        //Second Code
        // Organization Data with Thank You Messages
        const organizations = {
            animal: {
                name: "Animal Shelter",
                icon: "🐾",
                account: "1234-5678-9012",
                thankYouMessage: "Your generous donation will help provide food, shelter, and medical care for rescued animals. Because of supporters like you, we can continue giving abandoned pets a second chance at a loving home. Every wagging tail and purring kitten thanks you! 🐕🐈"
            },
            senior: {
                name: "Senior Care",
                icon: "👴",
                account: "2345-6789-0123",
                thankYouMessage: "Thank you for caring for our community's elders! Your donation supports daily activities, nutritious meals, and companionship programs that bring joy and dignity to seniors. You're helping ensure our loved ones age with grace and connection. 💝"
            },
            children: {
                name: "Children's Orphanage",
                icon: "🧒",
                account: "3456-7890-1234",
                thankYouMessage: "You're helping build brighter futures! Your donation provides education, healthcare, and a nurturing environment for children who need it most. Every child deserves to dream big, and you're making that possible. Thank you for being their champion! ⭐"
            },
            food: {
                name: "Food Bank",
                icon: "🍎",
                account: "4567-8901-2345",
                thankYouMessage: "No one should go hungry, and because of you, they won't! Your donation helps us provide nutritious meals to families facing food insecurity. Together, we're fighting hunger one meal at a time. Thank you for feeding hope in our community! 🥗"
            },
            library: {
                name: "Local Library",
                icon: "📚",
                account: "5678-9012-3456",
                thankYouMessage: "Knowledge is power, and you're empowering our community! Your donation supports new book acquisitions, educational programs, and free resources for learners of all ages. Thank you for investing in literacy and lifelong learning! 📖✨"
            },
            community: {
                name: "Community Center",
                icon: "🏠",
                account: "6789-0123-4567",
                thankYouMessage: "You're strengthening the heart of our neighborhood! Your donation funds youth programs, fitness classes, and community events that bring people together. Thank you for helping us build a more connected, vibrant community! 🤝"
            },
            eco: {
                name: "EcoFun",
                icon: "🌱",
                account: "7890-1234-5678",
                thankYouMessage: "Thank you for choosing our planet! Your donation supports environmental education, tree planting initiatives, and sustainability projects. Together, we're nurturing a greener, healthier world for future generations. Earth thanks you! 🌍💚"
            }
        };

        let currentOrg = 'animal';

        // DOM Elements
        const pinInputs = document.querySelectorAll('.pin-input');
        const confirmBtn = document.getElementById('confirmBtn');
        const checkoutForm = document.getElementById('checkoutForm');
        const thankYouScreen = document.getElementById('thankYouScreen');
        const pinError = document.getElementById('pinError');
        const forgotPinLink = document.getElementById('forgotPinLink');
        const newDonationBtn = document.getElementById('newDonationBtn');
        const cardNumberInput = document.getElementById('cardNumber');
        const expiryDateInput = document.getElementById('expiryDate');

        // Card Number Formatting
        cardNumberInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
            e.target.value = value.substring(0, 19);
        });

        // Expiry Date Formatting
        expiryDateInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });

        // PIN Input Handling
        pinInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                const value = e.target.value;
                
                if (!/^\d*$/.test(value)) {
                    e.target.value = '';
                    return;
                }

                if (value.length === 1 && index < pinInputs.length - 1) {
                    pinInputs[index + 1].focus();
                }

                pinError.classList.add('hidden');
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    pinInputs[index - 1].focus();
                }
            });

            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text').replace(/\D/g, '').slice(0, 4);
                pastedData.split('').forEach((char, i) => {
                    if (pinInputs[i]) {
                        pinInputs[i].value = char;
                    }
                });
                if (pastedData.length === 4) {
                    pinInputs[3].focus();
                }
            });
        });

        // Confirm Donation
        confirmBtn.addEventListener('click', () => {
            const pin = Array.from(pinInputs).map(input => input.value).join('');
            const amount = document.getElementById('donationAmount').value;
            // Amount validation
            if (amount === '' || parseFloat(amount) <= 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Donation Amount Required',
                    text: 'Please enter a valid donation amount.',
                    confirmButtonColor: '#16a34a'
                });
                document.getElementById('donationAmount').focus();
                return;
            }
            if (pin.length !== 4) {
                pinError.classList.remove('hidden');
                pinInputs[0].focus();
                return;
            }

            confirmBtn.disabled = true;
            confirmBtn.innerHTML = `
                <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
            `;
            //New Ajax code here to process the donation and handle response
            //const amount = document.getElementById('donationAmount').value;
            const npo_name = document.getElementById('orgName').innerText;
            const account_no = document.getElementById('orgAccount').innerText;
            fetch("{{ route('education.store.storeDonation') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    npo_name: npo_name,
                    account_no: account_no,
                    amount: amount,
                    pin: pin
                })
            })
            .then(res => res.json())
            .then(data => {

                if(data.status){

                    document.getElementById('transactionRef').textContent = data.txn;

                    // ✅ Show thank you screen AFTER database success
                    setTimeout(() => {
                        showThankYouScreen();
                    }, 1000);

                }else{

                    pinError.innerText = "Incorrect PIN";
                    pinError.classList.remove('hidden');

                    confirmBtn.disabled = false;
                    confirmBtn.innerHTML = `
                        <span class="text-xl">💝</span>
                        Confirm Donation
                    `;
                }

            });
            /*setTimeout(() => {
                showThankYouScreen();
            }, 1500);*/
        });

        // Show Thank You Screen
        function showThankYouScreen() {
            //const txnRef = 'TXN-2024-' + Math.random().toString(36).substr(2, 5).toUpperCase();
            //document.getElementById('transactionRef').textContent = txnRef;
            document.getElementById('thankYouMessage').textContent = organizations[currentOrg].thankYouMessage;
            
            // Display the donated amount
            const amount = document.getElementById('donationAmount').value || '0.00';
            document.getElementById('donatedAmount').textContent = parseFloat(amount).toFixed(2);

            checkoutForm.classList.add('hidden');
            thankYouScreen.classList.remove('hidden');

            createConfetti();
        }

        // Create Confetti Animation
        function createConfetti() {
            const container = document.getElementById('confettiContainer');
            const colors = ['#1a9e5a', '#86efb8', '#e6f7ef', '#157a46', '#0f6e3d', '#bbf7d4'];
            
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.borderRadius = Math.random() > 0.5 ? '50%' : '0';
                confetti.style.width = (Math.random() * 10 + 5) + 'px';
                confetti.style.height = (Math.random() * 10 + 5) + 'px';
                confetti.style.animation = `confettiFall ${Math.random() * 2 + 2}s ease-out ${Math.random() * 0.5}s forwards`;
                container.appendChild(confetti);
            }

            setTimeout(() => {
                container.innerHTML = '';
            }, 4000);
        }

        // New Donation Button
        newDonationBtn.addEventListener('click', () => {
            pinInputs.forEach(input => input.value = '');
            confirmBtn.disabled = false;
            confirmBtn.innerHTML = `
                <span class="text-xl">💝</span>
                Confirm Donation
            `;

            thankYouScreen.classList.add('hidden');
            checkoutForm.classList.remove('hidden');
        });

        // Forgot PIN Link
        forgotPinLink.addEventListener('click', (e) => {
            e.preventDefault();
            alert('Navigating to My Accounts → Security → View PIN\n\nThis would redirect you to your account dashboard where you can securely view or reset your PIN.');
        });

        // Select Organization (Demo)
        function selectOrganization(orgKey) {
            currentOrg = orgKey;
            const org = organizations[orgKey];
            
            document.getElementById('orgName').textContent = org.name;
            document.getElementById('orgIcon').textContent = org.icon;
            document.getElementById('orgAccount').textContent = org.account;

            if (!thankYouScreen.classList.contains('hidden')) {
                newDonationBtn.click();
            }
        }
    </script>
@endpush