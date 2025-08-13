<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Larabooks Welcome</title>
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
    <h1 class="text-4xl font-bold py-6">Welcome to Larabooks</h1>
  </header>
  <main>
    <section class="w-full flex justify-center">
      <form class="flex flex-col gap-4" action="?search={{ request('search') }}&show={{ request('show') }}" method="GET">
        <div class="flex flex-col">
          <label for="show">Show:</label>
          <select name="show" id="show" class="border p-2">
            @for ($show = 10; $show <= 100; $show+=10) <option value="{{ $show }}" {{ request('show') == $show ? 'selected' : '' }}>
              {{ $show }}
              </option>
              @endfor
          </select>
        </div>
        <div class="flex flex-col">
          <label for="show">Search:</label>
          <input type="text" name="search" class="border p-2" placeholder="Search for books..." value="{{ request('search') }}">
        </div>
        <button type="submit" class="border p-2">Submit</button>
      </form>
    </section>

    <section>
      <div class="flex flex-col items-center mt-10">
        @if(request('search'))
        <h2 class="text-2xl mb-4">Search Results for "{{ request('search') }}"</h2>
        @endif

				<h2 class="text-2xl mb-4">Showing top {{ request('show') ?? '10'}} books</h2>

        <table class="w-full max-w-4xl mx-auto border-collapse">
          <thead>
            <tr>
              <th class="border p-2">#NO</th>
              <th class="border p-2">ID</th>
              <th class="border p-2">Book Name</th>
              <th class="border p-2">Category</th>
              <th class="border p-2">Author</th>
              <th class="border p-2">Average Rating</th>
              <th class="border p-2">Voter</th>
            </tr>
          </thead>
          <tbody>
            @foreach($books as $book)
            <tr>
							<td class="border p-2">{{ $loop->iteration }}</td>
							<td class="border p-2">{{ $book->id }}</td>
							<td class="border p-2">{{ $book->title }}</td>
							<td class="border p-2">{{ $book->category->name }}</td>
							<td class="border p-2">{{ $book->author->name }}</td>
							<td class="border p-2">{{ $book->average_rating }}</td>
							<td class="border p-2">{{ $book->voter_count }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <footer class="text-center">
    <p>&copy; {{ date('Y') }} Larabooks. All rights reserved.</p>
  </footer>
</body>
</html>
