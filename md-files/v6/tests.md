Below are the **two test files** that Patch v6 adds to your **`tests/`** directory.
Create the directory structure exactly as shown, paste each file’s code, then run:

```bash
composer dump-autoload
php artisan test
```

---

## 1. `tests/Feature/RegistrarApiTest.php`

```php
<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrarApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_create_a_registrar_via_api(): void
    {
        // Fake admin user
        $admin = User::factory()->create(['role' => 'admin']);

        $payload = [
            'name'  => 'Demo Registrar',
            'email' => 'demo@example.com',
        ];

        $response = $this->actingAs($admin)
            ->postJson('/api/v1/registry/registrars', $payload);

        $response->assertCreated();

        $this->assertDatabaseHas('registrars', [
            'email' => 'demo@example.com',
        ]);
    }
}
```

---

## 2. `tests/Unit/TableHelpersTest.php`

```php
<?php

namespace Tests\Unit;

use App\Livewire\RegistrarTable;
use App\Models\Registrar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TableHelpersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function search_filter_returns_expected_rows(): void
    {
        Registrar::factory()->create(['name' => 'Alpha Corp']);
        Registrar::factory()->create(['name' => 'Beta LLC']);

        Livewire::test(RegistrarTable::class)
            ->set('search', 'Alpha')
            ->assertSee('Alpha Corp')
            ->assertDontSee('Beta LLC');
    }
}
```

---

### Folder layout recap

```
tests/
├── Feature/
│   └── RegistrarApiTest.php
└── Unit/
    └── TableHelpersTest.php
```

After saving these files:

1. Ensure you have a `User` factory with a `role` field, and a `Registrar` factory (or adjust as needed).
2. Run `php artisan test` — both tests should pass, confirming Patch v6’s test layer is functional.
