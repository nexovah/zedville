@extends('layouts.profile')

@section('title', 'Frequently Asked Questions')

@section('content')
<div class="flex flex-col items-start justify-between pb-6 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-xl font-bold whitespace-nowrap ">Help & Support</h1>
</div>

<div class="grid grid-cols-1 gap-5 mt-6">
    <div class="themeTabspills">
        <div class="w-full">
            @include('bank.partials.bankmenu')
            <div class="py-6 lg:py-10 px-6 lg:px-8 w-full mt-4 border border-[#D2DDDB] rounded-lg">
                <div class="tab-content">
                    <div class="helpSection">
                        <div class="mb-8 text-center">
                            <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-help text-purple-600 mr-3">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                    <path d="M12 17h.01"></path>
                                </svg>Help &amp; Support
                            </h2>
                            <p class="text-gray-600 mt-2 text-md lg:text-lg">Find answers to your questions and get the help you need</p>
                        </div>
                        <div class="mb-8">
                            <div class="relative max-w-2xl mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </svg>
                                <input placeholder="Search for help topics, FAQs, or guides..." class="w-full pl-12 pr-4 py-4 border border-gray-300 rounded-lg focus:border-gray-400 text-lg" id="searchFaq" type="text" />
                            </div>
                        </div>
                        <div class="categorySec grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Help Categories</h3>
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                                    <a href="javascript:void(0);" class="w-full flex items-center space-x-3 p-3 rounded-lg transition-colors text-left border border-gray-200 hover:bg-gray-50 text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open">
                                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                        </svg>
                                        <span class="font-medium text-sm">All Topics</span>
                                    </a>
                                    <a href="#" class="w-full flex items-center space-x-3 p-3 rounded-lg transition-colors text-left border border-gray-200 hover:bg-gray-50 text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user">
                                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="font-medium text-sm">Account Management</span>
                                    </a>
                                    <a href="#" class="w-full flex items-center space-x-3 p-3 rounded-lg transition-colors text-left border border-gray-200 hover:bg-gray-50 text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-smartphone">
                                            <rect width="14" height="20" x="5" y="2" rx="2" ry="2"></rect>
                                            <path d="M12 18h.01"></path>
                                        </svg>
                                        <span class="font-medium text-sm">Online Banking</span>
                                    </a>
                                    <a href="#" class="w-full flex items-center space-x-3 p-3 rounded-lg transition-colors text-left border border-gray-200 hover:bg-gray-50 text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-right">
                                            <path d="M8 3 4 7l4 4"></path>
                                            <path d="M4 7h16"></path>
                                            <path d="m16 21 4-4-4-4"></path>
                                            <path d="M20 17H4"></path>
                                        </svg>
                                        <span class="font-medium text-sm">Transfers &amp; Payments</span>
                                    </a>
                                    <a href="#" class="w-full flex items-center space-x-3 p-3 rounded-lg transition-colors text-left border border-gray-200 hover:bg-gray-50 text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-credit-card">
                                            <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                                            <line x1="2" x2="22" y1="10" y2="10"></line>
                                        </svg>
                                        <span class="font-medium text-sm">Cards</span>
                                    </a>
                                    <a href="#" class="w-full flex items-center space-x-3 p-3 rounded-lg transition-colors text-left border border-gray-200 hover:bg-gray-50 text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield">
                                            <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path>
                                        </svg>
                                        <span class="font-medium text-sm">Security</span>
                                    </a>
                                    <a href="#" class="w-full flex items-center space-x-3 p-3 rounded-lg transition-colors text-left border border-gray-200 hover:bg-gray-50 text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text">
                                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                                            <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                            <path d="M10 9H8"></path>
                                            <path d="M16 13H8"></path>
                                            <path d="M16 17H8"></path>
                                        </svg>
                                        <span class="font-medium text-sm">Statements</span>
                                    </a>
                                </div>
                            </div>
                            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                                <div class="space-y-2">
                                    <a href="#" class="w-full flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50  border border-gray-200 transition-colors text-left">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock text-blue-600">
                                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 text-sm">Reset Password</p>
                                            <p class="text-xs text-gray-500">Quickly reset your online banking password</p>
                                        </div>
                                    </a>
                                    <a href="#" class="w-full flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors text-left">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search text-blue-600">
                                                <circle cx="11" cy="11" r="8"></circle>
                                                <path d="m21 21-4.3-4.3"></path>
                                            </svg></div>
                                        <div>
                                            <p class="font-medium text-gray-900 text-sm">Find ATM/Branch</p>
                                            <p class="text-xs text-gray-500">Locate the nearest ATM or branch</p>
                                        </div>
                                    </a>
                                    <a href="#" class="w-full flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors text-left">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert text-blue-600">
                                                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"></path>
                                                <path d="M12 9v4"></path>
                                                <path d="M12 17h.01"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 text-sm">Report Fraud</p>
                                            <p class="text-xs text-gray-500">Report suspicious account activity</p>
                                        </div>
                                    </a>

                                    <a href="#" class="w-full flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors text-left">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text text-blue-600">
                                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                                                <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                                <path d="M10 9H8"></path>
                                                <path d="M16 13H8"></path>
                                                <path d="M16 17H8"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 text-sm">Account Statements</p>
                                            <p class="text-xs text-gray-500">Access your account statements</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Popular Help Topics</h3>
                            <div class="populartopicLists space-y-2">
                                <a href="#" class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                        <span class="font-medium text-gray-900">How do I reset my online banking password?</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="text-xs text-gray-500">15,234 views</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right text-gray-400">
                                            <path d="m9 18 6-6-6-6"></path>
                                        </svg>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                        <span class="font-medium text-gray-900">How to set up a money transfer</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="text-xs text-gray-500">12,856 views</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right text-gray-400">
                                            <path d="m9 18 6-6-6-6"></path>
                                        </svg>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                        <span class="font-medium text-gray-900">Understanding account fees</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="text-xs text-gray-500">11,492 views</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right text-gray-400">
                                            <path d="m9 18 6-6-6-6"></path>
                                        </svg>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                        <span class="font-medium text-gray-900">How to download bank statements</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="text-xs text-gray-500">9,781 views</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right text-gray-400">
                                            <path d="m9 18 6-6-6-6"></path>
                                        </svg>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                        <span class="font-medium text-gray-900">Card security features</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="text-xs text-gray-500">8,634 views</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right text-gray-400">
                                            <path d="m9 18 6-6-6-6"></path>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Frequently Asked Questions</h3>
                            <div class="themeAccordian" id="faqaccordians">
                                <div class="accordion mb-4 rounded-lg border border-black/20 bg-themeyellow">
                                    <button class="accordion-toggle w-full pl-[30px] py-4 pr-10 text-left font-medium text-md xl:text-[16px] text-black">
                                        How do I update my personal information?
                                    </button>
                                    <div class="accordion-content px-6 text-black text-md xl:text-base leading-relaxed">
                                        You can update your personal information by logging into your account and navigating to Profile & Settings. From there, you can edit your contact details, address, and other personal information. Some changes may require verification.
                                    </div>
                                </div>
                                <div class="accordion mb-4 rounded-lg border border-black/20 bg-themeyellow">
                                    <button class="accordion-toggle w-full pl-[30px] py-4 pr-10 text-left font-medium text-md xl:text-[16px] text-black">
                                        Why am I locked out of my account?
                                    </button>
                                    <div class="accordion-content px-6 text-black text-md xl:text-base leading-relaxed">
                                        Account lockouts typically occur after multiple unsuccessful login attempts for security reasons. You can unlock your account by using the "Forgot Password" link on the login page or by contacting our support team.
                                    </div>
                                </div>
                                <div class="accordion mb-4 rounded-lg border border-black/20 bg-themeyellow">
                                    <button class="accordion-toggle w-full pl-[30px] py-4 pr-10 text-left font-medium text-md xl:text-[16px] text-black">
                                        What are the transfer limits?
                                    </button>
                                    <div class="accordion-content px-6 text-black text-md xl:text-base leading-relaxed">
                                        Transfer limits vary based on your account type and verification level. Standard accounts have no daily limits for internal transfers between your own accounts. External transfers and new beneficiaries may have different limits for security.
                                    </div>
                                </div>
                                <div class="accordion mb-4 rounded-lg border border-black/20 bg-themeyellow">
                                    <button class="accordion-toggle w-full pl-[30px] py-4 pr-10 text-left font-medium text-md xl:text-[16px] text-black">
                                        How do I report a lost or stolen card?
                                    </button>
                                    <div class="accordion-content px-6 text-black text-md xl:text-base leading-relaxed">
                                        Immediately lock your card through the mobile app or online banking. You can then order a replacement card, which will arrive within 3-5 business days. Your account remains protected with zero liability for unauthorized transactions.
                                    </div>
                                </div>
                                <div class="accordion mb-4 rounded-lg border border-black/20 bg-themeyellow">
                                    <button class="accordion-toggle w-full pl-[30px] py-4 pr-10 text-left font-medium text-md xl:text-[16px] text-black">
                                        How do I set up two-factor authentication?
                                    </button>
                                    <div class="accordion-content px-6 text-black text-md xl:text-base leading-relaxed">
                                        Go to Security Settings in your account dashboard. Enable two-factor authentication and choose your preferred method (SMS or authenticator app). You will receive a verification code each time you log in from a new device.
                                    </div>
                                </div>
                                <div class="accordion mb-4 rounded-lg border border-black/20 bg-themeyellow">
                                    <button class="accordion-toggle w-full pl-[30px] py-4 pr-10 text-left font-medium text-md xl:text-[16px] text-black">
                                        How far back can I access my statements?
                                    </button>
                                    <div class="accordion-content px-6 text-black text-md xl:text-base leading-relaxed">
                                        Digital statements are available for up to 7 years through your online banking account. You can view, download, or print statements from the Statements section. Older statements can be requested through our secure message center.
                                    </div>
                                </div>
                            </div>
                            <div id="faqnoresultsec" style="display: none;">
                                <div class="text-center py-8"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search mx-auto text-gray-400 mb-4">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <path d="m21 21-4.3-4.3"></path>
                                    </svg>
                                    <p class="text-gray-500">No results found. Try adjusting your search or category filter.</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-red-50 to-orange-50 rounded-xl p-6 border border-red-200 mb-8">
                            <div class="flex items-center space-x-3 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield text-red-600">
                                    <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path>
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-900">Security Tips</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-3">
                                    <div class="flex items-start space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check text-green-600 mt-1">
                                            <path d="M20 6 9 17l-5-5"></path>
                                        </svg>
                                        <div>
                                            <p class="font-medium text-gray-900 text-sm">Use Strong Passwords</p>
                                            <p class="text-xs text-gray-600">Create unique passwords with letters, numbers, and symbols</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check text-green-600 mt-1">
                                            <path d="M20 6 9 17l-5-5"></path>
                                        </svg>
                                        <div>
                                            <p class="font-medium text-gray-900 text-sm">Enable Two-Factor Authentication</p>
                                            <p class="text-xs text-gray-600">Add an extra layer of security to your account</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex items-start space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check text-green-600 mt-1">
                                            <path d="M20 6 9 17l-5-5"></path>
                                        </svg>
                                        <div>
                                            <p class="font-medium text-gray-900 text-sm">Monitor Your Accounts</p>
                                            <p class="text-xs text-gray-600">Regularly check for unauthorized transactions</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check text-green-600 mt-1">
                                            <path d="M20 6 9 17l-5-5"></path>
                                        </svg>
                                        <div>
                                            <p class="font-medium text-gray-900 text-sm">Secure Your Devices</p>
                                            <p class="text-xs text-gray-600">Keep your devices updated and use secure networks</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Service Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h3 class="font-medium text-gray-900 mb-3">Digital Banking</h3>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between"><span class="text-gray-600">Online Banking:</span><span class="font-medium">24/7 Available</span></div>
                                        <div class="flex justify-between"><span class="text-gray-600">Mobile App:</span><span class="font-medium">24/7 Available</span></div>
                                        <div class="flex justify-between"><span class="text-gray-600">ATM Network:</span><span class="font-medium">24/7 Access</span></div>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900 mb-3">Support Response Times</h3>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between"><span class="text-gray-600">Secure Messages:</span><span class="font-medium">Within 24 hours</span></div>
                                        <div class="flex justify-between"><span class="text-gray-600">Account Issues:</span><span class="font-medium">Same business day</span></div>
                                        <div class="flex justify-between"><span class="text-gray-600">Fraud Reports:</span><span class="font-medium">Immediate response</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection