<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminArticleController extends AbstractController
{
    //CRUD Article

    /**
     * list of article in an array
     * @Route("/admin/article", name="admin_article")
     */
    public function articleList()
    {
        // 1) retrieve all articles

        $repository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repository->findAll();

        // 2) display render
        return $this->render('admin_article/list.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * 
     * @Route("/admin/article/add", name="admin_article_add")
     */
    public function articleAdd(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //create a new object
        $article = new Article();
        
        //create form
        $form = $this->createForm(ArticleType::class, $article);
        //traiter info formulaire
        $form->handleRequest($request);

        if($form -> isSubmitted() && $form -> isValid()){

            $image = $article->getImage();
            $imageName = md5(uniqid()).'.'.$image->guessExtension();
            $image->move($this->getParameter('upload_directory'), $imageName);
            $article->setImage($imageName);

            $em-> persist($article);
            $em -> flush(); // Exécute l'insertion en BDD
            
            $this -> addFlash('success', 'L\'article '. $article -> getTitle() . ' a bien été ajouté');
            return $this -> redirectToRoute('admin_article');
        } 

        // display render
        return $this->render('admin_article/form.html.twig',[
            'articleForm' => $form -> createView(),
        ]);
    }

    /**
     * 
     * @Route("/admin/article/update/{id}", name="admin_article_update")
     */
    public function articleUpdate($id, Request $request)
    {
        //retrieve article you want to update
        $em = $this->getDoctrine()->getManager();
        $article = $em->find(Article::class,$id);
        //create form
        $form = $this->createForm(ArticleType::class, $article);
        //traiter info formulaire
        $form->handleRequest($request);

        if($form -> isSubmitted() && $form -> isValid()){
            $em-> persist($article);
            
            $em -> flush(); // Exécute l'insertion en BDD
            
            $this -> addFlash('success', 'L\'article '. $article -> getTitle() . ' a bien été modifié');
            return $this -> redirectToRoute('admin_article');
            }    
        // display render
        return $this->render('admin_article/form.html.twig',[
            'articleForm' => $form -> createView(),
        ]);
    }

    /**
     * 
     * @Route("/admin/article/delete/{id}", name="admin_article_delete")
     */
    public function articleDelete($id, Request $request)
    {
        //retrieve article you want to delete ($id)
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->find($id);

        //delete article
        $em->remove($article);
        $em->flush();

        // message + redirection
        $this->addFlash('success', 
        'L\'article' . $id . ' a bien été supprimé');

        return $this->redirectToRoute('admin_article');
    }

}
