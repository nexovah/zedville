<?php

namespace App\Services;

use App\Models\BankAccount;
use App\Models\AutoDebitRequest;
use App\Models\ConsumerSurvey;

class CitizenActivationService
{
    public function getNextRoute($user)
    {
        // STEP 1 - Bank Account
        $bankAccount = BankAccount::where('student_id', $user->id)->first();

        if (!$bankAccount) {
            return route('CitizenActivation.bankAccount');
        }

        // STEP 2 - Salary Authorization
        if (($bankAccount->primary_savings_account_amount ?? 0) <= 0) {
            return route('CitizenActivation.salaryAuthorization');
        }

        // STEP 3 - Auto Debit
        $autoDebit = AutoDebitRequest::where('user_id', $user->id)->exists();

        if (!$autoDebit) {
            return route('CitizenActivation.autoDebit');
        }

        // STEP 4 - Consumer Profile
        $consumerProfile = ConsumerSurvey::where('user_id', $user->id)->exists();

        if (!$consumerProfile) {
            return route('CitizenActivation.consumerProfile');
        }

        // All completed
        return null;
    }
}