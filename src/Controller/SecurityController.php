<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $auth)
    {
        $lastUsername = $auth -> getLastUserName();
        $error = $auth -> getLastAuthenticationError();

        if(!empty($error)){
            $this -> addFlash('error', 'Problème d\'identifiant');
        }

        return $this -> render('security/login.html.twig', ['lastUsername' => $lastUsername]);
    }





    //// Pour logout et logincheck il faut juste créer les routes avec des fonctions vides




    /**
     * @Route("/logout", name="logout")
     * 
     */
    public function logout(){}


    /**
	* @Route("/login_check", name="login_check")
	*
	*/
	public function loginCheck(){}


}
