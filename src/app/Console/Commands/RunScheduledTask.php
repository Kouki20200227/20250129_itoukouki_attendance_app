<?php

namespace App\Console\Commands;

use App\Models\Situation;
use Illuminate\Console\Command;

class RunScheduledTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '指定の時間になったら処理を実行';

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
        Situation::all()->update(
            ['situation' => 0]
        );
    }
}
