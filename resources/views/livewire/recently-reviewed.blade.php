<div wire:init="loadRecentlyReviewed" class="recently-reviewed-container space-y-12 mt-8">
    @forelse ($recentlyReviewed as $game)
        <x-game-review-card :game="$game" />
    @empty
        @foreach (range(1,3) as $item)
            <x-game-review-card-skeleton />
        @endforeach

    @endforelse
</div>
