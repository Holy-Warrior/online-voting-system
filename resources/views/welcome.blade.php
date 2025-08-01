<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Voting Results</title>
  @livewireStyles()
  @livewireScripts()
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <style>
    .font-pacifico {
      font-family: 'Pacifico', cursive;
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800 p-6">
    @livewire('rankings')

</body>
</html>