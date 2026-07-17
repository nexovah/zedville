<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mailbox Email Schedule by Event
    |--------------------------------------------------------------------------
    | Keys = event names ('registration', 'bank_account_opened', etc.)
    | Each event has an array of [delay, template, subject]
    */
    'events' => [

        'registration' => [
            [
                'delay' => 0,
                'template' => 'welcome',
                'subject' => 'Welcome to Zedville, {{name}}! ',
            ],
            /*[
                'delay' => 2,
                'template' => 'cityzenid',
                //'subject' => 'Your Next Steps in Zedville',
                //'subject' => '{{citizenId}}',
                'subject' => 'Citizen Id',
            ],
            [
                'delay' => 3,
                'template' => 'open-city-bank-account',
                //'subject' => 'Your Next Steps in Zedville',
                'subject' => 'Open Your City Bank Student Account Today!',
            ],*/
        ],

       /*'login' => [
            [
                'delay' => 1,
                'template_id' => 2,
                'template' => 'cityzenid',
                //'subject' => 'Your Next Steps in Zedville',
                'subject' => '{{citizenId}}',
            ],
        ],*/

        'bank_account_opened' => [
            [
                'delay' => 0,
                'template' => 'bank-account-ready',
                'subject' => 'Account is ready',
            ],
            [
                'delay' => 2,
                'template' => 'salary-deposite',
                'subject' => 'FIRST SALARY NOTIFICATION',
            ],
            [
                'delay' => 3,
                'template' => 'direct-deposit',
                'subject' => 'Please Fill Out Your Direct Deposit Form',
            ],
            [
                'delay' => 4,
                'template' => 'auto-debit',
                'subject' => 'Simplify Bills with Auto-Debit',
            ],
            /*[
                'delay' => 5,
                'template' => 'school-auto-debit',
                'subject' => 'School - Payment and Auto Debit',
            ],
            [
                'delay' => 5,
                'template' => 'internet-auto-debit',
                'subject' => 'Internet provider - Payment and Auto Debit',
            ],
            [
                'delay' => 5,
                'template' => 'electricity-auto-debit',
                'subject' => 'Electricity - Payment and Auto Debit',
            ],
            [
                'delay' => 5,
                'template' => 'water-auto-debit',
                'subject' => 'Water-  Payment and Auto Debit',
            ],*/
        ],

    ],
];
