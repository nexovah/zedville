@extends('layouts.profile')

@section('title', 'Account Statements')

@section('content')
<div class="flex flex-col items-start justify-between pb-6 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-xl font-bold whitespace-nowrap ">Account Statements</h1>
</div>
<div class="grid grid-cols-1 gap-5 mt-6">
    <div class="themeTabspills">
        <div class="w-full">
            @include('bank.partials.bankmenu')
            <div class="">
                <div class="tab-content">
                    <div class="py-6 lg:py-10 px-6 lg:px-8 w-full mt-4 border border-[#D2DDDB] rounded-lg userProfileDtls tableAdfilter">
                        <form action="#" method="post">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-3">
                                <div class="mb-4 form-group">
                                    <label class="block mb-2 text-base font-medium text-black">Account</label>
                                    <select class="form-select">
                                        <option value="primary">Primary Savings Account</option>
                                        <option value="emergency">Emergency Fund Account</option>
                                        <option value="moneyMarket">Money Market Account</option>
                                    </select>
                                </div>
                                <div class="mb-4 form-group">
                                    <label class="block mb-2 text-base font-medium text-black">Start Date</label>
                                    <input class="form-control" placeholder="START DATE" type="date">
                                </div>
                                <div class="mb-4 form-group">
                                    <label class="block mb-2 text-base font-medium text-black">End Date</label>
                                    <input class="form-control" placeholder="END DATE" type="date">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="themeBtn">Apply Filter</button>
                            </div>
                        </form>
                    </div>
                    <div class="bg-white rounded-lg py-6 lg:py-10 px-6 lg:px-8 border border-[#D2DDDB] my-6">
                        <div class="flex flex-wrap gap-4 items-center justify-between mb-4">
                            <h3 class="font-semibold text-lg text-gray-900">Available Statements</h3>
                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-paperclip">
                                    <path d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l8.49-8.48"></path>
                                </svg>
                                <span>Up to 7 years available</span>
                            </div>
                        </div>
                        <div class="themeTable">
                            <table class="table w-full">
                                <tbody>
                                     @forelse($transactions as $st)
                                    <tr>
                                        <td>
                                            <div class="flex items-center space-x-3">
                                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text text-purple-600">
                                                        <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                                                        <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                                        <path d="M10 9H8"></path>
                                                        <path d="M16 13H8"></path>
                                                        <path d="M16 17H8"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-gray-900 text-sm">{{ $st->txn_date->format('F Y') }}</p>
                                                    <p class="text-gray-900 text-sm">{{ $st->txn_date->format('d/m/Y') }} - {{ $st->value_date->format('d/m/Y') }}</p>
                                                    <div class="flex items-center space-x-2 text-xs text-gray-500"><span>Monthly Statement</span><span>•</span><span>245 KB</span><span>•</span><span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Available</span></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex gap-2 text-right justify-end">
                                                <a href="{{ route('bank.viewStatement', ['year'  => $st->txn_date->format('Y'), 'month' => $st->txn_date->format('m'),]) }}" class="flex items-center space-x-2 px-4 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors text-sm font-medium">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
                                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                    <span>View</span>
                                                </a>
                                                <a href="#" class="flex items-center space-x-2 px-4 py-2 bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors text-sm font-medium">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download">
                                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                        <polyline points="7 10 12 15 17 10"></polyline>
                                                        <line x1="12" x2="12" y1="15" y2="3"></line>
                                                    </svg>
                                                    <span>Download</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr><td colspan="2" class="text-center text-gray-500 py-4">No statements found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg py-6 lg:py-10 px-6 lg:px-8 border border-[#D2DDDB] my-6">
                        <h3 class="font-semibold text-lg text-gray-900 mb-4">Statement Delivery Preferences</h3>
                        <div class="grid grid-cols-1 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-center space-x-3"><input id="paperless" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" type="radio" checked="" name="delivery"><label for="paperless" class="text-sm font-medium text-gray-900">Paperless Statements (Recommended)</label></div>
                                <p class="text-sm text-gray-600 ml-7">Receive email notifications when statements are ready. Access statements online anytime.</p>
                                <div class="flex items-center space-x-3"><input id="paper" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" type="radio" name="delivery"><label for="paper" class="text-sm font-medium text-gray-900">Paper Statements</label></div>
                                <p class="text-sm text-gray-600 ml-7">Receive printed statements by mail. Additional fees may apply.</p>
                            </div>

                            <div class="bg-green-50 p-4 rounded-lg">
                                <div class="flex items-center space-x-2 mb-2">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div><span class="text-sm font-medium text-green-800">Current Setting</span>
                                </div>
                                <p class="text-sm text-green-700">You're currently enrolled in paperless statements for all accounts.</p><button class="mt-2 text-sm text-green-800 font-medium hover:text-green-900">Manage Preferences →</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection