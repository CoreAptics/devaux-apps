<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\QuestionAttribute", mappedBy="question")
     */
    private $attributes;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\QuestionType", inversedBy="questions")
     */
    private $type;

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
     * @ORM\Column(name="horizontal", type="boolean")
     */
    private $horizontal;


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
     * @return Question
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
        $this->attributes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add attribute
     *
     * @param \CoreBundle\Entity\QuestionAttribute $attribute
     *
     * @return Question
     */
    public function addAttribute(\CoreBundle\Entity\QuestionAttribute $attribute)
    {
        $this->attributes[] = $attribute;

        return $this;
    }

    /**
     * Remove attribute
     *
     * @param \CoreBundle\Entity\QuestionAttribute $attribute
     */
    public function removeAttribute(\CoreBundle\Entity\QuestionAttribute $attribute)
    {
        $this->attributes->removeElement($attribute);
    }

    /**
     * Get attributes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Set type
     *
     * @param \CoreBundle\Entity\QuestionType $type
     *
     * @return Question
     */
    public function setType(\CoreBundle\Entity\QuestionType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \CoreBundle\Entity\QuestionType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set horizontal
     *
     * @param boolean $horizontal
     *
     * @return Question
     */
    public function setHorizontal($horizontal)
    {
        $this->horizontal = $horizontal;

        return $this;
    }

    /**
     * Get horizontal
     *
     * @return boolean
     */
    public function getHorizontal()
    {
        return $this->horizontal;
    }
}
