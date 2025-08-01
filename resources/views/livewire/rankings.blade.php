<div>
  <!-- Stylish Heading -->
  <h1 class="text-5xl font-pacifico text-center text-pink-500 mb-10">
    Voting Results
  </h1>

  <!-- Top 3 Podium -->
  <div class="flex justify-center items-end gap-4 mb-10">
    <!-- 2nd place -->
    <div class="flex flex-col items-center mt-10">
      <img src="https://via.placeholder.com/100" class="w-24 h-24 rounded-full border-4 border-gray-400" />
      <span class="mt-2 font-semibold text-lg text-gray-600">2nd Place</span>
    </div>
    
    <!-- 1st place -->
    <div class="flex flex-col items-center">
      <img src="https://via.placeholder.com/150" class="w-36 h-36 rounded-full border-4 border-yellow-400" />
      <span class="mt-2 font-bold text-xl text-yellow-500">1st Place</span>
    </div>
    
    <!-- 3rd place -->
    <div class="flex flex-col items-center mt-14">
      <img src="https://via.placeholder.com/100" class="w-24 h-24 rounded-full border-4 border-orange-400" />
      <span class="mt-2 font-semibold text-lg text-orange-500">3rd Place</span>
    </div>
  </div>

  <!-- Choose Your Vote Button -->
  <div class="flex justify-center mb-10">
    <a class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg text-lg" href="{{ route('dashboard') }}">
      Choose Your Vote
    </a>
  </div>

  <!-- Candidates List -->
  <div class="max-w-4xl mx-auto space-y-4">
    <!-- Candidate Item -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow hover:shadow-md transition border-l-4 border-yellow-500">
      <div class="text-3xl font-bold text-yellow-500 w-12">1</div>
      <div class="ml-4 flex-1">
        <div class="text-lg font-semibold">Alice Johnson</div>
        <div class="text-sm text-gray-500">Top-voted candidate with inspiring speech.</div>
      </div>
      <img src="https://via.placeholder.com/50" class="w-12 h-12 rounded-full ml-4" />
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow hover:shadow-md transition border-l-4 border-gray-400">
      <div class="text-3xl font-bold text-gray-600 w-12">2</div>
      <div class="ml-4 flex-1">
        <div class="text-lg font-semibold">Brian Smith</div>
        <div class="text-sm text-gray-500">Runner-up with great ideas.</div>
      </div>
      <img src="https://via.placeholder.com/50" class="w-12 h-12 rounded-full ml-4" />
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow hover:shadow-md transition border-l-4 border-orange-400">
      <div class="text-3xl font-bold text-orange-500 w-12">3</div>
      <div class="ml-4 flex-1">
        <div class="text-lg font-semibold">Cathy Lee</div>
        <div class="text-sm text-gray-500">Strong contender with unique approach.</div>
      </div>
      <img src="https://via.placeholder.com/50" class="w-12 h-12 rounded-full ml-4" />
    </div>

    <!-- Other Candidates -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow hover:shadow-md transition">
      <div class="text-xl font-medium text-gray-700 w-12">4</div>
      <div class="ml-4 flex-1">
        <div class="text-base font-semibold">Daniel Reed</div>
        <div class="text-sm text-gray-500">Solid presence in the vote.</div>
      </div>
      <img src="https://via.placeholder.com/50" class="w-12 h-12 rounded-full ml-4" />
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow hover:shadow-md transition">
      <div class="text-xl font-medium text-gray-700 w-12">5</div>
      <div class="ml-4 flex-1">
        <div class="text-base font-semibold">Emma Davis</div>
        <div class="text-sm text-gray-500">Made an impact with creativity.</div>
      </div>
      <img src="https://via.placeholder.com/50" class="w-12 h-12 rounded-full ml-4" />
    </div>

    <!-- Add more candidates as needed -->
  </div>
</div>
