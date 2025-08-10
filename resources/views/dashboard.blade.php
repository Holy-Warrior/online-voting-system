<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <div>
            <flux:heading size="xl">Welcome, {{ auth()->user()->name }}</flux:heading>
            <flux:subheading>
                @if (auth()->user()->isAdmin())
                    You're signed in as an administrator.
                @elseif ($hasVoted)
                    You've already cast your vote. Thanks for participating!
                @else
                    You haven't voted yet.
                @endif
            </flux:subheading>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            @if (auth()->user()->isAdmin())
                <div class="rounded-lg border border-zinc-200 p-4 dark:border-zinc-700">
                    <flux:heading>Admin Panel</flux:heading>
                    <flux:text class="mt-1 block">Manage candidates and control whether voting is open.</flux:text>
                    <a href="{{ route('admin.overview') }}" wire:navigate
                        class="mt-3 inline-flex items-center rounded-lg bg-zinc-800 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-700 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-white">
                        Go to Admin Panel
                    </a>
                </div>
            @else
                <div class="rounded-lg border border-zinc-200 p-4 dark:border-zinc-700">
                    <flux:heading>{{ $hasVoted ? 'Your Vote' : 'Cast Your Vote' }}</flux:heading>
                    <flux:text class="mt-1 block">
                        {{ $hasVoted ? 'You can review the live results at any time.' : 'Choose your candidate. You can only vote once.' }}
                    </flux:text>
                    <a href="{{ route('vote') }}" wire:navigate
                        class="mt-3 inline-flex items-center rounded-lg bg-zinc-800 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-700 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-white">
                        {{ $hasVoted ? 'View Vote Page' : 'Vote Now' }}
                    </a>
                </div>
            @endif

            <div class="rounded-lg border border-zinc-200 p-4 dark:border-zinc-700">
                <flux:heading>Live Results</flux:heading>
                <flux:text class="mt-1 block">See how the election is going right now.</flux:text>
                <a href="{{ route('results') }}" wire:navigate
                    class="mt-3 inline-flex items-center rounded-lg border border-zinc-300 px-4 py-2 text-sm font-semibold hover:bg-zinc-50 dark:border-zinc-600 dark:hover:bg-zinc-800">
                    View Results
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
