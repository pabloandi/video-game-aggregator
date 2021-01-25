{{-- game card --}}
<div class="game bg-gray-800 rounded-lg shadow-md flex p-6">
    <div class="relative flex-none">
        <a href="{{ $game['route'] }}">
            <img
                src="{{ $game['coverImageUrl'] }}"
                alt="game cover"
                class="w-48 hover:opacity-75 transition ease-in-out duration-150"
            >
        </a>
        @if (isset($game['rating']))
            <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-900 rounded-full" style="right: -20px; bottom: -20px;">
                <div class="font-semibold text-xs flex justify-center items-center h-full">
                    {{ $game['rating'] }}
                </div>
            </div>
        @endif
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
