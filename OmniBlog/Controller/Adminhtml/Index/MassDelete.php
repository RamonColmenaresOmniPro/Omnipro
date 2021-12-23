<?php
namespace Omnipro\OmniBlog\Controller\Adminhtml\Index;

class MassDelete extends \Magento\Backend\App\Action
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
        $this->omniBlogFactory = $omniBlogFactory;
        $this->omniBlogRepository = $omniBlogRepository;
        parent::__construct($context);
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $selectedIds = $data['selected'];
        try {
            foreach ($selectedIds as $selectedId) {
                $this->omniBlogRepository->deleteById($selectedId);
            }
            $this->messageManager->addSuccess(__('Row data has been successfully deleted.'));
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
