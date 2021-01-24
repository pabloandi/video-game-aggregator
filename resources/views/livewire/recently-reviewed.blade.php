<div wire:init="loadRecentlyReviewed" class="recently-reviewed-container space-y-12 mt-8">
    @forelse ($recentlyReviewed as $game)
        @include('_recently-reviewed-game-card', compact('game'))
    @empty
        @foreach (range(1,3) as $item)
            <div class="game bg-gray-800 rounded-lg shadow-md flex p-6">
                <div class="relative flex-none">
                    <div class="bg-gray-700 w-32 lg:w-48 h-40 lg:h-56"></div>
                </div>
                <div class="ml-6 lg:ml-12">
                    <div class="inline-block font-semibold text-transparent text-lg bg-gray-700 rounded leading-tight mt-4">
                        Title goes here
                    </div>

                    <div class="mt-8 space-y-4 hidden lg:block">
                        <span class="text-transparent bg-gray-700 rounded inline-block">Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem, ipsum.</span>
                        <span class="text-transparent bg-gray-700 rounded inline-block">Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem, ipsum.</span>
                        <span class="text-transparent bg-gray-700 rounded inline-block">Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem, ipsum.</span>
                        <span class="text-transparent bg-gray-700 rounded inline-block">Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem, ipsum.</span>
                    </div>
                </div>
            </div>
        @endforeach

    @endforelse
</div>
