<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserType extends AbstractType

{
    /**
     * Permet d'avoir la configuration de base d'un champ !
     *
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     */
    protected function getConfiguration($label, $placeholder, $options = []) {
        return array_merge_recursive([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ], $options);
              }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,$this->getConfiguration("nom", "Votre nom ..."))
            ->add('prenom',TextType::class,$this->getConfiguration("Prénom", "Votre prénom ..."))
            ->add('email',EmailType::class, $this->getConfiguration("Email", "Votre adresse email"))
            // ->add('hash')
            ->add('picture',UrlType::class, $this->getConfiguration("Photo de profil", "URL de votre avatar ..."))
            ->add('description', TextareaType::class, $this->getConfiguration("description", "Présentez vous en quelques mots ..."))
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    
                    'Admin' => 'ROLE_ADMIN',
                    'Ressource' => 'ROLE_Ressource',
                    'ST-Fixe' => 'ROLE_ST-Fixe',
                    'BO intervention' => 'ROLE_BO intervention',
                    
                ],
                'expanded'  => true, // liste déroulante
                'multiple'  => true, // choix multiple

            ])

            //$builder->add('userRoles',EntityType::class,[
                //'class'=> Role::class,
            //])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
