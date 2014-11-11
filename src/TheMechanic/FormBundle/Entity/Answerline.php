<?php

namespace TheMechanic\FormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Answerline
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Answer")
     */
    protected $answer;

    /**
     * @ORM\ManyToOne(targetEntity="Field")
     */
    protected $field;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $value;

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
     * Set value
     *
     * @param string $value
     * @return Answerline
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set answer
     *
     * @param \TheMechanic\FormBundle\Entity\Answer $answer
     * @return Answerline
     */
    public function setAnswer(\TheMechanic\FormBundle\Entity\Answer $answer = null)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return \TheMechanic\FormBundle\Entity\Answer 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set field
     *
     * @param \TheMechanic\FormBundle\Entity\Field $field
     * @return Answerline
     */
    public function setField(\TheMechanic\FormBundle\Entity\Field $field = null)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return \TheMechanic\FormBundle\Entity\Field 
     */
    public function getField()
    {
        return $this->field;
    }
}
