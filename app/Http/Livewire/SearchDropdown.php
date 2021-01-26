<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropdown extends Component
{
    public $search = '';
    public $searchResults = [];

    public function render()
    {
        if (strlen($this->search) >= 2){
            $this->searchResults = Http::withHeaders([
                    'Client-ID'        => config('services.igdb.client-id'),
                    'Authorization'    => config('services.igdb.client-auth'),
                ])
                ->withBody(
                    "
                    search \"{$this->search}\";
                    fields name, slug, cover.url;
                    limit 8;
                    ", 'text'
                )
                ->post('https://api.igdb.com/v4/games/')
                ->json();
        }

        return view('livewire.search-dropdown');
    }
}
