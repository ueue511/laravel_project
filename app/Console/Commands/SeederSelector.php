<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SeederSelector extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:seed-select';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Select seeder class to run';

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
     * @return mixed
     */
    public function handle()
    {
        $path = database_path('seeds/*.php');

        $files = collect(File::glob($path))->map(function ($path) {
            return str_replace('.php', '', basename($path));
        })->toArray();

        $seederName = $this->choice('Select seeder', $files);

        $this->call('db:seed', ['--class' => $seederName]);
        $this->info('Seeding ' . $seederName);
    }
}
