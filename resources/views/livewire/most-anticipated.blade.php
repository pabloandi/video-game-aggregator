<div wire:init="loadMostAnticipated" class="most-anticipated-container space-y-10 mt-8">
    @forelse ($mostAnticipated as $game)
        @include('_most-anticipated-game-card', compact('game'))
    @empty
        <div class="spinner mt-8"></div>
    @endforelse
</div>
