<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Ticket;
use App\Entity\TypeVisite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('montant')
            ->add('typeVisite', EntityType::class, [
                'class' => TypeVisite::class,
                'choice_label' => 'libelle',
                'placeholder' => '',
                'required'=>false
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}
