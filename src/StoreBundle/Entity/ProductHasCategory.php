<?php

namespace StoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * ProductHasCategory
 */
class ProductHasCategory
{
    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \StoreBundle\Entity\Product
     */
    private $product;

    /**
     * @var \AppBundle\Entity\Classification\Category
     */
    private $category;


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ProductHasCategory
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return ProductHasCategory
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set product
     *
     * @param \StoreBundle\Entity\Product $product
     *
     * @return ProductHasCategory
     */
    public function setProduct(\StoreBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \StoreBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Classification\Category $category
     *
     * @return ProductHasCategory
     */
    public function setCategory(\AppBundle\Entity\Classification\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Classification\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    public function prePersist()
    {
        // Add your code here
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }


    public function preUpdate()
    {
        // Add your code here
        $this->updatedAt = new \DateTime();
    }

    public function __toString() {
        return $this->category ? $this->category->getName() : 'new';
    }
}
