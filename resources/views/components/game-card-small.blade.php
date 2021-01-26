{{-- most anticipated game card --}}
<div class="game flex">
    @isset($game['cover'])
        <a href="{{ $game['route'] }}">
            <img
                src="{{ $game['coverImageUrl'] }}"
                alt="game cover"
                class="w-16 hover:opacity-75 transition ease-in-out duration-150"
            >
        </a>
    @else
        <x-game-no-cover-small-skeleton />
    @endisset
    <div class="ml-4">
        <a href="{{ $game['route'] }}" class="hover:text-gray-300">
            @if (isset($game['name']))
                {{ $game['name'] }}
            @endif
        </a>
        <div class="text-gray-400 text-sm mt-1">
            @isset($game['releaseDate'])
                {{ $game['releaseDate'] }}
            @endisset
        </div>
    </div>
</div>
