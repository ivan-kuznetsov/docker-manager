<?php

namespace DockerManager;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\FactoryCommandLoader;

class Runner
{
    /**
     * @var Application
     */
    protected $console;

    /**
     * Runner constructor.
     * @param $console
     */
    public function __construct($console = null)
    {
        $this->console = $console ?? $this->createConsole();
    }

    public function execute()
    {
        $this->registerCommands();
        $this->console->run();
    }

    protected function config($key, $default = null)
    {
        return Configurator::get($key, $default);
    }

    protected function createConsole()
    {
        return new Application($this->config('name'));
    }

    protected function registerCommands()
    {
        $commandLoader = new FactoryCommandLoader($this->loadCommands());
        $this->console->setCommandLoader($commandLoader);
    }

    protected function loadCommands(): array
    {
        $commandsFiles = FilesystemUtils::recursiveFileSearch('./src/Commands', '*.command.php');
        $commands = [];

        foreach ($commandsFiles as $command) {
            $commands = array_merge($commands, require $command);
        }

        return $commands;
    }
}