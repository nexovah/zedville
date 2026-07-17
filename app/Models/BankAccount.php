<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'bank_id',
        'student_id',
        'sid',
        'student_name',
        'student_dob',
        'student_email',
        'student_phone',
        'student_cityzen_id',
        'student_address',
        'student_prefered_name',
        'bank_name',
        'primary_savings_account',
        'primary_savings_account_number',
        'primary_savings_account_amount',
        'emergency_fund_account',
        'emergency_fund_account_number',
        'emergency_fund_account_amount',
        'money_market_account',
        'money_market_account_number',
        'money_market_account_amount',
        'card_name',
        'card_type',
        'card_number',
        'card_valid',
        'card_cvv',
        'card_iban',
        'card_swift',
        'card_status',
        'card_pin',
        'student_accountstatement',
        'student_trem',
    ];
}
