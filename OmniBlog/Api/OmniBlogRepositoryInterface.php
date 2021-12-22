<?php
namespace Omnipro\OmniBlog\Api;

interface OmniBlogRepositoryInterface
{
    /**
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Omnipro\OmniBlog\Api\Data\SearchResultsInterface
     */
    public function getList($searchCriteria);

    /**
     *
     * @param int $id
     * @return \Omnipro\OmniBlog\Api\Data\OmniBlogInterface
     */
    public function getById($id);

    /**
     *
     * @param \Omnipro\OmniBlog\Api\Data\OmniBlogInterface $omniBlog
     * @return \Omnipro\OmniBlog\Api\Data\OmniBlogInterface
     */
    public function save($omniBlog);

    /**
     *
     * @param \Omnipro\OmniBlog\Api\Data\OmniBlogInterface $omniBlog
     * @return bool
     */
    public function delete($omniBlog);

    /**
     *
     * @param int $id
     * @return bool
     */
    public function deleteById($id);
}
