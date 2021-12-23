<?php
namespace Omnipro\OmniBlog\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Omnipro\OmniBlog\Model\OmniBlogFactory;

class Edit extends Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @var OmniBlogFactory
     */
    protected $_omniBlogFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @param \Omnipro\OmniBlog\Api\OmniBlogRepositoryInterface
     */
    private $omniBlogRepository;

    /**
     * Edit constructor.
     * @param Context $context
     * @param PageFactory $rawFactory
     * @param OmniBlogFactory $_omniBlogFactory
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        Context $context,
        PageFactory $rawFactory,
        OmniBlogFactory $_omniBlogFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Omnipro\OmniBlog\Api\OmniBlogRepositoryInterface $omniBlogRepository
    )
    {
        $this->pageFactory = $rawFactory;
        $this->_omniBlogFactory = $_omniBlogFactory;
        $this->coreRegistry = $coreRegistry;
        $this->omniBlogRepository = $omniBlogRepository;
        parent::__construct($context);
    }


    /**
     * @return Page
     */
    public function execute(): Page
    {
        $resultPage = $this->pageFactory->create();
        $rowId = (int)$this->getRequest()->getParam('id');
        $rowData = '';

        if ($rowId) {
            $rowData = $this->_omniBlogFactory->create();
            $rowData = $this->omniBlogRepository->getById($rowId);
            if (!$rowData) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('omniblog/index/index');
            }
        }
        $this->omniBlogRepository->save($rowData);
        $title = $rowId ? __('Edit Review ') : __('Add Review');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Omnipro_OmniBlog::index');
    }
}

