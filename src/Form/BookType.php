<?php

namespace App\Form;

use App\Entity\Book;
use Doctrine\ORM\Mapping\Entity;
use PhpParser\Node\Stmt\Break_;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Valid;

class BookType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                // ->add('title')
                ->add('title',null, ['attr'=>['title'=>'Blah Blah']])
                ->add('publicationDate')
                ->add('ISBN')
                ->add('author',null,[
                    'required'=>false
                ])
                // ->add('author',null, ['required'=>true, 'attr'=>['required'=>true, 'class'=>'nothing']])
                // ->add('author',EntityType::class, [
                //     'class'=>"App\Entity\Author",
                //     'required'=>false
                // ])
                ->add('categories', null, ['expanded' => true])
        ;

        switch($options['app_mode']){
            case 'inside_author_form':
                $builder->remove('author');
                break;
                
            case 'include_author_form':
                $builder->add('author', AuthorType::class, [
                    'app_mode'=>'inside_book_form',
                    'constraints'=>new Valid()
                ]);
                break;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
            'app_mode'=>null
        ]);

        $resolver->setAllowedValues('app_mode',[
            null,
            'inside_author_form', 
            'include_author_form'
        ]);
    }

}
