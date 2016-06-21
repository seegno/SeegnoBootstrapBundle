<?php

namespace Seegno\BootstrapBundle\Form\Extension\Core\Type;

use Seegno\BootstrapBundle\Form\AbstractFormControlTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType as BaseTextType;

/**
 * TextType
 */
class TextType extends AbstractFormControlTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return BaseTextType::class;
    }
}
