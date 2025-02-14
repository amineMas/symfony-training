<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        
        return $this -> render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
            ]);
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
