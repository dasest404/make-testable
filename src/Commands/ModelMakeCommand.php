<?php

namespace IaK\MakeTestable\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand as Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class ModelMakeCommand extends Command
{
    /**
     * @inheritDoc
     */
    public function handle()
    {
        parent::handle();

        if ($this->option('test')) {
            $this->createTest();
        }
    }

    /**
     * Create a test for the model.
     *
     * @return void
     */
    protected function createTest()
    {
        $name = Str::studly($this->argument('name'));

        $this->call('make:test', [
            'name' => 'Models\\' . $name  . 'Test',
            '--unit' => true,
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getOptions()
    {
        return [
            ...parent::getOptions(),
            ['test', 't', InputOption::VALUE_NONE, 'Generate a test for the model'],
        ];
    }
}
