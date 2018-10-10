<?php
/**
 * Created by IntelliJ IDEA.
 * User: mert
 * Date: 10/9/18
 * Time: 2:55 PM
 */

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Google\Cloud\Translate\TranslateClient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class QuizController
 * @package App\Controller
 * @Route("/quiz")
 * @Security("has_role('ROLE_USER')")
 */
class QuizController extends AbstractController
{
    /**
     * @Route("/quiz", name="quiz")
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/check", name="quiz-check", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * It receives 2 variables. They are comparing each other.
     */
    public function check(Request $request)
    {
        $foreignWord = $request->request->get('foreignWord', null);
        $yourKnown = $request->request->get('yourKnown', null);
        if (empty($foreignWord) || empty($yourKnown)) {
            return $this->json(array(
                'status' => false,
                'message' => 'Foreign word and known-mean are must sent!',
                'data' => array()
            ));
        }

        $translate = new TranslateClient();
        $result = $translate->translate($foreignWord, [
            'target' => (!empty($this->getUser()->getTargetLanguage())) ? $this->getUser()->getTargetLanguage() : 'en',
        ]);

        similar_text($yourKnown, $result['text'], $perc);

        //if (soundex($result['text']) === soundex($yourKnown)) {
        if (strpos($result['text'], $yourKnown) !== false || intval($perc) > 70) {
            return $this->json(array(
                'status' => true,
                'message' => 'Successful!',
                'data' => array(
                    'result' => true,
                    'mean' => $result['text']
                )
            ));
        } else {
            return $this->json(array(
                'status' => true,
                'message' => 'Incorrect!',
                'data' => array(
                    'result' => false,
                    'mean' => $result['text']
                )
            ));
        }


    }

    /**
     * @Route("/random-word", methods={"GET"}, name="quiz-random-word")
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * It returns the user's random word
     */
    public function getRandomWord(EntityManagerInterface $entityManager)
    {
        $user = $entityManager->getRepository('App:User')->findOneBy(array('id' => $this->getUser()->getId()));
        $vocabularies = $entityManager->getRepository('App:Vocabulary')->findBy(array('user' => $user));
        $response = array(
            'foreignWord' => $vocabularies[array_rand($vocabularies)]->getForeignWord()
        );

        return $this->json(array(
            'status' => true,
            'message' => '',
            'data' => $response
        ));

    }

}