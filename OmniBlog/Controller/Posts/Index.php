<?php
namespace Omnipro\OmniBlog\Controller\Posts;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Framework\Controller\Result\JsonFactory
     */
    private $jsonFactory;

    /**
     * @param \Omnipro\OmniBlog\Model\OmniBlogFactory
     */
    private $omniBlogFactory;

    /**
     * @param \Omnipro\OmniBlog\Api\OmniBlogRepositoryInterface
     */
    private $omniBlogRepository;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Omnipro\OmniBlog\Model\OmniBlogFactory $omniBlogFactory,
        \Omnipro\OmniBlog\Api\OmniBlogRepositoryInterface $omniBlogRepository
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->jsonFactory = $jsonFactory;
        $this->omniBlogFactory = $omniBlogFactory;
        $this->omniBlogRepository = $omniBlogRepository;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $json = $this->jsonFactory->create();

        $omniblog = $this->omniBlogFactory->create();

        $data =$this->getRequest()->getParams();
        
        $omniblog->setData($data);

        $this->omniBlogRepository->save($omniblog);

        $json->setData([
            'success' => true,
            'omniblog' => $omniblog->toArray()
        ]);
        return $this->_pageFactory->create();
    }
}
