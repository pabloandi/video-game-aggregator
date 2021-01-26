<div class="relative">
    <input
        wire:model.debounce.300ms="search"
        type="text"
        class="bg-gray-800 text-sm rounded-full focus:outline-none focus:shadow-outline w-64 px-3 pl-8 py-1"
        placeholder="Search..."
    >
    <div class="absolute top-0 flex items-center h-full ml-2">
        <svg class="fill-current text-gray-400 w-4" viewBox="0 0 512 512">
            <title>ionicons-v5-f</title>
            <path d="M456.69,421.39,362.6,327.3a173.81,173.81,0,0,0,34.84-104.58C397.44,126.38,319.06,48,222.72,48S48,126.38,48,222.72s78.38,174.72,174.72,174.72A173.81,173.81,0,0,0,327.3,362.6l94.09,94.09a25,25,0,0,0,35.3-35.3ZM97.92,222.72a124.8,124.8,0,1,1,124.8,124.8A124.95,124.95,0,0,1,97.92,222.72Z"/>
          </svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3" style="position: absolute;"></div>

    @if (strlen($search) >= 2)
        <div class="absolute z-50 bg-gray-800 text-xs rounded w-64 mt-2">
            @if (count($searchResults) > 0)
                <ul>
                    @foreach ($searchResults as $game)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('games.show', $game['slug']) }}" class="hover:bg-gray-700 flex items-center transition ease-in-out duration-150 p-3">
                                @isset($game['cover'])
                                    <img
                                        src="{{ Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']) }}"
                                        alt="cover"
                                        class="w-10"
                                    >
                                @else
                                    <div class="relative inline-block">
                                        <div class="bg-gray-500 w-10 h-10"></div>
                                    </div>
                                @endisset
                                <span class="ml-4">{{ $game['name'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="p-3">No results for "{{ $search }}"</div>

            @endif
        </div>
    @endif
</div>
