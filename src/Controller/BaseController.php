<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    /**
     * home page 
     * @Route("/", name="home")
     */
    public function home(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Article::class);

        $categorie = 'stereotype';
        $latestArticles = $repository->findLatestArticlesExcept($categorie);

        $stereotypeArticle = $repository->findOneBy(
            ['categorie' => 'stereotype'],
            ['addDate' => 'DESC']
        );
        
        

        return $this->render('base/index.html.twig', [
            'latestArticles' => $latestArticles,
            'stereotypeArticle' => $stereotypeArticle,
        ]);
    }

    /**
     * about
     * @Route("/about/", name="about")
     */
    public function about(){
        return $this->render('base/about.html.twig');
    }

    /**
     * 
     * @Route("/cookies/", name="cookies")
     */
    public function cookiesPolicy(){
        return $this->render('base/cookies.html.twig');
    }

    /**
     * legal notice
     * @Route("/legal_notice/", name="legal_notice")
     */
    public function legalNotice(){
        return $this->render('base/legal_notice.html.twig');
    }

    /**
     * home  back-office 
     * @Route("/admin/", name="admin_home")
     */
    public function adminHome()
    {
        return $this->render('base/back_office.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

}
