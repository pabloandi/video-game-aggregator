{{-- most anticipated game card --}}
<div class="game flex">
    <a href="{{ $game['slug'] }}">
        <img
            src="{{ $game['cover']['url'] }}"
            alt="game cover"
            class="w-16 hover:opacity-75 transition ease-in-out duration-150"
        >
    </a>
    <div class="ml-4">
        <a href="{{ $game['slug'] }}" class="hover:text-gray-300">
            @if (isset($game['name']))
                {{ $game['name'] }}
            @endif
        </a>
        <div class="text-gray-400 text-sm mt-1">
            @isset($game['release_dates'])
                <?php $date = array_shift($game['release_dates']) ?>
                    @isset($date['date'])
                        {{ Carbon\Carbon::parse($date['date'])->format('M d, Y') }} <br>
                    @endisset
            @endisset
        </div>
    </div>
</div>
