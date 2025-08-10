<div class="space-y-8">
    <div>
        <flux:heading size="xl">Election Overview</flux:heading>
        <flux:subheading>Control voting and see turnout at a glance.</flux:subheading>
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-green-300 bg-green-50 p-4 text-sm text-green-700 dark:border-green-800 dark:bg-green-950 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-4 md:grid-cols-3">
        <div class="rounded-lg border border-zinc-200 p-4 dark:border-zinc-700">
            <div class="text-sm text-zinc-500">Candidates</div>
            <div class="text-2xl font-semibold">{{ $totalCandidates }}</div>
        </div>
        <div class="rounded-lg border border-zinc-200 p-4 dark:border-zinc-700">
            <div class="text-sm text-zinc-500">Registered voters</div>
            <div class="text-2xl font-semibold">{{ $totalVoters }}</div>
        </div>
        <div class="rounded-lg border border-zinc-200 p-4 dark:border-zinc-700">
            <div class="text-sm text-zinc-500">Votes cast</div>
            <div class="text-2xl font-semibold">
                {{ $totalVotes }}
                <span class="text-sm font-normal text-zinc-500">
                    ({{ $totalVoters > 0 ? round($totalVotes / $totalVoters * 100) : 0 }}% turnout)
                </span>
            </div>
        </div>
    </div>

    <div class="rounded-lg border border-zinc-200 p-4 dark:border-zinc-700">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <div class="font-semibold">Voting status: {{ $votingOpen ? 'Open' : 'Closed' }}</div>
                <div class="text-sm text-zinc-500">Voters can only submit a vote while this is open.</div>
            </div>
            <flux:button wire:click="toggleVoting" variant="{{ $votingOpen ? 'danger' : 'primary' }}">
                {{ $votingOpen ? 'Close Voting' : 'Open Voting' }}
            </flux:button>
        </div>
    </div>

    <div>
        <a href="{{ route('admin.candidates') }}" wire:navigate
            class="inline-flex items-center rounded-lg bg-zinc-800 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-700 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-white">
            Manage Candidates
        </a>
    </div>
</div>
