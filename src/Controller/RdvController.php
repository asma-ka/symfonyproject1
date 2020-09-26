<?php

namespace App\Controller;

use App\Entity\Rdv;
use App\Form\RdvType;
use App\Entity\Client;
use App\Entity\TypeLigne;
use App\Entity\Prestataire;
use App\Entity\TypeEquipment;
use App\Entity\TypePrestation;
use App\Repository\RdvRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/rdv")
 */
class RdvController extends AbstractController
{
    /**
     * @Route("/", name="rdv_index", methods={"GET"})
     */
    public function index(RdvRepository $rdvRepository): Response
    {
        return $this->render('rdv/index.html.twig', [
            'rdvs' => $rdvRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="rdv_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        
        //$form = $this->createForm(RdvType::class, $rdv);
        //$form->handleRequest($request);
        $clients = $this->getDoctrine()->getRepository(Client::class)->findAll();
        $prestataires = $this->getDoctrine()->getRepository(Prestataire::class)->findAll();
         $tpequits = $this->getDoctrine()->getRepository(TypeEquipment::class)->findAll();
         $tpprestations = $this->getDoctrine()->getRepository(TypePrestation::class)->findAll();
         $tplignes = $this->getDoctrine()->getRepository(TypeLigne::class)->findAll();
        
         if ($request->getMethod() == "POST"){
            $entityManager = $this->getDoctrine()->getManager();
            $rdv = new Rdv();
            // $rdv->setNumeroContrat($request->get('numcont'));
            // $rdv->setAdress($request->get('adresnam'));
            // $client->setCordonees($request->get('cordonnee'));
      
           // $rdv->setAuthor($request->get('nuser'));
            // $prestataire= $this->getDoctrine()->getRepository(Prestataire::class)->find($request->request->get('prestaire'));
            // $rdv->setPrestataire($prestataire);
            
            
      

            $entityManager->persist($rdv);
            $entityManager->flush();
            


            return $this->redirectToRoute('rdv_index');
        }

        return $this->render('rdv/new.html.twig' ,[
            //   'rdv' => $rdv,
              'clients' => $clients,
              'tpequits'=>$tpequits,
              'tplignes' => $tplignes,
              'tpprestations' => $tpprestations,
              //'prestataires' => $prestataires,
              //'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rdv_show", methods={"GET"})
     */
    public function show(Rdv $rdv): Response
    {
        return $this->render('rdv/show.html.twig', [
            'rdv' => $rdv,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rdv_edit", methods={"GET","POST"})
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
     * @Route("/{id}", name="rdv_delete", methods={"DELETE"})
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
