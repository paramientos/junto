<?php

namespace Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class UpdateCommand extends Command
{

    public function configure()
    {
        $this->setName('update')
            ->setDescription('Greet a user based on the time of the day.')
            ->setHelp('This command allows you to greet a user based on the time of the day...')
            ->addArgument('o', InputArgument::OPTIONAL, 'You can use o for optimize the process');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->update($input, $output);
    }

    protected function update(InputInterface $input, OutputInterface $output)
    {
        $command = 'composer dump-autoload' . ($input->getArgument('o') == 'o' ? ' -o' : '');
        exec($command, $out, $result);
        if ($result == 0) {
            $output->write("<info>\"{$command}\" successfully executed.</info>");
        } else {
            $output->write("<info>An error occurred while running the \"{$command}\".</info>");
        }
    }

}


