<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PopularGames extends Component
{
    public $popularGames = [];

    public function loadPopularGames()
    {
        $before = Carbon::now()->subMonth(2)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;

        $popularGamesUnformatted = Cache::remember('popular-games', 7, function() use($before, $after) {


            return Http::withHeaders([
                'Client-ID'        => config('services.igdb.client-id'),
                'Authorization'    => config('services.igdb.client-auth'),
            ])
            ->withBody(
                "
                fields slug, name, cover.url, release_dates.date, total_rating, platforms.abbreviation, rating;
                where platforms = (48,49,130,6)
                & (release_dates.date > {$before} & release_dates.date < {$after})
                & rating != null;
                sort rating desc;
                limit 12;
                ", 'text'
            )
            ->post('https://api.igdb.com/v4/games/')
            ->json();
        });

        $this->popularGames = $this->formatForView($popularGamesUnformatted);

    }

    private function formatForView($params)
    {
        return collect($params)->map(function($game){
            return collect($game)->merge([
                'coverImageUrl' => Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']),
                'rating'    => isset($game['rating']) ? round($game['rating']) . " %" : null,
                'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', ')

            ]);
        });
    }

    public function render()
    {
        return view('livewire.popular-games');
    }
}
