<?php
// Component: components/cards/service_card.php
// Data contract:
// $service: object
?>
<article class="flex flex-col h-full bg-white shadow-sm rounded-lg overflow-hidden hover:scale-105 hover:shadow-lg transition hover:-translate-y-[2px] duration-200 card <?= $service->is_available ? "" : "grayscale brightness-90 contrast-90 opacity-50" ?>" data-id="<?= $service->id ?? '' ?>" data-category="<?= $service->category ?? '' ?>" data-cost="<?= $service->cost ?? '' ?>" data-created="<?= $service->created_at ?? '' ?>">
    <?= $service->is_available ? '<a href="services/' . ($service->id ?? '') . '" class="duration-200 transform">' : "<div class='cursor-not-allowed'>";
    ?>
    <?php if ($service->image): ?>
        <img class="w-full h-44 object-cover" src="<?= $service->image ?>" alt="<?= $service->title ?? 'Service image' ?>">
    <?php else: ?>
        <div class="flex justify-center items-center bg-slate-100 w-full h-44">
            <img src="<?= $service->banner_image ? "/" . $service->banner_image : 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80' ?>" alt="<?= $service->title ?? 'no image' ?>">
        </div>
    <?php endif; ?>
    <div class="flex flex-col flex-1 mt-8 py-4">
        <h3 class="bg-white mb-1 px-4 pt-4 min-h-[4rem] overflow-hidden font-medium text-slate-900 text-lg line-clamp-2" style="display:-webkit-box;">
            <?= $service->title ?? 'Untitled' ?><?= $service->is_available ? " " : " (inactive)" ?>
        </h3>
        <p class="flex-1 px-4 min-h-[3rem] overflow-hidden text-slate-700 text-sm line-clamp-2">
            <?= $service->description ?? '', 0, 240 ?><?= $service->description ?? '' > 240 ? '…' : '' ?>
        </p>
        <div class="flex justify-between items-center mt-4 px-4">
            <div class="inline-flex items-center bg-indigo-50 px-3 py-1 rounded-full font-medium text-indigo-700 text-sm">$<?= number_format((float)($service->cost ?? 0), 2) ?></div>
        </div>
    </div>
    <?= $service->is_available ? '</a>' : "</div>"; ?>
</article>