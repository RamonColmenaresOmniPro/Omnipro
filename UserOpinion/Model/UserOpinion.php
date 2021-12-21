<?php
namespace Omnipro\UserOpinion\Model;

use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;
use \Omnipro\UserOpinion\Api\Data\UserOpinionInterface;
use Omnipro\UserOpinion\Model\ResourceModel\UserOpinion as UserOpinionResource;

class UserOpinion extends AbstractModel implements IdentityInterface, UserOpinionInterface
{
    const CACHE_TAG = 'omnipro_useropinion_user_opinion';

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
    protected $_eventPrefix = 'user_opinion';

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
        $this->_init(UserOpinionResource::class);
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

    public function getOpinionId()
    {
        return $this->getData('opinion_id');
    }

    public function setOpinionId($opinionId)
    {
        $this->setData('opinion_id', $opinionId);
    }

    public function getOpinionSku()
    {
        return $this->getData('sku');
    }

    public function setOpinionSku($sku)
    {
        $this->setData('sku', $sku);
    }
}
