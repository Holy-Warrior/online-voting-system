<div>
    <h2 class="text-lg font-semibold mb-4"></h2>

    <!-- Stylish heading -->
    <h1 class="text-5xl font-pacifico text-center text-pink-500 mb-10">
        Vote for your candidate
    </h1>

    <!-- Candidates List -->
    <div class="max-w-4xl mx-auto space-y-4">
        <!-- JavaScript for card highlighting -->
        <script>
            function updateSelection(el) {
                const allCards = document.querySelectorAll('.candidate-card');

                // Reset all cards to default style
                allCards.forEach(card => {
                    card.classList.remove('border-4', 'border-blue-300', 'bg-blue-200', 'ring-4', 'ring-blue-200');
                    card.classList.add('border', 'border-gray-200');
                });

                // Highlight the selected candidate card
                const candidateId = el.value;
                const selectedCard = document.getElementById(`candidate-${candidateId}`);

                if (selectedCard) {
                    selectedCard.classList.remove('border', 'border-gray-200');
                    selectedCard.classList.add('border-4', 'border-blue-300', 'bg-blue-200', 'ring-4', 'ring-blue-200');
                }
            }
        </script>

        @foreach($candidates as $candidate)
            <label class="block cursor-pointer">
                <input 
                    type="radio" 
                    name="option" 
                    wire:model="selectedCandidate" 
                    value="{{ $candidate->id }}" 
                    class="hidden" 
                    onclick="updateSelection(this)">

                <div 
                    id="candidate-{{ $candidate->id }}"
                    class="candidate-card flex items-center p-4 rounded-lg shadow hover:shadow-md transition 
                    {{ $selectedCandidate == $candidate->id ? 'border-4 border-blue-500 bg-blue-600 ring-4 ring-blue-200' : 'border border-gray-200' }}">
                    
                    <div class="text-xl font-medium text-gray-700 w-12">{{ $loop->iteration }}</div>
                    <div class="ml-4 flex-1">
                        <div class="text-base font-semibold">{{ $candidate->name }}</div>
                        <div class="text-sm text-gray-500">{{ $candidate->party }}</div>
                    </div>
                    <img src="{{ asset('storage/' .$candidate->image) }}" class="w-12 h-12 rounded-full ml-4" />
                </div>
            </label>
        @endforeach
    </div>

    <!-- Submit Button -->
    <div class="flex justify-center my-10">
        <button wire:click="castVote" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg text-lg">
            Submit Vote
        </button>
    </div>

    <!-- Feedback Messages -->
    @if (session()->has('error'))
        <div class="text-red-500 mt-2">{{ session('error') }}</div>
    @endif

    @if (session()->has('success'))
        <div class="text-green-500 mt-2">{{ session('success') }}</div>
    @endif
</div>
