<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Reference", mappedBy="category")
     */
    private $references;

    /**
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\Ville", inversedBy="categories")
     */
    private $villes;

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
     * @return Category
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
        $this->villes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add reference
     *
     * @param \CoreBundle\Entity\Reference $reference
     *
     * @return Category
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
     * Add ville
     *
     * @param \CoreBundle\Entity\Ville $ville
     *
     * @return Category
     */
    public function addVille(\CoreBundle\Entity\Ville $ville)
    {
        $this->villes[] = $ville;

        return $this;
    }

    /**
     * Remove ville
     *
     * @param \CoreBundle\Entity\Ville $ville
     */
    public function removeVille(\CoreBundle\Entity\Ville $ville)
    {
        $this->villes->removeElement($ville);
    }

    /**
     * Get villes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVilles()
    {
        return $this->villes;
    }
}
