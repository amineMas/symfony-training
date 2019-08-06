<?php

namespace App\Controller;

use App\Entity\Training;
use App\Form\TrainingType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminTrainingController extends AbstractController
{
    //CRUD training

    /**
     * list of training in an array
     * @Route("/admin/training", name="admin_training")
     */
    public function trainingList()
    {
        // 1) retrieve all trainingtraining


        // 2) display render
        return $this->render('admin_training/list.html.twig', [
            'controller_name' => 'AdminArticleController',
        ]);
    }

    /**
     * 
     * @Route("/admin/training/add", name="admin_training_add")
     */
    public function trainingAdd(Request $request)
    {
        //create a new object

        //create form

        //traiter info formulaire

        // display render
        return $this->render('admin_training/form.html.twig');
    }

    /**
     * 
     * @Route("/admin/training/update/{id}", name="admin_training_update")
     */
    public function trainingUpdate($id, Request $request)
    {
        //retrieve training you want to update

        //create form

        //traiter info formulaire

        // display render
        return $this->render('admin_training/form.html.twig');
    }

    /**
     * 
     * @Route("/admin/training/delete/{id}", name="admin_training_delete")
     */
    public function trainingDelete($id, Request $request)
    {
        //retrieve training you want to delete ($id)

        //delete product

        // message + redirection
        $this->addFlash('success', 
        'Le programme d\'entraînement' . $id . ' a bien été supprimé');

        return $this->redirectToRoute('admin_training');
    }

}
