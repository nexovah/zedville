<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Academic Year Start Month
    |--------------------------------------------------------------------------
    |
    | The calendar month (1 = January ... 12 = December) that the academic
    | year rolls over on. Used by badge/point calculations to decide which
    | "academic year" a given month/year belongs to (e.g. month >= this
    | value means the academic year is "$year-" . ($year + 1)).
    |
    | Previously this was hardcoded independently across multiple files
    | with inconsistent values (9 in most places, 4 in FinheroPointService).
    | Confirmed canonical value: April (4).
    |
    */
    'academic_year_start_month' => 4,

    /*
    |--------------------------------------------------------------------------
    | Monthly Salary
    |--------------------------------------------------------------------------
    |
    | The default virtual monthly salary credited to students. Previously
    | hardcoded independently across multiple files with inconsistent values
    | (3952.40 in most places, 4250 in BankController::creditMonthlySalary).
    | Confirmed canonical value: 3952.40.
    |
    */
    'monthly_salary' => 3952.40,

];
