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
        $repository = $this->getDoctrine()->getRepository(Training::class);
        $trainings = $repository->findAll();

        // 2) display render
        return $this->render('admin_training/list.html.twig', [
            'trainings' => $trainings,
        ]);
    }

    /**
     * 
     * @Route("/admin/training/add", name="admin_training_add")
     */
    public function trainingAdd(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //create a new object
        $training = new Training();
        
        //create form
        $form = $this->createForm(TrainingType::class, $training);
        //traiter info formulaire
        $form->handleRequest($request);

        if($form -> isSubmitted() && $form -> isValid()){
            $em-> persist($training);
                
            $em -> flush(); // Exécute l'insertion en BDD
            
            $this -> addFlash('success', 'L\'entraînement '. $training -> getName() . ' a bien été ajouté');
            return $this -> redirectToRoute('admin_training');
        } 

        // display render
        return $this->render('admin_training/form.html.twig',[
            'trainingForm' => $form -> createView(),
        ]);
    }

    /**
     * 
     * @Route("/admin/training/update/{id}", name="admin_training_update")
     */
    public function trainingUpdate($id, Request $request)
    {
        //retrieve training you want to update
        $em = $this->getDoctrine()->getManager();
        $training = $em->find(Training::class,$id);
        //create form
        $form = $this->createForm(TrainingType::class, $training);
        //traiter info formulaire
        $form->handleRequest($request);

        if($form -> isSubmitted() && $form -> isValid()){
            $em-> persist($training);
                
            $em -> flush(); // Exécute l'insertion en BDD
            
            $this -> addFlash('success', 'L\'entraînement '. $training -> getName() . ' a bien été modifié');
            return $this -> redirectToRoute('admin_training');
            }    
        // display render
        return $this->render('admin_training/form.html.twig',[
            'trainingForm' => $form -> createView(),
        ]);
    }

    /**
     * 
     * @Route("/admin/training/delete/{id}", name="admin_training_delete")
     */
    public function trainingDelete($id, Request $request)
    {
        //retrieve training you want to delete ($id)
        $em = $this->getDoctrine()->getManager();
        $training = $em->getRepository(Training::class)->find($id);

        //delete training
        $em->remove($training);
        $em->flush();

        // message + redirection
        $this->addFlash('success', 
        'L\'entraînement n° ' . $id . ' a bien été supprimé');

        return $this->redirectToRoute('admin_training');
    }
    
}
