<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

class MostAnticipated extends Component
{
    public $mostAnticipated = [];

    public function loadMostAnticipated()
    {
        $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;
        $current = Carbon::now()->timestamp;

        $mostAnticipatedUnformatted = Cache::remember('most-anticipated', 7, function() use($afterFourMonths, $current) {
            return Http::withHeaders([
                'Client-ID'        => config('services.igdb.client-id'),
                'Authorization'    => config('services.igdb.client-auth'),
            ])
            ->withBody(
                "
                fields slug, name, summary, cover.url, release_dates.date, total_rating, platforms.abbreviation, rating, rating_count;
                where platforms = (48,49,130,6)
                & (release_dates.date > {$current} & release_dates.date < {$afterFourMonths})
                & rating_count > 5
                & rating != null;
                sort rating desc;
                limit 4;
                ", 'text'
            )
            ->post('https://api.igdb.com/v4/games/')
            ->json();
        });

        $this->mostAnticipated = $this->formatForView($mostAnticipatedUnformatted);

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
        return view('livewire.most-anticipated');
    }
}
