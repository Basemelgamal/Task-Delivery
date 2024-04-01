<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup-project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Installing Composer dependencies...');
        exec('composer install');

        // Migrate the database
        $this->info('Migrating database...');
        $this->call('migrate');

        // Seed the database
        $this->info('Seeding database...');
        $this->call('db:seed');

        $this->info('Project setup completed successfully.');
    }
}
