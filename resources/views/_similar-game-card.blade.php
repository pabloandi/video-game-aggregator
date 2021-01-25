{{-- similar games card --}}
<div class="game mt-8">
    <div class="relative inline-block">
        @isset($similar_game['coverImageUrl'])
            <a href="{{ $similar_game['route'] }}">
                <img
                    src="{{ $similar_game['coverImageUrl'] }}"
                    alt="game cover"
                    class="hover:opacity-75 transition ease-in-out duration-150"
                >
            </a>
        @else
            <div class="bg-gray-800 w-52 h-72"></div>
        @endisset

        @isset($similar_game['rating'])
            <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full" style="right: -20px; bottom: -20px;">
                <div class="font-semibold text-xs flex justify-center items-center h-full">
                    {{ $similar_game['rating'] }}

                </div>
            </div>
        @endisset
    </div>


    <a
        href="{{ $similar_game['route'] }}"
        class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8"
    >
        @isset($similar_game['name'])
            {{ $similar_game['name'] }}
        @endisset
    </a>
    <div class="text-gray-400 mt-1">
        @isset($similar_game['platforms'])
            {{ $similar_game['platforms'] }}
        @endisset
    </div>
</div>
{{-- end similar games card --}}
