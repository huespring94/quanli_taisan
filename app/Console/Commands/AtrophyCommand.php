<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\AtrophyService;

class AtrophyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:atrophy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Atrophy service
     *
     * @var AtrophyService
     */
    private $atrophyService;

    /**
     * Create a new command instance.
     *
     * @param AtrophyService $atrophyService []
     *
     * @return void
     */
    public function __construct(AtrophyService $atrophyService)
    {
        parent::__construct();
        $this->atrophyService = $atrophyService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->atrophyService->updateStatusStuff();
    }
}
