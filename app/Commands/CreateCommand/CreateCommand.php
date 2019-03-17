<?php

namespace App\Commands\CreateCommand;

use App\FilesystemUtils;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\Commands\Command;

class CreateCommand extends Command
{
    public function configure()
    {
        $this->setName('create')
          ->setDescription('Creates docker files for chosen environment.')
          ->setHelp('This command allows you to create docker environment.')
          ->addArgument('environment', InputArgument::REQUIRED, 'The type of the environment.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $envName = $input->getArgument('environment');

        $output->writeln('Creating files for ' . $envName . ' environment...');

        FilesystemUtils::copyFiles(__DIR__ . '/../../Environments/php', __DIR__ . '/../../../');

        $output->writeln('Environment ' . $envName . ' has created!');
    }
}