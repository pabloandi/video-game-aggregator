<?php

namespace Tests\Feature;

use App\Http\Livewire\SearchDropdown;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class SearchDropdownTest extends TestCase
{
    /** @test */
    public function the_search_dropdown_searches_for_games() {
        Http::fake([
            'https://api.igdb.com/v4/games/' => Http::response($this->getSearchDropdownData(), 200),
        ]);

        Livewire::test(SearchDropdown::class)
            ->assertDontSee('castlevania')
            ->set('search', 'castlevania')
            ->assertSee('Fake Castlevania: Aria of Sorrow')
            ->assertSee("Fake Castlevania: Vampire's Kiss");

    }
}
