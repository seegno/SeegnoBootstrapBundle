<?php

namespace Seegno\BootstrapBundle\Form\Extension\Core\Type;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\ButtonType as BaseButtonType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * ButtonType
 */
class ButtonType extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return BaseButtonType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'attr' => array('class' => 'btn btn-default')
        ));
    }
}
