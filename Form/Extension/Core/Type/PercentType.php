<?php

namespace Seegno\BootstrapBundle\Form\Extension\Core\Type;

use Seegno\BootstrapBundle\Form\AbstractFormControlTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\PercentType as BasePercentType;

/**
 * PercentType
 */
class PercentType extends AbstractFormControlTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return BasePercentType::class;
    }
}
