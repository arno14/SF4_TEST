<?php

namespace App\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormNoHTML5ValidationExtension extends AbstractTypeExtension
{
    public static function getExtendedTypes(): iterable
    {
        return [
            FormType::class,
        ];
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        if ($view->parent instanceof FormView) {
            return;
        }

        $view->vars['attr']['novalidate'] = 'novalidate'; //désactivation validation JS
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // echo '<br/>     configureOptions CustomFormExtension';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // echo '<br/>buildForm CustomFormExtension, name=', $builder->getName();
    }
}
