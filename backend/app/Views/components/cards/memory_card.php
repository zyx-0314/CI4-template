<figure class="bg-gray-50 border rounded overflow-hidden">
    <div class="bg-gray-100 h-28 overflow-hidden">
        <img src="<?= esc($memories['img'] ?? '') ?>" alt="<?= esc($memories['title'] ?? 'Memory') ?>" class="w-full h-full object-cover">
    </div>
    <figcaption class="p-2 text-gray-700 text-xs">
        <div class="font-medium text-sm"><?= esc($memories['title'] ?? '') ?></div>
        <div class="text-gray-500 text-xs"><?= esc($memories['descriptions'] ?? '') ?></div>
    </figcaption>
</figure>