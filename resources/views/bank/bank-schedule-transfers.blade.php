@extends('layouts.profile')

@section('title', 'Schedule Transfers')

@section('content')
<div class="flex flex-col items-start justify-between pb-6 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-xl font-bold whitespace-nowrap ">Schedule Transfers</h1>
    <a href="{{ route('bank.index') }}" class="themeBtn py-2 px-4 inline-block flex gap-2 items-center">
        <span class="font-bold leading-none">← </span>Back to Bank Account
    </a>
</div>
<div class="grid grid-cols-1 gap-5 mt-6">

    <div class="themeTabspills">
        <div class="w-full">
            <!-- Tabs Header -->
            <div class="flex menus overborderleftright border-b border-[#D2DDDB]">
                 <a href="{{ route('bank.pay_bills') }}" class="tabitems">
                    Pay a Bill
                </a>
                <a href="{{ route('bank.transfer') }}" class="tabitems">
                    Transfers Money
                </a>
                <a href="{{ route('bank.manage_payee') }}" class="tabitems">
                    Manage Payee
                </a>
                <a href="{{ route('bank.schedule_transfers') }}" class="tabitems active">
                    Schedule Transfers
                </a>
                <a href="{{ route('bank.recurring_payment') }}" class="tabitems">
                    Recurring Payment
                </a>
                <a href="{{ route('bank.payment_history') }}" class="tabitems">
                    Payment History
                </a>
            </div>

            <div class="tailCard py-6 lg:py-10 px-6 lg:px-8 max-w-full w-full mt-4 border border-[#D2DDDB] rounded-lg">
                <div class="activeTab">
                    <div class="transMoneySec">
                        <div class="flex flex-wrap gap-4 mb-8 justify-between items-center">
                            <h3 class="text-lg font-bold">Scheduled Transfers</h3>
                            <a href="transfer-money.php" type="button" class="themeBtn">Schedule Transfer</a>
                        </div>
                        <h3 class="text-lg font-bold mb-4">My Billers:</h3>
                        <div class="scheTransLists space-y-4 mb-6">
                            <div class="items border border-[#D2DDDB] bg-gray-50 p-4 rounded-lg">
                                <div class="topSec mb-4">
                                    <div class="flex gap-2 items-center">
                                        <h4 class="font-md font-semibold">John Smith</h4>
                                        <div class="text-xs px-2 py-1 rounded inline-block mt-1 bg-green-100 text-green-700">Active</div>
                                    </div>
                                    <div class="text-xs text-gray-600">Global Trust Bank</div>
                                    <div class="text-xs text-gray-500">Account: 4567890123</div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-white rounded-lg p-6">
                                    <div class="items last:border-0 md:border-r border-dashed border-[#D2DDDB] flex md:justify-center">
                                        <div class="innerContent">
                                            <div class="text-xs text-gray-500 mb-1">Amount:</div>
                                            <div class="text-xl font-semibold text-gray-800">500.00 ZEDS</div>
                                        </div>
                                    </div>
                                    <div class="items last:border-0 md:border-r border-dashed border-[#D2DDDB] flex md:justify-center">
                                        <div class="innerContent">
                                            <div class="text-xs text-gray-500 mb-1">Frequency:</div>
                                            <div class="text-xl font-semibold text-gray-800">Monthly</div>
                                        </div>
                                    </div>
                                    <div class="items last:border-0 md:border-r border-dashed border-[#D2DDDB] flex md:justify-center">
                                        <div class="innerContent">
                                            <div class="text-xs text-gray-500 mb-1">Next Date:</div>
                                            <div class="text-xl font-semibold text-gray-800">2025-08-15</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttonsGroup flex flex-wrap gap-2 mt-4">
                                    <button class="themeBtn py-1 px-4">Edit</button>
                                    <button class="secondaryBtn py-1 px-4">Pause</button>
                                    <button class="dangerBtn py-1 px-4">Cancel</button>
                                </div>
                            </div>
                            <div class="items border border-[#D2DDDB] bg-gray-50 p-4 rounded-lg">
                                <div class="topSec mb-4">
                                    <div class="flex gap-2 items-center">
                                        <h4 class="font-md font-semibold">Sarah Johnson</h4>
                                        <div class="text-xs px-2 py-1 rounded inline-block mt-1 bg-yellow-100 text-yellow-700">Pending</div>
                                    </div>
                                    <div class="text-xs text-gray-600">Metro Commerce Bank</div>
                                    <div class="text-xs text-gray-500">Account: 7890123456</div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-white rounded-lg p-6">
                                    <div class="items last:border-0 md:border-r border-dashed border-[#D2DDDB] flex md:justify-center">
                                        <div class="innerContent">
                                            <div class="text-xs text-gray-500 mb-1">Amount:</div>
                                            <div class="text-xl font-semibold text-gray-800">250.00 ZEDS</div>
                                        </div>
                                    </div>
                                    <div class="items last:border-0 md:border-r border-dashed border-[#D2DDDB] flex md:justify-center">
                                        <div class="innerContent">
                                            <div class="text-xs text-gray-500 mb-1">Frequency:</div>
                                            <div class="text-xl font-semibold text-gray-800">One-time</div>
                                        </div>
                                    </div>
                                    <div class="items last:border-0 md:border-r border-dashed border-[#D2DDDB] flex md:justify-center">
                                        <div class="innerContent">
                                            <div class="text-xs text-gray-500 mb-1">Next Date:</div>
                                            <div class="text-xl font-semibold text-gray-800">2025-08-20</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttonsGroup flex flex-wrap gap-2 mt-4">
                                    <button class="themeBtn py-1 px-4">Edit</button>
                                    <button class="secondaryBtn py-1 px-4">Pause</button>
                                    <button class="dangerBtn py-1 px-4">Cancel</button>
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