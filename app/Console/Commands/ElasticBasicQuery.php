<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ElasticBasicQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:basic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elasticsearch basic query';

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
        dd("basic");
    }
}
