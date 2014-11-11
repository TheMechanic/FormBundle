<?php

namespace TheMechanic\FormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Answer
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Form")
     * @ORM\JoinColumn(name="form_id", referencedColumnName="id")
     */
    protected $form;

    /**
     * @ORM\OneToMany(targetEntity="Answerline", mappedBy="answer", cascade={"remove", "persist"})
     */
    protected $answerlines;
    
    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Answer
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
     * Set form
     *
     * @param \TheMechanic\FormBundle\Entity\Form $form
     * @return Answer
     */
    public function setForm(\TheMechanic\FormBundle\Entity\Form $form = null)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * Get form
     *
     * @return \TheMechanic\FormBundle\Entity\Form 
     */
    public function getForm()
    {
        return $this->form;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answerlines = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * Add answerlines
     *
     * @param \TheMechanic\FormBundle\Entity\Answerline $answerlines
     * @return Answer
     */
    public function addAnswerline(\TheMechanic\FormBundle\Entity\Answerline $answerlines)
    {
        $answerlines->setAnswer($this);
        $this->answerlines[] = $answerlines;

        return $this;
    }

    /**
     * Remove answerlines
     *
     * @param \TheMechanic\FormBundle\Entity\Answerline $answerlines
     */
    public function removeAnswerline(\TheMechanic\FormBundle\Entity\Answerline $answerlines)
    {
        $this->answerlines->removeElement($answerlines);
    }

    /**
     * Get answerlines
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswerlines()
    {
        return $this->answerlines;
    }
}
