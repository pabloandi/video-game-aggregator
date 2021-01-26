<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class RecentlyReviewed extends Component
{
    public $recentlyReviewed = [];

    public function loadRecentlyReviewed()
    {
        $before = Carbon::now()->subMonth(2)->timestamp;
        $current = Carbon::now()->timestamp;

        $recentlyReviewedUnformatted = Cache::remember('recently-reviewed', 7, function() use($before, $current) {
            return Http::withHeaders([
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
        });

        $this->recentlyReviewed = $this->formatForView($recentlyReviewedUnformatted);

        collect($this->recentlyReviewed)->filter(function ($game){
            return $game['rating'];
        })->each(function ($game){
            $this->emit('reviewGameWithRatingAdded', [
                'slug'      =>  'review_' . $game['slug'],
                'rating'    =>  $game['rating'] / 100
            ]);
        });

    }

    private function formatForView($params)
    {
        return collect($params)->map(function($game){
            return collect($game)->merge([
                'route'             => route('games.show', $game['slug']),
                'coverImageUrl' =>
                    isset($game['cover'])
                    ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url'])
                    : null,
                'rating'    =>
                    isset($game['rating'])
                    ? round($game['rating'])
                    : null,
                'platforms' =>
                    isset($game['rating'])
                    ? collect($game['platforms'])->pluck('abbreviation')->implode(', ')
                    : null

            ]);
        });
    }

    public function render()
    {
        return view('livewire.recently-reviewed');
    }
}
