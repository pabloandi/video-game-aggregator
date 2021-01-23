<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $before = Carbon::now()->subMonth(2)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;
        $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;
        $current = Carbon::now()->timestamp;

         $popularGames = Http::withHeaders([
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

        $recentlyReviewed = Http::withHeaders([
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

        $mostAnticipated = Http::withHeaders([
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

        $comingSoon = Http::withHeaders([
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

        //  return $recentlyReviewed;
        //  return $popularGames;
         return view('index', compact(
             'popularGames',
             'recentlyReviewed',
             'mostAnticipated',
             'comingSoon'
            ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
