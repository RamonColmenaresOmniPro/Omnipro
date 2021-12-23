<?php
namespace Omnipro\OmniBlog\Controller\Adminhtml\Index;

class Save extends \Magento\Backend\App\Action
{

    /**
     * @param \Omnipro\OmniBlog\Model\OmniBlogFactory
     */
    private $omniBlogFactory;

    /**
     * @param \Omnipro\OmniBlog\Api\OmniBlogRepositoryInterface
     */
    private $omniBlogRepository;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Omnipro\OmniBlog\Model\OmniBlogFactory $omniBlogFactory,
        \Omnipro\OmniBlog\Api\OmniBlogRepositoryInterface $omniBlogRepository
    )
    {
        $this->_omniBlogFactory = $omniBlogFactory;
        $this->omniBlogRepository = $omniBlogRepository;
        $this->omniBlogFactory = $omniBlogFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $reviewId = isset($data['post_id']) ? $data['post_id'] : '';
        if (!$data) {
            $this->_redirect('omniblog/index/index');
        }
        try {
            $rowData = $this->_omniBlogFactory->create()->load($reviewId);
            $rowData = $this->omniBlogRepository->getById($reviewId);
            if (!$rowData->getPostId() && $reviewId) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('omniblog/index/index');
            }
            $this->omniBlogRepository->save($rowData);
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('omniblog/index/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Omnipro_OmniBlog::home');
    }
}