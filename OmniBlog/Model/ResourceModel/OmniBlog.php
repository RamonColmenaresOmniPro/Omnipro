<?php
namespace Omnipro\OmniBlog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class OmniBlog extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('omnipro_omniblog', 'post_id');
    }
}
