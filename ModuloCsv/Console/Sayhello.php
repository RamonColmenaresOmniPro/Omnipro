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

    /**
     * @param \Omnipro\ModuloCsv\Helper\Email
     */
    private $helperEmail;

    public function __construct(
        \Omnipro\ModuloCsv\Helper\Csv $csv,
        \Omnipro\ModuloCsv\Helper\Email $helperEmail
    )
    {
        $this->csv = $csv;
        $this->helperEmail = $helperEmail;
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
        $this->helperEmail->sendEmail();
        // $output->writeln($prueba2);
    }
}
