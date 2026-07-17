@extends('layouts.profile')

@section('title', 'Transfer Money')

@section('content')
<div class="flex flex-col items-start justify-between pb-6 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-xl font-bold whitespace-nowrap ">Transfer Money</h1>
</div>
<div class="grid grid-cols-1 gap-5 mt-6">
    <div class="themeTabspills">
        <div class="w-full">
            @include('bank.partials.bankmenu')
            <!-- <div class="bg-white rounded-lg py-6 lg:py-10 px-6 lg:px-8 border border-[#D2DDDB] my-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">When do you want to send?</h3>
                <div class="grid gap-3 moneysendOption">
                    
                    <button class="p-4 rounded-lg border-2 transition-all border-gray-200 focus:bg-blue-50 focus:text-blue-700 active:bg-blue-50 active:text-blue-700 focus:border-blue-500 active:border-blue-500" onclick="submitType('now')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send mx-auto mb-2">
                            <path d="m22 2-7 20-4-9-9-4Z"></path>
                            <path d="M22 2 11 13"></path>
                        </svg>
                        <div class="font-semibold text-sm">Now</div>
                        <div class="text-xs text-gray-500">Send immediately</div>
                    </button>
                   
                    <button class="p-4 rounded-lg border-2 transition-all border-gray-200 hover:border-gray-300  focus:bg-blue-50 focus:text-blue-700 active:bg-blue-50 active:text-blue-700 focus:border-blue-500 active:border-blue-500" onclick="submitType('later')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock mx-auto mb-2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <div class="font-semibold text-sm">Later</div>
                        <div class="text-xs text-gray-500">Schedule for future</div>
                    </button>
                    <button class="p-4 rounded-lg border-2 transition-all border-gray-200 hover:border-gray-300  focus:bg-blue-50 focus:text-blue-700 active:bg-blue-50 active:text-blue-700 focus:border-blue-500 active:border-blue-500" onclick="submitType('recurring')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-repeat mx-auto mb-2">
                            <path d="m17 2 4 4-4 4"></path>
                            <path d="M3 11v-1a4 4 0 0 1 4-4h14"></path>
                            <path d="m7 22-4-4 4-4"></path>
                            <path d="M21 13v1a4 4 0 0 1-4 4H3"></path>
                        </svg>
                        <div class="font-semibold text-sm">Recurring</div>
                        <div class="text-xs text-gray-500">Repeat transfers</div>
                    </button>
                     
                </div>
            </div> -->
            <div style="overflow:hidden;" class="bg-white userProfileDtls rounded-lg py-6 lg:py-10 px-6 lg:px-8 border border-[#D2DDDB] my-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Transfer Details</h3>
                <div class="flex menus overborderleftright border-b  mb-4 border-[#D2DDDB]">
                <a href="#" onclick="submitType('now','tab-now');  return false" id="tab-now" class="tabitems tabitemsbt active">
                    Now
                </a>
                <a href="#" onclick="submitType('later','tab-later');  return false" id="tab-later" class="tabitems tabitemsbt ">
                    Later
                </a>
                <a onclick="submitType('recurring','tab-recurring');  return false"   href="#" id="tab-recurring" class="tabitems tabitemsbt ">
                    Recurring
                </a>
            
            </div>
                <form action="{{ route('bank.transfer_store') }}" method="post">
                     @csrf
                    <input type="text" name="type" id="transferType"  value="now" class="hidden">
                    <div class="mb-4 form-group">
                        <label class="block mb-2 text-base font-medium text-black">From Account</label>
                        <select class="form-select" name="from_account" id="formAccountSelect">
                            <option value="">Select from Account</option>
                            <option value="Primary Savings Account">Primary Savings Account</option>
                            <option value="Emergency Fund Account">Emergency Fund Account</option>
                            <option value="Money Market Account">Money Market Account</option>
                            <!-- <option value="Universal Bank">Universal Bank</option>
                            <option value="First National Bank">First National Bank</option>
                            <option value="Central Bank">Central Bank</option>
                            <option value="Metro Bank">Metro Bank</option>
                            <option value="Standard Bank">Standard Bank</option>
                            <option value="Regional Bank">Regional Bank</option> -->
                        </select>
                        <div class="infoMsg">
                            <p class="text-xs text-green-600 mt-1 flex items-center freeAmount hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert mr-1">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12"></line>
                                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                </svg>External transfer fee: Free
                            </p>
                            <p class="text-xs text-orange-600 mt-1 flex items-center freAmount hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert mr-1">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" x2="12" y1="8" y2="12"></line>
                                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                </svg>External transfer fee: Ƶ2.50
                            </p>
                        </div>
                    </div>
                    <!-- New Dropdown for Account Type -->
                    <div class="mb-4 form-group">
                        <label class="block mb-2 text-base font-medium text-black">Transfer Type</label>
                        <select class="form-select" id="accountTypeSelect">
                            <option value="">Select Type</option>
                            <option value="own">Own Account</option>
                            <option value="other">Other Account</option>
                        </select>
                    </div>
                    <!-- Radio buttons (hidden by default) -->
                    <div id="ownAccountOptions" class="ml-4 hidden">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Select Target Account:</label>
                        <!-- <div class="flex flex-col gap-2 mt-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="own_account_option" value="Emergency Fund Account" class="form-radio account-radio text-indigo-600" data-account="{{$bankaccountdetails->emergency_fund_account_number}}" data-name="{{$bankaccountdetails->student_name}}" value="Emergency Fund Account">
                                <span class="ml-2">Emergency Fund Account</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="own_account_option" value="Money Market Account" class="form-radio account-radio text-indigo-600" data-account="{{$bankaccountdetails->money_market_account_number}}" data-name="{{$bankaccountdetails->student_name}}" value="Money Market Account">
                                <span class="ml-2">Money Market Account</span>
                            </label>
                        </div> -->
                        <div class="flex flex-col gap-2 mt-2">

                            {{-- Emergency Fund Account --}}
                            <label class="inline-flex items-center gap-2
                                {{ $bankaccountdetails->is_open_emergency_account == 0 ? 'opacity-50 cursor-not-allowed' : '' }}">
                                
                                <input type="radio"
                                    name="own_account_option"
                                    value="Emergency Fund Account"
                                    class="form-radio account-radio text-indigo-600"
                                    data-account="{{ $bankaccountdetails->emergency_fund_account_number }}"
                                    data-name="{{ $bankaccountdetails->student_name }}"
                                    {{ $bankaccountdetails->is_open_emergency_account == 0 ? 'disabled' : '' }}>

                                <span class="ml-1">Emergency Fund Account</span>

                                @if ($bankaccountdetails->is_open_emergency_account == 1)
                                    <span class="text-green-600 text-sm font-semibold">(Open)</span>
                                @else
                                    <span class="text-red-600 text-sm font-semibold">(Not Open)</span>
                                @endif
                            </label>

                            {{-- Money Market Account --}}
                            <label class="inline-flex items-center gap-2
                                {{ $bankaccountdetails->is_open_money_market_account == 0 ? 'opacity-50 cursor-not-allowed' : '' }}">
                                
                                <input type="radio"
                                    name="own_account_option"
                                    value="Money Market Account"
                                    class="form-radio account-radio text-indigo-600"
                                    data-account="{{ $bankaccountdetails->money_market_account_number }}"
                                    data-name="{{ $bankaccountdetails->student_name }}"
                                    {{ $bankaccountdetails->is_open_money_market_account == 0 ? 'disabled' : '' }}>

                                <span class="ml-1">Money Market Account</span>

                                @if ($bankaccountdetails->is_open_money_market_account == 1)
                                    <span class="text-green-600 text-sm font-semibold">(Open)</span>
                                @else
                                    <span class="text-red-600 text-sm font-semibold">(Not Open)</span>
                                @endif
                            </label>

                        </div>

                    </div>
                    <div class="flex flex-wrap lg:flex-nowrap gap-4">
                        <div class="w-full lg:w-[50%]">
                            <div class="mb-4 form-group">
                                <label class="block mb-2 text-base font-medium text-black">Account Number</label>
                                <input type="text" class="form-control" name="account_number" id="accountNumberInput" placeholder="Enter Account Number">
                            </div>
                        </div>
                        <div class="w-full lg:w-[50%]">
                            <div class="mb-4 form-group">
                                <label class="block mb-2 text-base font-medium text-black">BIC/SWIFT</label>
                                <input type="text" class="form-control" name="sort_code" id="sort_code" placeholder="xx-xx-xx" readonly>
                            </div>
                        </div>
                        <div class="w-full lg:w-[50%]">
                            <div class="mb-4 form-group">
                                <label class="block mb-2 text-base font-medium text-black">Beneficiary Name</label>
                                <input type="text" class="form-control" name="beneficiary_name" id="beneficiaryNameInput" placeholder="Beneficiary Name">
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-lg border border-blue-200 mb-4">
                        <input id="saveAsBeneficiary" name="saveAsBeneficiary" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" type="checkbox" value="1">
                        <label for="saveAsBeneficiary" class="text-sm font-medium text-blue-800">Save as beneficiary for future transfers</label>
                    </div>
                    <div class="flex flex-wrap lg:flex-nowrap gap-4">
                        <div class="w-full lg:w-[50%]">
                            <div class="mb-4 form-group">
                                <label class="block mb-2 text-base font-medium text-black">Amount (ZEDS)</label>
                                <input type="number" class="form-control" name="amount" placeholder="0.00">
                            </div>
                        </div>
                        <div class="w-full lg:w-[50%]" id="laterpay" style="display: none;">
                            <div class="mb-4 form-group">
                                <label class="block mb-2 text-base font-medium text-black">Pay On</label>
                                <input type="date" class="form-control" name="paydate" >
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap lg:flex-nowrap gap-4" id="recurringpay" style="display: none;">
                        <div class="w-full lg:w-[33.33%]">
                            <div class="mb-4 form-group">
                                <label class="block mb-2 text-base font-medium text-black">Frequency</label>
                                <select class="form-select" name="frequency">
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                                </select>
                                <input type="hidden" name="payment_type" value="recurring">
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
                    <div class="mb-4 form-group">
                        <label class="block mb-2 text-base font-medium text-black">Memo (Optional)</label>
                        <input type="text" class="form-control" name="memo" placeholder="Add a note for this transfer">
                    </div>
                    <div class="text-center space-x-2">
                        <button type="submit" class="themeBtn">Transfer Now</button>
                        <button type="button" class="secondaryBtn">Cancel</button>
                    </div>
                </form>
            </div>
            <div class="bg-white userProfileDtls rounded-lg py-6 lg:py-10 px-6 lg:px-8 border border-[#D2DDDB] my-6">
                <div class="flex flex-wrap gap-4 mb-4 justify-between items-center userProfileDtls">
                    <h3 class="text-lg font-semibold text-gray-900">Saved Beneficiaries</h3>
                    <button class="flex items-center space-x-1 text-blue-600 hover:text-blue-700 text-sm font-medium" id="addnewtransferBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg>
                        <span>Add New</span>
                    </button>
                </div>
                <div id="addNewTransfer" class="hidden">
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-[#D2DDDB]">
                        <h3 class="text-md font-bold mb-4">Add New Beneficiary</h3>
                        <form action="{{ route('bank.beneficiary_store') }}" method="post">
                            @csrf
                            <div class="flex flex-wrap lg:flex-nowrap gap-4">

                                <div class="w-full lg:w-[33.33%]">
                                    <div class="mb-4 form-group">
                                        <label class="block mb-2 text-base font-medium text-black">Beneficiary name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Beneficiary Name" />
                                    </div>
                                </div>
                                <div class="w-full lg:w-[33.33%]">
                                    <div class="mb-4 form-group">
                                        <label class="block mb-2 text-base font-medium text-black">Select Bank</label>
                                        <select class="form-select" name="bank">
                                            <option value="">Select bank</option>
                                            <option value="Universal Bank">Universal Bank</option>
                                            <option value="First National Bank">First National Bank</option>
                                            <option value="Central Bank">Central Bank</option>
                                            <option value="Metro Bank">Metro Bank</option>
                                            <option value="Standard Bank">Standard Bank</option>
                                            <option value="Regional Bank">Regional Bank</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="w-full lg:w-[33.33%]">
                                    <div class="mb-4 form-group">
                                        <label class="block mb-2 text-base font-medium text-black">Account Number</label>
                                        <input type="number" class="form-control" name="account_number">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center space-x-2">
                                <button type="submit" class="themeBtn">Save Beneficiary</button>
                                <button type="reset" class="secondaryBtn" id="cancelBaneficary">Cancel</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="space-y-3">
                    @if($beneficiaries->count())
                    @foreach($beneficiaries as $t)
                    <div class="w-full p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors text-left">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user text-blue-600">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 text-sm">{{ $t->name }}</p>
                                <p class="text-xs text-gray-500">{{ $t->account_number }}</p>
                                <p class="text-xs text-gray-400">{{ str_repeat('*', max(0, strlen($t->account_number) - 4)) . substr($t->account_number, -4) }} • {{ $t->sort_code }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                        <p>No beneficiaries saved yet.</p>
                    @endif
                </div>
            </div>
            <div class="bg-white userProfileDtls rounded-lg py-6 lg:py-10 px-6 lg:px-8 border border-[#D2DDDB] my-6" style="display: none;">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Scheduled Transfers</h3>

                <div class="scheTransLists space-y-4 mb-6">
                    @forelse($scheduledTransfers as $t)
                        <div class="items border border-[#D2DDDB] bg-gray-50 p-4 rounded-lg">
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
                        <p class="text-sm text-gray-500">No scheduled transfers.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    
    function submitType(value,id) {
        let tabs = document.querySelectorAll('.tabitemsbt');
        tabs.forEach(tab => {
            tab.classList.remove('active');
        });
        if(id){
            document.getElementById(id).classList.add('active');
        }
    //alert(value);
    document.getElementById('transferType').value = value;
    // grab elements
    const laterpay      = document.getElementById('laterpay');
    const recurringDiv = document.getElementById('recurringpay');
    // default hide all
    laterpay.style.display      = 'none';
    recurringDiv.style.display = 'none';
    // show as needed
    if (value === 'later') {
        laterpay.style.display = 'block';
    } else if (value === 'recurring') {
        recurringDiv.style.display = 'flex';
    }
}
document.getElementById('accountTypeSelect').addEventListener('change', function () {
    const ownOptions = document.getElementById('ownAccountOptions');
    const accountInput = document.getElementById('accountNumberInput');
    const nameInput = document.getElementById('beneficiaryNameInput');
    if (this.value === 'own') {
        ownOptions.classList.remove('hidden');
    } else {
        ownOptions.classList.add('hidden');
        accountInput.value = '';
        nameInput.value = '';
        document.getElementById('sort_code').value = '';
    }
});
document.querySelectorAll('.account-radio').forEach(radio => {
    radio.addEventListener('change', function() {
        const accountNumber = this.dataset.account || '';
        const beneficiaryName = this.dataset.name || '';

        document.getElementById('accountNumberInput').value = accountNumber;
        document.getElementById('beneficiaryNameInput').value = beneficiaryName;
        document.getElementById('sort_code').value = 'UNIBWLXX';
    });
});
document.getElementById('accountNumberInput').addEventListener('input', function() {
    const sortCodeField = document.getElementById('sort_code');
    
    if (this.value.trim() !== '') {
        sortCodeField.value = 'UNIBWLXX';
    } else {
        sortCodeField.value = ''; // Clear if user deletes the account number
    }
});

</script>
@endpush