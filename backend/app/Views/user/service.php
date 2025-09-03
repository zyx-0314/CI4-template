<!doctype html>
<html lang="en">
<?= view('components/head', ['title' => 'Services — Sunset Funeral Homes']) ?>
<body class="bg-gray-50 text-gray-900">
  <?php echo view('components/header'); ?>
  <div class="mx-auto px-6 py-12 max-w-5xl">
    <header class="mb-6">
      <h1 class="font-bold text-2xl">Services</h1>
      <p class="text-gray-600">Choose a service style to see sample design and options.</p>
    </header>

    <?php $style = $style ?? null; ?>

    <?php if (empty($style)): ?>
      <div class="gap-4 grid grid-cols-1 md:grid-cols-3">
        <a href="/services/traditional" class="block bg-white shadow hover:shadow-md p-6 rounded-lg">
          <h3 class="font-semibold">Traditional Filipino style</h3>
          <p class="text-gray-600 text-sm">Faith-based rituals, family-led wakes with community support.</p>
        </a>
        <a href="/services/cremation" class="block bg-white shadow hover:shadow-md p-6 rounded-lg">
          <h3 class="font-semibold">Cremation</h3>
          <p class="text-gray-600 text-sm">Affordable, flexible memorial options with cremation care.</p>
        </a>
        <a href="/services/green" class="block bg-white shadow hover:shadow-md p-6 rounded-lg">
          <h3 class="font-semibold">Green burial</h3>
          <p class="text-gray-600 text-sm">Environmentally friendly, natural burial practices.</p>
        </a>
      </div>
    <?php else: ?>
      <?php $s = strtolower($style); ?>
      <div class="bg-white shadow p-6 rounded-lg">
        <h2 class="mb-2 font-semibold text-xl"><?php echo ucfirst($s); ?> style</h2>
        <?php if ($s === 'traditional' || $s === 'traditional-filipino'): ?>
          <p class="text-gray-700">Traditional Filipino style: family-centered wakes, open-casket viewing, community rituals, and faith-based ceremonies. Design cues: warm neutrals, respectful typography, and photography that centers family and ritual.</p>
          <div class="mt-4">
            <h4 class="font-medium">Sample layout</h4>
            <div class="gap-4 grid grid-cols-1 md:grid-cols-2 mt-2">
              <div class="bg-gray-100 p-4 rounded">Hero with large family photo and simple headline.</div>
              <div class="bg-gray-100 p-4 rounded">Service details, schedule, and contact CTA.</div>
            </div>
          </div>
        <?php elseif ($s === 'cremation'): ?>
          <p class="text-gray-700">Cremation: streamlined services, flexible memorial choices, and clear pricing. Design cues: calm blues and indigos, clean layouts, compact forms for arranging services.</p>
        <?php elseif ($s === 'green'): ?>
          <p class="text-gray-700">Green burial: natural materials, minimalistic signage, and ecological information for families. Design cues: soft gold accent, earth tones, and simple educational content.</p>
        <?php else: ?>
          <p class="text-gray-700">We don't have details for this style yet. Please choose one of the available service styles.</p>
        <?php endif; ?>

        <div class="mt-6">
          <a href="/services" class="inline-block px-4 py-2 border rounded text-sm">Back to services</a>
          <a href="/" class="inline-block bg-indigo-600 ml-2 px-4 py-2 rounded text-white text-sm">Back to home</a>
        </div>
      </div>
    <?php endif; ?>

    <?php echo view('components/footer'); ?>
  </div>
</body>
</html>
