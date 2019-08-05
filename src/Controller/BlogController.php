<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * displays all articles about training , diet and stereotypes
     * @Route("/blog", name="blog_list")
     * localhost:8000/blog
     */
    public function blogList()
    {
        return $this->render('blog/all_articles.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * displays articles about training
     * @Route("/blog/training_articles", name="training_articles")
     * localhost:8000/blog/training_articles/
     */
    public function trainingArticles(){
        return $this->render('blog/training_articles.html.twig');
    }

    /**
     * displays articles about diet
     * @Route("/blog/diet_articles", name="diet_articles")
     * localhost:8000/blog/diet_articles/
     */
    public function dietArticles(){
        return $this->render('blog/diet_articles.html.twig');
    }

    /**
     * displays articles about stereotypes
     * @Route("/blog/stereotypes_articles", name="stereotypes_articles")
     * localhost:8000/blog/stereotypes_articles/
     */
    public function stereotypesArticles(){
        return $this->render('blog/stereotypes_articles.html.twig');
    }
}
