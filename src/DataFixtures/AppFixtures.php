<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Rdv;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\Zone;
use App\Entity\Ligne;
use App\Entity\Motif;
use App\Entity\Client;
use App\Entity\Statut;
use App\Entity\TypeLigne;
use App\Entity\Competence;
use App\Entity\Equipement;
use App\Entity\Prestation;
use App\Entity\Prestataire;
use App\Entity\DugreUrgence;
use App\Entity\TypeEquipment;
use App\Entity\TypePrestation;
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
        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $adminUser = new User();
        $adminUser->setPrenom('meryameee')
            ->setNom('kacimi')
            ->setEmail('meryam@gmail.com')
            ->setHash($this->encoder->encodePassword($adminUser, 'admin'))
            ->setPicture('https://avatars.io/facebooc/asma')
            ->setDescription($faker->sentence())
            ->addUserRole($adminRole);
        $manager->persist($adminUser);
        //gerons les competence:
        for ($i = 0; $i < 12; $i++) {
           $competence = new Competence();
           $competence ->setLibelle($faker->sentence())
                       ->setDescription($faker->sentence(5));
        
        $manager->persist($competence);
        }
        //gerons les prestataire:
           
           
        for ($i = 0; $i < 12; $i++) {
            $prestataire = new Prestataire();
            $prestataire  ->setNom($faker->Lastname)
                          ->setPrenom($faker->Firstname)
                          ->setAddress($faker->address)
                          ->setEmail($faker->email)
                          ->setTelephon($faker->e164PhoneNumber)
                          ->setDescription($faker->sentence(2))
                          ->setPrtaireCompc($competence);
        $manager->persist($prestataire);
        }

         //gerons les DugreeUrgence:
        //   for ($i = 0; $i < 8; $i++) {
        //       $dugreUrgence = new DugreUrgence();
        //       $dugreUrgence ->setLibelle($faker->word)
        //                     ->setDescription($faker->sentence(2))
        //                     ->setOrdre($faker->sentence())
        //                     ->setActif($faker->boolean());
        // $manager->persist($dugreUrgence);
        //   }
         //gerons les types des prestations:
         $tprestations = [];
         for ($i = 0; $i < 4; $i++) {
            
              $tprestation = new TypePrestation();
              $tprestation -> setLibelle($faker->word)
                       -> setDescription($faker->sentence())
                       // ->setActif($faker->boolean())
                       -> setOrdre($faker->word);
            $manager->persist($tprestation);
            $tprestations[] =  $tprestation; 
         }
          //gerons les prestation:
          $prestations = [];
          for ($i = 0; $i < 15; $i++) {
              $prestation = new Prestation();
             
              $prestation -> setNumeroPrestation(mt_rand(1, 20))
                          -> setTitre($faker->word)
                          -> setGenre($faker->sentence())
                           -> setDegreeUrgence($faker->word);
                         // -> setPstionDrUrgc($dugreUrgence)
                          //-> setPrstionPrstaire($prestataire) ;
         $manager->persist($prestation); 
         $prestations[] =  $prestation;                
          }

            //nous gerons les TypeEquipement:
            $tpequipments = [];
            for ($i = 0; $i < 4; $i++) {
               
                 $tpequipment = new TypeEquipment();
                 $tpequipment -> setLibelle($faker->word)
                          -> setDescription($faker->sentence())
                          // ->setActif($faker->boolean())
                          -> setOrdre($faker->word);
               $manager->persist($tpequipment);
               $tpequipments[] =  $tpequipment; 
            }
          //nous gerons les Equipement:
           $equipements = [];
          for ($i = 0; $i < 15; $i++) {
              $equipement = new Equipement();
              $equipement -> setAdressMac($faker->macAddress)
                          -> setNumeroSerie(mt_rand(13, 30))
                          -> setGarentie(mt_rand(1, 2))
                          ->  setDateDbGartie($faker->dateTime());
        $manager->persist($equipement);    
        $equipements[] =  $equipement;            
         }
          //Nous gérons les typeLigne:
          $tplignes = [];
         for ($i = 0; $i < 10; $i++) {
            
              $tpligne = new TypeLigne();
              $tpligne -> setLibelle($faker->word)
                       -> setDescription($faker->sentence())
                       ->setActif($faker->boolean())
                       -> setOrdre($faker->word);
            $manager->persist($tpligne);
            $tplignes[] =  $tpligne; 
         }
      // Nous gerons les lignes:
        $lignes = [];
         for ($i = 0; $i < 10; $i++) {
              $ligne = new Ligne();
              $ligne -> setNumerLigne(mt_rand(1, 25))
                     -> setPlanTarifaire(mt_rand(100, 500))
                     -> setDureeEngagement(mt_rand(1, 5));
            $manager->persist($ligne);
            $lignes[] =  $ligne; 
         }
         // Nous gerons les Clients:
         $clients = [];
         for ($i = 0; $i < 10; $i++) {
             $client = new Client();
             $client->setNom($faker->Lastname)
                    ->setPrenom($faker->Firstname)
                    ->setAdress($faker->streetAddress)
                    //->setDateprevisionnelle ( $faker->dateTime())
                    ->setCordonees($faker->sentence(3))
                    ->setTypeIdentification($faker->sentence())
                    ->setNumeroIdentification(mt_rand(111, 330)) 
                    ->setNumeroContrat(mt_rand(405478, 985744)) ;
                    $manager->persist($client);
                    $clients[] =  $client;  
                }
    // Nous gerons les Statut:
       $statuts= [];
       for ($i = 1; $i <= 3
       ; $i++) {
           
        $statut = new Statut();
           $statut  -> setLibelle($faker->word)
                    -> setOrdre($faker->word)
                    -> setDescription($faker->sentence(3));
         $manager->persist($statut);
         $statuts[] = $statut;
       }
       // Nous gerons les motif:
        $motifs= [];
        for ($i = 1; $i <= 9; $i++) {
            $motif = new Motif();

            $motif   -> setLibelle($faker->word)
                     -> setOrdre($faker->word)
                     ->setActif($faker->boolean)
                     -> setDescription($faker->sentence(3)); 
        $manager->persist($motif);
        $motifs[] = $motif;
        }
        // Nous gerons les Zone:
         $zones = [];
        for ($i = 1; $i <= 9; $i++) {
            $zone = new Zone();
             $zone -> setLibelle($faker->word)
                   -> setAddress($faker->address)
                   -> setCodePostal($faker->postcode )
                   -> setDescription($faker->sentence(3)); 
            $manager->persist($zone);
            $zones[] = $zone;
        }

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
// nos gerons les RDV:
        for ($i = 1; $i <= 30; $i++) {
         $rdv = new Rdv();
         $user = $users[mt_rand(0, count($users) - 1)];
         $equipement = $equipements[mt_rand(0, count($equipements) - 1)];
         $client = $clients[mt_rand(0, count($clients) - 1)];
         $ligne = $lignes[mt_rand(0, count($lignes) - 1)];
         $rdv->setNumeroRdv(mt_rand(11, 20))
            // ->setResultat($faker->sentence())
             ->setCommentaire($faker->paragraph(2)) 
             ->setPrix(mt_rand(40, 200)) 
             //->setClientSatisfat($faker->boolean()) 
             ->setDateCreation($faker->word) 
             ->setAuthor($user)
             ->setRdvPrestation($prestation)
             ->setRdvMotif($motif)
             ->setRdvZone($zone)
             ->setRdvLigne($ligne)
             ->setPrestataire($prestataire)
             ->setRdvEqipment($equipement)
             ->setRdvStatus($statut)
             ->setCustomer($client);
            

  
             $manager->persist($rdv);
    }
        $manager->flush();
    }
}
