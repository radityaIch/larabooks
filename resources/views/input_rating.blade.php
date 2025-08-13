<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Larabooks - Input Rating</title>
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
    <h1 class="text-4xl font-bold py-6">Input Rating</h1>
  </header>

  <main>
    <section class="w-full flex justify-center">
      <form class="flex flex-col gap-4" action={{ route('input_rating.store') }} method="POST">
        @csrf
        <div class="flex flex-col">
          <label for="author">Author:</label>
          <select name="author_id" id="author" class="border p-2" onchange="chooseAuthor()">
            <option value="">Select an Author</option>
            @foreach ($authors as $author)
            <option value="{{ $author->id }}">{{ $author->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="flex flex-col">
          <label for="book">Book Name:</label>
          <select name="book_id" id="book" class="border p-2">
            <option value="">Select Author First Please</option>
          </select>
        </div>

        <div class="flex flex-col">
          <label for="rating">Rating:</label>
          <select name="score" id="rating" class="border p-2">
            @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }}</option>
              @endfor
          </select>
        </div>

        <button type="submit" class="border p-2 bg-blue-500 text-white hover:bg-blue-600">Submit</button>
      </form>
    </section>
  </main>

  <footer class="text-center py-6">
    <p class="text-gray-600">© {{ date('Y') }} Larabooks. All rights reserved.</p>
  </footer>

  <script>
    const authors = @json($authors);

    function chooseAuthor() {
      const authorSelect = document.getElementById('author');
      const selectedAuthorId = authorSelect.value;

      const books = authors.find(author => author.id == selectedAuthorId)?.books || [];
      const bookSelect = document.getElementById('book');
      bookSelect.innerHTML = '<option value="">Select a Book</option>'; // Reset options
      books.forEach(book => {
        const option = document.createElement('option');
        option.value = book.id;
        option.textContent = book.title;
        bookSelect.appendChild(option);
      });
    }

  </script>
</body>

</html>
