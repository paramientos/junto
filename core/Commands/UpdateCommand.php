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
            ->setDescription('This command runs the composer dump-autoload script.')
            ->setHelp('With this command you can manage the dependencies through the composer.')
            ->addArgument('o', InputArgument::OPTIONAL, 'You can use <info>o</info> for optimize the process');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->command($input, $output);
    }

    protected function command(InputInterface $input, OutputInterface $output)
    {
        //@TODO check composer whether installed or not
        $command = 'composer dump-autoload' . ($input->getArgument('o') == 'o' ? ' -o' : '');
        exec($command, $out, $result);
        if ($result == 0) {
            $output->write("<info>\"{$command}\" successfully executed.</info>");
        } else {
            $output->write("<info>An error occurred while running the \"{$command}\".</info>");
        }
    }

}


