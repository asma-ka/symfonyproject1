<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PremierController extends AbstractController
{
    
    public function index()
    {
        return $this->render('premier/index.html.twig', [
            'controller_name' => 'PremierController',
        ]);
    }
    public function addrdv()
    {
        return $this->render('rdv/add.html.twig', [
            'controller_name' => 'PremierController',
        ]);
    }
}
