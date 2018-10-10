<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 *
 * @Route("/user")
 * @Security("has_role('ROLE_USER')")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/setting", name="setting", methods={"GET"})
     */
    public function setting()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/postSetting", name="post_setting", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function postSetting(Request $request, EntityManagerInterface $entityManager)
    {
        $language = $request->request->get('language');
        if (empty($language)) {
            return new JsonResponse(array(
                'status' => false,
                'message' => 'Language value is required!',
                'data' => array()
            ));
        }

        $user = $entityManager->getRepository('App:User')->findOneBy(array('id' => $this->getUser()->getId()));
        $user->setTargetLanguage($language);
        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(array(
            'status' => true,
            'message' => 'User is updated successfully!',
            'data' => $user
        ));

    }

    /**
     * @Route("/get", name="get_user", methods={"GET"})
     * @return JsonResponse
     */
    public function fetchUser()
    {
        return new JsonResponse(
            array(
                'status' => true,
                'message' => 'User data.',
                'data' => $this->getUser()
            )
        );

    }
}
