<?php
namespace Omnipro\OmniBlog\Controller\Posts;

use  Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\CouldNotSaveException;

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

    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;

    /**
     * @param \Magento\Framework\Data\Form\FormKey\Validator
     */
    private $formKeyValidator;

    public function __construct(
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Omnipro\OmniBlog\Model\OmniBlogFactory $omniBlogFactory,
        \Omnipro\OmniBlog\Api\OmniBlogRepositoryInterface $omniBlogRepository,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
    )
    {
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        $this->_pageFactory = $pageFactory;
        $this->jsonFactory = $jsonFactory;
        $this->omniBlogFactory = $omniBlogFactory;
        $this->omniBlogRepository = $omniBlogRepository;
        $this->formKeyValidator = $formKeyValidator;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try{
            $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'image']);
            $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $imageAdapter = $this->adapterFactory->create();
            /* start of validated image */
            $uploaderFactory->addValidateCallback('custom_image_upload',
                $imageAdapter,'validateUploadFile');
            $uploaderFactory->setAllowRenameFiles(true);
            $uploaderFactory->setFilesDispersion(true);
            $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
            $destinationPath = $mediaDirectory->getAbsolutePath('custom_image');
            $result = $uploaderFactory->save($destinationPath);
            if (!$result) {
                throw new LocalizedException(
                    __('File cannot be saved to path: $1', $destinationPath)
                );
            }
            /* you need yo save image 
                 $result['file'] at datbaseQQ 
            */
            $imagepath = $result['file'];
            //
        } catch (\Exception $e) {
        }

        $json = $this->jsonFactory->create();

        $omniblog = $this->omniBlogFactory->create();

        $data =$this->getRequest()->getParams();
        
        $omniblog->setData($data);

        $this->validateFormKey($omniblog);

        $this->omniBlogRepository->save($omniblog);

        $json->setData([
            'success' => true,
            'omniblog' => $omniblog->toArray()
        ]);
        return $this->_pageFactory->create();
    }

    /**
     * @param OmniBlog $omniBlog
     */
    private function validateFormKey(){
        $omniblog = $this->omniBlogFactory->create();

        $data =$this->getRequest()->getParams();
        
        $omniblog->setData($data);

        $validate = sizeof($omniblog->getData());
        if (!$this->formKeyValidator->validate($this->getRequest()) && $validate) {
            throw new CouldNotSaveException(__("The Form it is Invalid"));
        }
    }
}
