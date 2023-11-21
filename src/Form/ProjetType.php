<?php

namespace App\Form;

use App\Entity\Projet;
use App\Entity\Categorie;
use App\Form\ProjetImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'required' => true,
                'sanitize_html' => true,
                'attr' => [
                    'placeholder' => 'title...'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Content',
                'required' => true,
                'sanitize_html' => true,
                'attr' => [
                    'placeholder' => 'content...',
                    'rows' => 5,
                ]
            ])
            ->add('image', VichImageType::class, [
                'label' => 'Image:',
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Supprimer l\'image',
                'image_uri' => true,
                'download_uri' => false,
            ])
            ->add('categories', EntityType::class, [
                'label' => 'Catégories:',
                'class' => Categorie::class,
                'choice_label' => 'title',
                'expanded' => false,
                'multiple' => true,
                'autocomplete' => true,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Projet::class,
            'translation_domain' => 'form',
        ]);
    }
}
