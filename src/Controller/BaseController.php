<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * home page 
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
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
     * contacts
     * @Route("/contacts/", name="contacts")
     */
    public function contacts(){
        return $this->render('base/contacts.html.twig');
    }

    /**
     * recruitment
     * @Route("/recruitment/", name="recruitment")
     */
    public function recruitment(){
        return $this->render('base/recruitment.html.twig');
    }

    /**
     * legal notice
     * @Route("/legal_notice/", name="legal_notice")
     */
    public function legalNotice(){
        return $this->render('base/legal_notice.html.twig');
    }

}
