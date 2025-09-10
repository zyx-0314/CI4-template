<article class="flex flex-col bg-white shadow-sm rounded-lg overflow-hidden hover:scale-105 hover:shadow-lg transition hover:-translate-y-[2px] duration-200 card <?php echo $s['is_available'] ? "" : "grayscale brightness-90 contrast-90 opacity-50" ?>" data-id="<?= esc($s['id'] ?? '') ?>" data-category="<?= esc($s['category'] ?? '') ?>" data-cost="<?= esc($s['cost'] ?? '') ?>" data-created="<?= esc($s['created_at'] ?? '') ?>">
    <?php
    echo $s['is_available'] ? '<a href="' . $s['id'] . '" class="duration-200 transform">' : "<div class='cursor-not-allowed'>";
    ?>
    <?php if (!empty($s['image'])): ?>
        <img class="w-full h-44 object-cover" src="<?= esc($s['image']) ?>" alt="<?= esc($s['title'] ?? 'Service image') ?>">
    <?php else: ?>
        <div class="flex justify-center items-center bg-slate-100 w-full h-44">
            <img src="https://hds.hel.fi/images/foundation/visual-assets/placeholders/image-l@3x.png" alt="no image">
        </div>
    <?php endif; ?>
    <div class="flex flex-col flex-1 p-4">
        <h3 class="mb-1 font-medium text-slate-900 text-lg"><?= esc($s['title'] ?? 'Untitled') ?><?php echo $s['is_available'] ? " " : " (inactive)" ?></h3>
        <p class="flex-1 text-slate-700 text-sm"><?= esc(substr($s['description'] ?? '', 0, 160)) ?><?= strlen($s['description'] ?? '') > 160 ? '…' : '' ?></p>
        <div class="flex justify-between items-center mt-4">
            <div class="inline-flex items-center bg-indigo-50 px-3 py-1 rounded-full font-medium text-indigo-700 text-sm">$<?= number_format((float)($s['cost'] ?? 0), 2) ?></div>
        </div>
    </div>
    <?php
    echo $s['is_available'] ? '</a>' : "</div>";
    ?>
</article>