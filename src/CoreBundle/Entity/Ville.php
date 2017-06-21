<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table(name="ville")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\VilleRepository")
 */
class Ville
{
    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Reference", mappedBy="ville")
     */
    private $references;

    /**
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\Category", mappedBy="villes")
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Country", inversedBy="villes")
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Departement", inversedBy="villes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $departement;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Ville
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
     * Constructor
     */
    public function __construct()
    {
        $this->references = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add reference
     *
     * @param \CoreBundle\Entity\Reference $reference
     *
     * @return Ville
     */
    public function addReference(\CoreBundle\Entity\Reference $reference)
    {
        $this->references[] = $reference;

        return $this;
    }

    /**
     * Remove reference
     *
     * @param \CoreBundle\Entity\Reference $reference
     */
    public function removeReference(\CoreBundle\Entity\Reference $reference)
    {
        $this->references->removeElement($reference);
    }

    /**
     * Get references
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferences()
    {
        return $this->references;
    }

    /**
     * Set category
     *
     * @param \CoreBundle\Entity\Category $category
     *
     * @return Ville
     */
    public function setCategory(\CoreBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \CoreBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set country
     *
     * @param \CoreBundle\Entity\Country $country
     *
     * @return Ville
     */
    public function setCountry(\CoreBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \CoreBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set departement
     *
     * @param \CoreBundle\Entity\Departement $departement
     *
     * @return Ville
     */
    public function setDepartement(\CoreBundle\Entity\Departement $departement = null)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return \CoreBundle\Entity\Departement
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Add category
     *
     * @param \CoreBundle\Entity\Category $category
     *
     * @return Ville
     */
    public function addCategory(\CoreBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \CoreBundle\Entity\Category $category
     */
    public function removeCategory(\CoreBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
