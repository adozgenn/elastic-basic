<?php

namespace App\Console\Commands;

use App\Models\Document;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToText\Pdf;

class BulkImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bulk:import {--type=}';

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
        $type = $this->option('type');
        if ($type){
            return $this->call('php artisan scout:flush "App\Models\Document"');
        }
        try {
            $attributes = [
                "path"=> Storage::path("test.pdf"),
                "title"=>"test.pdf",
            ];
            Document::query()->create($attributes);
            $this->output->writeln("başarılı");
        } catch (\Exception $exception){
            $this->output->writeln($exception->getMessage());
        }
    }
}
