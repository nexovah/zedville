@extends('layouts.profile')

@section('title', 'Manage Payee')

@section('content')
<div class="flex flex-col items-start justify-between pb-6 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-xl font-bold whitespace-nowrap ">Manage Payee</h1>
    <a href="{{ route('bank.index') }}" class="themeBtn py-2 px-4 inline-block flex gap-2 items-center">
        <span class="font-bold leading-none">← </span>Back to Bank Account
    </a>
</div>
<div class="grid grid-cols-1 gap-5 mt-6" x-data="{ confirmationModal: false }">

    <div class="themeTabspills">
        <div class="w-full">
            <!-- Tabs Header -->
             @include('bank.partials.bankpaybillmenu')

            <div class="tailCard py-6 lg:py-10 px-6 lg:px-8 max-w-full w-full mt-4 border border-[#D2DDDB] rounded-lg">
                <div class="activeTab">
                    <div class="transMoneySec">
                        <div class="flex flex-wrap gap-4 mb-8 justify-between items-center userProfileDtls">
                            <h3 class="text-lg font-bold">Manage Payee</h3>
                            <div class="searchField">
                                <div class="relative flex gap-2 items-stretch">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute left-3 top-3 text-gray-400">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <path d="m21 21-4.3-4.3"></path>
                                    </svg>
                                    <input placeholder="Search payees..." class="form-control" id="searchPayeesFields" type="text"  />
                                    <button type="button" class="themeBtn h-[36px] py-0">Search</button>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold mb-4">My Billers:</h3>
                        <div class="billerList space-y-4 userProfileDtls mb-6" data-filter="true">
                            @foreach($getAllbiller as $mbill)
                            <div class="items border border-[#D2DDDB] bg-gray-50 p-4 rounded-lg" data-title="Utility - Electricity">
                                <h4 class="text-md font-bold mb-4">{{ $mbill->name }}</h4>
                                <div class="flex flex-wrap lg:flex-nowrap gap-4">
                                    <!-- <div class="w-full lg:w-[33.33%]">
                                        <div class="mb-4 form-group">
                                            <label class="block mb-2 text-md font-medium text-black">DUE DATE:</label>
                                            <input class="form-control" placeholder="Enter account number" type="date" value="{{ $bill->schedule_date ?? '' }}" />
                                        </div>
                                    </div> -->
                                    <div class="w-full lg:w-[33.33%]">
                                        <div class="mb-4 form-group">
                                            <label class="block mb-2 text-md font-medium text-black">Account Number:</label>
                                            <input class="form-control" placeholder="Enter account number" type="number" value="{{ $mbill->account_number }}" readonly />
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-[33.33%]">
                                        <div class="mb-4 form-group">
                                            <label class="block mb-2 text-md font-medium text-black">Amount </label>
                                            <input class="form-control" placeholder="0.00" type="text" value="{{ number_format($mbill->amount, 2) }} ZEDS" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="buttonsGroup flex flex-wrap gap-2">
                                    <button class="themeBtn py-1 px-4">Pay Now</button>
                                    <button class="secondaryBtn py-1 px-4">Edit</button>
                                    <button class="dangerBtn py-1 px-4">Remove</button>
                                </div>
                            </div>
                             @endforeach
                        </div>

                        <!-- <h3 class="text-lg font-bold mb-4">My Transfer Recipients</h3>
                        <div class="billerList space-y-4 userProfileDtls mb-6" data-filter="true">
                            @foreach($transferRecipients as $recipient)
                            <div class="items border border-[#D2DDDB] bg-gray-50 p-4 rounded-lg" data-title="{{ $recipient['name'] }}">
                                <h4 class="text-md font-bold mb-2">{{ $recipient['name'] }}</h4>
                                <h4 class="text-xs text-gray-400 mb-4">{{ $recipient['bank'] }}</h4>
                                <div class="flex flex-wrap lg:flex-nowrap gap-4">
                                    <div class="w-full lg:w-[50%]">
                                        <div class="mb-4 form-group">
                                            <label class="block mb-2 text-md font-medium text-black">Account Number:</label>
                                            <input class="form-control" placeholder="Enter account number" type="number" value="{{ $recipient['account_number'] }}" readonly />
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-[50%]">
                                        <div class="mb-4 form-group">
                                            <label class="block mb-2 text-md font-medium text-black">Amount </label>
                                            <input class="form-control" placeholder="0.00" type="text" value="{{ $recipient['amount'] }}" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="buttonsGroup flex flex-wrap gap-2">
                                    <button class="themeBtn py-1 px-4">Transfer</button>
                                    <button class="secondaryBtn py-1 px-4">Edit</button>
                                    <button class="dangerBtn py-1 px-4">Remove</button>
                                </div>
                            </div>
                            @endforeach
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection