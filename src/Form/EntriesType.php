<?php

// src/Form/EntriesType.php
namespace App\Form;

use App\Entity\Entries;
use App\Entity\Recommend;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class EntriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('headline', TextType::class, ["attr" => ["placeholder" => "please tell us the blog post titel", "class" => "form-control mb-2"]])
            ->add('bloggerName', TextType::class, ["attr" => ["placeholder" => "Enter your Name", "class" => "form-control mb-2"]])
            ->add('destination', TextType::class, ["attr" => ["placeholder" => "Destination", "class" => "form-control mb-2"]])
            ->add('story', TextareaType::class, ["attr" => ["placeholder" => "Write your story here", "class" => "form-control mb-2"]])
            ->add('visitDate', DateType::class, ["attr" => ["class" => "form-control mb-2"]])
            ->add('entryDate', DateType::class, ["attr" => ["class" => "form-control mb-2"]])
            ->add('fk_recommend', EntityType::class, [
                'class' => Recommend::class,
                'choice_label' => 'name',
                'attr' => ["class" => "form-control mb-2"]
            ])
            ->add('Send', SubmitType::class, ["attr" => ["class" => "btn btn-primary"]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entries::class
        ]);
    }
}
