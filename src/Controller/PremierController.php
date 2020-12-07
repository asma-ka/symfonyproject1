<?php

namespace App\Controller;

use App\Repository\RdvRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PremierController extends AbstractController
{
    
    public function index(RdvRepository $rdvRepo)
    {
        $statutsRdvCree=$rdvRepo->statu('cree');
        $statutsRdvTraitee=$rdvRepo->status('traitee');
        $totalRdv=$rdvRepo->CountRdv();
        return $this->render('premier/index.html.twig', [
            'controller_name' => 'PremierController',
            'totalRdv'=> $totalRdv,
            'statutsRdvTraitee'=>$statutsRdvTraitee,
            'statutsRdvCree'=>$statutsRdvCree,
        ]);
    }
    
    public function addrdv()
    {
        return $this->render('rdv/add.html.twig', [
            'controller_name' => 'PremierController',
        ]);
    }
}
