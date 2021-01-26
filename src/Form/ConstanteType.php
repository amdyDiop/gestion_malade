<?php

namespace App\Form;

use App\Entity\Constante;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConstanteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tension')
            ->add('pression')
            ->add('pouls')
            ->add('temperature')
            ->add('infirmier')
            ->add('patient')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Constante::class,
        ]);
    }
}
