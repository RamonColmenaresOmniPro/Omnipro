<?php
namespace Omnipro\ModuloCsv\Cron;

class Job
{
    protected $logger;
    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->_logger= $logger;
    }
    public function execute()
    {
        $this->_logger->info('hola');
        return $this;
    }
}
