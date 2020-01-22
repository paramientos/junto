<?php

namespace Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class ServeCommand extends Command
{

    public function configure()
    {
        $this->setName('serve')
            ->setDescription('This command runs local server.')
            ->setHelp('With this command you can run the local server.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->command($input, $output);
    }

    protected function command(InputInterface $input, OutputInterface $output)
    {
        $command = 'php -S localhost:8000';
        exec($command, $out, $result);

        if ($result == 0) {
            $output->write("<info>\"{$command}\" successfully executed.</info>");
        } else {
            $output->write("<info>An error occurred while running the \"{$command}\".</info>");
        }
    }

}


