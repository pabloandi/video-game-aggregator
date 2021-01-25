<?php

namespace Tests\Feature;

use App\Http\Livewire\PopularGames;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class PopularGamesTest extends TestCase
{
    /** @test */
    public function the_main_page_shows_popular_games() {
        Http::fake([
            'https://api.igdb.com/v4/games/' => Http::response($this->getPopularGamesData(), 200),
        ]);

        Livewire::test(PopularGames::class)
            ->assertSet('popularGames', [])
            ->call('loadPopularGames')
            ->assertSee('DOOM Eternal')
            ->assertSee('Yakuza: Like a Dragon')
            ->assertSee('Persona 5 Royal Limited Edition')
            ->assertSee('Ghostrunner')
            ->assertSee('PC, PS4, XONE, PS5, Series X')
            ->assertSee('Bloodstained: Ritual of the Night');
    }
}
