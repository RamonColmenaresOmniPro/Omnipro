<?php
namespace Omnipro\OmniBlog\Api\Data;

interface SearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     *
     * @return \Omnipro\OmniBlog\Api\Data\OmniBlogInterface[]
     */
    public function getItems();

    /**
     *
     * @param \Omnipro\OmniBlog\Api\Data\OmniBlogInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
