<?php

namespace App\Controller\Front;

use App\Repository\TechnologyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="front_home")
     * @param TechnologyRepository $technologyRepository
     * @return Response
     */
    public function index(TechnologyRepository $technologyRepository) : Response
    {
        $technos = $technologyRepository->findAll();

        return $this->render('front/home/index.html.twig', [
            'technos' => $technos,
        ]);
    }
}
