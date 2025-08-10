<div class="space-y-8">
    <div>
        <flux:heading size="xl">Manage Candidates</flux:heading>
        <flux:subheading>Add, edit, or remove candidates for the election.</flux:subheading>
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-green-300 bg-green-50 p-4 text-sm text-green-700 dark:border-green-800 dark:bg-green-950 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="rounded-lg border border-red-300 bg-red-50 p-4 text-sm text-red-700 dark:border-red-800 dark:bg-red-950 dark:text-red-300">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit="save" class="max-w-lg space-y-4 rounded-lg border border-zinc-200 p-4 dark:border-zinc-700">
        <flux:input wire:model="name" label="Name" type="text" />

        <div>
            <label class="mb-1 block text-sm font-medium text-zinc-700 dark:text-zinc-300">Details / bio</label>
            <textarea wire:model="details" rows="3"
                class="w-full rounded-lg border border-zinc-300 bg-white p-2 text-sm dark:border-zinc-700 dark:bg-zinc-900"></textarea>
            @error('details') <div class="mt-1 text-sm text-red-500">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-zinc-700 dark:text-zinc-300">Photo</label>
            <input type="file" wire:model="photo" accept="image/*"
                class="block w-full text-sm text-zinc-700 dark:text-zinc-300">
            <div wire:loading wire:target="photo" class="mt-1 text-sm text-zinc-500">Uploading&hellip;</div>
            @error('photo') <div class="mt-1 text-sm text-red-500">{{ $message }}</div> @enderror
            @if ($photo)
                <img src="{{ $photo->temporaryUrl() }}" class="mt-2 h-16 w-16 rounded-full object-cover">
            @endif
        </div>

        <div class="flex gap-2">
            <flux:button type="submit" variant="primary">{{ $editingId ? 'Update Candidate' : 'Add Candidate' }}</flux:button>
            @if ($editingId)
                <flux:button type="button" wire:click="cancelEdit" variant="filled">Cancel</flux:button>
            @endif
        </div>
    </form>

    <div class="space-y-3">
        @forelse ($candidates as $candidate)
            <div class="flex flex-wrap items-center justify-between gap-4 rounded-lg border border-zinc-200 p-4 dark:border-zinc-700">
                <div class="flex items-center gap-4">
                    @if ($candidate->image_url)
                        <img src="{{ $candidate->image_url }}" class="h-12 w-12 rounded-full object-cover">
                    @else
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-zinc-200 text-sm font-semibold text-zinc-600 dark:bg-zinc-700 dark:text-zinc-300">
                            {{ $candidate->initials() }}
                        </div>
                    @endif
                    <div>
                        <div class="font-semibold">{{ $candidate->name }}</div>
                        <div class="text-sm text-zinc-500">{{ $candidate->votes_count }} vote(s)</div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <flux:button size="sm" wire:click="edit({{ $candidate->id }})">Edit</flux:button>
                    <flux:button size="sm" variant="danger" wire:click="delete({{ $candidate->id }})" wire:confirm="Remove this candidate?">Delete</flux:button>
                </div>
            </div>
        @empty
            <flux:text>No candidates yet. Add your first one above.</flux:text>
        @endforelse
    </div>
</div>
