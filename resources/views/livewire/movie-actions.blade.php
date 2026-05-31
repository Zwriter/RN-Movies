<div>
    {{-- Toast notification --}}
    @if($statusMessage)
        <div x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="position-fixed bottom-0 end-0 m-4"
            style="z-index: 9999; min-width: 280px;">
            <div class="d-flex align-items-center gap-3 p-3 rounded"
                style="background-color: #2a2a3e; border: 1px solid #f5c518;">
                <span style="color: #f5c518;">✓</span>
                <span style="color: #fff;">{{ $statusMessage }}</span>
            </div>
        </div>
    @endif

    {{-- Action Buttons --}}
    <div class="d-flex flex-wrap gap-2 mb-4">
        <button wire:click="toggleWatchlist"
            class="btn btn-sm"
            style="border: 1px solid #f5c518; color: {{ $inWatchlist ? '#000' : '#f5c518' }}; background-color: {{ $inWatchlist ? '#f5c518' : '#1a1a2e' }};">
            {{ $inWatchlist ? '✓ In Watchlist' : '+ Watchlist' }}
        </button>

        <button wire:click="toggleWatched"
            class="btn btn-sm"
            style="border: 1px solid #f5c518; color: {{ $inWatched ? '#000' : '#f5c518' }}; background-color: {{ $inWatched ? '#f5c518' : '#1a1a2e' }};">
            {{ $inWatched ? '✓ Watched' : 'Mark as Watched' }}
        </button>

        <button wire:click="toggleFavorite"
            class="btn btn-sm"
            style="border: 1px solid #f5c518; color: {{ $inFavorites ? '#000' : '#f5c518' }}; background-color: {{ $inFavorites ? '#f5c518' : '#1a1a2e' }};">
            {{ $inFavorites ? '♥ Favorited' : '♡ Favorite' }}
        </button>
    </div>
</div>