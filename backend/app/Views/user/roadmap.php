<!doctype html>
<html lang="en">
<?= view('components/head', ['title' => 'Road map — Sunset Funeral Homes']) ?>

<body class="bg-gray-50 text-gray-900">
  <?= view('components/header'); ?>
  <div class="mx-auto px-6 py-12 max-w-5xl">
    <header class="mb-6">
      <h1 class="font-bold text-2xl">Road map</h1>
      <p class="text-gray-600">High-level plan and status for upcoming features.</p>
    </header>

    <div class="flex justify-between items-center mb-4">
      <div class="flex items-center space-x-3">
        <label class="text-gray-600 text-sm">Filter:</label>
        <select id="statusFilter" class="border-gray-300 rounded text-sm">
          <option value="all">All</option>
          <option value="Backlog">Backlog</option>
          <option value="Planned">Planned</option>
          <option value="In Progress">In Progress</option>
          <option value="Done">Done</option>
        </select>
      </div>
      <div class="text-gray-500 text-sm">This is a UI-only roadmap for planning.</div>
    </div>

    <section id="roadmapList" class="space-y-4">
      <?= view('staticData/roadmap') ?>
    </section>

  </div>
  <?= view('components/footer'); ?>

  <script>
    document.getElementById('statusFilter').addEventListener('change', function(e) {
      const v = e.target.value;
      document.querySelectorAll('#roadmapList article').forEach(function(el) {
        if (v === 'all' || el.dataset.status === v) el.style.display = '';
        else el.style.display = 'none';
      });
    });
  </script>
</body>

</html>