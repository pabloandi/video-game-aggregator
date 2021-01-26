{{-- game card --}}
<div class="game bg-gray-800 rounded-lg shadow-md flex p-6">
    <div class="relative flex-none">
        @isset($game['cover'])
            <a href="{{ $game['route'] }}">
                <img
                    src="{{ $game['coverImageUrl'] }}"
                    alt="game cover"
                    class="w-48 hover:opacity-75 transition ease-in-out duration-150"
                >
            </a>
        @else
            <x-game-no-cover-skeleton />
        @endisset

        @isset($game['rating'])
            <div
                id="review_{{ $game['slug'] }}"
                class="absolute bottom-0 right-0 w-16 h-16 bg-gray-900 rounded-full text-xs"
                style="right: -20px; bottom: -20px;"
            >

            </div>
        @endisset
    </div>
    <div class="ml-6 lg:ml-12">
        <a href="#" class="block text-base font-semibold leading-tight hover:text-gray-400 mt-4">
            @isset($game['name'])
                {{ $game['name'] }}
            @endisset
        </a>
        <div class="text-gray-400 mt-1">
            {{ $game['platforms'] }}
        </div>
        <p class="mt-6 text-gray-400 hidden lg:block">
            @isset($game['summary'])
                {{ $game['summary'] }}
            @endisset
        </p>
    </div>
</div>
{{-- end game card --}}
