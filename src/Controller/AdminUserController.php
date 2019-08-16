<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminUserController extends AbstractController
{
    //CRUD user

    /**
     * list of user in an array
     * @Route("/admin/user", name="admin_user")
     */
    public function userList()
    {
        // 1) retrieve all users
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();

        // 2) display render
        return $this->render('admin_user/list.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * 
     * @Route("/admin/user/add", name="admin_user_add")
     */
    public function userAdd(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //create a new object
        $user = new User();
        
        //create form
        $form = $this->createForm(UserType::class, $user);
        //traiter info formulaire
        $form->handleRequest($request);

        if($form -> isSubmitted() && $form -> isValid()){
            $em-> persist($user);
                
            $em -> flush(); // Exécute l'insertion en BDD
            
            $this -> addFlash('success', 'Le membre '. $user -> getUsername() . ' a bien été ajouté');
            return $this -> redirectToRoute('admin_user');
        } 

        // display render
        return $this->render('admin_user/form.html.twig',[
            'userForm' => $form -> createView(),
        ]);
    }

    /**
     * 
     * @Route("/admin/user/update/{id}", name="admin_user_update")
     */
    public function userUpdate($id, Request $request)
    {
        //retrieve user you want to update
        $em = $this->getDoctrine()->getManager();
        $user = $em->find(User::class,$id);
        //create form
        $form = $this->createForm(UserType::class, $user);
        //traiter info formulaire
        $form->handleRequest($request);

        if($form -> isSubmitted() && $form -> isValid()){
            $em-> persist($user);
                
            $em -> flush(); // Exécute l'insertion en BDD
            
            $this -> addFlash('success', 'L\'entraînement '. $user -> getUsername() . ' a bien été modifié');
            return $this -> redirectToRoute('admin_user');
            }    
        // display render
        return $this->render('admin_user/form.html.twig',[
            'userForm' => $form -> createView(),
        ]);
    }

    /**
     * 
     * @Route("/admin/user/delete/{id}", name="admin_user_delete")
     */
    public function userDelete($id, Request $request)
    {
        //retrieve user you want to delete ($id)
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);

        //delete user
        $em->remove($user);
        $em->flush();

        // message + redirection
        $this->addFlash('success', 
        'Le membre n° ' . $id . ' a bien été supprimé');

        return $this->redirectToRoute('admin_user');
    }
}
