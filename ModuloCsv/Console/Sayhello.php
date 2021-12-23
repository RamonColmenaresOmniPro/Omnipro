<?php
namespace Omnipro\ModuloCsv\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Sayhello extends Command
{
    /**
     * @param \Omnipro\ModuloCsv\Helper\Csv
     */
    private $csv;

    public function __construct(
        \Omnipro\ModuloCsv\Helper\Csv $csv
    )
    {
        $this->csv = $csv;
        parent::__construct();
    }
    protected function configure()
    {
        $this->setName('example:sayhello');
        $this->setDescription('Demo command line');
       
        parent::configure();
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $prueba1 = $this->csv;
        $prueba2 = $prueba1->readCsv();
        $output->writeln("Lectura exitosa de Csv");
    }
}
