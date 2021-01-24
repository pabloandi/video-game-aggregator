<div wire:init="loadComingSoon" class="coming-soon-container space-y-10 mt-8">
    @forelse ($comingSoon as $game)
        @include('_coming-soon-game-card', compact('game'))
    @empty
        <div class="spinner mt-8"></div>
    @endforelse
</div>
