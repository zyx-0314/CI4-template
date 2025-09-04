<?php // components/footer.php ?>
<footer class="bg-white mt-12 border-t">
  <div class="mx-auto px-6 py-8 max-w-5xl text-gray-600 text-sm">
    <div class="flex md:flex-row flex-col md:justify-between md:items-start gap-6">
      <div>
  <img src="<?= esc(base_url('logo/main.svg')) ?>" alt="Sunset Funeral Homes" class="mb-2 h-11">
        <p>Compassionate care, every step of the way</p>
      </div>
      <div class="gap-6 grid grid-cols-1 sm:grid-cols-3">
        <div>
          <h4 class="mb-2 font-semibold">Services</h4>
          <ul>
            <li><a href="/services/traditional" class="hover:underline">Traditional Filipino</a></li>
            <li><a href="/services/cremation" class="hover:underline">Cremation</a></li>
            <li><a href="/services/green" class="hover:underline">Green burial</a></li>
          </ul>
        </div>
        <div>
          <h4 class="mb-2 font-semibold">Company</h4>
          <ul>
            <li><a href="/landing" class="hover:underline">Home</a></li>
            <li><a href="/mood-board" class="hover:underline">Mood board</a></li>
            <li><a href="/roadmap" class="hover:underline">Road map</a></li>
          </ul>
        </div>
        <div>
          <h4 class="mb-2 font-semibold">Contact</h4>
          <p>Phone: (555) 123-4567</p>
          <p>Email: info@sunsetfunerals.example</p>
        </div>
      </div>
    </div>
    <div class="mt-6 text-gray-500">© Sunset Funeral Homes — Sample site</div>
  </div>
</footer>
