<?php
namespace Omnipro\UserOpinion\Model\ResourceModel;

class UserOpinion extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('omnipro_useropinion', 'opinion_id');
    }
}
