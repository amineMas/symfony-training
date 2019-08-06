<?php

namespace App\Controller;

use App\Entity\User;
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


        // 2) display render
        return $this->render('admin_user/list.html.twig', [
            'controller_name' => 'AdminuserController',
        ]);
    }

    /**
     * 
     * @Route("/admin/user/add", name="admin_user_add")
     */
    public function userAdd(Request $request)
    {
        //create a new object

        //create form

        //traiter info formulaire

        // display render
        return $this->render('admin_user/form.html.twig');
    }

    /**
     * 
     * @Route("/admin/user/update/{id}", name="admin_user_update")
     */
    public function userUpdate($id, Request $request)
    {
        //retrieve user you want to update

        //create form

        //traiter info formulaire

        // display render
        return $this->render('admin_user/form.html.twig');
    }

    /**
     * 
     * @Route("/admin/user/delete/{id}", name="admin_user_delete")
     */
    public function userDelete($id, Request $request)
    {
        //retrieve user you want to delete ($id)

        //delete product

        // message + redirection
        $this->addFlash('success', 
        'L\'user' . $id . ' a bien été supprimé');

        return $this->redirectToRoute('admin_user');
    }
}
