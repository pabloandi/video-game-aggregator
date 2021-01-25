<?php

namespace Tests\Feature;

use App\Http\Livewire\RecentlyReviewed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class RecentlyReviewedTest extends TestCase
{
    /** @test */
    public function the_main_page_shows_rencently_reviewed_games() {
        Http::fake([
            'https://api.igdb.com/v4/games/' => Http::response($this->getRecentlyReviewedData(), 200),
        ]);

        Livewire::test(RecentlyReviewed::class)
            ->assertSet('recentlyReviewed', [])
            ->call('loadRecentlyReviewed')
            ->assertSee('Zaos')
            ->assertSee('Persona 5 Royal Limited Edition')
            ->assertSee('Fire Emblem: Shadow Dragon and the Blade of Light');
    }
}
