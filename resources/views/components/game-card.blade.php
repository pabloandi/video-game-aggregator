{{-- game card --}}
<div class="game mt-4">
    <div class="relative inline-block">
        @isset($game['cover'])
            <a href="{{ $game['route'] }}">
                <img
                    src="{{ $game['coverImageUrl'] }}"
                    alt="game cover"
                    class="hover:opacity-75 transition ease-in-out duration-150 w-52 h-72"
                >
            </a>
        @else
            <x-game-no-cover-skeleton />
        @endisset
        @isset($game['rating'])
            <div id="{{ $game['slug'] }}" class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full" style="right: -20px; bottom: -20px;">

            </div>

            @push('scripts')
                @include('_rating', [
                    'slug'      =>  $game['slug'],
                    'rating'    =>  $game['rating'],
                    'event'     => null
                ])
            @endpush

        @endisset
    </div>
    <a href="{{ $game['route'] }}" class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">
        @isset($game['name'])
            {{ $game['name'] }}
        @endisset
    </a>
    <div class="text-gray-400 mt-1"> {{ $game['platforms'] }} </div>
</div>
{{-- end game card --}}
