<?php

namespace App\Controller\Front;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="front_blog_index")
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function index(ArticleRepository $articleRepository) : Response
    {
        $articles = $articleRepository->findAll();

        return $this->render('front/blog/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/blog/article/{id}", name="front_article_show")
     * @param ArticleRepository $articleRepository
     * @param Int $id
     * @return Response
     */
    public function show(ArticleRepository $articleRepository, Int $id) : Response
    {
        $article = $articleRepository->find($id);

        return $this->render('front/blog/article.html.twig', [
            'article' => $article,
        ]);
    }
}
