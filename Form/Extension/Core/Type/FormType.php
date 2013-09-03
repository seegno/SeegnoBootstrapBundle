<?php

namespace Seegno\BootstrapBundle\Form\Extension\Core\Type;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * ButtonType
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
        return 'form';
    }

    /**
     * {@inheritdoc}
     *
     * For a "horizontal" form, we can use, for example, the following options:
     *
     *     array(
     *         'label_attr'          => 'control-label col-lg-2',
     *         'widget_wrapper_attr' => 'col-lg-10',
     *         // ...
     *     );
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array('help', 'widget_wrapper_attr'));

        $resolver->setAllowedTypes(array(
            'widget_wrapper_attr' => 'array',
        ));
    }
}
