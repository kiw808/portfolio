<?php

namespace App\Controller\Admin;

use App\Entity\Technology;
use App\Form\TechnologyType;
use App\Repository\TechnologyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/technology", name="admin_technology_")
 */
class TechnologyController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     * @param TechnologyRepository $technologyRepository
     * @return Response
     */
    public function index(TechnologyRepository $technologyRepository): Response
    {
        return $this->render('admin/technology/index.html.twig', [
            'technologies' => $technologyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $technology = new Technology();
        $form = $this->createForm(TechnologyType::class, $technology);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($technology);
            $entityManager->flush();

            return $this->redirectToRoute('admin_technology_index');
        }

        return $this->render('admin/technology/new.html.twig', [
            'technology' => $technology,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     * @param Technology $technology
     * @return Response
     */
    public function show(Technology $technology): Response
    {
        return $this->render('admin/technology/show.html.twig', [
            'technology' => $technology,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param Technology $technology
     * @return Response
     */
    public function edit(Request $request, Technology $technology): Response
    {
        $form = $this->createForm(TechnologyType::class, $technology);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_technology_index');
        }

        return $this->render('admin/technology/edit.html.twig', [
            'technology' => $technology,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @param Request $request
     * @param Technology $technology
     * @return Response
     */
    public function delete(Request $request, Technology $technology): Response
    {
        if ($this->isCsrfTokenValid('delete'.$technology->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($technology);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_technology_index');
    }
}
