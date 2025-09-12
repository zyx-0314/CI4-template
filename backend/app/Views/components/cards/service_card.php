<?php
if (is_array($s)) {
    $svc = $s;
} elseif (is_object($s)) {
    $svc = [];
    $fields = ['id', 'title', 'description', 'cost', 'category', 'created_at', 'is_available', 'image', 'banner_image'];
    foreach ($fields as $f) {
        if (isset($s->{$f})) {
            $svc[$f] = $s->{$f};
            continue;
        }
        $method = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', $f)));
        if (method_exists($s, $method)) {
            $svc[$f] = $s->{$method}();
            continue;
        }
        if (method_exists($s, '__get')) {
            try {
                $svc[$f] = $s->{$f};
                continue;
            } catch (Throwable $e) {
                $svc[$f] = null;
            }
        }
        $svc[$f] = null;
    }
} else {
    $svc = [];
}

?>
<article class="flex flex-col h-full bg-white shadow-sm rounded-lg overflow-hidden hover:scale-105 hover:shadow-lg transition hover:-translate-y-[2px] duration-200 card <?php echo !empty($svc['is_available']) ? "" : "grayscale brightness-90 contrast-90 opacity-50" ?>" data-id="<?= esc($svc['id'] ?? '') ?>" data-category="<?= esc($svc['category'] ?? '') ?>" data-cost="<?= esc($svc['cost'] ?? '') ?>" data-created="<?= esc($svc['created_at'] ?? '') ?>">
    <?php
    echo !empty($svc['is_available']) ? '<a href="services/' . ($svc['id'] ?? '') . '" class="duration-200 transform">' : "<div class='cursor-not-allowed'>";
    ?>
    <?php if (!empty($svc['image'])): ?>
        <img class="w-full h-44 object-cover" src="<?= esc($svc['image']) ?>" alt="<?= esc($svc['title'] ?? 'Service image') ?>">
    <?php else: ?>
        <div class="flex justify-center items-center bg-slate-100 w-full h-44">
            <img src="<?= esc(!empty($svc['banner_image']) ? "/" . $svc['banner_image'] : 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80') ?>" alt="<?= esc($svc['title'] ?? 'no image') ?>">
        </div>
    <?php endif; ?>
    <div class="flex flex-col flex-1 mt-8 p-4">
        <h3 class="mb-1 min-h-[4rem] overflow-hidden font-medium text-slate-900 text-lg line-clamp-2" style="display:-webkit-box;">
            <?= esc($svc['title'] ?? 'Untitled') ?><?php echo !empty($svc['is_available']) ? " " : " (inactive)" ?>
        </h3>
        <p class="flex-1 min-h-[3rem] overflow-hidden text-slate-700 text-sm line-clamp-2">
            <?= esc(substr($svc['description'] ?? '', 0, 240)) ?><?= strlen($svc['description'] ?? '') > 240 ? '…' : '' ?>
        </p>
        <div class="flex justify-between items-center mt-4">
            <div class="inline-flex items-center bg-indigo-50 px-3 py-1 rounded-full font-medium text-indigo-700 text-sm">$<?= number_format((float)($svc['cost'] ?? 0), 2) ?></div>
        </div>
    </div>
    <?php
    echo !empty($svc['is_available']) ? '</a>' : "</div>";
    ?>
</article>