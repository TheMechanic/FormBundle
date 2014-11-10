<?php

namespace TheMechanic\FormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FieldsGroupType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label')
            ->add('fields', 'collection', array(
                'type'         => new FieldType(),
                'allow_add'    => true,
                'by_reference' => false,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TheMechanic\FormBundle\Entity\FieldsGroup'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'themechanic_formbundle_fieldsgroup';
    }
}
