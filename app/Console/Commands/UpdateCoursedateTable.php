<?php

namespace Yours\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Yours\Jobs\UpdateCoursedateTable as UpdateCoursedateTableJob;

class UpdateCoursedateTable extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coursedates:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the Coursedates table with new Coursedates for all Courses.';

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
        $this->dispatch(new UpdateCoursedateTableJob());
        $this->comment(PHP_EOL.'coursedates auf neusten stand'.PHP_EOL);
    }
}
