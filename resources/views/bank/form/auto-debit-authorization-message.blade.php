@extends('layouts.profile')

@section('title', 'Direct Deposit Authorization form')

@section('content')
<div class="flex flex-col items-start justify-between pb-6 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-xl font-bold whitespace-nowrap">Direct Deposit Authorization</h1>
</div>

<div class="grid grid-cols-1 gap-5 mt-6">
    <div class="w-full bg-white border border-color-[#D2DDDB] rounded p-10 userProfileDtls">
        <p>Set up automatic payments for your services (School, Internet, Electricity, and Water) to avoid late fees and manual payments.</p>
        <p>You'll authorize:</p>
        <ul>
            <li>Automatic payment of the full bill amount each month to ABC Group Companies</li>
        </ul>
        <br>
        <a href="{{ route('bank.auto_debit_authorization_form') }}" class="themeBtn mt-6 inline-block">Set Up Auto-Debit</a>
    </div>
</div>
@endsection