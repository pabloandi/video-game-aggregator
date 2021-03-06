<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

class ComingSoon extends Component
{
    public $comingSoon = [];

    public function loadComingSoon()
    {
        $current = Carbon::now()->timestamp;

        $comingSoonUnformatted = Cache::remember('coming-soon', 7, function() use($current) {
            return Http::withHeaders([
                'Client-ID'        => config('services.igdb.client-id'),
                'Authorization'    => config('services.igdb.client-auth'),
            ])
            ->withBody(
                "
                fields slug, name, summary, cover.url, release_dates.date, total_rating, platforms.abbreviation, rating, rating_count;
                where platforms = (48,49,130,6)
                & (release_dates.date > {$current} & rating_count > 5)
                & rating != null;
                sort rating desc;
                limit 4;
                ", 'text'
            )
            ->post('https://api.igdb.com/v4/games/')
            ->json();
        });

        $this->comingSoon = $this->formatForView($comingSoonUnformatted);
    }

    private function formatForView($params)
    {
        return collect($params)->map(function($game){
            return collect($game)->merge([
                'coverImageUrl' => $game['cover']['url'],
                'route'     => route('games.show', $game['slug']),
                'releaseDate'   =>
                Carbon::parse(collect($game['release_dates'])->pluck('date')->pop())->format('M d, Y')
            ]);
        });
    }

    public function render()
    {
        return view('livewire.coming-soon');
    }
}
