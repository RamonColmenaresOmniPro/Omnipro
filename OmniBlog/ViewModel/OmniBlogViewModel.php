<?php
namespace Omnipro\OmniBlog\ViewModel;

class OmniBlogViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @param \Omnipro\OmniBlog\Model\ResourceModel\OmniBlog\CollectionFactory
     */
    private $omniBlogCollectionFactory;

    public function __construct(
        \Omnipro\OmniBlog\Model\ResourceModel\OmniBlog\CollectionFactory $omniBlogCollectionFactory
    )
    {
        $this->omniBlogCollectionFactory = $omniBlogCollectionFactory;
        
    }

    public function getPosts()
    {
        /**
         * @var \Omnipro\OmniBlog\Model\ResourceModel\OmniBlog\Collection $omniBlogCollection
         */
        $omniBlogCollection = $this->omniBlogCollectionFactory->create();
        $omniBlogCollection->addFieldToSelect('*');
        return $omniBlogCollection->getItems();
    }
}
