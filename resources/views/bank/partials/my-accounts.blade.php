<div class="myAccountSec">
    <h3 class="text-lg font-bold whitespace-nowrap ">My Account</h3>

    <div class="flex-1 bg-white mt-6">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-credit-card text-blue-600">
                <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                <line x1="2" x2="22" y1="10" y2="10"></line>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900 mb-2 text-center">Account Details</h2>
        <p class="text-gray-600 text-center">Detailed account information and management tools</p>
    </div>
    <div class="flex flex-wrap gap-4 mt-6 hidden">
        <div class="w-full">
            <div class="flex items-center justify-between p-4 border rounded-lg transition-colors cursor-pointer hover:opacity-90 bg-green-50 border-green-200 hover:bg-green-100">
                <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-piggy-bank text-green-600">
                        <path d="M19 5c-1.5 0-2.8 1.4-3 2-3.5-1.5-11-.3-11 5 0 1.8 0 3 2 4.5V20h4v-2h3v2h4v-4c1-.5 1.7-1 2-2h2v-4h-2c0-1-.5-1.5-1-2h0V5z"></path>
                        <path d="M2 9v1c0 1.1.9 2 2 2h1"></path>
                        <path d="M16 11h0"></path>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-lg text-gray-900">{{ $bankAccount->primary_savings_account }}</h4>
                        <p class="text-md text-gray-600">{{ '•••• •••• ' . substr($bankAccount->primary_savings_account_number, -4) }} • 0% APY</p>
                        <p class="text-md text-gray-500 mt-1">Primary account for everyday spending</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="font-bold text-xl text-green-600">{{ number_format($bankAccount->primary_savings_account_amount) }} ZEDS</div>
                    <a href="#" class="text-md text-green-800 mt-1">View Agreement →</a>
                </div>
            </div>
        </div>
        <div class="w-full">
            <div class="flex items-center justify-between p-4 border rounded-lg transition-colors cursor-pointer hover:opacity-90 bg-orange-50 border-orange-200 hover:bg-orange-100">
                <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield text-orange-600">
                        <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-lg text-gray-900">{{ $bankAccount->emergency_fund_account }}</h4>
                        <p class="text-md text-gray-600">{{ '•••• •••• ' . substr($bankAccount->emergency_fund_account_number, -4) }} • 2% APY</p>
                        <p class="text-md text-gray-500 mt-1">Emergency savings with 2% interest</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="font-bold text-xl text-yellow-500">{{ number_format($bankAccount->emergency_fund_account_amount) }} ZEDS</div>
                    <a href="#" class="text-md text-yellow-600 mt-1">View Agreement →</a>
                </div>
            </div>
        </div>
        <div class="w-full">
            <div class="flex items-center justify-between p-4 border rounded-lg transition-colors cursor-pointer hover:opacity-90 bg-purple-50 border-purple-200 hover:bg-purple-100">
                <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up text-purple-600">
                        <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                        <polyline points="16 7 22 7 22 13"></polyline>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-gray-900">{{ $bankAccount->money_market_account }}</h4>
                        <p class="text-md text-gray-600">{{ '•••• •••• ' . substr($bankAccount->money_market_account_number, -4) }} • 4% APY</p>
                        <p class="text-md text-gray-500 mt-1">High-yield savings with 4% interest</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="font-bold text-xl text-purple-600">{{ number_format($bankAccount->money_market_account_amount) }} ZEDS</div>
                    <a href="#" class="text-md text-purple-800 mt-1">View Agreement →</a>
                </div>
            </div>
        </div>
    </div>

    <div class="accSummeryCardDtls mt-6 hidden">
        <div class="flex flex-wrap lg:flex-nowrap gap-6 items-start">
            <div class="w-full xl:w-[40%]">
                <div class="bg-white rounded-lg p-4 border border-[#D2DDDB] flex-shrink-0">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-credit-card text-themegreen mr-2">
                            <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                            <line x1="2" x2="22" y1="10" y2="10"></line>
                        </svg>{{ $bankAccount->card_name }}
                    </h3>
                    <div class="w-full h-40 bg-gradient-to-br from-gray-900 to-gray-700 rounded-lg p-3 text-white relative overflow-hidden mx-auto mb-4">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-white opacity-10 rounded-full -translate-y-6 translate-x-6"></div>
                        <div class="flex justify-between items-start mb-4">
                            <div class="text-xs font-medium">{{ $bankAccount->bank_name }}</div>
                            <div class="bg-yellow-400 text-black px-1.5 py-0.5 rounded text-xs font-bold">
                                {{ collect(explode(' ', $bankAccount->bank_name))->map(function($word) {
                                return strtoupper(substr($word, 0, 1));
                            })->implode('') }}
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="text-sm font-mono tracking-wider">{{ trim(chunk_split($bankAccount->card_number, 4, ' ')) }}</div>
                            <div class="flex justify-between items-end">
                                <div class="flex space-x-3">
                                    <div>
                                        <div class="text-xs opacity-75">VALID THRU</div>
                                        <div class="font-mono text-xs">{{ \Carbon\Carbon::parse($bankAccount->card_valid)->format('m/y') }}</div>
                                    </div>
                                    <div>
                                        <div class="text-xs opacity-75">CVV</div>
                                        <div class="font-mono text-xs">{{ $bankAccount->card_cvv }}</div>
                                    </div>
                                </div>
                                <div class="bg-white text-gray-900 px-1.5 py-0.5 rounded text-xs font-semibold">DEBIT</div>
                            </div>
                            <div class="mt-1">
                                <div class="text-xs opacity-75">CARDHOLDER</div>
                                <div class="font-medium text-xs">{{ $bankAccount->student_name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="inline-flex items-center space-x-2 bg-green-100 text-green-800 px-3 py-2 rounded-full">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div><span class="text-sm font-medium">Card Active</span>
                        </div>
                    </div>
                </div>
                <!-- Inactive Card Design -->
                <div class="bg-white rounded-lg p-4 border border-[#D2DDDB] flex-shrink-0 hidden">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-credit-card text-themegreen mr-2">
                            <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                            <line x1="2" x2="22" y1="10" y2="10"></line>
                        </svg>{{ $bankAccount->card_name }}
                    </h3>
                    <div class="w-full h-40 bg-gradient-to-br from-gray-900 to-gray-700 rounded-lg p-3 text-white relative overflow-hidden mx-auto mb-4 opacity-50">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-white opacity-10 rounded-full -translate-y-6 translate-x-6"></div>
                        <div class="flex justify-between items-start mb-4">
                            <div class="text-xs font-medium">{{ $bankAccount->bank_name }}</div>
                            <div class="bg-yellow-400 text-black px-1.5 py-0.5 rounded text-xs font-bold">
                                {{ collect(explode(' ', $bankAccount->bank_name))->map(function($word) {
                                return strtoupper(substr($word, 0, 1));
                            })->implode('') }}
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="text-sm font-mono tracking-wider">{{ trim(chunk_split($bankAccount->card_number, 4, ' ')) }}</div>
                            <div class="flex justify-between items-end">
                                <div class="flex space-x-3">
                                    <div>
                                        <div class="text-xs opacity-75">VALID THRU</div>
                                        <div class="font-mono text-xs">{{ \Carbon\Carbon::parse($bankAccount->card_valid)->format('m/y') }}</div>
                                    </div>
                                    <div>
                                        <div class="text-xs opacity-75">CVV</div>
                                        <div class="font-mono text-xs">{{ $bankAccount->card_cvv }}</div>
                                    </div>
                                </div>
                                <div class="bg-white text-gray-900 px-1.5 py-0.5 rounded text-xs font-semibold">{{ $bankAccount->card_type }}</div>
                            </div>
                            <div class="mt-1">
                                <div class="text-xs opacity-75">CARDHOLDER</div>
                                <div class="font-medium text-xs">{{ $bankAccount->student_name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="inline-flex items-center space-x-2 bg-gray-200 text-gray-400 px-3 py-2 rounded-full">
                            <div class="w-2 h-2 bg-gray-500 rounded-full"></div><span class="text-sm font-medium">Card Inactive</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full xl:w-[60%]">
                <div class="flex-1 bg-white rounded-lg p-6 border border-[#d2dddb]">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy text-themegreen mr-2">
                            <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                            <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                        </svg>Card Information
                    </h3>
                    <div class="grid grid-cols-1 gap-4 mb-6">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <div>
                                <div class="text-sm font-medium text-gray-700">Card Number</div>
                                <div class="font-mono text-sm text-gray-900">{{ trim(chunk_split($bankAccount->card_number, 4, ' ')) }}</div>
                            </div>
                            <button class="text-themegreen hover:text-black p-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy">
                                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <div>
                                <div class="text-sm font-medium text-gray-700">IBAN</div>
                                <div class="font-mono text-sm text-gray-900">{{ $bankAccount->card_iban }}</div>
                            </div>
                            <button class="text-themegreen hover:text-black p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy">
                                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <div>
                                <div class="text-sm font-medium text-gray-700">BIC/SWIFT</div>
                                <div class="font-mono text-sm text-gray-900">{{ $bankAccount->card_swift }}</div>
                            </div>
                            <button class="text-themegreen hover:text-black p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy">
                                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-[#d2dddb]">
                        <h4 class="text-md font-bold text-gray-900 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings text-themegreen mr-2">
                                <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>Card Controls
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <button @click="confirmationModal = true" class="themeBtn flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield">
                                    <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path>
                                </svg>
                                <span>Freeze Card</span>
                            </button>
                            <button class="whiteBtn flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings">
                                    <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <span>Card Settings</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>