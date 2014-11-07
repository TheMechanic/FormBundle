<?php

namespace TheMechanic\FormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Form
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="FieldsGroup", mappedBy="form", cascade={"remove", "persist"})
     */
    protected $fieldsGroups;

    /**
     * @ORM\OneToMany(targetEntity="Field", mappedBy="form", cascade={"remove", "persist"})
     */
    protected $fields;

    /**
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    protected $isActive;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fieldsGroup = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fields = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Form
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
     * Set isActive
     *
     * @param boolean $isActive
     * @return Form
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }


    /**
     * Add fields
     *
     * @param \TheMechanic\FormBundle\Entity\Fields $fields
     * @return Form
     */
    public function addField(\TheMechanic\FormBundle\Entity\Field $fields)
    {
        $this->fields[] = $fields;

        return $this;
    }

    /**
     * Remove fields
     *
     * @param \TheMechanic\FormBundle\Entity\Fields $fields
     */
    public function removeField(\TheMechanic\FormBundle\Entity\Field $fields)
    {
        $this->fields->removeElement($fields);
    }

    /**
     * Get fields
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Add fieldsGroups
     *
     * @param \TheMechanic\FormBundle\Entity\FieldsGroup $fieldsGroups
     * @return Form
     */
    public function addFieldsGroup(\TheMechanic\FormBundle\Entity\FieldsGroup $fieldsGroups)
    {
        $this->fieldsGroups[] = $fieldsGroups;

        return $this;
    }

    /**
     * Remove fieldsGroups
     *
     * @param \TheMechanic\FormBundle\Entity\FieldsGroup $fieldsGroups
     */
    public function removeFieldsGroup(\TheMechanic\FormBundle\Entity\FieldsGroup $fieldsGroups)
    {
        $this->fieldsGroups->removeElement($fieldsGroups);
    }

    /**
     * Get fieldsGroups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFieldsGroups()
    {
        return $this->fieldsGroups;
    }
}
