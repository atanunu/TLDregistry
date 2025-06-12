### ✅ Files delivered for Patch v6 so far

| Folder                   | Files you already pasted (from our conversation)                                                                                                                                                                       |
| ------------------------ | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **app/**                 | • `Livewire/Traits/TableHelpers.php`<br>• `Livewire/RegistrarTable.php`<br>• `Models/Registrar.php`<br>• `Models/Ledger.php`<br>• `Models/ReservedLabel.php`<br>• `Models/PremiumLabel.php`                            |
| **database/migrations/** | • `2025_01_10_000000_create_registrars_table.php`<br>• `2025_01_11_000000_create_reserved_labels_table.php`<br>• `2025_01_12_000000_create_premium_labels_table.php`<br>• `2025_01_13_000000_create_ledgers_table.php` |
| **config/**              | • `billing.php`<br>• `registrar.php`                                                                                                                                                                                   |
| **routes/**              | • `web.php` (new)<br>• `console.php` (Laravel default; unchanged)                                                                                                                                                      |
| **resources/views/**     | • `livewire/registrar-table.blade.php`<br>• `livewire/components/button.blade.php`                                                                                                                                     |
| **tests/**               | • `Feature/RegistrarApiTest.php`<br>• `Unit/TableHelpersTest.php`                                                                                                                                                      |

These six folders constitute the **entire v6 patch**.
No additional v6 files exist outside these paths.

---

### Quick verification checklist

```bash
composer dump-autoload
php artisan migrate          # creates four new tables
php artisan test             # both tests pass
php artisan route:list | grep admin.registrars   # route exists
```

If all three commands succeed, your v6 layer is complete and functional.
Now you’re ready to move on to Patch v7.
