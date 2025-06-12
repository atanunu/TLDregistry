<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Currency
    |--------------------------------------------------------------------------
    |
    | ISO-4217 3-letter code used when a registrar hasn’t selected a preferred
    | currency.  Multi-currency invoices convert from USD using the fx_rate.
    |
    */

    'default_currency' => env('BILLING_DEFAULT_CURRENCY', 'USD'),

    /*
    |--------------------------------------------------------------------------
    | VAT / Tax Settings
    |--------------------------------------------------------------------------
    */

    // Example: 0.20 = 20 %
    'vat_rate' => env('BILLING_VAT_RATE', 0.00),

    /*
    |--------------------------------------------------------------------------
    | Tier Discounts
    |--------------------------------------------------------------------------
    |
    | Registrars move between tiers automatically based on their lifetime debit
    | volume (not credits).  The discount percentage is applied to every future
    | fee line once the threshold is crossed.
    |
    */

    'tiers' => [
        'bronze' => ['threshold' => 0,       'discount' => 0],
        'silver' => ['threshold' => 10_000,  'discount' => 3],
        'gold'   => ['threshold' => 50_000,  'discount' => 5],
    ],

];
