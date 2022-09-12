<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class allClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'allClear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All cache cleared';

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
        Artisan::call("config:cache");
        Artisan::call("config:clear");
        Artisan::call("cache:clear");
        Artisan::call("route:clear");
        Artisan::call("view:clear");
        Artisan::call("view:cache");
        Artisan::call("optimize:clear");
        $this->info("All cache cleared");
    }
}