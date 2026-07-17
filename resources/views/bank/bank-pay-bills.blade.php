@extends('layouts.profile')

@section('title', 'Pay Bills')

@section('content')
<!-- <div class="flex flex-col items-start justify-between pb-6 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-xl font-bold whitespace-nowrap ">Pay Bills</h1>
    <a href="{{ route('bank.index') }}" class="themeBtn py-2 px-4 inline-block flex gap-2 items-center">
        <span class="font-bold leading-none">← </span>Back to Bank Account
    </a>
</div> -->
<div class="grid grid-cols-1 gap-5 mt-6" x-data="{ confirmationModal: false }">


    <div class="themeTabspills">
        <div class="w-full">
            <!-- Tabs Header -->
            <!-- @include('bank.partials.bankpaybillmenu') -->
             @include('bank.partials.bankmenu')
                 <form method="POST" action="{{ route('bank.store_pay_bill') }}"> 
                <!-- <form method="POST" action="{{ route('bank.transfer_store') }}"> -->
                @csrf
                    <div class="tailCard py-6 lg:py-10 px-6 lg:px-8 max-w-full w-full mt-4 border border-[#D2DDDB] rounded-lg">
                        <div class="active">
                            <div class="billPaymentSec userProfileDtls">
                                <h3 class="text-lg font-bold mb-4">Bill Payment</h3>
                                <div class="flex flex-wrap lg:flex-nowrap gap-6">
                                    <div class="flex-1">
                                        <div class="max-w-3xl">
                                            <div class="space-y-4">
                                                <div class="flex flex-wrap lg:flex-nowrap gap-4">
                                                    <div class="w-full lg:w-[50%]">
                                                        <div class="mb-4 form-group">
                                                            <label class="block mb-2 text-base font-medium text-black">From Account</label>
                                                            <select class="form-select" name="from_account">
                                                                <option value="primary">Primary </option>
                                                                <option value="emergency">Emergency </option>
                                                                <option value="moneyMarket">Money Market </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="w-full lg:w-[50%]">
                                                        <div class="mb-4 form-group">
                                                            <label class="block mb-2 text-base font-medium text-black">Biller</label>
                                                            <select class="form-select" name="beneficiary_name" id="billerSelect">
                                                                <option value="">Select Biller</option>
                                                                 @foreach($getAllbiller as $mbill)
                                                                <option value="{{ $mbill->name }}" data-id="{{ $mbill->id }}" data-account="{{ $mbill->account_number }}" 
                                                                data-amount="{{ $mbill->amount }}">{{ $mbill->name }}</option>
                                                                 @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex flex-wrap lg:flex-nowrap gap-4">
                                                    <div class="w-full lg:w-[50%]">
                                                        <div class="mb-4 form-group">
                                                            <label class="block mb-2 text-base font-medium text-black">Account Number</label>
                                                            <input type="text" name="account_number" id="billerAccount" class="form-control" placeholder="Enter Account Number">
                                                        </div>
                                                    </div>
                                                    <div class="w-full lg:w-[50%]">
                                                        <div class="mb-4 form-group">
                                                            <label class="block mb-2 text-base font-medium text-black">Amount (ZEDS)</label>
                                                            <input type="number" name="amount" id="billerAmount" class="form-control" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-[#D2DDDB]">
                                                <h3 class="text-lg font-bold mb-4">Schedule Payment</h3>
                                                <div class="flex menus border-b border-[#D2DDDB]">
                                                    <button type="button"  class="tabitems tab-button active" data-tab="subtab1">
                                                        Now
                                                    </button>
                                                    <button type="button"  class="tabitems tab-button" data-tab="subtab2">
                                                        Later
                                                    </button>
                                                    <button type="button"  class="tabitems tab-button" data-tab="subtab3">
                                                        Recurring
                                                    </button>
                                                </div>
                                                <input type="hidden" name="type" id="payment_type" value="now">
                                                <div class="py-6">
                                                    <div id="subtab1" class="tab-content active" onclick="submitType('now')">
                                                        <div class="bg-white p-4 rounded-lg border mb-4">
                                                            <p class="text-sm text-gray-700">Payment will be processed immediately upon confirmation.</p>
                                                        </div>
                                                        <button type="submit" class="themeBtn">Pay Bill Now</button>
                                                    </div>
                                                    <div id="subtab2" class="tab-content" onclick="submitType('later')">
                                                        <div class="bg-white p-4 rounded-lg border mb-4">
                                                            <div class="flex flex-wrap lg:flex-nowrap gap-4">
                                                                <div class="w-full lg:w-[75%]">
                                                                    <div class="mb-4 form-group">
                                                                        <label class="block mb-2 text-base font-medium text-black">Pay On</label>
                                                                        <input type="date" class="form-control" name="paydate" />
                                                                        <p class="subhelptxt text-xs text-gray-500 mt-1">Select any future date when this bill should be paid</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="themeBtn">Schedule Payment</button>
                                                    </div>
                                                    <div id="subtab3" class="tab-content" onclick="submitType('recurring')">
                                                        <div class="bg-white p-4 rounded-lg border mb-4">
                                                            <div class="flex flex-wrap lg:flex-nowrap gap-4">
                                                                <div class="w-full lg:w-[33.33%]">
                                                                    <div class="mb-4 form-group">
                                                                        <label class="block mb-2 text-base font-medium text-black">Frequency</label>
                                                                        <select class="form-select" name="frequency">
                                                                            <option value="weekly">Weekly</option>
                                                                            <option value="monthly">Monthly</option>
                                                                            <option value="yearly">Yearly</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="w-full lg:w-[33.33%]">
                                                                    <div class="mb-4 form-group">
                                                                        <label class="block mb-2 text-base font-medium text-black">Start Date</label>
                                                                        <input type="date"  name="start_date" class="form-control" />
                                                                    </div>
                                                                </div>
                                                                <div class="w-full lg:w-[33.33%]">
                                                                    <div class="mb-4 form-group">
                                                                        <label class="block mb-2 text-base font-medium text-black">End Date</label>
                                                                        <input type="date" name="end_date" class="form-control" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="subhelptxt text-xs text-gray-500 mt-1">Set up automatic recurring payments for this bill</p>
                                                        </div>
                                                        <button type="submit" class="themeBtn">Set Up Recurring Payment</button>
                                                    </div>
                                                     
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-80"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Recurring Payment -->
                  <div class="tailCard py-6 lg:py-10 px-6 lg:px-8 max-w-full w-full mt-4 border border-[#D2DDDB] rounded-lg">
                    <div class="activeTab">
                        <div class="transMoneySec">
                            <h3 class="text-lg font-bold mb-4">Recurring Payment</h3>
                            @forelse($scheduledTransfers as $t)
                                <div class="items border border-[#D2DDDB] bg-gray-50 p-4 rounded-lg mb-4">
                                    <div class="topSec mb-4">
                                        <div class="flex gap-2 items-center">
                                            <h4 class="font-md font-semibold">{{ $t->beneficiary_name }}</h4>

                                            {{-- Status badge: Pending if future date else Active --}}
                                            @php
                                                $isPending = $t->scheduled_at && $t->scheduled_at->isFuture();
                                            @endphp
                                            <!-- <div class="text-xs px-2 py-1 rounded inline-block mt-1
                                                {{ $isPending ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                                {{ $isPending ? 'Pending' : 'Active' }}
                                            </div> -->
                                        </div>

                                        <div class="text-md text-green-600">Ƶ{{ number_format($t->amount, 0) }}</div>
                                        <div class="text-xs text-gray-600">{{ $t->from_account }}</div>
                                        <div class="text-xs text-gray-500">
                                            Scheduled: {{
                                                    optional($t->scheduled_at ? \Carbon\Carbon::parse($t->scheduled_at) : (\Carbon\Carbon::parse($t->start_date) ?? null))->format('d/m/Y')
                                                }}
                                        </div>
                                    </div>

                                    <!-- <div class="buttonsGroup flex flex-wrap gap-2 mt-4">
                                        <a href="#" class="themeBtn py-1 px-4">View</a>
                                        <a href="#" class="secondaryBtn py-1 px-4">Edit</a>
                                        <form action="#" method="POST"
                                            onsubmit="return confirm('Delete this transfer?')">
                                            @csrf @method('DELETE')
                                            <button class="dangerBtn py-1 px-4">Delete</button>
                                        </form>
                                    </div> -->
                                </div>
                            @empty
                            <div class="themeTable">
                                <div class="text-center py-8 text-gray-500"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-target mx-auto mb-3 text-gray-300">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <circle cx="12" cy="12" r="6"></circle>
                                        <circle cx="12" cy="12" r="2"></circle>
                                    </svg>
                                    <p class="text-sm">No Recurring Payments</p>
                                    <p class="text-xs text-gray-400 mt-2">Set up recurring payments to automate your bills.</p>
                                    <a href="{{ route('bank.pay_bills') }}" class="themeBtn inline-block mt-4">Setup Payment</a>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- Recurring Payment -->
                 <div class="tailCard py-6 lg:py-10 px-6 lg:px-8 max-w-full w-full mt-4 border border-[#D2DDDB] rounded-lg">
                    <div class="activeTab">
                        <div class="faqAskedSec">
                            <h3 class="text-lg font-bold">Payment History</h3>
                            <div class="themeTable">
                                <div class="text-center py-8 text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text mx-auto mb-3 text-gray-300"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M10 9H8"></path><path d="M16 13H8"></path><path d="M16 17H8"></path></svg>
                                    <p class="text-sm">Payment History</p>
                                    <p class="text-xs text-gray-400 mt-2">Your recent bill payments will appear here.</p>
                                </div>
                                <table class="table w-full">
                                    <tbody>
                                        @forelse($transactions as $txn)
                                            <tr>
                                                <td>
                                                    {{ $txn->description }}
                                                    - {{ $txn->transaction_date->format('M d, Y') }}
                                                </td>
                                                <td class="text-right">
                                                    <span class="text-red-600 font-bold">
                                                        -{{ number_format($txn->amount, 2) }} ZEDS
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center text-gray-500">
                                                    No debit transactions found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Payment History -->
                <!-- Payment History -->
            
        </div>
    </div>
@endsection
@push('scripts')
<script>
    
    function submitType(value) {
    //alert(value);
    document.getElementById('payment_type').value = value;
}
document.getElementById('billerSelect').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];

    const accountNumber = selectedOption.getAttribute('data-account') || '';
    const amount = selectedOption.getAttribute('data-amount') || '';

    document.getElementById('billerAccount').value = accountNumber;
    document.getElementById('billerAmount').value = amount;
});
</script>
@endpush