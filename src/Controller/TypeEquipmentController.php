<?php

namespace App\Controller;

use App\Entity\TypeEquipment;
use App\Form\TypeEquipmentType;
use App\Repository\TypeEquipmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/equipment")
 */
class TypeEquipmentController extends AbstractController
{
    /**
     * @Route("/", name="type_equipment_index", methods={"GET"})
     */
    public function index(TypeEquipmentRepository $typeEquipmentRepository): Response
    {
        return $this->render('type_equipment/index.html.twig', [
            'type_equipments' => $typeEquipmentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_equipment_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeEquipment = new TypeEquipment();
        $form = $this->createForm(TypeEquipmentType::class, $typeEquipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeEquipment);
            $entityManager->flush();

            return $this->redirectToRoute('type_equipment_index');
        }

        return $this->render('type_equipment/new.html.twig', [
            'type_equipment' => $typeEquipment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_equipment_show", methods={"GET"})
     */
    public function show(TypeEquipment $typeEquipment): Response
    {
        return $this->render('type_equipment/show.html.twig', [
            'type_equipment' => $typeEquipment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_equipment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeEquipment $typeEquipment): Response
    {
        $form = $this->createForm(TypeEquipmentType::class, $typeEquipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_equipment_index');
        }

        return $this->render('type_equipment/edit.html.twig', [
            'type_equipment' => $typeEquipment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_equipment_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeEquipment $typeEquipment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeEquipment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeEquipment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_equipment_index');
    }
}
