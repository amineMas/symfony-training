<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrainingController extends AbstractController
{
    /**
     * displays all trainings
     * @Route("/training_programs/", name="training_programs")
     * localhost:8000/training_programs/
     */
    public function trainingPrograms()
    {
        return $this->render('training/training_programs.html.twig', [
            'controller_name' => 'TrainingController',
        ]);
    }

    /**
     * displays training to lose weight
     * @Route("/training_programs/weight_loss/", name="weight_loss")
     * localhost:8000/training_programs/weight_loss/
     */
    public function weightLoss()
    {
        return $this->render('training/weight_loss.html.twig');

    }

    /**
     * displays training to gain muscle
     * @Route("/training_programs/muscle_gain/", name="muscle_gain")
     * localhost:8000/training_programs/muscle_gain/
     */
    public function muscleGain()
    {
        return $this->render('training/muscle_gain.html.twig');

    }

    /**
     * displays training to keep fit
     * @Route("/training_programs/keep_fit/", name="keep_fit")
     * localhost:8000/training_programs/keep_fit/
     */
    public function keepFit()
    {
        return $this->render('training/keep_fit.html.twig');

    }


}
