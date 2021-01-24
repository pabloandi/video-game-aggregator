<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

class RecentlyReviewed extends Component
{
    public $recentlyReviewed = [];

    public function loadRecentlyReviewed()
    {
        $before = Carbon::now()->subMonth(2)->timestamp;
        $current = Carbon::now()->timestamp;

        $this->recentlyReviewed = Http::withHeaders([
            'Client-ID'        => config('services.igdb.client-id'),
            'Authorization'    => config('services.igdb.client-auth'),
        ])
        ->withBody(
            "
            fields slug, name, summary, cover.url, release_dates.date, total_rating, platforms.abbreviation, rating, rating_count;
            where platforms = (48,49,130,6)
            & (release_dates.date > {$before} & release_dates.date < {$current})
            & rating_count > 5
            & rating != null;
            sort rating desc;
            limit 3;
            ", 'text'
        )
        ->post('https://api.igdb.com/v4/games/')
        ->json();
    }
    public function render()
    {
        return view('livewire.recently-reviewed');
    }
}
