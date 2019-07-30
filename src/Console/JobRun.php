<?php

namespace Laravel\Support\Console;

use Illuminate\Bus\Dispatcher;
use Illuminate\Console\Command;
use ReflectionClass;

class JobRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:run {job}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a job';

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
    public function handle(Dispatcher $dispatcher)
    {
        $job = '\\App\\Jobs\\' . $this->argument('job');

        if (! class_exists($job)) {
            $this->error("Invalid job class [{$job}]");
            return;
        }

        if ($constructor = (new ReflectionClass($job))->getConstructor() !== null) {
            $parameters = $constructor->getParameters();

            if (count($parameters) > 0) {
                $this->error('This class has constructor parameters. Unable to run from here.');
                return;
            }
        }

        $dispatcher->dispatchNow(new $job());
    }
}
