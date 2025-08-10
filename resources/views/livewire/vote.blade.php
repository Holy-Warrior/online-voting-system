<div>
    <div class="mb-8">
        <flux:heading size="xl">Cast Your Vote</flux:heading>
        <flux:subheading>Choose one candidate below. You can only vote once.</flux:subheading>
    </div>

    @if (session('error'))
        <div class="mb-6 rounded-lg border border-red-300 bg-red-50 p-4 text-sm text-red-700 dark:border-red-800 dark:bg-red-950 dark:text-red-300">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="mb-6 rounded-lg border border-green-300 bg-green-50 p-4 text-sm text-green-700 dark:border-green-800 dark:bg-green-950 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if (! $votingOpen)
        <div class="rounded-lg border border-amber-300 bg-amber-50 p-4 text-sm text-amber-800 dark:border-amber-800 dark:bg-amber-950 dark:text-amber-300">
            <div class="font-semibold">Voting is currently closed.</div>
            <div>Check back later, or take a look at the live results.</div>
        </div>
    @elseif ($hasVoted)
        <div class="rounded-lg border border-green-300 bg-green-50 p-4 text-sm text-green-700 dark:border-green-800 dark:bg-green-950 dark:text-green-300">
            <div class="font-semibold">You've already cast your vote.</div>
            <div>Thanks for participating! You can view the live results any time.</div>
        </div>
    @else
        <div class="max-w-2xl space-y-3">
            @foreach ($candidates as $candidate)
                <label class="block cursor-pointer">
                    <input
                        type="radio"
                        wire:model="selectedCandidate"
                        value="{{ $candidate->id }}"
                        class="peer sr-only"
                    >
                    <div class="flex items-center gap-4 rounded-lg border border-zinc-200 p-4 transition
                        peer-checked:border-2 peer-checked:border-accent peer-checked:bg-accent/5
                        dark:border-zinc-700">
                        @if ($candidate->image_url)
                            <img src="{{ $candidate->image_url }}" class="h-12 w-12 rounded-full object-cover" alt="{{ $candidate->name }}">
                        @else
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-zinc-200 text-sm font-semibold text-zinc-600 dark:bg-zinc-700 dark:text-zinc-300">
                                {{ $candidate->initials() }}
                            </div>
                        @endif
                        <div class="flex-1">
                            <div class="text-base font-semibold">{{ $candidate->name }}</div>
                            @if ($candidate->details)
                                <div class="text-sm text-zinc-500">{{ $candidate->details }}</div>
                            @endif
                        </div>
                    </div>
                </label>
            @endforeach
        </div>

        @error('selectedCandidate')
            <flux:text class="mt-3 text-red-500">{{ $message }}</flux:text>
        @enderror

        <div class="mt-8">
            <flux:button variant="primary" wire:click="castVote" wire:loading.attr="disabled" wire:target="castVote">
                Submit Vote
            </flux:button>
        </div>
    @endif
</div>
