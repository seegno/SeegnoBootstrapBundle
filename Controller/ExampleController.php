<?php

namespace Seegno\BootstrapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ExampleController extends Controller
{
    /**
     * @Template()
     */
    public function alertsAction()
    {
        $this->get('session')->getFlashBag()->add('success', '<strong>Well done!</strong> You successfully read this important alert message.');
        $this->get('session')->getFlashBag()->add('info', '<strong>Heads up!</strong> This alert needs your attention, but it\'s not super important.');
        $this->get('session')->getFlashBag()->add('warning', '<strong>Warning!</strong> Best check yo self, you\'re not looking too good.');
        $this->get('session')->getFlashBag()->add('danger', '<strong>Oh snap!</strong> Change a few things up and try submitting again.');

        return array();
    }

    /**
     * @Template()
     */
    public function formsAction()
    {
        return array(
            'basicForm'      => $this->createBasicForm()->createView(),
            'inlineForm'     => $this->createInlineForm()->createView(),
            'horizontalForm' => $this->createHorizontalForm()->createView(),
            'fullForm'       => $this->createFullForm()->createView()
        );
    }

    /**
     * @Template()
     */
    public function navsAction()
    {
        return array();
    }

    /**
     * @Template()
     */
    public function paginationAction()
    {
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(range(1, 10), $this->get('request')->query->get('page', 1), 1);

        return array(
            'pagination' => $pagination
        );
    }

    /**
     * Create a basic form
     *
     * @return FormBuilder
     */
    private function createBasicForm()
    {
        return $this->createFormBuilder()
            ->add('email', 'email', array(
                'label' => 'Email address',
                'attr'  => array('placeholder' => 'Enter email', 'class' => 'form-control')
            ))
            ->add('password', 'password', array(
                'attr'  => array('placeholder' => 'Password', 'class' => 'form-control')
            ))
            ->add('file_input', 'file', array(
                'help' => 'Example block-level help text here.'
            ))
            ->add('checkbox', 'checkbox', array(
                'label' => 'Check me out'
            ))
            ->getForm()
        ;
    }

    /**
     * Create an inline form
     *
     * @return FormBuilder
     */
    private function createInlineForm()
    {
        return $this->createFormBuilder()
            ->add('email', 'email', array(
                'label' => false,
                'attr'  => array('placeholder' => 'Enter email', 'class' => 'form-control')
            ))
            ->add('password', 'password', array(
                'label' => false,
                'attr'  => array('placeholder' => 'Password', 'class' => 'form-control')
            ))
            ->add('remember', 'checkbox', array(
                'label' => 'Remember me',
            ))
            ->getForm()
        ;
    }

    /**
     * Create an horizontal form
     *
     * @return FormBuilder
     */
    private function createHorizontalForm()
    {
        return $this->createFormBuilder()
            ->add('email', 'email', array(
                'label_attr'          => array('class' => 'control-label col-sm-2'),
                'widget_wrapper_attr' => array('class' => 'col-sm-10'),
                'attr'                => array('placeholder' => 'Enter email', 'class' => 'form-control')
            ))
            ->add('password', 'password', array(
                'label_attr'          => array('class' => 'control-label col-sm-2'),
                'widget_wrapper_attr' => array('class' => 'col-sm-10'),
                'attr'                => array('placeholder' => 'Password', 'class' => 'form-control')
            ))
            ->add('remember', 'checkbox', array(
                'label'               => 'Remember me',
                'widget_wrapper_attr' => array('class' => 'col-sm-offset-2 col-sm-10'),
            ))
            ->getForm()
        ;
    }

    /**
     * Create a full form
     *
     * @return FormBuilder
     */
    private function createFullForm()
    {
        $choices = array('Choice 1', 'Choice 2', 'Choice 3');

        return $this->createFormBuilder()
            ->add('birthday', 'birthday')
            ->add('checkbox', 'checkbox')
            ->add('choice', 'choice', array(
                'choices' => array_combine($choices, $choices)
            ))
            ->add('choiceExpandedMultiple', 'choice', array(
                'label'    => 'Choice (expanded and multiple)',
                'help'     => 'Renderer as "expanded" and "multiple".',
                'expanded' => true,
                'multiple' => true,
                'choices'  => array_combine($choices, $choices)
            ))
            ->add('choiceExpandedMultipleInline', 'choice', array(
                'label'    => 'Choice (expanded and multiple)',
                'help'     => 'Renderer as "expanded", "multiple" and "inline".',
                'expanded' => true,
                'multiple' => true,
                'inline'   => true,
                'choices'  => array_combine($choices, $choices)
            ))
            ->add('country', 'country')
            ->add('date', 'date', array(
                'help' => 'Rendered as a "choice" widget.'
            ))
            ->add('dateText', 'date', array(
                'widget' => 'text',
                'label'  => 'Date (text)',
                'help'   => 'Rendered as a "text" widget.'
            ))
            ->add('dateSingleText', 'date', array(
                'widget' => 'single_text',
                'label'  => 'Date (single text)',
                'help'   => 'Rendered as a "single_text" widget.'
            ))
            ->add('datetime', 'datetime')
            ->add('email', 'email')
            ->add('hidden', 'hidden')
            ->add('integer', 'integer')
            ->add('language', 'language')
            ->add('locale', 'locale')
            ->add('money', 'money')
            ->add('password', 'password')
            ->add('percent', 'percent')
            ->add('search', 'search')
            ->add('textarea', 'textarea')
            ->add('text', 'text')
            ->add('time', 'time')
            ->add('timezone', 'timezone')
            ->add('url', 'url')
            ->add('file', 'file')
            ->add('currency', 'currency')
            ->getForm()
        ;
    }
}
