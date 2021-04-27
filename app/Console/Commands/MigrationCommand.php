<?php

namespace App\Console\Commands;

use App\Console\MigrationLibrary;
use Illuminate\Console\Command;

class MigrationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:columns';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add missing columns to the system';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $migrationLibrary;

    public function __construct(MigrationLibrary $migrationLibrary)
    {
        parent::__construct();

        $this->migrationLibrary = $migrationLibrary;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->migrationLibrary->run();
    }
}
