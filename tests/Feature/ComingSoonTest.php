<?php

namespace Tests\Feature;

use App\Http\Livewire\ComingSoon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ComingSoonTest extends TestCase
{
    /** @test */
    public function the_main_page_shows_coming_soon_games() {
        Http::fake([
            'https://api.igdb.com/v4/games/' => Http::response($this->getComingSoonData(), 200),
        ]);

        Livewire::test(ComingSoon::class)
            ->assertSet('comingSoon', [])
            ->call('loadComingSoon')
            ->assertSee('Disco Elysium')
            ->assertSee('Spelunky 2')
            ->assertSee('Spelunky')
            ->assertSee('Pathfinder: Kingmaker');
    }
}
