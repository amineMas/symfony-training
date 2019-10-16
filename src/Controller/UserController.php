<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Training;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * profile page
     * @Route("/profile", name="profile")
     */
    public function profile()
    {
        return $this->render('user/profile.html.twig');
    }

    /**
     * update profile
     * @Route("/profile/update/{id}", name="profile_update")
     */
    public function profileUpdate($id)
    {
        return $this->render('user/profile_update.html.twig');
    }


     /**
     * @Route("/registration", name="registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user, array());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //crypter le mdp
            $password_crypte = $encoder -> encodePassword($user, $user ->getPassword());
            $user -> setPassword($password_crypte);

            // enregistrer dans la BDD
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('login');
        }

        return $this->render('user/register.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    

    /**
     * @Route("/purchase/{idTraining}", name="purchase")
     */
    public function purchase($idTraining)
    {
        $user = $this -> getUser(); // utilisateur connecté

        
        $em = $this -> getDoctrine() -> getManager();
        $training = $em -> find(Training::class, $idTraining);
        
        $user -> addTraining($training);
        $em -> persist($user);
        $em -> flush();

         $this->addFlash(
             'notice',
             'Votre programme a été ajouté avec succès'
         );
        

        return $this->redirectToRoute('profile');
    
        
        return $this -> render('training/purchase_validation.html.twig', [
            'user' => $user,
            'training' => $training
        ]);

       
    }
}
