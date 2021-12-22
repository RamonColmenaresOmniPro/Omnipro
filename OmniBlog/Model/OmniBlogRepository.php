<?php
namespace Omnipro\OmniBlog\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class OmniBlogRepository implements \Omnipro\OmniBlog\Api\OmniBlogRepositoryInterface
{
    /**
     * @param \Omnipro\OmniBlog\Model\OmniBlogFactory
     */
    private $omniBlogFactory;

    /**
     * @param \Omnipro\OmniBlog\Model\ResourceModel\OmniBlog
     */
    private $omniBlogResource;

    /**
     * @param \Omnipro\OmniBlog\Model\ResourceModel\OmniBlog\CollectionFactory
     */
    private $omniBlogCollectionFactory;

    /**
     * @param \Omnipro\OmniBlog\Api\Data\SearchResultsInterfaceFactory
     */
    private $searchResultsInterfaceFactory;

    /**
     * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface
     */
    private $collectionProcessor;

    public function __construct(
        \Omnipro\OmniBlog\Model\OmniBlogFactory $omniBlogFactory,
        \Omnipro\OmniBlog\Model\ResourceModel\OmniBlog $omniBlogResource,
        \Omnipro\OmniBlog\Model\ResourceModel\OmniBlog\CollectionFactory $omniBlogCollectionFactory,
        \Omnipro\OmniBlog\Api\Data\SearchResultsInterfaceFactory $searchResultsInterfaceFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
    )
    {
        $this->omniBlogFactory = $omniBlogFactory;
        $this->omniBlogResource = $omniBlogResource;
        $this->omniBlogCollectionFactory = $omniBlogCollectionFactory;
        $this->searchResultsInterfaceFactory = $searchResultsInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    public function getList($searchCriteria)
    {
        $collection = $this->omniBlogCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    public function getById($id)
    {
        $omniBlog = $this->omniBlogFactory->create();
        $this->omniBlogResource->load($omniBlog, $id);

        if (!$omniBlog ->getPostId()) {
            throw new NoSuchEntityException(__("The post doesn't exists"));
        }

        return $omniBlog;
    }

    /**
     * @param OmniBlog $omniBlog
     * @return OmniBlogInterface
     * @throws CouldNotSaveException
     */
    public function save($omniBlog)
    {
        try {
            $this->omniBlogResource->save($omniBlog);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
    }

    /**
     * @param OmniBlog $omniBlog
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete($omniBlog)
    {
        try {
            $this->omniBlogResource->delete($omniBlog);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
    }

    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }
}
