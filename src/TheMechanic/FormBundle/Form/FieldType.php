<?php

namespace TheMechanic\FormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FieldType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'choice', array(
                'choices'   => array(
                    'text' => 'text', 
                    'checkbox' => 'checkbox', 
                    'radio' => 'radio', 
                    'select' => 'select',
                ),
            ))
            ->add('name')
            ->add('placeholder')
            ->add('label')
            ->add('value')
            ->add('isRequired')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TheMechanic\FormBundle\Entity\Field'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'themechanic_formbundle_field';
    }
}
