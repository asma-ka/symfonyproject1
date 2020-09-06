<?php

namespace App\Controller;

use App\Entity\Rdv;
use App\Repository\RdvRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RdvController extends AbstractController
{
    /**
     * afficher les rdv
     * 
     * @Route("/rdvs", name="rdv_index")
     */
    public function afficher(RdvRepository $repo)
    {
        $rdvs = $repo->findAll();
            return $this->render('rdv/show.html.twig', [
                'rdvs' => $rdvs,
            ]);
            
        }
    
}
