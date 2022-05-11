<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FreshDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all tenants DBs and create fresh central DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (DB::select('SHOW DATABASES LIKE "tenant%"') as $db) {
            $db = array_values((array) $db)[0];
            DB::select("DROP DATABASE `$db`");
        }
        $this->call('migrate:fresh', ['--force' => true, '--seed' => true]);
    }
}
