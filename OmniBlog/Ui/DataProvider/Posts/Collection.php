<?php
namespace OmniPro\OmniBlog\Ui\DataProvider\Posts;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

/**
 * Class Collection
 * @package MmniPro\OmniBlog\Ui\DataProvider\Posts
 */
class Collection extends SearchResult
{
    /**
     * Override _initSelect to add custom columns
     *
     * @return void
     */
    protected function _initSelect()
    {
        $this->addFilterToMap('post_id', 'main_table.post_id');
        $this->addFilterToMap('email', 'omniproomniblog.email');
        parent::_initSelect();
    }
}