<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Rdv;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        //Nous gérons les utilisateurs
       $users = [];
    $genres = ['male', 'female'];

       for ($i = 1; $i <= 10; $i++) {
           $user = new User();

           $genre = $faker->randomElement($genres);

           $picture = 'https://randomuser.me/api/portraits/';
           $pictureId = $faker->numberBetween(1, 99) . '.jpg';

           $picture .= ($genre == 'male' ? 'men/' : 'women/') . $pictureId;
           $hash = $this->encoder->encodePassword($user, 'password');
           $user->setPrenom($faker->firstname($genre))
          
               ->setNom($faker->lastname)
               ->setEmail($faker->email)
               ->setDescription($faker->sentence())
               ->setHash($hash)
               ->setPicture($picture);
            $manager->persist($user);
            $users[] = $user;
        }

        for ($i = 1; $i <= 30; $i++) {
         $rdv = new Rdv();
         $user = $users[mt_rand(0, count($users) - 1)];
         $rdv->setNumeroRdv(mt_rand(11, 20))
             ->setResultat($faker->sentence())
             ->setCommentaire($faker->paragraph(2)) 
             ->setPrix(mt_rand(40, 200)) 
             ->setClientSatisfat($faker->boolean()) 
             ->setSignature($faker->sentence()) 
             ->setAuthor($user);
            





         $manager->persist($rdv);
    }
        $manager->flush();
    }
}
