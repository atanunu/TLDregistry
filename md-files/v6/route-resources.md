Below are the **exact file contents** that Patch v6 adds to the **routes** and **resources** folders.
Create any missing directories, paste each file exactly as shown, save, then run:

```bash
composer dump-autoload
php artisan view:clear   # clears compiled Blade cache
```

---

## routes

### 1. `routes/web.php`

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\RegistrarTable;

/*
|--------------------------------------------------------------------------
| Web Routes  –  introduced in v6
|--------------------------------------------------------------------------
|
| Admins can list and search registrars at /admin/registrars.
|
*/

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/registrars', RegistrarTable::class)
        ->name('admin.registrars');
});
```

### 2. `routes/console.php`

```php
<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| Here you may define `php artisan` commands that interact with your
| application. A basic "inspire" example is included.  v6 does not add
| commands here, but the stub remains for future dns:sync or billing:*
| commands.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
```

---

## resources  (Blade views)

> **Folder structure**
>
> ```
> resources/views/
> └── livewire/
>     ├─ registrar-table.blade.php
>     └── components/
>         └── button.blade.php
> ```

### 3. `resources/views/livewire/registrar-table.blade.php`

```blade
<div class="p-4">

    <input wire:model.debounce.300ms="search"
           type="text"
           placeholder="Search registrars…"
           class="border rounded px-2 py-1 mb-3 w-64">

    <table class="table-auto w-full text-sm">
        <thead class="bg-gray-100">
        <tr>
            <th class="p-2 text-left">Name</th>
            <th>Email</th>
            <th class="text-right">Balance</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($rows as $row)
            <tr class="border-b">
                <td class="p-2">{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td class="text-right">{{ number_format($row->balance, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $rows->links() }}
    </div>
</div>
```

### 4. `resources/views/livewire/components/button.blade.php`

```blade
<button {{ $attributes->merge([
    'class' =>
        'px-2 py-1 rounded bg-blue-600 text-white text-xs hover:bg-blue-700 focus:outline-none'
]) }}>
    {{ $slot }}
</button>
```

---

Add these files, clear caches, and Patch v6’s **routes** and **view layer** are complete.
