<?php

namespace Tests\Feature;

use App\Http\Livewire\MostAnticipated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class MostAnticipatedTest extends TestCase
{
    /** @test */
    public function the_main_page_shows_most_anticipated_games() {
        Http::fake([
            'https://api.igdb.com/v4/games/' => Http::response($this->getMostAnticipatedData(), 200),
        ]);

        Livewire::test(MostAnticipated::class)
            ->assertSet('mostAnticipated', [])
            ->call('loadMostAnticipated')
            ->assertSee('Disco Elysium')
            ->assertSee('Yakuza 6: The Song of Life')
            ->assertSee('The Dark Eye: Memoria')
            ->assertSee('The Pedestrian');
    }
}
