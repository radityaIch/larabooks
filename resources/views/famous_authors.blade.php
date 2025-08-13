<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Larabooks - Top 10 Famous Author</title>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

  <!-- Styles / Scripts -->
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
</head>
<body>
  @include('partials.menu')
  <header class="text-center">
    <h1 class="text-4xl font-bold py-6">Top 10 Famous Author</h1>
  </header>

  <main>
    <section class="flex w-full justify-center">
      <table class="min-w-[60%] border-collapse border border-gray-200">
        <thead>
          <tr>
            <th class="border border-gray-300 px-4 py-2">Rank</th>
            <th class="border border-gray-300 px-4 py-2">Author</th>
            <th class="border border-gray-300 px-4 py-2">Voters</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($authors as $author)
          <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $author->name }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $author->voter_count }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </section>
  </main>

  <footer class="text-center py-6">
    <p class="text-gray-600">© {{ date('Y') }} Larabooks. All rights reserved.</p>
  </footer>
</body>
</html>
