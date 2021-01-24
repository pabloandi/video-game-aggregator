<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

class MostAnticipated extends Component
{
    public $mostAnticipated = [];

    public function loadMostAnticipated()
    {
        $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;
        $current = Carbon::now()->timestamp;

        $this->mostAnticipated = Http::withHeaders([
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
    }

    public function render()
    {
        return view('livewire.most-anticipated');
    }
}
