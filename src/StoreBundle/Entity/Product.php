<?php

namespace StoreBundle\Entity;

/**
 * Product
 */
class Product
{
    
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $quantity;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $productHasCategories;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productHasCategories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set quantity
     *
     * @param string $quantity
     *
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Product
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
     * @return Product
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
     * Add productHasCategory
     *
     * @param \StoreBundle\Entity\ProductHasCategory $productHasCategory
     *
     * @return Product
     */
    public function addProductHasCategory(\StoreBundle\Entity\ProductHasCategory $productHasCategory)
    {
        $this->productHasCategories[] = $productHasCategory;

        return $this;
    }

    /**
     * Remove productHasCategory
     *
     * @param \StoreBundle\Entity\ProductHasCategory $productHasCategory
     */
    public function removeProductHasCategory(\StoreBundle\Entity\ProductHasCategory $productHasCategory)
    {
        $this->productHasCategories->removeElement($productHasCategory);
    }

    /**
     * Get productHasCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductHasCategories()
    {
        return $this->productHasCategories;
    }

    public function prePersist()
    {
        // Add your code here
    }
    
    public function preUpdate()
    {
        // Add your code here
    }
}
