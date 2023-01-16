<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearRolesCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear_roles_cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear roles and permission cache';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $this->info('done.');
        return 0;
    }
}
