@extends('layouts.profile')

@section('title', 'Citizen Activation')

@section('content')

<div class="grid grid-cols-1 gap-5">

    <div class="page-shell">

        {{-- Progress Bar --}}
        @include('citizen-activation.layouts.progress', ['step' => 1])

        <div class="step-header">
            <div class="step-eyebrow">
                Step 1 of 6 — Welcome
            </div>

            <div class="ca-step-title">
                Welcome to Zedville,
                <span>{{ Auth::user()->name ?? 'Student' }}</span>!
            </div>

            <div class="step-subtitle">
                Your <span class="term">Citizen ID</span> is ready — this takes about 5 minutes to complete.
            </div>
        </div>

        <div class="step-body">

            <div class="narrative">
                You are now officially a Zedville citizen.
                <strong>Everything here is virtual</strong> — the city, the money, the bills.

                You will earn a monthly <strong>salary in Zeds</strong> (our virtual currency),
                open a bank account, pay bills and make real spending decisions —
                just like adult life.

                <br><br>

                Nothing costs real money.

                This is your space to learn by doing.

                Complete the steps below to activate your account and unlock the city.
            </div>

            <div class="info-box">

                <div class="info-row">
                    <span class="info-label">Your Citizen ID</span>
                    <span>ZV-2026-0076</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Your Role</span>
                    <span>Zedville Resident & Student</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Time to Complete</span>
                    <span>About 5 Minutes</span>
                </div>

            </div>

            <div class="btn-row">

                <a href="{{ route('CitizenActivation.bankAccount') }}"
                   class="ca-btn-primary">
                    Start Activation →
                </a>

            </div>

        </div>

    </div>

</div>

@endsection