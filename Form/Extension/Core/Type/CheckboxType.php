<?php

namespace Seegno\BootstrapBundle\Form\Extension\Core\Type;

use Seegno\BootstrapBundle\Form\AbstractFormControlTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType as BaseCheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * CheckboxType
 */
class CheckboxType extends AbstractFormControlTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return BaseCheckboxType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'widget_wrapper_attr'  => array('class' => 'checkbox')
        ));
    }
}
