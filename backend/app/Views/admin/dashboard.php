<?= view('components/head', ['title' => 'Admin Dashboard']) ?>
<?= view('components/header') ?>

<main class="mx-auto px-6 py-10 max-w-6xl">
  <h2 class="mb-6 font-semibold text-2xl">Admin Dashboard</h2>

  <div class="gap-6 grid grid-cols-1 md:grid-cols-2">
    <!-- DB health card -->
    <div class="col-span-1">
      <?= view('components/card/db_card', ['title' => 'Database tables', 'dbGroup' => 'default']) ?>
    </div>

    <!-- Placeholder: future cards (cache, queue, jobs) -->
    <div class="col-span-1">
      <div class="bg-white shadow-lg p-6 rounded-lg">
        <h3 class="font-semibold text-lg">Other systems</h3>
        <p class="mt-2 text-gray-600 text-sm">Add cards for cache, queues, external APIs, or scheduled jobs here.</p>
      </div>
    </div>
  </div>

  <section class="mt-8">
    <h3 class="mb-3 font-semibold text-xl">Dashboard format proposal</h3>
    <ol class="pl-6 text-gray-700 text-sm list-decimal">
      <li>Top row: high-level status cards (DB, Cache, Queue, Storage) — visual cards with counts and statuses.</li>
      <li>Second row: trend charts (requests, errors) and recent logs.</li>
      <li>Controls: quick links for maintenance tasks (run migration, clear cache) — protected by admin auth.</li>
      <li>Config: a lightweight page to view current environment and connection strings (read-only in UI).</li>
    </ol>
  </section>
</main>

<?= view('components/footer') ?>
