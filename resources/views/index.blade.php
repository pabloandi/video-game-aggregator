@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        {{-- init popular games --}}
        <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Popular Games</h2>
        <div class="popular-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12 border-b border-gray-800 pb-16">
            @foreach ($popularGames as $game)
                @include('_popular-game-card', compact('game'))

            @endforeach

        </div>
        {{-- end popular games --}}
        <div class="flex flex-col lg:flex-row my-10">
            <div class="recently-reviewed w-full lg:w-3/4 mr-0 lg:mr-32">
                <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Recently Reviewed</h2>
                <div class="recently-reviewed-container space-y-12 mt-8">
                    @foreach ($recentlyReviewed as $game)
                        @include('_recently-reviewed-game-card', compact('game'))
                    @endforeach


                </div>
            </div>
            <div class="most-anticipated lg:w-1/4 mt-12">
                <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Most Anticipated</h2>
                <div class="most-anticipated-container space-y-10 mt-8">
                    @foreach ($mostAnticipated as $game)
                        @include('_most-anticipated-game-card', compact('game'))
                    @endforeach
                </div>
                <h2 class="text-blue-500 uppercase tracking-wide font-semibold mt-12">Coming soon</h2>
                <div class="coming-soon-container space-y-10 mt-8">
                    @foreach ($comingSoon as $game)
                        @include('_coming-soon-game-card', compact('game'))
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{-- end container --}}


@endsection
