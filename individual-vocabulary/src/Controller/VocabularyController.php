<?php

namespace App\Controller;

use App\Entity\Vocabulary;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VocabularyController
 * @package App\Controller
 *
 * @Route("/vocabulary")
 * @Security("has_role('ROLE_USER')")
 */
class VocabularyController extends AbstractController
{
    /**
     * @Route("/add", name="vocabulary-add")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function add(Request $request, EntityManagerInterface $entityManager)
    {
        if ($request->isMethod('POST')) {
            $foreignWord = $request->request->get('foreignWord', null);
            $knownMean = $request->request->get('knownMean', null);
            if (empty($foreignWord) || empty($knownMean)) {
                return $this->json(array(
                    'status' => false,
                    'message' => 'Foreign word and known-mean are must sent!',
                    'data' => array()
                ));
            }

            $user = $entityManager->getRepository('App:User')->findOneBy(array('id' => $this->getUser()->getId()));

            $vocabulary = new Vocabulary();
            $vocabulary->setForeignWord($foreignWord);
            $vocabulary->setKnownMean($knownMean);
            $vocabulary->setUser($user);

            $entityManager->persist($vocabulary);
            $entityManager->flush();

            return $this->json(
                array(
                    'status' => true,
                    'message' => 'Vocabular is added!',
                    'data' => array()
                )
            );
        }

        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/list", name="vocabulary-list")
     */
    public function list()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/list-items", name="vocabulary-list-items")
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function listItems(EntityManagerInterface $entityManager)
    {
        $user = $entityManager->getRepository('App:User')->findOneBy(array('id' => $this->getUser()->getId()));

        $vocabularies = $entityManager->getRepository('App:Vocabulary')->findBy(array('user' => $user));

        $items = array();
        foreach ($vocabularies as $vocabulary) {
            $items[] = array(
                'foreignWord' => $vocabulary->getForeignWord(),
                'knownMean' => $vocabulary->getKnownMean(),
                'htmlContent' => '<button v-on:click="say(\'hi\')" type="button" href="' . $vocabulary->getId() . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i>
                            </button>  <button type="button" href="' . $vocabulary->getId() . '" class="btn btn-info btn-circle"><i class="fa fa-trash"></i>
                            </button>'
            );
        }

        return $this->json(array(
            'status' => true,
            'message' => '',
            'data' => $items
        ));

    }
}
