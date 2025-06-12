Here are the **two configuration files** added in Patch v6.
Create them exactly under `config/` in your Laravel project, then run `php artisan config:clear` (or `config:cache`) so the framework picks them up.

---

### `config/billing.php`

```php
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
```

---

### `config/registrar.php`

```php
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
```

---

After adding these files:

```bash
composer dump-autoload
php artisan config:clear   # or  php artisan config:cache
```

These configs complete the **v6 configuration layer**.
