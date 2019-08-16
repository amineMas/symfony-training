<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * displays all articles about training , diet and stereotypes
     * @Route("/blog", name="blog_list")
     * localhost:8000/blog
     */
    public function blogList()
    {
        //1 retrieve all articles

        $repository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repository->findAll();

        return $this->render('blog/all_articles.html.twig', [
            'articles' => $articles
        ]);
        
    }

    /**
     * displays articles about training
     * @Route("/blog/training_articles", name="training_articles")
     * localhost:8000/blog/training_articles/
     */
    public function trainingArticles(){

        $repository = $this->getDoctrine()->getRepository(Article::class);

        // we search articles with categorie : training
        $trainingArt = $repository->findBy(
            ['categorie' => 'entrainement']
        );

        return $this->render( 'blog/training_articles.html.twig', ['articles' => $trainingArt] );

    }

    /**
     * displays articles about diet
     * @Route("/blog/diet_articles", name="diet_articles")
     * localhost:8000/blog/diet_articles/
     */
    public function dietArticles(){

        $repository = $this->getDoctrine()->getRepository(Article::class);

        // we search articles with categorie : diet
        $trainingDiet = $repository->findBy(
            ['categorie' => 'nutrition']
        );
            

        return $this->render('blog/diet_articles.html.twig', ['articles' => $trainingDiet] );

    }

    /**
     * displays articles about stereotypes
     * @Route("/blog/stereotypes_articles", name="stereotypes_articles")
     * localhost:8000/blog/stereotypes_articles/
     */
    public function stereotypesArticles(){

        $repository = $this->getDoctrine()->getRepository(Article::class);

        // we search articles with categorie : stereotype
        $trainingStereo = $repository->findBy(
            ['categorie' => 'stereotype']
        );

        return $this->render('blog/stereotypes_articles.html.twig', ['articles' => $trainingStereo ]);
    }

    /**
     * 
     * @Route("/")
     */
}
