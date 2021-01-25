{{-- popular games card --}}
<div class="game mt-4">
    <div class="relative inline-block">
        @isset($game['cover'])
            <a href="{{ route('games.show', $game['slug']) }}">
                <img
                    src="{{ $game['coverImageUrl'] }}"
                    alt="game cover"
                    class="hover:opacity-75 transition ease-in-out duration-150 w-52 h-72"
                >
            </a>

        @endisset
        @isset($game['rating'])
            <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full" style="right: -20px; bottom: -20px;">
                <div class="font-semibold text-xs flex justify-center items-center h-full">
                    {{ $game['rating'] }}
                </div>
            </div>
        @endisset
    </div>
    <a href="#" class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">
        @isset($game['name'])
            {{ $game['name'] }}
        @endisset
    </a>
    <div class="text-gray-400 mt-1"> {{ $game['platforms'] }} </div>
</div>
{{-- end popular games card --}}
