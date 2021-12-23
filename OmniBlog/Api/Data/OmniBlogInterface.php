<?php
namespace Omnipro\OmniBlog\Api\Data;

interface OmniBlogInterface
{
    /**
     * getPostId
     *
     * @return int
     */
    public function getPostId();
    
    /**
     * setPostId
     *
     * @param int $postId
     * @return void
     */
    public function setPostId($postId);
    
    /**
     * getTitle
     *
     * @return string
     */
    public function getTitle();
        
    /**
     * setTitle
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title);
    
    /**
     * getContent
     *
     * @return string
     */
    public function getContent();
        
    /**
     * setContent
     *
     * @param  string $content
     * @return void
     */
    public function setContent($content);
        
    /**
     * getImage
     *
     * @return string
     */
    public function getImage();
        
    /**
     * setImage
     *
     * @param string $image
     * @return void
     */
    public function setImage($image);
    
    /**
     * getEmail
     *
     * @return string
     */
    public function getEmail();
    
    /**
     * setEmail
     *
     * @param  string $email
     * @return void
     */
    public function setEmail($email);
}
