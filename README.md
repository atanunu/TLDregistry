```
# TLD Registry – Core (v6)

A Laravel 11 application that forms the **foundation layer** for a ccTLD / gTLD
registry. Patch v6 upgrades the original DNS-only skeleton by adding:

* Registrar model, REST endpoint, migrations and factories  
* Reserved- and Premium-label tables  
* Ledger table to record registrar credits/debits  
* Configuration stubs for billing & registrar defaults  
* Admin Livewire grid (`/admin/registrars`) with search + pagination  
* Basic PHPUnit + Livewire unit tests

---

## Folder map (after v6)

````

app/
├─ Livewire/
│   └─ RegistrarTable.php
│
├─ Models/
│   ├─ Registrar.php
│   ├─ Ledger.php
│   ├─ ReservedLabel.php
│   └─ PremiumLabel.php
│
config/
├─ billing.php
└─ registrar.php

database/migrations/
├─ 2025\_01\_10\_create\_registrars\_table.php
├─ 2025\_01\_11\_create\_reserved\_labels\_table.php
├─ 2025\_01\_12\_create\_premium\_labels\_table.php
└─ 2025\_01\_13\_create\_ledgers\_table.php

resources/views/livewire/
├─ registrar-table.blade.php
└─ components/button.blade.php

routes/web.php
tests/Feature/RegistrarApiTest.php
tests/Unit/TableHelpersTest.php

````

---

## Quick-start

```bash
# clone repo, then
composer install
cp .env.example .env
php artisan key:generate
# set DB_* creds in .env
php artisan migrate
npm install && npm run build     # for Livewire asset compilation
php artisan serve
````

Open [http://localhost:8000/admin/registrars](http://localhost:8000/admin/registrars) after logging in with an admin
user seeded or created manually.

---

## API sample

```bash
POST /api/v1/registry/registrars
Authorization: Bearer {admin_token}

{
  "name":  "Demo Registrar",
  "email": "demo@example.com"
}
```

*Response `201 Created`* returns JSON with registrar ID & generated `api_key`.

---

## Running tests

```bash
php artisan test          # runs Feature + Unit suites
```

> `RegistrarApiTest` validates the create endpoint.
> `TableHelpersTest` checks Livewire search filtering.

---

## Next patches

* **v7** – DNSSEC signer & parent-DS workflow
* **v8** – Extended billing scaffold (invoices, deposits)
* … see `docs/CHANGELOG.md` for full roadmap

````

### What changed
* Added concise description of new models/migrations.
* Listed folder structure and commands relevant up to v6 only.
* Included sample API call and test instructions.

Commit with:

```bash
git add README.md
git commit -m "docs: update README for v6 core features"
git push
````
