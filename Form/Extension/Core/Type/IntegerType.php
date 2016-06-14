<?php

namespace Seegno\BootstrapBundle\Form\Extension\Core\Type;

use Seegno\BootstrapBundle\Form\AbstractFormControlTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\IntegerType as BaseIntegerType;

/**
 * IntegerType
 */
class IntegerType extends AbstractFormControlTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return BaseIntegerType::class;
    }
}
