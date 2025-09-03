<!doctype html>
<html lang="en">
<?= view('components/head', [ 'title' => 'Mood board — Sunset Funeral Homes' ]) ?>
<body class="bg-gray-50 text-gray-900">
  <?php echo view('components/header'); ?>
  <div class="mx-auto px-6 py-12 max-w-5xl">
    <header class="mb-8">
      <h1 class="font-bold text-2xl">Mood board</h1>
      <p class="text-gray-600">Visual identity samples for Sunset Funeral Homes (funeral services)</p>
    </header>

    <section class="mb-8">
      <h2 class="mb-4 font-semibold text-lg">Color system</h2>
      <p class="mb-4 text-gray-600 text-sm">Three main colors with three vibrance levels (dark → light).</p>
      <div class="gap-4 grid grid-cols-3">
        <!-- Sage Green (Accent) -->
        <div>
          <div class="swatch" style="background:var(--sage-dark)"></div>
          <div class="mt-2 swatch" style="background:var(--sage)"></div>
          <div class="mt-2 swatch" style="background:var(--sage-light)"></div>
          <p class="mt-2 font-medium">Sage Green (Main accent)</p>
          <p class="text-gray-500 text-sm">#6F8E78, #8DAA91, #CFE6D7</p>
        </div>

        <!-- Muted Rose -->
        <div>
          <div class="swatch" style="background:var(--rose-dark)"></div>
          <div class="mt-2 swatch" style="background:var(--rose)"></div>
          <div class="mt-2 swatch" style="background:var(--rose-light)"></div>
          <p class="mt-2 font-medium">Muted Rose (Subtle warmth)</p>
          <p class="text-gray-500 text-sm">#A87D79, #C7A6A0, #EDD9D6</p>
        </div>

        <!-- Cool Stone Gray -->
        <div>
          <div class="swatch" style="background:var(--stone-dark)"></div>
          <div class="mt-2 swatch" style="background:var(--stone)"></div>
          <div class="mt-2 swatch" style="background:var(--stone-light)"></div>
          <p class="mt-2 font-medium">Cool Stone Gray (Secondary background)</p>
          <p class="text-gray-500 text-sm">#B1B1B1, #E2E2E2, #F7F7F7</p>
        </div>
      </div>
    </section>

    <section class="mb-8">
      <h2 class="mb-4 font-semibold text-lg">Typography</h2>
      <div class="gap-6 grid grid-cols-2">
        <div>
          <p class="text-gray-500 text-sm">Heading font</p>
          <p class="font-sample font-semibold">Playfair Display — Heading example</p>
        </div>
        <div>
          <p class="text-gray-500 text-sm">Body font</p>
          <p class="font-sample">Lato — Body text example that demonstrates readable copy for longer paragraphs.</p>
        </div>
      </div>
    </section>

    <section class="mb-8">
      <h2 class="mb-4 font-semibold text-lg">Buttons</h2>
      <div class="space-y-4">
        <div class="flex items-center space-x-4">
          <button class="bg-indigo-600 px-4 py-2 rounded text-white">Primary</button>
          <button class="bg-gray-600 px-4 py-2 rounded text-white">Secondary</button>
          <button class="px-4 py-2 border border-gray-400 rounded text-gray-800">Border</button>
          <button class="bg-gray-200 px-4 py-2 rounded text-gray-400 cursor-not-allowed" disabled>Disabled</button>
        </div>
        <p class="text-gray-500 text-sm">Primary for main CTAs, secondary for supportive actions, border for subtle actions, disabled for unavailable states.</p>
      </div>
    </section>

    <section class="mb-8">
      <h2 class="mb-4 font-semibold text-lg">Card sample</h2>
      <div class="gap-4 grid grid-cols-1 md:grid-cols-3">
        <div class="bg-white shadow p-4 rounded-lg">
          <h3 class="font-semibold">Memorial Planning</h3>
          <p class="text-gray-600 text-sm">Guidance and options to plan a respectful service.</p>
        </div>
        <div class="bg-white shadow p-4 rounded-lg">
          <h3 class="font-semibold">Transportation</h3>
          <p class="text-gray-600 text-sm">Professional and dignified transport services.</p>
        </div>
        <div class="bg-white shadow p-4 rounded-lg">
          <h3 class="font-semibold">Grief Support</h3>
          <p class="text-gray-600 text-sm">Resources and community support for families.</p>
        </div>
      </div>
    </section>

    <section class="mb-8">
      <h2 class="mb-4 font-semibold text-lg">Logos</h2>
      <div class="items-center gap-6 grid grid-cols-2">
        <div class="bg-white shadow p-4 rounded text-center">
          <div class="mx-auto mb-3" style="width:96px;height:96px;display:flex;align-items:center;justify-content:center;background:#312e81;color:white;border-radius:48px;font-weight:700">SF</div>
          <p class="font-medium">Minimal logo</p>
        </div>
        <div class="bg-gray-900 shadow p-4 rounded text-white text-center">
          <div class="mx-auto mb-3" style="width:220px;padding:12px;background:transparent;border-radius:6px">
            <div style="font-weight:700;font-size:18px">Sunset Funeral Homes</div>
            <div style="font-size:12px;opacity:0.8">Compassionate care, every step</div>
          </div>
          <p class="font-medium">Full logo (dark bg)</p>
        </div>
      </div>

      <div class="items-center gap-6 grid grid-cols-2 mt-4">
        <div class="bg-white shadow p-4 rounded text-center">
          <div class="mx-auto mb-3" style="width:220px;padding:12px;background:transparent;border-radius:6px">
            <div style="font-weight:700;font-size:18px;color:#1f2937">Sunset Funeral Homes</div>
            <div style="font-size:12px;opacity:0.8;color:#4b5563">Compassionate care, every step</div>
          </div>
          <p class="font-medium">Full logo (light bg)</p>
        </div>
        <div class="bg-gray-800 shadow p-4 rounded text-white text-center">
          <p class="text-gray-300 text-sm">Logo variants shown in light and dark contexts to ensure accessibility and contrast.</p>
        </div>
      </div>
    </section>

  </div>
  <?php echo view('components/footer'); ?>
</body>
</html>
