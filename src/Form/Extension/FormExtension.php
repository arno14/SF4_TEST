<?php

namespace App\Form\Extension;

use Symfony\Component\Form\FormView;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\FormType;

class FormExtension extends AbstractTypeExtension
{
    public static function getExtendedTypes():iterable
    {
        return [
            FormType::class
        ];
    }


    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        if($view->parent instanceof FormView){
            return;
        }

        $view->vars['attr']['novalidate']='novalidate';//désactivation validation JS
    }
}