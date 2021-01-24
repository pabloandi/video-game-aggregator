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

        $this->comingSoon = Cache::remember('most-anticipated', 7, function() use($current) {
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


    }

    public function render()
    {
        return view('livewire.coming-soon');
    }
}
