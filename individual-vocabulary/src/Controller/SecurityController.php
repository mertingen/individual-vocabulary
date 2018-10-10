<?php
/**
 * Created by IntelliJ IDEA.
 * User: mert
 * Date: 5/13/18
 * Time: 2:58 PM
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('vocabulary-list');
        }
        return $this->render('security/auth.html.twig');
    }

    /**
     * @Route("/logout", name="logout")
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return void
     */
    public function logout(Request $request, AuthenticationUtils $authenticationUtils)
    {
    }


}