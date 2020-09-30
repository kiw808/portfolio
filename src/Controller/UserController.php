<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     * @param UserRepository $repo
     * @return Response
     */
    public function index(UserRepository $repo)
    {
        $user = $repo->find(1);

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
        ]);
    }
}
