{{-- popular games card --}}
<div class="game mt-8">
    <div class="relative inline-block">
        @if (isset($game['cover']))
            <a href="{{ $game['slug'] }}">
                <img
                    src="{{ Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) }}"
                    alt="game cover"
                    class="hover:opacity-75 transition ease-in-out duration-150"
                >
            </a>

        @endif
        @if (isset($game['rating']))
            <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full" style="right: -20px; bottom: -20px;">
                <div class="font-semibold text-xs flex justify-center items-center h-full">
                    {{ round($game['rating']) }} %

                </div>
            </div>
        @endif
    </div>
    <a href="#" class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">
        @if (isset($game['name']))
            {{ $game['name'] }}
        @endif
    </a>
    <div class="text-gray-400 mt-1">
        @isset($game['platforms'])
            @foreach ($game['platforms'] as $platform)
                @isset($platform['abbreviation'])
                    {{ $platform['abbreviation'] }} &middot;
                @endisset

            @endforeach
        @endisset
    </div>
</div>
{{-- end popular games card --}}
