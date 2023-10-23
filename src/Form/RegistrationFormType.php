<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\AdressType;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Votre nom'
                ]
            ])
            ->add('firstName', null, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Votre prénom'
                ]
            ])
            ->add('mail',EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Votre email'
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => [
                    'placeholder' => 'Votre mot de passe'
                ]
            ])
            ->add('adress',AdressType::class, [
                'label' => 'Adresse',
                'attr' => [
                    'placeholder' => 'Votre adresse'
                ]
            ])
            ->add('city', null, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Votre ville'
                ]
            ])
            ->add('zipCode', null, [
                'label' => 'Code postal',
                'attr' => [
                    'placeholder' => 'Votre code postal'
                ]
            ])
            ->add('createdAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
