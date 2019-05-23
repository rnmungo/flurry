<?php

namespace Flurry\Console\Commands;

use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Carbon\Carbon;

class RestoreDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:restore {--p|path= : The PATH of the Backup}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore the database';

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
        try {
            Log::channel('backups')->info('Comenzando a restaurar el archivo '.$this->option('path').'...');
            $this->process = new Process(sprintf(
                'mysql --user=%s --password=%s --host=%s %s < %s',
                config('database.connections.mysql.username'),
                config('database.connections.mysql.password'),
                config('database.connections.mysql.host'),
                config('database.connections.mysql.database'),
                $this->option('path')
            ));
            $this->process->mustRun();
            $this->info('The backup has been restored successfully.');
            Log::channel('backups')->info('¡Backup restaurado correctamente!');
        }
        catch (ProcessFailedException $exception) {
            $this->error($exception->getMessage());
        }
    }
}
