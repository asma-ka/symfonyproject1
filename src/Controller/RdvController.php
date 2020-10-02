<?php

namespace App\Controller;

use App\Entity\Rdv;
use App\Entity\Zone;
use App\Entity\Motif;
use App\Form\RdvType;
use App\Entity\Client;
use App\Entity\Search;
use App\Form\SearchType;
use App\Entity\TypeLigne;
use App\Entity\Prestataire;
use App\Entity\TypeEquipment;
use App\Entity\TypePrestation;
use App\DBAL\Types\RdvStatuType;
use App\Repository\RdvRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class RdvController extends AbstractController
{
    /**
     * @Route("/rdv", name="rdv_index", methods={"GET"})
     */
    public function index(RdvRepository $rdvRepository ,Request $request): Response
    {
        
            $search = new Search();
            $form = $this->createForm(SearchType::class,$search);
            $form->handleRequest($request);
            //initialement le tableau des articles est vide,
            //c.a.d on affiche les articles que lorsque l'utilisateur
            //clique sur le bouton rechercher
            $rdvs= [];
           
            if($form->isSubmitted() && $form->isValid()) {
            
            //$prestataire = $search->getPrestataire();
            $numeroRdv = $search->getNumeroRdv();
            if ($numeroRdv!=""  )
           
            $rdvs= $this->getDoctrine()->getRepository(Rdv::class)
             ->findBy(['numeroRdv' => $numeroRdv]);
            else
            
            $rdvs= $this->getDoctrine()->getRepository(Rdv::class)
            ->findAll();
            }
            return $this->render('rdv/index.html.twig',[ 
                'form' =>$form->createView(),
                'rdvs' => $rdvs

            ]);
        // ******
        // return $this->render('rdv/index.html.twig', [
        //     'rdvs' => $rdvRepository->findAll(),
        // ]);
    }

    /**
     * @Route("rdv/new", name="rdv_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
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
     * @IsGranted("ROLE_USER")
     */
    public function show(Rdv $rdv): Response
    {
        return $this->render('rdv/show.html.twig', [
            'rdv' => $rdv,
        ]);
    }

    /**
     * @Route("rdv/{id}/edit", name="rdv_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Rdv $rdv): Response
    {
        $form = $this->createForm(RdvType::class, $rdv);
        $form->handleRequest($request);
        
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
    
                return $this->redirectToRoute('rdv_index');
            }
    
            return $this->render('rdv/edit.html.twig', [
                'rdv' => $rdv,
                'form' => $form->createView(),
            ]);
        
    }

    /**
     * @Route("rdv/{id}", name="rdv_delete", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
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


     /**
     * @Route("/intervention", name="intervention_index", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function indexinter(RdvRepository $rdvRepository): Response
    {
        return $this->render('intervention/index.html.twig', [
            'rdvs' => $rdvRepository->findAll(),
        ]);
    }

    /**
     * @Route("intervention/new", name="intervention_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function newInter(Request $request): Response
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
            $rdv->setRdvStatus(RdvStatuType::TRAITEE);
            $rdv->setnumeroRdv($numRdv);
    $prestataire= $this->getDoctrine()->getRepository(Prestataire::class)->find($request->request->get('prestaire'));
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
            


            return $this->redirectToRoute('intervention_index');
        }
        return $this->render('intervention/new.html.twig' ,[
            'numRdv' => $numRdv,
            'motifs' =>$motifs,
             'zones' => $zones,
              'clients' => $clients,
              'tpequits'=>$tpequits,
              'tplignes' => $tplignes,
              'tpprestations' => $tpprestations,
              'prestataires' => $prestataires,
              //'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("intervention/{id}", name="intervention_show", methods={"GET"})
     */
    public function showInter(Rdv $rdv): Response
    {
        return $this->render('intervention/show.html.twig', [
            'rdv' => $rdv,
        ]);
    }
    /**
     * @Route("intervention/{id}/edit", name="intervention_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function editinter(Request $request, Rdv $rdv): Response
    {
        $form = $this->createForm(RdvType::class, $rdv);
        $form->handleRequest($request);
        
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
    
                return $this->redirectToRoute('intervention_index');
            }
    
            return $this->render('intervention/edit.html.twig', [
                'rdv' => $rdv,
                'form' => $form->createView(),
            ]);
        
    }


}
