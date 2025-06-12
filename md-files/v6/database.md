Below is every file that lives in **`database/`** for Patch **v6**.
Copy each code block into the matching path in your project:

```
database/
└── migrations/
    ├─ 2025_01_10_000000_create_registrars_table.php
    ├─ 2025_01_11_000000_create_reserved_labels_table.php
    ├─ 2025_01_12_000000_create_premium_labels_table.php
    └─ 2025_01_13_000000_create_ledgers_table.php
```

No factories or seeders were introduced in v6—only these four core migrations.

---

### 1. `database/migrations/2025_01_10_000000_create_registrars_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('api_key', 64)->unique();
            $table->decimal('balance', 14, 2)->default(0);
            $table->decimal('credit_limit', 14, 2)->default(0);
            $table->enum('status', ['pending', 'verified', 'suspended'])
                  ->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrars');
    }
};
```

---

### 2. `database/migrations/2025_01_11_000000_create_reserved_labels_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reserved_labels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tld_id')
                  ->constrained('tlds')
                  ->cascadeOnDelete();
            $table->string('label');
            $table->string('reason')->nullable();
            $table->timestamps();

            $table->unique(['tld_id', 'label']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reserved_labels');
    }
};
```

---

### 3. `database/migrations/2025_01_12_000000_create_premium_labels_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('premium_labels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tld_id')
                  ->constrained('tlds')
                  ->cascadeOnDelete();
            $table->string('label');
            $table->decimal('fee', 10, 2);
            $table->string('currency', 3)->default('USD');
            $table->timestamps();

            $table->unique(['tld_id', 'label']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('premium_labels');
    }
};
```

---

### 4. `database/migrations/2025_01_13_000000_create_ledgers_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registrar_id')
                  ->constrained('registrars')
                  ->cascadeOnDelete();
            $table->decimal('amount', 14, 2);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ledgers');
    }
};
```

---

**Next steps**

```bash
composer dump-autoload
php artisan migrate
```

These four migrations complete the **database layer for v6**. Proceed to add the `app/`, `config/`, `routes/`, `resources/`, and `tests/` files we supplied earlier, then run `php artisan test`.
