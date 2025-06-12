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
