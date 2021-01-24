<div wire:init="loadComingSoon" class="coming-soon-container space-y-10 mt-8">
    @forelse ($comingSoon as $game)
        @include('_coming-soon-game-card', compact('game'))
    @empty
        @foreach (range(1,4) as $item)
            <div class="game flex">
                <div class="bg-gray-800 w-16 h-20 flex-none"></div>
                <div class="ml-4">
                    <div class="text-transparent bg-gray-700 rounded leading-tight">
                        Title goes here today
                    </div>
                    <div class="text-transparent bg-gray-700 rounded inline-block text-sm mt-2">
                        Sept 27, 2020
                    </div>
                </div>
            </div>
        @endforeach
    @endforelse
</div>
