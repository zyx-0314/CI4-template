<div class="bg-white p-4 border border-gray-100 rounded w-full">
    <div class="flex items-start gap-3 w-max">
        <div class="mt-1 text-gray-400">
            <!-- subtle icon -->
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2v6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M7 12h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M10 16h4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <div>
            <h4 class="font-medium text-sm"><?= $event['label'] ?></h4>
            <p class="text-gray-500 text-xs"><?= !empty($obituary[$event['date_time']]) ? date('F j, Y, g:i A', strtotime($obituary[$event['date_time']])) : 'TBA' ?></p>
            <p class="mt-1 text-gray-700 text-sm"><?= esc($obituary[$event['place']] ?? 'No location provided') ?></p>
        </div>
    </div>
</div>