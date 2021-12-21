<?php
namespace Omnipro\UserOpinion\Api\Data;

interface UserOpinionInterface
{
    /**
     * Return Opinion Id
     * @return int
     */
    public function getOpinionId();
    
    /**
     * Set an Opinion Id
     * @param int $opinionId
     * @return void
     */
    public function setOpinionId($opinionId);

    /**
     * Get the Opinion Sku
     * @return string
     */
    public function getOpinionSku();

    /**
     * Set the product sku
     * @param string $sku
     * @return void
     */
    public function setOpinionSku($opinionSku);
}
