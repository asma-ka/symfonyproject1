<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/client")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/", name="client_index", methods={"GET"})
     */
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }

    
   
    /**
     * @Route("/new", name="client_new")
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request)
    {
  
        if ($request->getMethod() == "POST"){
            $entityManager = $this->getDoctrine()->getManager();
            $client = new Client();


            $client->setNom($request->get('nom'));
            $client->setPrenom($request->get('prenom'));
            $client->setTypeIdentification($request->get('typeIdenti'));
            $client->setNumeroIdentification($request->get('numid'));
            $client->setNumeroContrat($request->get('numcont'));
            $client->setAdress($request->get('adresnam'));
            $client->setCordonees($request->get('cordonnee'));
      

            $entityManager->persist($client);
            $entityManager->flush();
            return $this->redirectToRoute('client_index');


        }

        return $this->render('client/new.html.twig');

    }




    /**
     * @Route("/{id}", name="client_show", methods={"GET"})
     */
    public function show(Client $client): Response
    {
        return $this->render('client/show.html.twig', [
            'client' => $client,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="client_edit",  methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request ,Client $clid){
        $client=$this->getDoctrine()->getRepository(Client::class)->findOneById($clid);
        if ($request->getMethod() == "POST"){
        $nom=$client->getNom();
        $prenom=$client->getPrenom();
        $tpid=$client->getTypeIdentification();
        $nmid=$client->getNumeroIdentification();
        $nmcon=$client->getNumeroContrat();
        $adress=$client->getAdress();
        $cord=$client->getCordonees();
        $em = $this->getDoctrine()->getManager();
            $clt = new Client();
             $clt->setNom($nom);
             $clt->setPrenom($prenom);
             $clt->setTypeIdentification($tpid);
             $clt->setNumeroIdentification($nmid);
             $clt->setNumeroContrat($nmcon);
             $clt->setAdress($adress);
             $clt->setCordonees($cord);

             $clid->setNom($request->get('nom'));
             $clid->setPrenom($request->get('prenom'));
             $clid->setTypeIdentification($request->get('typeIdenti'));
             $clid->setNumeroIdentification($request->get('numid'));
             $clid->setNumeroContrat($request->get('numcont'));
             $clid->setAdress($request->get('adresnam'));
             $clid->setCordonees($request->get('cordonnee'));
         
                $em->persist($clt);
                $em->flush();
                return $this->redirectToRoute('client_index');
        
          }

        return $this->render('client/edit.html.twig',[
            'client' => $client,
        ]);

    }

    /**
     * @Route("/{id}", name="client_delete", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, Client $client): Response
    {
        if ($this->isCsrfTokenValid('delete' . $client->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('client_index');
    }
}
