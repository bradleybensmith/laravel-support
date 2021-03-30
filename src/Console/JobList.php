<?php

namespace Laravel\Support\Console;

use ReflectionClass;
use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;
use hanneskod\classtools\Iterator\ClassIterator;

class JobList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all jobs';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->table([ 'Job Class', 'Constructor' ], $this->getClasses(base_path('app/Jobs')));
    }

    private function getClasses(string $path): array
    {
        $classes = [];
        $iterator = new ClassIterator((new Finder())->in($path));
        $iterator->enableAutoloading();

        foreach ($iterator->where('isInstantiable') as $class) {
            $classes[] = [
                $class->getName(),
                $this->getConstructor($class),
            ];
        }

        return $classes;
    }

    private function getConstructor(ReflectionClass $class): string
    {
        $params = [];

        if ($constructor = $class->getConstructor()) {
            foreach ($constructor->getParameters() as $param) {
                $params[] = "{$param->getType()} \${$param->name}";
            }
        }

        return implode(', ', $params);
    }
}
