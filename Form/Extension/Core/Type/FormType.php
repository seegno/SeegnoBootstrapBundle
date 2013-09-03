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
        // $view->vars['widget_wrapper_attr'] = $options['widget_wrapper_attr'];

        if (isset($options['help'])) {
            $view->vars['help'] = $options['help'];
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
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array('help'));

        // $resolver->setDefaults(array(
        //     'attr'                => array('class' => 'form-control'),
        //     'widget_wrapper_attr' => array() // col-lg-10
        //     // 'label_attr' => array('class' => 'control-label col-lg-2')
        // ));
    }
}
