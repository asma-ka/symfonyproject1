<?php

namespace App\Form;

use App\Entity\Rdv;
use App\Entity\User;
use App\Entity\Client;
use App\Entity\Prestation;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RdvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroRdv')
            
            //->add('author')
            ->add('rdvLigne')
            ->add('rdvEqipment')
            ->add('rdvPrestation')
    //->add('customer')
            ->add('rdvStatus')
           // ->add('rdvMotif')
            //->add('rdvZone')

           //  ->add('customer', EntityType::class, [
                //'class' => Client::class,
            //])
            // ->add('rdvPrestation', ChoiceType::class, [
            //     'action' => Prestation::class,
            //     'choice_label' => 'titre',
            //    'multiple' => false,
            //    'expanded' => false,
              
            // ])
            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rdv::class,
        ]);
    }
}
