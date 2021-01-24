<div wire:init="loadRecentlyReviewed" class="recently-reviewed-container space-y-12 mt-8">
    @forelse ($recentlyReviewed as $game)
        @include('_recently-reviewed-game-card', compact('game'))
    @empty
        <div class="spinner mt-8"></div>
    @endforelse
</div>
