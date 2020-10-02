<?php

namespace App\Form;

use App\Entity\Search;
use App\Entity\Prestataire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
            //$builder ->add('prestataire', TextType::class, [
            //     'required'=> false,
            //     'label'=> false,
            //     'attr' =>[
            //         'placeholder' => 'nom prestataire'
            //     ]
            // ])
            $builder ->add('prestataire',EntityType::class,['class' => Prestataire::class,
                        'required'=> false,
                        'choice_label' => 'prenom' ,
                        'placeholder' =>' ',
                        'label' => 'Prestatire' ]);
            //$builder->add('dateCreation', TextType::class, [
            //     'required'=> false,
            //     'label'=> false,
            //     'attr' =>[
            //         'placeholder' => 'la date de cration'
            //     ]
            // ])
            

            $builder ->add('numeroRdv',IntegerType::class, [
                'required'=> false,
                'label' => 'Numero de Rendez Vous',
                'attr' =>[
                    'placeholder' => 'numero de rendez vous'
                ]
            ]);
              
                }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'get',
            'csrf-protector' => false
        ]);
    }
}
