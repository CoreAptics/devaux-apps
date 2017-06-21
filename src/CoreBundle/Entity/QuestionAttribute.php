<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionAttribute
 *
 * @ORM\Table(name="question_attribute")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\QuestionAttributeRepository")
 */
class QuestionAttribute
{
    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Question", inversedBy="attributes")
     */
    private $question;

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
     * @ORM\Column(name="optional", type="boolean", length=255)
     */
    private $optional;

    /**
     * @ORM\Column(name="optionel", type="string", length=255, nullable=true)
     */
    private $optionalText;


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
     * @return QuestionAttribute
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
     * Set question
     *
     * @param \CoreBundle\Entity\Question $question
     *
     * @return QuestionAttribute
     */
    public function setQuestion(\CoreBundle\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \CoreBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set optional
     *
     * @param boolean $optional
     *
     * @return QuestionAttribute
     */
    public function setOptional($optional)
    {
        $this->optional = $optional;

        return $this;
    }

    /**
     * Get optional
     *
     * @return boolean
     */
    public function getOptional()
    {
        return $this->optional;
    }

    /**
     * Set optionalText
     *
     * @param string $optionalText
     *
     * @return QuestionAttribute
     */
    public function setOptionalText($optionalText)
    {
        $this->optionalText = $optionalText;

        return $this;
    }

    /**
     * Get optionalText
     *
     * @return string
     */
    public function getOptionalText()
    {
        return $this->optionalText;
    }
}
