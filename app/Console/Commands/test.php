<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\SitemapHelper;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $eventRoute = [
            ["events/128", '0.64'],
        ];

        SitemapHelper::addNewRoute($eventRoute);
    }
}
