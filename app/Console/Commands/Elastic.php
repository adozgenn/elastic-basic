<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Elastic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic';

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
        $fp = fopen(resource_path('locations.csv'), 'r+');

        $locations = ['body' => []];
        $i = 1;
        while (($location = fgetcsv($fp)) !== FALSE) {

            $locations['body'][] = [
                'index' => [
                    '_index' => 'locations',
                    '_id' => (int)$location[0],
                ]
            ];

            $locations['body'][] = [
                'title' => $location[1],
                'type' => $location[2],
                'level' => $location[3],
                'is_in' => $location[4],
                'parent_name' => $location[5],
                'parent_level' => $location[6],
                'source' => 'service',
            ];
            $i += 1;
        }
        fclose($fp);

        $this->output->writeln("test başarılı");
    }
}
