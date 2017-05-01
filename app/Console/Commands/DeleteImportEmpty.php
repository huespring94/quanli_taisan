<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ImportStuffService;

class DeleteImportEmpty extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delete-empty-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete empty import store';

    /**
     * Import stuff service
     *
     * @var ImportStuffService
     */
    private $importStuffService;
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ImportStuffService $importStuffService)
    {
        parent::__construct();
        $this->importStuffService = $importStuffService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->importStuffService->deleteEmptyImportStore();
        $this->info('deleted');
        \Log::debug('deleted');
    }
}
