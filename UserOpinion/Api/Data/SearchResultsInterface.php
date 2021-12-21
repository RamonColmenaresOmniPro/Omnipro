<?php
namespace Omnipro\UserOpinion\Api\Data;

use \Omnipro\UserOpinion\Api\Data\UserOpinionInterface;

interface SearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * getItems
     *
     * @return \Omnipro\UserOpinion\Api\Data\UserOpinionInterface[]
     */
    public function getItems();
    
    /**
     * setItems
     *
     * @param \Omnipro\UserOpinion\Api\Data\UserOpinionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
