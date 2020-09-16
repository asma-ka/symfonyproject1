<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\UnicodeString;

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

    
    // public function new(Request $request): Response
    // {
    //     $client = new Client();
    //     $form = $this->createForm(ClientType::class, $client);

    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $request->isMethod('POST') && $form->isValid()) {

    //         $date = $request ->request->get('datepr');
    //         $name = $request->request->get('nom');
    //         $typeIdentification = $request->request->get('typeIdenti');
    //         $numeroIdentification = $request->request->get('numid');
    //         $numeroContrat = $request->request->get('numcont');
    //         $address = $request->request->get('adresnam');
    //         $cordonees = $request->request->get('cordnam');
    //         $prenom = $request->request->get('renom');

    //         $date = new \DateTime($date);

    //         $client->setTypeIdentification($typeIdentification);
    //         $client->setNumeroIdentification($numeroIdentification);
    //         $client->setNumeroContrat($numeroContrat);
    //         $client->setDateprevisio($date->format('d/m/Y'));
    //         $client->setAdress($address);
    //         $client->setCordonees($cordonees);
    //         $client->setPrenom($prenom);
    //         $client->setNom($name);

    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($client);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('client_index');
    //     }
    //   return $this->render('client/new.html.twig', [
    //         'client' => $client
    //         , 'form' => $form->createView(),
    //     ]);
    // }
    /**
     * @Route("/new", name="client_new")
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
     * @Route("/{id}/edit", name="client_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Client $client): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('client_index');
        }

        return $this->render('client/edit.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="client_delete", methods={"DELETE"})
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
