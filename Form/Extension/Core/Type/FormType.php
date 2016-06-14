<?php

namespace Seegno\BootstrapBundle\Form\Extension\Core\Type;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType as BaseFormType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * FormType.
 */
class FormType extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (isset($options['help'])) {
            $view->vars['help'] = $options['help'];
        }

        if (isset($options['widget_wrapper_attr'])) {
            $view->vars['widget_wrapper_attr'] = $options['widget_wrapper_attr'];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return BaseFormType::class;
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(array('help', 'widget_wrapper_attr'));

        $resolver->setAllowedTypes('widget_wrapper_attr', 'array');
    }
}
