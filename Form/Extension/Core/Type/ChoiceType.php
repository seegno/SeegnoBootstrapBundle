<?php

namespace Seegno\BootstrapBundle\Form\Extension\Core\Type;

use Seegno\BootstrapBundle\Form\AbstractFormControlTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType as BaseChoiceType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * ChoiceType
 */
class ChoiceType extends AbstractFormControlTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return BaseChoiceType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['inline'] = $options['inline'];
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'inline'  => false
        ));
    }
}
