<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Storage;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function getResponseData()
    {
        return json_decode(Storage::disk('tests_data')->get('igdb-test-show-game-response.json'));
    }

    public function getPopularGamesData()
    {
        return json_decode(Storage::disk('tests_data')->get('igdb-test-popular-games-response.json'));
    }

    public function getRecentlyReviewedData()
    {
        return json_decode(Storage::disk('tests_data')->get('igdb-test-recently-reviewed-response.json'));
    }

    public function getMostAnticipatedData()
    {
        return json_decode(Storage::disk('tests_data')->get('igdb-test-most-anticipated-games-response.json'));
    }

    public function getComingSoonData()
    {
        return json_decode(Storage::disk('tests_data')->get('igdb-test-coming-soon-games-response.json'));
    }

    public function getSearchDropdownData()
    {
        return json_decode(Storage::disk('tests_data')->get('igdb-test-search-dropdown-games-response.json'));
    }
}
