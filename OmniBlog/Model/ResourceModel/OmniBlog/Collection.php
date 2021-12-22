<?php
namespace Omnipro\OmniBlog\Model\ResourceModel\OmniBlog;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use \Omnipro\OmniBlog\Model\OmniBlog;
use \Omnipro\OmniBlog\Model\ResourceModel\OmniBlog as OmniBlogResource;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'post_id';
    protected $_eventPrefix = 'omnipro_omniblog_omni_blog_collection';
    protected $_eventObject = 'omni_blog_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(OmniBlog::class, OmniBlogResource::class);
    }
}
