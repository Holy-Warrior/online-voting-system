<div>
  <!-- Stylish Heading -->
  <h1 class="text-5xl font-pacifico text-center text-pink-500 mb-10">
    Voting Results
  </h1>

  <!-- Top 3 Podium (First Place Centered) -->
  <div class="flex justify-center items-end gap-4 mb-10">
    @foreach ([1, 0, 2] as $order)
      @php
        $candidate = $topThree[$order] ?? null;
        if (!$candidate) continue;
        $place = [1 => '2nd Place', 0 => '1st Place', 2 => '3rd Place'][$order];
        $colors = ['1st Place' => 'yellow-500', '2nd Place' => 'gray-400', '3rd Place' => 'orange-500'];
        $size = $order == 0 ? 'w-36 h-36' : 'w-24 h-24';
        $margin = $order == 1 ? 'mt-10' : ($order == 2 ? 'mt-14' : '');
      @endphp
      <div class="flex flex-col items-center {{ $margin }}">
        <img src="{{ asset('storage/' .$candidate->image) }}" class="{{ $size }} rounded-full border-4 border-{{ $colors[$place] }}" />
        <span class="mt-2 font-semibold text-lg text-{{ $colors[$place] }}">{{ $place }}</span>
      </div>
    @endforeach
  </div>

  <!-- Choose Your Vote Button -->
  <div class="flex justify-center mb-10">
    <a class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg text-lg" href="{{ route('dashboard') }}">
      Choose Your Vote
    </a>
  </div>

  <!-- Candidates List -->
  <div class="max-w-4xl mx-auto space-y-4">
    @foreach ($topThree->concat($others) as $i => $candidate)
      <div class="flex items-center p-4 bg-white rounded-lg shadow hover:shadow-md transition
        @if ($i == 0) border-l-4 border-yellow-500
        @elseif ($i == 1) border-l-4 border-gray-400
        @elseif ($i == 2) border-l-4 border-orange-400
        @endif">

        <div class="text-3xl font-bold text-gray-700 w-12">{{ $i + 1 }}</div>
        <div class="ml-4 flex-1">
          <div class="text-lg font-semibold">{{ $candidate->name }}</div>
          <div class="text-sm text-gray-500">{{ $candidate->details ?? '—' }}</div>
        </div>
        <img src="{{ asset('storage/' .$candidate->image) }}" class="w-12 h-12 rounded-full ml-4" />
      </div>
    @endforeach
  </div>
</div>
