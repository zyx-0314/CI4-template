<?php

namespace Config;

use CodeIgniter\Commands\Commands as BaseCommands;

class Commands extends BaseCommands
{
    /**
     * @var array<string, string>
     */
    protected $commands = [
        'health:check' => \App\Commands\HealthCheck::class,
    ];
}
