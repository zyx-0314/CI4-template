<?php // Header component (compatible name): components/header.php
?>
<header class="bg-white shadow">
  <div class="flex justify-between items-center mx-auto px-6 py-6 max-w-5xl">
    <div class="flex items-center space-x-3">
      <div class="flex justify-center items-center bg-gray-700 rounded-full w-10 h-10 font-bold text-white">SF</div>
      <div>
        <h1 class="font-semibold text-xl">Sunset Funeral Homes</h1>
        <p class="text-gray-500 text-sm">Compassionate care, every step of the way</p>
      </div>
    </div>
    <nav class="flex items-center space-x-4 text-sm">
      <a href="/" class="text-gray-700">Home</a>
      <a href="/mood-board" class="text-gray-700">Mood board</a>
      <a href="/roadmap" class="text-gray-700">Road map</a>
      <div class="group inline-block relative">
        <button class="focus:outline-none text-gray-700">Services ▾</button>
        <div class="hidden group-hover:block right-0 absolute bg-white shadow-lg mt-2 border rounded w-48" style="z-index:50;" aria-hidden="true">
          <a class="block hover:bg-gray-100 px-4 py-2 text-gray-700" href="/services/traditional">Traditional Filipino</a>
          <a class="block hover:bg-gray-100 px-4 py-2 text-gray-700" href="/services/cremation">Cremation</a>
          <a class="block hover:bg-gray-100 px-4 py-2 text-gray-700" href="/services/green">Green burial</a>
        </div>
      </div>
    </nav>
  </div>
</header>
