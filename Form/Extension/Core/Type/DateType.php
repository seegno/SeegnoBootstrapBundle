<?php

namespace Seegno\BootstrapBundle\Form\Extension\Core\Type;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\DateType as BaseDateType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * DateType
 */
class DateType extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return BaseDateType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        if ('single_text' !== $view->vars['widget']) {
            $view->vars['year_attr'] = self::htmlAttributes($options['year_attr']);
            $view->vars['month_attr'] = self::htmlAttributes($options['month_attr']);
            $view->vars['day_attr'] = self::htmlAttributes($options['day_attr']);

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
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'year_attr'  => array('class' => 'col-xs-4'),
            'month_attr' => array('class' => 'col-xs-4'),
            'day_attr'   => array('class' => 'col-xs-4')
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
