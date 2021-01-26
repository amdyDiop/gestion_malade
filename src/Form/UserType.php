<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',TextType::class,[
                'required' => true,
                'invalid_message' => 'Veillez entrez un email valide',
            ])
            ->add('nom',TextType::class,[
                "required"=>true
            ])
            ->add('prenom',TextType::class,[
                "required"=>true
            ])
            ->add('adresse',TextType::class,[
                "required"=>true
            ])->add('telephone',TextType::class,[
                "required"=>true
            ])
            ->add('dateNaiss',BirthdayType::class,[
                "label"=>"date de naissance",
            ])
            ->add('cni',TextType::class,[
                "label"=>"numeéro carte d'identité",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
