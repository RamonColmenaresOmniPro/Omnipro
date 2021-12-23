<?php
namespace Omnipro\ModuloCsv\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;

class Email extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        Escaper $escaper,
        TransportBuilder $transportBuilder
    ) {
        parent::__construct($context);
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->logger = $context->getLogger();
    }

    public function sendEmail()
    {
        try {
            $this->inlineTranslation->suspend();
            $sender = [
                'name' => $this->escaper->escapeHtml('Omnipro'),
                'email' => $this->escaper->escapeHtml('admin@omni.pro'),
            ];
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('omni_blog_template')
                ->setTemplateOptions(
                    [
                        'area' => 'frontend',
                        'store' => 0,
                    ]
                )
                ->setTemplateVars([
                    'templateVar'  => 'Csv Resume',
                ])
                ->setFrom($sender)
                ->addTo('paola.joya@omni.pro')
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }
}
