<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\CountryRepository")
 */
class Country
{
    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Ville", mappedBy="country", cascade={"remove"})
     */
    private $villes;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Departement", mappedBy="country", cascade={"remove"})
     */
    private $departements;

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
     * @return Country
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
        $this->villes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->departements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ville
     *
     * @param \CoreBundle\Entity\Ville $ville
     *
     * @return Country
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

    /**
     * Add departement
     *
     * @param \CoreBundle\Entity\Departement $departement
     *
     * @return Country
     */
    public function addDepartement(\CoreBundle\Entity\Departement $departement)
    {
        $this->departements[] = $departement;

        return $this;
    }

    /**
     * Remove departement
     *
     * @param \CoreBundle\Entity\Departement $departement
     */
    public function removeDepartement(\CoreBundle\Entity\Departement $departement)
    {
        $this->departements->removeElement($departement);
    }

    /**
     * Get departements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartements()
    {
        return $this->departements;
    }
}
