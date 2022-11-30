<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
               
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
               
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                
            ])
            ->add('sujet', TextType::class, [
                'label' => 'Sujet',
                
            ])
             ->add('captcha',ReCaptchaType::class, [
                'label' => 'Captcha',
                'required' => true,
                'attr' => [
                    'style' => 'margin : auto',
                ],
                
            ]) 
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'attr' => [
                    'rows' => 10,
                ],
               
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
