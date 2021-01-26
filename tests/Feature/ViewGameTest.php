<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ViewGameTest extends TestCase
{


    /** @test */
    public function the_game_page_shows_correct_game_info() {
        Http::fake([
            'https://api.igdb.com/v4/games/' => Http::response($this->getResponseData(), 200),
        ]);


        $response = $this->get(route('games.show','yakuza-like-a-dragon'));

        $response->assertSuccessful();
        $response->assertSeeText('Yakuza: Like a Dragon');
        $response->assertSeeText("Role-playing (RPG), Hack and slash/Beat 'em up");
        $response->assertSeeText('Sega, Ryu ga Gotoku Studios');
        $response->assertSeeText("Become Ichiban Kasuga, a low-ranking yakuza grunt left on the brink of death by the man he trusted most. Take up your legendary bat and get ready to crack some underworld skulls in dynamic RPG combat set against the backdrop of modern-day Japan.");
        // $response->assertSeeText('86%');
        // $response->assertSeeText('96%');

    }

}
