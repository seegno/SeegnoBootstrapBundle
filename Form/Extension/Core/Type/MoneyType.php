<?php

namespace Seegno\BootstrapBundle\Form\Extension\Core\Type;

use Seegno\BootstrapBundle\Form\AbstractFormControlTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

/**
 * MoneyType
 */
class MoneyType extends AbstractFormControlTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'money';
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $pattern = $view->vars['money_pattern'];
        $content = str_replace('{{ widget }}', '', $pattern);
        $space = strpos($content, ' ');

        if (0 === $space) {
            $view->vars['money_pattern'] = sprintf('{{ widget }} <span class="input-group-addon">%s</span>', trim($content));
        } elseif (strlen($content) - 1  === $space) {
            $view->vars['money_pattern'] = sprintf('<span class="input-group-addon">%s</span> {{ widget }}', trim($content));
        }
    }
}
