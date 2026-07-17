@extends('layouts.profile')

@section('title', 'Account Statements')

@section('content')

<div class="flex flex-col items-start justify-between pb-6 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
    <div class="leftheading">
        <h1 class="text-xl font-bold whitespace-nowrap ">Statement Overview -  {{ \Carbon\Carbon::create($year,$month)->format('F Y') }}</h1>
        <p class="text-gray-600 text-sm mt-1">{{ $start->format('d/m/Y') }} - {{ $end->format('d/m/Y') }}</p>
    </div>
    <a href="{{ route('bank.bank_statements') }}" class="themeBtn py-2 px-4 inline-block flex gap-2 items-center"><span class="font-bold leading-none">← </span>Back to Statements</a>
</div>

<div class="grid grid-cols-1 gap-5 mt-6">
    <div class="statementSeec">
        <div class="bg-white rounded-lg py-6 lg:py-10 px-6 lg:px-8 border border-[#D2DDDB] my-6">
            <h3 class="font-semibold text-lg text-gray-900 mb-4">Statement Summary</h3>
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-blue-600 font-medium">Opening Balance</p>
                    <p class="text-xl font-bold text-blue-700">Ƶ{{ number_format($openingBalance,2) }}</p></p>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <p class="text-sm text-green-600 font-medium">Total Credits</p>
                    <p class="text-xl font-bold text-green-700">+Ƶ{{ number_format($totalCredits,2) }}</p>
                </div>
                <div class="text-center p-4 bg-red-50 rounded-lg">
                    <p class="text-sm text-red-600 font-medium">Total Debits</p>
                    <p class="text-xl font-bold text-red-700">-Ƶ{{ number_format($totalDebits,2) }}</p>
                </div>
                <div class="text-center p-4 bg-purple-50 rounded-lg">
                    <p class="text-sm text-purple-600 font-medium">Closing Balance</p>
                    <p class="text-xl font-bold text-purple-700">Ƶ{{ number_format($closingBalance,2) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-6 border border-[#D2DDDB] my-6">
            <h3 class="text-lg font-semibold text-black mb-4">Transaction Details</h3>
            <div class="themeTable">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Transaction Date</th>
                            <th class="text-left">Transaction Description</th>
                            <th class="text-right">Debit</th>
                            <th class="text-right">Credit</th>
                            <th class="text-right">Balance</th>
                        </tr>
                    </thead>
                     <tbody>
                    @forelse ($transactions as $txn)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($txn->txn_date)->format('d/m/Y') }}</td>
                            <td>{{ $txn->description }}</td>
                            <td class="text-right">
                                 <div class="text-right text-red-600 font-bold">{{ $txn->debit > 0 ? number_format($txn->debit, 2).' ZEDS' : '' }}</div>
                            </td>
                            <td>
                                <div class="text-right text-green-600 font-medium">{{ $txn->credit > 0 ? number_format($txn->credit, 2).' ZEDS' : '' }}</div>
                            </td>
                            <td><div class="text-right font-bold">{{ number_format($txn->balance,2) }} ZEDS</div></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-4">No transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection