<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class ApiSandboxController
 * @package App\Controller\Admin
 * @Route("/admin/api-sandbox", name="admin_api_sandbox_")
 */
class ApiSandboxController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param HttpClientInterface $httpClient
     * @return Response
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function index(HttpClientInterface $httpClient): Response
    {
        $response = $httpClient->request('GET', 'https://api.github.com/users/kiw808/repos', [
            'query' => [
                'sort' => 'created',
            ]
        ]);

        if ($response->getStatusCode() == Response::HTTP_NOT_FOUND) {
            throw new NotFoundHttpException('No repos found');
        } else {
            $repos = $response->toArray();
        }

        return $this->render('admin/api_sandbox/index.html.twig', [
            'repos' => $repos
        ]);
    }

    /**
     * @Route("/{id}", name="show")
     * @param HttpClientInterface $httpClient
     * @param int $id
     * @return Response
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function show(HttpClientInterface $httpClient, int $id) : Response
    {
        $response = $httpClient->request('GET', 'https://api.github.com/repositories/' . $id);

        if ($response->getStatusCode() == Response::HTTP_NOT_FOUND) {
            throw new NotFoundHttpException('No repository found for id ' . $id);
        } else {
            $repo = $response->toArray();
        }

        return $this->render('admin/api_sandbox/show.html.twig', [
            'repo' => $repo
        ]);
    }
}
