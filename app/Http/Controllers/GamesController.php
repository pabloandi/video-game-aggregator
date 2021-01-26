<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
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
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $game = Http::withHeaders([
            'Client-ID'        => config('services.igdb.client-id'),
            'Authorization'    => config('services.igdb.client-auth'),
        ])
        ->withBody(
            "
            fields slug, name, summary, cover.url, release_dates.date,
            rating, aggregated_rating, platforms.abbreviation,
            involved_companies.company.name, genres.name, websites.*,
            videos.*, screenshots.*, similar_games.platforms.abbreviation,
            similar_games.name, similar_games.slug,
            similar_games.rating, similar_games.cover.url;

            where slug = \"{$slug}\";
            limit 1;
            ", 'text'
        )
        ->post('https://api.igdb.com/v4/games/')
        ->json();


        abort_if(!$game, 404);



        return view('show', [
            'game'  =>  $this->formatGameForView($game[0])
        ]);
    }

    private function formatGameForView($game)
    {
        return collect($game)->merge([
            'coverImageUrl' =>
                isset($game['cover'])
                ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url'])
                : null,
            'genres'    =>
                isset($game['cover'])
                ? collect($game['genres'])->pluck('name')->implode(', ')
                : null,
            'companies'    =>
                isset($game['cover'])
                ? collect($game['involved_companies'])->pluck('company.name')->implode(', ')
                :null,
            'platforms' =>
                isset($game['platforms'])
                ? collect($game['platforms'])->pluck('abbreviation')->implode(', ')
                : null,
            'memberRating'    =>
                isset($game['rating'])
                ? round($game['rating'])
                : 0,
            'criticRating'    =>
                isset($game['aggregated_rating'])
                ? round($game['aggregated_rating'])
                : 0,
            'trailerUrl'      =>
                isset($game['videos'])
                ? "https://youtube.com/embed/" . $game['videos'][0]['video_id']
                : '#',
            'screenshots'   =>
                isset($game['screenshots'])
                ? collect($game['screenshots'])->map(function($screenshot){
                        return [
                            'huge' => Str::replaceFirst('thumb', 'screenshot_huge', $screenshot['url']),
                            'big' => Str::replaceFirst('thumb', 'screenshot_big', $screenshot['url'])
                        ];
                    })->take(9)
                : [],
            'similarGames'  => collect($game['similar_games'])->map(function($game){
                return collect($game)->merge([
                    'route'             => route('games.show', $game['slug']),
                    'coverImageUrl'     =>
                        isset($game['cover'])
                        ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url'])
                        : null,
                    'rating'    =>
                        isset($game['rating'])
                        ? round($game['rating'])
                        : null,
                    'platforms' =>
                        isset($game['platforms'])
                        ? collect($game['platforms'])->pluck('abbreviation')->implode(', ')
                        : null

                ]);
            })->take(6),
            'social'    =>
                isset($game['websites'])
                ?   [
                        'website'   => collect($game['websites'])->first(),
                        'facebook'   => collect($game['websites'])->filter(function($website){
                            return Str::contains($website['url'], 'facebook');
                        })->first(),
                        'instagram'   => collect($game['websites'])->filter(function($website){
                            return Str::contains($website['url'], 'instagram');
                        })->first(),
                        'twitter'   => collect($game['websites'])->filter(function($website){
                            return Str::contains($website['url'], 'twitter');
                        })->first(),
                    ]
                : null,



        ]);

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
