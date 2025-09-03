<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Mood board — Sunset Funeral Homes</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    /* small utility to show color variants */
    .swatch { height: 96px; border-radius: 8px }
    .font-sample { font-size: 1.125rem }
  </style>
</head>
<body class="bg-gray-50 text-gray-900">
  <div class="mx-auto px-6 py-12 max-w-5xl">
    <header class="mb-8">
      <h1 class="font-bold text-2xl">Mood board</h1>
      <p class="text-gray-600">Visual identity samples for Sunset Funeral Homes (funeral services)</p>
    </header>

    <section class="mb-8">
      <h2 class="mb-4 font-semibold text-lg">Color system</h2>
      <p class="mb-4 text-gray-600 text-sm">Three main colors with three vibrance levels (dark → light).</p>
      <div class="gap-4 grid grid-cols-3">
        <!-- Primary: Deep Indigo -->
        <div>
          <div class="bg-indigo-900 swatch"></div>
          <div class="bg-indigo-700 mt-2 swatch"></div>
          <div class="bg-indigo-300 mt-2 swatch"></div>
          <p class="mt-2 font-medium">Indigo (Primary)</p>
          <p class="text-gray-500 text-sm">#312e81, #4c51bf, #c3dafe</p>
        </div>

        <!-- Accent: Warm Gray -->
        <div>
          <div class="bg-gray-800 swatch"></div>
          <div class="bg-gray-600 mt-2 swatch"></div>
          <div class="bg-gray-200 mt-2 swatch"></div>
          <p class="mt-2 font-medium">Warm Gray (Accent)</p>
          <p class="text-gray-500 text-sm">#1f2937, #4b5563, #e5e7eb</p>
        </div>

        <!-- Support: Soft Gold -->
        <div>
          <div class="swatch" style="background:#8b6b2a"></div>
          <div class="mt-2 swatch" style="background:#b0843c"></div>
          <div class="mt-2 swatch" style="background:#f3e8c3"></div>
          <p class="mt-2 font-medium">Soft Gold (Support)</p>
          <p class="text-gray-500 text-sm">#8b6b2a, #b0843c, #f3e8c3</p>
        </div>
      </div>
    </section>

    <section class="mb-8">
      <h2 class="mb-4 font-semibold text-lg">Typography</h2>
      <div class="gap-6 grid grid-cols-2">
        <div>
          <p class="text-gray-500 text-sm">Heading font</p>
          <p class="font-sample font-semibold" style="font-family: 'Merriweather', serif;">Merriweather — Heading example</p>
        </div>
        <div>
          <p class="text-gray-500 text-sm">Body font</p>
          <p class="font-sample" style="font-family: 'Inter', sans-serif;">Inter — Body text example that demonstrates readable copy for longer paragraphs.</p>
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

    <footer class="mt-12 text-gray-500 text-sm">© Sunset Funeral Homes — Brand mood board (sample)</footer>
  </div>
</body>
</html>
