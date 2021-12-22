<?php
namespace Omnipro\OmniBlog\Model;

use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;
use \Omnipro\OmniBlog\Api\Data\OmniBlogInterface;
use \Omnipro\OmniBlog\Model\ResourceModel\OmniBlog as OmniBlogResource;

class OmniBlog extends AbstractModel implements IdentityInterface, OmniBlogInterface
{
    const CACHE_TAG = 'omnipro_omniblog_omni_blog';

    /**
     * Model cache tag for clear cache in after save and after delete
     *
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'omni_blog';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(OmniBlogResource::class);
    }

    /**
     * Return a unique id for the model.
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getPostId()
    {
        return $this->getData('post_id');
    }
    
    public function setPostId($postId)
    {
        $this->setData('post_id', $postId);
    }
    
    public function getTitle()
    {
        return $this->getData('title');
    }

    public function setTitle($title)
    {
        $this->setData('title', $title);
    }

    public function getContent()
    {
        return $this->getData('content');
    }

    public function setContent($content)
    {
        $this->setData('content', $content);
    }

    public function getImage()
    {
        return $this->getData('image');
    }

    public function setImage($image)
    {
        $this->setData('image', $image);
    }

    public function getEmail()
    {
        return $this->getData('email');
    }

    public function setEmail($email)
    {
        $this->setData('email', $email);
    }
}
