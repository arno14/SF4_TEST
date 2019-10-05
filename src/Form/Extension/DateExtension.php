<?php

namespace App\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DateExtension extends AbstractTypeExtension
{
    protected $dateFormat;

    public function __construct($myDateFormat)
    {
        $this->dateFormat = $myDateFormat;
    }

    public static function getExtendedTypes(): iterable
    {
        return [
            DateType::class,
        ];
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // return;
        $resolver->setDefaults([
            'html5' => false,
            'widget' => 'single_text',
            'format' => $this->dateFormat,
            'attr' => [
                'title' => 'Please fill date as format '.$this->dateFormat,
            ],
        ]);
    }
}
