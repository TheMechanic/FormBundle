<?php

namespace TheMechanic\FormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class FieldsGroup
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $label;

    /**
     * @ORM\OneToMany(targetEntity="Field", mappedBy="fieldGroup", cascade={"remove", "persist"})
     */
    protected $fields;

    /**
    * @ORM\ManyToOne(targetEntity="Form", inversedBy="fieldsGroups", cascade={"remove", "persist"})
     */
    protected $form;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set label
     *
     * @param string $label
     * @return FieldsGroup
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Add field
     *
     * @param \TheMechanic\FormBundle\Entity\Fields $field
     * @return FieldsGroup
     */
    public function addField(\TheMechanic\FormBundle\Entity\Field $field)
    {
        $field->setFieldGroup($this);
        $field->setForm($this->getForm());
        $this->fields[] = $field;

        return $this;
    }

    /**
     * Remove field
     *
     * @param \TheMechanic\FormBundle\Entity\Fields $field
     */
    public function removeField(\TheMechanic\FormBundle\Entity\Field $field)
    {
        $this->fields->removeElement($field);
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
     * Set form
     *
     * @param \TheMechanic\FormBundle\Entity\Form $form
     * @return FieldsGroup
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
}
