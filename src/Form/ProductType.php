<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProductType extends AbstractType
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('media', FileType::class,[
                'mapped' => false,//true par défaut, à mettre false pour pas envoyé direct en bdd pour traité l'image à part (lui donner un nom unique...)
                'required' => false,//car l'image n'est pas obligatoire pour mes articles
                'constraints' => [//limite de taille d'image à 2 megas
                    new File([
                        'maxSize' => '2M'
                    ])
                ]
            ])
            ->add('category', EntityType::class,
            ['class'=>Category::class,
                'choice_label'=>'name',
                /*'choices' => $this->categoryRepository->findBy(["parent"=>null]),
                'placeholder' => ' '*/
                ])
            ->add('soumettre', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
