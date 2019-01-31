<?php

namespace Console;

use Endocore\App\Configs\AppConfig;
use Endocore\Core\Constants\Extension;
use Fleshgrinder\Core\Formatter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class ControllerCommand extends Command
{

    public function configure()
    {
        $this->setName('c:c')
            ->setDescription('Generates controller file.')
            ->setHelp('Generates a controller file in the Controllers folder.')
            ->addArgument('controllerName', InputArgument::OPTIONAL, 'Controller name to generate');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->command($input, $output);
    }

    protected function command(InputInterface $input, OutputInterface $output)
    {
        $controllerName = $input->getArgument('controllerName');
        $controllerFileName = Formatter::format('{ControllerDir}{Ds}{Arg}Controller{Ext}',
            [
                'ControllerDir' => AppConfig::CDIR,
                'Ds' => AppConfig::DS,
                'Arg' => $controllerName,
                'Ext' => Extension::PHP
            ]);

        if (file_exists($controllerFileName)) {
            $output->write("<error>{$controllerName} controller already exists.</error>");
            return false;
        }


        $fh = fopen($controllerFileName, "w");
        if (!is_resource($fh)) {
            return false;
        }

        $fileContent = <<<EOF
<?php

namespace App\Controllers;

use Endocore\Core\Controller;

class {$controllerName}Controller extends Controller
{

    public function indexAction()
    {

    }

}

EOF;

        $result = fwrite($fh, $fileContent);
        if ($result) {
            $output->write("<info>{$controllerName} controller successfully created.</info>");
        } else {
            $output->write("<error>An error occurred while creating the {$controllerName}.</error>");
        }
        fclose($fh);

    }

}


