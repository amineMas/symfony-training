<?php

namespace App\Controller;

use App\Entity\Training;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrainingController extends AbstractController
{
    /**
     * displays all trainings
     * @Route("/training_programs/", name="training_programs")
     * localhost:8000/training_programs/
     */
    public function trainingPrograms()
    {
        // retrieve all training programs from database
        $repository = $this->getDoctrine()->getRepository(Training::class);
        $trainings = $repository->findAll();

        return $this->render('training/training_programs.html.twig', [
            'trainings' => $trainings
        ]);
    }

    /**
     * displays training to lose weight
     * @Route("/training_programs/weight_loss/", name="weight_loss")
     * localhost:8000/training_programs/weight_loss/
     */
    public function weightLoss()
    {
        $repository = $this->getDoctrine()->getRepository(Training::class);
        $lossTrain = $repository->findBy(
            ['category' => 'perdre poids']
        );

        return $this->render('training/weight_loss.html.twig', ['trainings' => $lossTrain ]);

    }

    /**
     * displays training to gain muscle
     * @Route("/training_programs/muscle_gain/", name="muscle_gain")
     * localhost:8000/training_programs/muscle_gain/
     */
    public function muscleGain()
    {
        $repository = $this->getDoctrine()->getRepository(Training::class);
        $muscleTrain = $repository->findBy(
            ['category'=>'prise masse']
        );

        return $this->render('training/muscle_gain.html.twig', ['trainings' => $muscleTrain ]);

    }

    /**
     * displays training to keep fit
     * @Route("/training_programs/keep_fit/", name="keep_fit")
     * localhost:8000/training_programs/keep_fit/
     */
    public function keepFit()
    {
        $repository = $this->getDoctrine()->getRepository(Training::class);
        $fitTrain = $repository->findBy(
            ['category'=>'garder la ligne']
        );
        return $this->render('training/keep_fit.html.twig', ['trainings' => $fitTrain ]);

    }


}
