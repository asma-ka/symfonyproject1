<?php

namespace App\Controller;

use App\Entity\Rdv;
use App\Entity\Zone;
use App\Entity\Motif;
use App\Form\RdvType;
use App\Entity\Client;
use App\Entity\TypeLigne;
use App\Entity\Prestataire;
use App\Entity\TypeEquipment;
use App\Entity\TypePrestation;
use App\DBAL\Types\RdvStatuType;
use App\Repository\RdvRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class RdvController extends AbstractController
{
    /**
     * @Route("/rdv", name="rdv_index", methods={"GET"})
     */
    public function index(RdvRepository $rdvRepository): Response
    {
        return $this->render('rdv/index.html.twig', [
            'rdvs' => $rdvRepository->findAll(),
        ]);
    }

    /**
     * @Route("rdv/new", name="rdv_new", methods={"GET","POST"})
     */
    public function newRdv(Request $request): Response
    {
        
        //$form = $this->createForm(RdvType::class, $rdv);
        //$form->handleRequest($request);
        $clients = $this->getDoctrine()->getRepository(Client::class)->findAll();
        $motifs = $this->getDoctrine()->getRepository(Motif::class)->findAll();
        $zones = $this->getDoctrine()->getRepository(Zone::class)->findAll();
        $prestataires = $this->getDoctrine()->getRepository(Prestataire::class)->findAll();
         $tpequits = $this->getDoctrine()->getRepository(TypeEquipment::class)->findAll();
         $tpprestations = $this->getDoctrine()->getRepository(TypePrestation::class)->findAll();
         $tplignes = $this->getDoctrine()->getRepository(TypeLigne::class)->findAll();
        $lastRdv=$this->getDoctrine()->getRepository(Rdv::class)->findOneBy([],["id"=>"desc"]);
        $numRdv=$lastRdv->getNumeroRdv()+1;
         if ($request->getMethod() == "POST"){
            
            $entityManager = $this->getDoctrine()->getManager();
            $rdv = new Rdv();
            $rdv->setRdvStatus(RdvStatuType::CREE);
            $rdv->setnumeroRdv($numRdv);
     $motif= $this->getDoctrine()->getRepository(Motif::class)->find($request->request->get('motif'));
     $zone= $this->getDoctrine()->getRepository(Zone::class)->find($request->request->get('zone'));
     $client= $this->getDoctrine()->getRepository(Client::class)->find($request->request->get('client'));
     $tpLigne= $this->getDoctrine()->getRepository(TypeLigne::class)->find($request->request->get('tpligne'));
     $tpEqipement= $this->getDoctrine()->getRepository(TypeEquipment::class)->find($request->request->get('tpequipment'));
     $tpPrestation= $this->getDoctrine()->getRepository(TypePrestation::class)->find($request->request->get('tpprestation'));
     $rdv->setCommentaire($request->get('commentaire'));
     $rdv->setNumeroRdv($request->get('nmrdv'));      
      

            $entityManager->persist($rdv);
            $entityManager->flush();
            


            return $this->redirectToRoute('rdv_index');
        }

        return $this->render('rdv/new.html.twig' ,[
            'numRdv' => $numRdv,
            'motifs' =>$motifs,
             'zones' => $zones,
              'clients' => $clients,
              'tpequits'=>$tpequits,
              'tplignes' => $tplignes,
              'tpprestations' => $tpprestations,
              //'prestataires' => $prestataires,
              //'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("rdv/{id}", name="rdv_show", methods={"GET"})
     */
    public function show(Rdv $rdv): Response
    {
        return $this->render('rdv/show.html.twig', [
            'rdv' => $rdv,
        ]);
    }

    /**
     * @Route("rdv/{id}/edit", name="rdv_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rdv $rdv): Response
    {
        $form = $this->createForm(RdvType::class, $rdv);
        $form->handleRequest($request);
     //$prestataires = $this->getDoctrine()->getRepository(Prestataire::class)->findAll();
         $tpequits = $this->getDoctrine()->getRepository(TypeEquipment::class)->findAll();
         $tpprestations = $this->getDoctrine()->getRepository(TypePrestation::class)->findAll();
         $tplignes = $this->getDoctrine()->getRepository(TypeLigne::class)->findAll();
        

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rdv_index');
        }

        return $this->render('rdv/edit.html.twig', [
            'rdv' => $rdv,
            'tpequits'=>$tpequits,
              'tplignes' => $tplignes,
              'tpprestations' => $tpprestations,
              'prestataires' => $prestataires,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("rdv/{id}", name="rdv_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Rdv $rdv): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rdv->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rdv);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rdv_index');
    }
}
