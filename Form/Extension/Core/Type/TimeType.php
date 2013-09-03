<?php

namespace Seegno\BootstrapBundle\Form\Extension\Core\Type;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * TimeType
 */
class TimeType extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'time';
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if ('single_text' !== $view->vars['widget']) {
            $view->vars['hours_attr'] = self::htmlAttributes($options['hours_attr']);
            $view->vars['minutes_attr'] = self::htmlAttributes($options['minutes_attr']);
            $view->vars['seconds_attr'] = self::htmlAttributes($options['seconds_attr']);

            $attrClass = ' row';
        } else {
            $attrClass = ' form-control';
        }

        // Append/add the HTML class attribute
        if (isset($view->vars['attr']['class'])) {
            $view->vars['attr']['class'] .= $attrClass;
        } else {
            $view->vars['attr']['class'] = trim($attrClass);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'hours_attr'   => array('class' => 'col-xs-4'),
            'minutes_attr' => array('class' => 'col-xs-4'),
            'seconds_attr' => array('class' => 'col-xs-4')
        ));
    }

    /**
     * Transforms an array in an HTML attributes string
     *
     * @param array $array
     * @return string
     */
    static private function htmlAttributes(array $array)
    {
        $string = '';

        foreach ($array as $key => $value) {
            $string .= $key . '="' . $value . '"';
        }

        return $string;
    }
}
