<nav class="bg-gray-800 p-4">
  <div class="container mx-auto">
    <div class="flex justify-between items-center">
      <div class="text-white text-lg font-bold">{{ env('APP_NAME') }}</div>
      <ul class="flex space-x-4">
        <li><a href="/" class="text-gray-300 hover:text-white">Home</a></li>
        <li><a href="/famous-authors" class="text-gray-300 hover:text-white">Famous Author</a></li>
        <li><a href="/input-rating" class="text-gray-300 hover:text-white">Input Rating</a></li>
      </ul>
    </div>
  </div>
</nav>