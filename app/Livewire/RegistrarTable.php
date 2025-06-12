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
