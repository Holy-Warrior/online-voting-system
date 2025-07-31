<div>
    <h2 class="text-lg font-semibold mb-4">Vote for your candidate</h2>

    @foreach($candidates as $candidate)
        <label class="block">
            <input type="radio" wire:model="selectedCandidate" value="{{ $candidate->id }}">
            {{ $candidate->name }} ({{ $candidate->party }})
        </label>
    @endforeach

    <button wire:click="castVote" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
        Submit Vote
    </button>

    @if (session()->has('error'))
        <div class="text-red-500 mt-2">{{ session('error') }}</div>
    @endif

    @if (session()->has('success'))
        <div class="text-green-500 mt-2">{{ session('success') }}</div>
    @endif
</div>
