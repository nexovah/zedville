<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();

            // IDs and student info
            $table->unsignedBigInteger('student_id')->index();
            $table->string('student_name');
            $table->date('student_dob')->nullable();
            $table->string('student_email')->unique();
            $table->string('student_phone')->nullable();
            $table->text('student_address')->nullable();

            // Bank details
            $table->string('bank_name')->default('Universal Bank');
            $table->string('primary_savings_account')->nullable()->default('Primary Savings Account');
            $table->string('primary_savings_account_number', 10)->nullable();
            $table->string('emergency_fund_account')->nullable()->default('Emergency Fund Account');
            $table->string('emergency_fund_account_number', 10)->nullable();
            $table->string('money_market_account')->nullable()->default('Money Market Account');
            $table->string('money_market_account_number', 10)->nullable();

            // Card details
            $table->string('card_name')->nullable();
            $table->string('card_type')->nullable();
            $table->string('card_number', 16)->nullable();
            $table->date('card_valid')->nullable();
            $table->string('card_cvv', 3)->nullable();
            $table->string('card_iban')->nullable();
            $table->string('card_swift')->nullable();
            $table->unsignedTinyInteger('card_status')->default(0)
                  ->comment('0=active, 1=inactive, 2=freeze, 3=block, 4=delete');

            // Student statement & terms
            $table->longText('student_accountstatement')->nullable()->default(0);
            $table->boolean('student_trem')->nullable()->default(0);

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_accounts');
    }
};
