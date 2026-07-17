@extends('layouts.profile')

@section('title', 'Educational Finance Department')

@section('content')
<div class="flex flex-col items-start justify-between pb-6 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-xl font-bold whitespace-nowrap ">Budget Simple Multiple Choice</h1>
    </div>
    <div class="grid grid-cols-1 gap-5 mt-6">
        <div class="themeTabspills">
        <div class="w-full">
            <!-- Tabs Header -->
            <!-- <div class="flex menus overborderleftright border-b border-[#D2DDDB]">
                <a href="educational-finance.php" class="tabitems active">
                    Educational Finance Department
                </a>
                <a href="emergency-fund.php" class="tabitems">
                    Emergency Fund
                </a>
            </div> -->

            <div class="max-w-[900px] w-full bg-white border border-color-[#D2DDDB] rounded p-10">
                <div class="text-md font-semibold">FROM: Educational Finance Department</div>
                <div class="text-md font-semibold text-center py-3 my-4 border-t border-b border-dashed border-color-[#D2DDDB]">SUBJECT: Complete Budget Theory Module for Financial Literacy Badge</div>
                <div class="mailBodyTxt text-md xl:text-md leading-[18px] text-black space-y-4">
                    <p>Dear Student,</p>
                    <p>Your next financial literacy activity is now available. To earn points toward your Financial Literacy Badge, please complete the following:</p>
                    <ul class="list-decimal list-inside">
                        <li>Read the <a href="{{ route('education.budgetQuiz') }}">Introduction to Budget</a> + 5 Multiple Choice</li>
                        <li><a href="{{ route('education.budgetQuiz2') }}">Why have a budget?</a> + 5 Multiple Choice</li>
                    </ul>
                    <p>Please be informed that completion of all assigned activities is mandatory in exchange for the financial support you receive from us.</p>
                    
                    <p><strong>Regards, <br>Educational Finance Department</strong></p>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection