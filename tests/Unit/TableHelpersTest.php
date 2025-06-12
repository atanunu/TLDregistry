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
