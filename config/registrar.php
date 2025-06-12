<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Initial Credit Limit
    |--------------------------------------------------------------------------
    |
    | The maximum negative balance a newly-created registrar can reach before
    | commands are rejected.  Finance staff can raise this later.
    |
    */

    'initial_credit_limit' => env('REG_INITIAL_CREDIT_LIMIT', 0),

    /*
    |--------------------------------------------------------------------------
    | Welcome Balance
    |--------------------------------------------------------------------------
    |
    | Optional free credit (in default currency) granted immediately at
    | activation or after successful KYC.
    |
    */

    'welcome_balance' => env('REG_WELCOME_BALANCE', 0),

];
