<div class="space-y-10">
    <div class="text-center">
        <flux:heading size="xl">Live Results</flux:heading>
        <flux:subheading>{{ $totalVotes }} vote(s) counted so far</flux:subheading>
    </div>

    @if ($topThree->isEmpty())
        <flux:text class="text-center block">No votes yet.</flux:text>
    @else
        <div class="flex items-end justify-center gap-4">
            @foreach ([1, 0, 2] as $order)
                @php $candidate = $topThree[$order] ?? null; @endphp
                @continue(! $candidate)
                @php
                    $place = [1 => '2nd', 0 => '1st', 2 => '3rd'][$order];
                    $size = $order === 0 ? 'h-28 w-28' : 'h-20 w-20';
                    $margin = $order === 1 ? 'mt-8' : ($order === 2 ? 'mt-12' : '');
                @endphp
                <div class="flex flex-col items-center {{ $margin }}">
                    @if ($candidate->image_url)
                        <img src="{{ $candidate->image_url }}" class="{{ $size }} rounded-full border-4 border-zinc-300 object-cover dark:border-zinc-600">
                    @else
                        <div class="{{ $size }} flex items-center justify-center rounded-full border-4 border-zinc-300 bg-zinc-200 font-semibold text-zinc-600 dark:border-zinc-600 dark:bg-zinc-700 dark:text-zinc-300">
                            {{ $candidate->initials() }}
                        </div>
                    @endif
                    <span class="mt-2 text-center font-semibold">{{ $place }} &middot; {{ $candidate->name }}</span>
                    <span class="text-sm text-zinc-500">{{ $candidate->votes_count }} vote(s)</span>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mx-auto max-w-2xl space-y-3">
        @foreach ($topThree->concat($others) as $i => $candidate)
            <div class="flex items-center gap-4 rounded-lg border border-zinc-200 p-4 dark:border-zinc-700">
                <div class="w-8 text-lg font-bold text-zinc-500">{{ $i + 1 }}</div>
                @if ($candidate->image_url)
                    <img src="{{ $candidate->image_url }}" class="h-10 w-10 rounded-full object-cover">
                @else
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-zinc-200 text-xs font-semibold text-zinc-600 dark:bg-zinc-700 dark:text-zinc-300">
                        {{ $candidate->initials() }}
                    </div>
                @endif
                <div class="flex-1">
                    <div class="font-semibold">{{ $candidate->name }}</div>
                    <div class="text-sm text-zinc-500">{{ $candidate->details ?? '—' }}</div>
                </div>
                <div class="font-semibold">{{ $candidate->votes_count }}</div>
            </div>
        @endforeach
    </div>
</div>
