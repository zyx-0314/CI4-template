<?php

/**
 * Shared roadmap items partial
 * Renders prioritized features and a small per-feature pipeline.
 */

$roadmapItemsDone = [
    [
        'id' => 'accounts',
        'title' => 'Employee & Admin accounts (RBAC)',
        'desc' => "Create employee and admin accounts, role assignment, and admin ability to deactivate any account.",
        'status' => 'Done',
        'priority' => 'High',
    ],
];

$roadmapItems = [
    [
        'id' => 'services',
        'title' => 'Services CRUD',
        'desc' => 'Add, update, and deactivate service packages (pricing, description, tags).',
        'status' => 'In Progress',
        'priority' => 'High',
    ],
    [
        'id' => 'requests-anon',
        'title' => 'Client service request (no account)',
        'desc' => 'Allow anonymous users to request a service; capture contact details and preferences.',
        'status' => 'Planned',
        'priority' => 'High',
    ],
    [
        'id' => 'requests-auth',
        'title' => 'Client service request (with account)',
        'desc' => 'Authenticated requests with tracking/history for the client (requires accounts).',
        'status' => 'Planned',
        'priority' => 'High',
    ],
    [
        'id' => 'obituary',
        'title' => 'Obituary & Memorial pages',
        'desc' => 'Clients with accounts can create memorial pages, upload images and moderate guestbook entries.',
        'status' => 'Backlog',
        'priority' => 'Medium',
    ],
    [
        'id' => 'email-verification',
        'title' => 'Email verification',
        'desc' => 'Send verification emails on signup and allow re-sending; gate sensitive actions until verified.',
        'status' => 'Planned',
        'priority' => 'Medium',
    ],
    [
        'id' => 'account-update',
        'title' => 'Account information updates',
        'desc' => 'Allow users to update profile data, contact details and change password.',
        'status' => 'Planned',
        'priority' => 'Medium',
    ],
    [
        'id' => 'manager-assign',
        'title' => 'Assign manager to employee',
        'desc' => "UI + data relation: set an employee's manager (for approvals and notifications).",
        'status' => 'Backlog',
        'priority' => 'Low',
    ],
    [
        'id' => 'work-status',
        'title' => 'Update work status for employee',
        'desc' => 'Employees can update job status (on-duty, off-duty, on-call) and managers can view history.',
        'status' => 'Backlog',
        'priority' => 'Low',
    ],
    [
        'id' => 'leave-requests',
        'title' => 'Employee leave requests and approvals',
        'desc' => 'Request leave flow with manager approvals and admin oversight.',
        'status' => 'Backlog',
        'priority' => 'Low',
    ],
    [
        'id' => 'platform-infra',
        'title' => 'Platform: middleware, & image upload',
        'desc' => 'Shared infra pieces: authorization middleware, and secure image upload handling for obituaries and profiles.',
        'status' => 'Backlog',
        'priority' => 'High',
    ],
];

function renderBadge($status)
{
    if ($status === 'In Progress') return '<span class="bg-emerald-100 px-3 py-1 rounded text-emerald-700">In Progress</span>';
    if ($status === 'Planned') return '<span class="bg-blue-50 px-3 py-1 rounded text-blue-700">Planned</span>';
    if ($status === 'Backlog') return '<span class="bg-gray-50 px-3 py-1 rounded text-gray-700">Backlog</span>';
    if ($status === 'Done') return '<span class="bg-emerald-600 px-3 py-1 rounded text-white">Done</span>';
    return '<span class="bg-gray-50 px-3 py-1 rounded text-gray-700">' . htmlspecialchars($status) . '</span>';
}

?>

<div class="space-y-4">
    <?php foreach ($roadmapItems as $it): ?>
        <article id="item-<?php echo esc($it['id']); ?>" data-status="<?php echo esc($it['status']); ?>" class="bg-white shadow p-4 rounded-lg">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h3 class="font-semibold text-lg"><?php echo esc($it['title']); ?></h3>
                    <p class="mt-1 text-gray-600 text-sm"><?php echo esc($it['desc']); ?></p>

                    <div class="mt-3 text-gray-700 text-xs">
                        <strong>Priority:</strong> <?php echo esc($it['priority']); ?>
                    </div>

                    <details class="mt-3 text-sm">
                        <summary class="text-gray-600 text-sm cursor-pointer">Implementation pipeline</summary>
                        <ol class="mt-2 ml-5 text-gray-700 list-decimal">
                            <li>Database migration (tables, columns, indexes)</li>
                            <li>Seeder(s) for dev/test data</li>
                            <li>Update Documentation for Database Commands</li>
                            <li>Controller endpoints (API + web) and routes</li>
                            <li>Views (frontend) and small UI components</li>
                            <li>Update Documentation for Mobile, Tablet and PC Screen Testing</li>
                            <li>Model / Entity and Repository</li>
                            <li>Service layer (business rules) + validation</li>
                            <li>Update Documentation for Functionality Testing</li>
                        </ol>
                    </details>
                </div>

                <div class="ml-4 text-right">
                    <?php echo renderBadge($it['status']); ?>
                </div>
            </div>
        </article>
    <?php endforeach; ?>

    <br>
    <hr>
    <br>
    <h2>Completed</h2>

    <?php foreach ($roadmapItemsDone as $it): ?>
        <article id="item-<?php echo esc($it['id']); ?>" data-status="<?php echo esc($it['status']); ?>" class="bg-white shadow p-4 rounded-lg">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h3 class="font-semibold text-lg"><?php echo esc($it['title']); ?></h3>
                    <p class="mt-1 text-gray-600 text-sm"><?php echo esc($it['desc']); ?></p>

                    <div class="mt-3 text-gray-700 text-xs">
                        <strong>Priority:</strong> <?php echo esc($it['priority']); ?>
                    </div>

                    <details class="mt-3 text-sm">
                        <summary class="text-gray-600 text-sm cursor-pointer">Implementation pipeline</summary>
                        <ol class="mt-2 ml-5 text-gray-700 list-decimal">
                            <li>Database migration (tables, columns, indexes)</li>
                            <li>Seeder(s) for dev/test data</li>
                            <li>Update Documentation for Database Commands</li>
                            <li>Controller endpoints (API + web) and routes</li>
                            <li>Views (frontend) and small UI components</li>
                            <li>Update Documentation for Mobile, Tablet and PC Screen Testing</li>
                            <li>Model / Entity and Repository</li>
                            <li>Service layer (business rules) + validation</li>
                            <li>Update Documentation for Functionality Testing</li>
                        </ol>
                    </details>
                </div>

                <div class="ml-4 text-right">
                    <?php echo renderBadge($it['status']); ?>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
</div>