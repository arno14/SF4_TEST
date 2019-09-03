<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Form\Transformer\ArrayToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TextType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Valid;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('birthDate')
            ->add('deathDate')
            ->add('emails', TextType::class)
        ;

        $builder->get('emails')->addModelTransformer(new ArrayToStringTransformer());

        if( 'include_books_forms' === $options['app_mode']){
            
            $builder->add('books', CollectionType::class, [
                'allow_add'=>true,
                'allow_delete'=>true,
                'entry_type'=>BookType::class,
                'entry_options'=>[
                    'app_mode'=>'inside_author_form',
                    'empty_data'=>function(Form $form){
                        $collectionForm = $form->getParent();
                        $authorForm = $collectionForm->getParent();
                        $author = $authorForm->getData();
                        $book = new Book();
                        $book->setAuthor($author);
                        return $book;
                    }
                ],
                'constraints'=>new Valid()
            ]);

        }       
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
            'app_mode'=> null
        ]);
        $resolver->setAllowedValues('app_mode',[
            null,
            'include_books_forms',
            'inside_book_form', 
        ]);
    }
}
