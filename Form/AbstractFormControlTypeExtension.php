<?php

namespace Seegno\BootstrapBundle\Form;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * AbstractFormControlTypeExtension
 */
abstract class AbstractFormControlTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'attr' => array('class' => 'form-control')
        ));
    }
}
