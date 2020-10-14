<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Project;
use App\Entity\Technology;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('type', ChoiceType::class, [
                'placeholder' => '-- Type --',
                'choices' => [
                    'Front-end' => 'Front-end',
                    'Back-end' => 'Back-end',
                    'Application' => 'Application',
                    'Website' => 'Website',
                    'API' => 'API'
                ],
                'expanded' => false,
                'multiple' => true
            ])
            ->add('year', DateType::class)
            ->add('url', TextType::class)
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'placeholder' => '-- Client --',
                'choice_label' => 'name'
            ])
            ->add('technologies', EntityType::class, [
                'class' => Technology::class,
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
