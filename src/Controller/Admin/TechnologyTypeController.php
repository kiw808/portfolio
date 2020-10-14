<?php

namespace App\Controller\Admin;

use App\Entity\TechnologyType;
use App\Form\TechnologyTypeType;
use App\Repository\TechnologyTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/technologytype", name="admin_technology_type_")
 */
class TechnologyTypeController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     * @param TechnologyTypeRepository $technologyTypeRepository
     * @return Response
     */
    public function index(TechnologyTypeRepository $technologyTypeRepository): Response
    {
        return $this->render('admin/technology_type/index.html.twig', [
            'technology_types' => $technologyTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $technologyType = new TechnologyType();
        $form = $this->createForm(TechnologyTypeType::class, $technologyType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($technologyType);
            $entityManager->flush();

            return $this->redirectToRoute('admin_technology_type_index');
        }

        return $this->render('admin/technology_type/new.html.twig', [
            'technology_type' => $technologyType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     * @param TechnologyType $technologyType
     * @return Response
     */
    public function show(TechnologyType $technologyType): Response
    {
        return $this->render('admin/technology_type/show.html.twig', [
            'technology_type' => $technologyType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param TechnologyType $technologyType
     * @return Response
     */
    public function edit(Request $request, TechnologyType $technologyType): Response
    {
        $form = $this->createForm(TechnologyTypeType::class, $technologyType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_technology_type_index');
        }

        return $this->render('admin/technology_type/edit.html.twig', [
            'technology_type' => $technologyType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @param Request $request
     * @param TechnologyType $technologyType
     * @return Response
     */
    public function delete(Request $request, TechnologyType $technologyType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$technologyType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($technologyType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_technology_type_index');
    }
}
