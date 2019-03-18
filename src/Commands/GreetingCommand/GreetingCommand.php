<?php

namespace DockerManager\Commands\GreetingCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use DockerManager\Commands\Command;

class GreetingCommand extends Command
{
    public function configure()
    {
        $this->setName('greeting')
          ->setDescription('Greet a user.')
          ->setHelp('This command allows you to greet a user.')
          ->addArgument('username', InputArgument::REQUIRED, 'The username of the user.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hi there, ' . $input->getArgument('username') . '!');
    }
}