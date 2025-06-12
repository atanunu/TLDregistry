Below are the **full contents** of every file that lives in the **`app/`** subtree for *v6*.
Copy-paste each block into the matching path in your project, **save exactly as shown**, then run:

```bash
composer dump-autoload
php artisan test
```

---

### 1. `app/Livewire/Traits/TableHelpers.php`

```php
<?php

namespace App\Livewire\Traits;

use Livewire\WithPagination;

/**
 * Shared pagination + search helpers for Livewire table components.
 *
 * Any Livewire component that uses this trait must implement
 * `protected function getRowsQuery()` and return an Eloquent Builder.
 */
trait TableHelpers
{
    use WithPagination;

    /** Search term bound to an <input> */
    public string $search = '';

    /** Reset back to page 1 whenever the search term changes. */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /** Computed property consumed by Blade view (`$rows`). */
    public function getRowsProperty()
    {
        return $this->getRowsQuery()
            ->when($this->search,
                fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->paginate(25);
    }

    /** Child component must implement and return `Builder`. */
    abstract protected function getRowsQuery();
}
```

---

### 2. `app/Livewire/RegistrarTable.php`

```php
<?php

namespace App\Livewire;

use App\Models\Registrar;
use Livewire\Component;
use App\Livewire\Traits\TableHelpers;

/**
 * Admin table of registrars.
 */
class RegistrarTable extends Component
{
    use TableHelpers;

    protected function getRowsQuery()
    {
        return Registrar::query()->latest();
    }

    public function render()
    {
        return view('livewire.registrar-table', [
            'rows' => $this->rows,
        ]);
    }
}
```

---

### 3. `app/Models/Registrar.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrar extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'api_key',
        'balance',
        'credit_limit',
        'status',
    ];

    /* -----------------------------------------------------------------
     |  Relationships
     |------------------------------------------------------------------*/

    public function ledger()
    {
        return $this->hasMany(Ledger::class);
    }

    /* -----------------------------------------------------------------
     |  Helpers
     |------------------------------------------------------------------*/

    /**
     * Credit the registrar’s balance and create a ledger row.
     */
    public function credit(float $amount, string $note = ''): void
    {
        $this->increment('balance', $amount);

        $this->ledger()->create([
            'amount' =>  $amount,
            'note'   =>  $note ?: 'Manual credit',
        ]);
    }
}
```

---

### 4. `app/Models/ReservedLabel.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservedLabel extends Model
{
    use HasFactory;

    protected $fillable = [
        'tld_id',
        'label',
        'reason',
    ];

    public function tld()
    {
        return $this->belongsTo(Tld::class);
    }
}
```

---

### 5. `app/Models/PremiumLabel.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumLabel extends Model
{
    use HasFactory;

    protected $fillable = [
        'tld_id',
        'label',
        'fee',
        'currency',
    ];

    public function tld()
    {
        return $this->belongsTo(Tld::class);
    }
}
```

---

### 6. `app/Models/Ledger.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;

    protected $fillable = [
        'registrar_id',
        'amount',
        'note',
    ];

    public function registrar()
    {
        return $this->belongsTo(Registrar::class);
    }
}
```

---

**That’s every file under `app/` introduced by patch v6.**
Add the matching migrations, config files, Blade views, and tests from the earlier folder-diffs, then run:

```bash
composer dump-autoload
php artisan migrate
php artisan test
```

to confirm the build succeeds before moving on to v7.
